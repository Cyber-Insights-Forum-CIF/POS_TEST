<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Illuminate\Events\queueable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest("id")->paginate(5)->withQueryString();
        return ProductResource::collection($products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'actual_price' => 'required',
            'sales_price' => 'required',
            'total_stock' => 'nullable',
            'unit' => 'required',
            'more_information' => 'required',
            'user_id' => 'nullable',
            'photos' => 'nullable',
        ]);
//        return response()->json([
//            'message' => 'Created Successfully',
//            'data' => 'Output',
//        ]);
        $products = Product::create([

            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'actual_price' => $request->actual_price,
            'sales_price' => $request->sales_price,
            'total_stock' => $request->total_stock,
            'unit' => $request->unit,
            'more_information' => $request->more_information,
            'user_id' => $request->user_id,
            'photos' => $request->photos,
        ]);
        return new ProductDetailResource($products);





//        return new ProductDetailResource($products);
//        return $request;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id);
        if(is_null($products)){
            return response()->json([
                // "success" => false,
                "message" => "Product not found",

            ],404);
        }

        return new ProductDetailResource($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json([
                "message" => "there is no product"
            ]);
        };
        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->user_id = Auth::id();
        $product->actual_price = $request->actual_price;
        $product->sales_price = $request->sales_price;
        $product->unit = $request->unit;
        $product->more_information = $request->more_information;
//        $product->photo = Photo::find(1)->url;
        $product->photos = config('info.default_main_photo');

        $product->update();

//        return response()->json([
//            "message" => "Updated successfully"
//        ]);

        return new ProductDetailResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json([
                "message" => "product not found",

            ],404);
        }
        $product->delete();
        return response()->json([
            "message" => "product is deleted",
        ]);
    }
}
