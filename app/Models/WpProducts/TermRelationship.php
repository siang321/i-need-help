<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_term_relationships";

    public function product()
    {
      return $this->belongsTo(Product::class, 'object_id');
    }

    // Term taxonomy can get category
    public function term_taxonomy()
    {
      return $this->belongsTo(TermTaxonomy::class, 'term_taxonomy_id');
    }
}
