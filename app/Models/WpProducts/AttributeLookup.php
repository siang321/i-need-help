<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeLookup extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_wc_product_attributes_lookup";

    public function post()
    {
      return $this->belongsTo(Post::class, 'product_id');
    }

    public function term()
    {
      return $this->belongsTo(Term::class, 'term_id');
    }
}
