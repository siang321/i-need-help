<?php

namespace App\Models\WpProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory;

    protected $connection = 'wp_product_mysql';
    protected $table = "wp_postmeta";
    protected $primaryKey = 'meta_id';

    public function post()
    {
      return $this->belongsTo(Post::class, 'post_id');
    }

}
