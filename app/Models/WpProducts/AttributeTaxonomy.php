<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTaxonomy extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_woocommerce_attribute_taxonomies";
    protected $primaryKey = 'attribute_id';


    public function post()
    {
      return $this->belongsTo(Post::class, 'post_id');
    }

    public function get_label($attribute_name)
    {
      $attribute = AttributeTaxonomy::where('attribute_name', $attribute_name)->first();
      if(isset($attribute))
      {
        return $attribute->attribute_label;
      }
      else
      {
        return "";
      }
    }
}
