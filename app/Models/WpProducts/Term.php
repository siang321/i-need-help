<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_terms";
    protected $primaryKey = 'term_id';



    public function term_meta(){
      return $this->hasMany(TermMeta::class, 'term_id');
    }

    
}
