<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_term_taxonomy";
    protected $primaryKey = 'term_taxonomy_id';


    public function term()
    {
      return $this->belongsTo(Term::class, 'term_id');
    }

    public function parent_term()
    {
      return $this->belongsTo(TermTaxonomy::class, 'parent');
    }

    public function children_terms()
    {
      return $this->hasMany(TermTaxonomy::class, 'parent')->whereNotIn('description', ['']);
    }

    public function products()
    {
      return $this->belongsToMany(Post::class, "wp_term_relationships", 'term_taxonomy_id', 'object_id')->where('post_status', 'publish')->where('post_type', 'product');
    }

    public function all_products()
    {
      $subcategory_ids = $this->children_terms()->select('term_taxonomy_id')->get()->modelKeys();
      $product_ids = TermRelationship::whereIn('term_taxonomy_id', $subcategory_ids)->orWhere('term_taxonomy_id', $this->term_taxonomy_id)->pluck('object_id')->toArray();
      return Post::where('post_status', 'publish')->where('post_type', 'product')->whereIn('ID', $product_ids);

    }

}
