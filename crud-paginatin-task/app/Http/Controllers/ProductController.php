<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        // $products = Product::whereHas('brand', function (Builder $query){
        //     $query -> where('name', 'Brand 1');
        // }) -> get();

        // $products -> load('brand');
        // return $products;



        $num_rows = $request -> all()['num_rows'] ?? 10;
        $page = $request -> all()['page'] ?? 1;
        $sort_column = $request -> all()['sort_column'] ?? 'id';
        $sort_direction = $request -> all()['sort_direction'] ?? 'ASC';
        

        $count = Product::count();
        // dd($count);
        $total_pages = ceil($count / $num_rows);
        // dd($total_pages);
        

        if ($page > $total_pages){
            $page = $total_pages;
        }

        $skip = ($page - 1) * $num_rows;
        $products = Product::select('*') -> orderBy($sort_column, $sort_direction) -> skip($skip) -> take($num_rows)->get();
        $products -> load('category');
        $products -> load('brand');
        return [
            'num_rows' => $num_rows,
            'page' => $page,
            'count' => $count,
            'total_pages' => $total_pages,
            'sort_column' => $sort_column,
            'sort_direction' => $sort_direction,
            'data' => $products
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $dta = $request -> validated();
        $product = Product::make($dta);
        $product -> status = 1;
        $product -> save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product -> update_url = route('product.update', ['product' => $product]);
        $product -> delete_url = route('product.destroy', ['product' => $product]);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCreateRequest $request, Product $product)
    {
        $validated = $request -> validated();
        $product -> name = $validated['name'];
        $product -> category_id  = $validated['category_id'];
        $product -> brand_id = $validated['brand_id'];
        $product -> stock = $validated['stock'];
        $product -> price = $validated['price'];
        $product -> description = $validated['description'];
        $product -> save();
        return $product;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product -> delete();
        return "Success";
    }
}
