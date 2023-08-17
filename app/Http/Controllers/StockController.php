<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockDetailRescource;
use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::latest("id")->paginate(5)->withQueryString();
        if ($stocks->count()  === 0) {
            return response()->json([
                "message" => "No  Stock available"
            ]);
        }
        return StockResource::collection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock = new Stock();
        $stock->user_id = Auth::id();
        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;
        $stock->more = $request->more;

        $product = Product::where("id", $request->product_id)->first();
        if (is_null($product)) {
            return response()->json([
                "message" => "No Product"
            ],404);
        };
        $product->total_stock = $product->total_stock + $request->quantity;
        $product->update();

        $stock->save();

        return response()->json([
            "message" => "your product is ready to sell"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock = Stock::find($id);

        if (is_null($stock)) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }

        $stock->delete();

        return response()->json([
            'message' => 'Stock Delete Successfully',
        ]);
    }
}
