<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Post extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_posts";
    protected $primaryKey = 'ID';

    protected $appends = ['product_attributes'];

    public function product_galleries()
    {
      return $this->hasMany(Post::class, 'post_parent')
                  ->where('post_type', 'attachment')
                  ->where('post_status', 'inherit')
                  ->whereIn('ID', $this->get_product_gallery_ids());
    }

    public function categories()
    {
      return $this->belongsToMany(TermTaxonomy::class, TermRelation::class, 'object_id', 'term_taxonomy_id')->where('taxonomy', 'prodcut_cat');
    }

    public function product_variations()
    {
      return $this->hasMany(Post::class, 'post_parent')
      ->where('post_type', 'product_variation')
      ->where('post_status', 'publish');
      // ->with(['product_post_meta' => function ($query)
      //   {
      //     $query->where('meta_key', 'like', '%pa%');
      //   }]);
    }

    public function getProductAttributesAttribute()
    {
      $arr = [];
      $return_arr = [];
      $product_variations = $this->product_variations;
      foreach($product_variations as $product_variation)
      {
        $product_attributes_lookup = $product_variation->product_attributes_lookup;
        foreach($product_attributes_lookup as $product_attribute)
        {
          if( isset($arr[$product_attribute->taxonomy]) )
          {
            array_push($arr[$product_attribute->taxonomy], $product_attribute->term->name);
          }
          else
          {
            $arr[$product_attribute->taxonomy] = array($product_attribute->term->name);
          }
        }
      }

      foreach($arr as $key => $value)
      {
        $json = [
          'name' => AttributeTaxonomy::get_label(str_replace('pa_', '', $key)),
          'options' => $value
        ];
        array_push($return_arr, $json);
      }

      return $return_arr;


    }

    public function product_attributes_lookup()
    {
      return $this->hasMany(AttributeLookup::class, 'product_id')->where('taxonomy', 'like', 'pa_%');
    }

    public function product_post_meta()
    {
      return $this->hasMany(PostMeta::class, 'post_id')->where('meta_key', 'like', 'attribute_pa_%');
    }

    public function get_product_gallery_ids(){
      $arr = array();
      $gallery_ids = PostMeta::where('meta_key', '_product_image_gallery')->where('post_id', $this->ID)->first();
      if(isset($gallery_ids))
      {
        $arr = explode(',', $gallery_ids->meta_value);
      }

      return $arr;
    }

    public function product_image(){
      $image_id = PostMeta::where('meta_key', '_thumbnail_id')->where('post_id', $this->ID)->first();
      return $this->hasOne(Post::class, 'post_parent')->where('ID', $image_id->meta_value);
    }

}
