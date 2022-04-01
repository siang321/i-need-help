<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Models\WpProducts\Product;
use App\Models\WpProducts\TermMeta;
use App\Models\WpProducts\TermTaxonomy;
use App\Models\WpProducts\Term;
use App\Models\WpProducts\Post;
use App\Http\Resources\WpProducts\CategoryResource;
use App\Http\Resources\WpProducts\ProductResource;



class ProductController extends Controller
{
    public function index(Request $request){

      $category_id = $request->category_id;
      $category = TermTaxonomy::find($category_id);
      // $products = $category->products;
      return $category;

      // return $products->product_image;

      return parent::response_method(200, "Success", ProductResource::collection($products)->response()->getData(true));
    }

    public function get_all_products()
    {
      // not using, move to home
      $products = Post::where('post_type', 'product')->where('post_status', 'publish')->paginate(20);

      return parent::response_method(200, "Success", ProductResource::collection($products)->response()->getData(true));

    }

    public function get_products(Request $request){

      $category_id = $request->category_id;
      $sort_by = $request->sort_by ? $request->sort_by : 'a-z';

      $sort_by_arr = ['a-z' => 'asc', 'z-a' => 'desc'];

      $category = TermTaxonomy::find($category_id);

      $products = $category->all_products()->orderBy('post_title', $sort_by_arr[$sort_by])->get();

      return parent::response_method(200, "Success", ProductResource::collection($products));
    }

    public function categories(){
      $categories = TermTaxonomy::where('taxonomy', 'product_cat')->where('parent', 0)->whereNotIn('description', [''])->whereNotNull('description')->get();


      return parent::response_method(200, "Success", CategoryResource::collection($categories));

    }

    public function sample()
    {
      // $categories = TermTaxonomy::where('taxonomy', 'product_cat')->where('parent', 0)->whereNotIn('description', [''])->whereNotNull('description')->get();
      // $categories = TermTaxonomy::with(['term'])
      //               ->where('taxonomy', 'product_cat')->where('parent', 0)
      //               ->whereHas('term', fn($query) => $query
      //               ->whereHas('term_meta', fn($query) => $query
      //               ->where('meta_key', 'order')
      //               ->where('meta_value', '>=', 2)
      //                 )->join('wp_termmeta', 'wp_termmeta.term_id', '=', 'wp_terms.term_id' ))
      //               ->get();

      // $categories = TermTaxonomy::query()
      //               ->where('taxonomy', 'product_cat')->where('parent', 0)
      //               ->whereHas('term', fn($query) => $query
      //               ->whereHas('term_meta', fn($query) => $query
      //               ->where('meta_key', 'order')
      //               ->where('meta_value', '>=', 2)
      //               ->orderBy('meta_value')))
      //               ->get();
    }
}
