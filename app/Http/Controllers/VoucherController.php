<?php

namespace App\Http\Controllers;


use App\Http\Resources\VoucherDetailRescource;
use App\Http\Resources\VoucherResource;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voucher = Voucher::latest("id")->paginate(5)->withQueryString();
        return VoucherResource::collection($voucher);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Voucher::find($id);
        if (is_null($product)) {
            return response()->json([
                "message" => "Not Found Voucher"
            ]);
        }
        return new VoucherDetailRescource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voucher = Voucher::find($id);
        if (is_null($voucher)) {
            return response()->json([
                "message" => "there is no voucher"
            ]);
        };

        $voucher->update([
            "customer" => $request->customer,
            "phone" => $request->phone,
            "voucher_number" => $request->voucher_number,
            "total" => $request->total,
            "tax" => $request->total * ($request->tax / 100),
            "net_total" => $request->total + $request->total * ($request->tax / 100),
            "user_id" => $request->user_id,
        ]);

        $voucher->update();

        return response()->json([
            "message" => "Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::find($id);
        if (is_null($voucher)) {
            return response()->json([
                "message" => "Voucher Not found",
            ], 404);
        }
        $voucher->delete();
        return response()->json([
            "message" => "Voucher is Deleted."
        ]);

    }
}
