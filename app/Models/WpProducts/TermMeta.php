<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermMeta extends Model
{
    use HasFactory;
    protected $connection = 'wp_product_mysql';
    protected $table = "wp_termmeta";
    protected $primaryKey = 'meta_id';

    // Category need to get order = 2, subcategory get order = 3


    public function term()
    {
      return $this->belongsTo(Term::class, 'term_id');
    }
}
