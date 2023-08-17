<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandDetailResource;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::latest("id")->paginate(5)->withQueryString();
        return BrandResource::collection($brand);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'information' => 'required',
            'photos' => 'required',

        ]);
        $brand = Brand::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'company' => $request->company,
            'information' => $request->information,
            'photos' => $request->photos
        ]);

        return response()->json([
            'message' => 'Created Successfully',
            'data' => $brand,
        ]);

        return new BrandDetailResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if(is_null($brand)){
            return response()->json([
                'message' => 'Not Found',
            ]);
        }
        return new BrandDetailResource($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "company" => "required",
            "information" => "required",
            'photos' => "required"
        ]);
        $brands = Brand::find($id);
        if(is_null($brands)){
            return response()->json([

                "message" => "Brand not found",

            ],404);
        };
        if($request->has('name')){
            $brands->name = $request->name;
        }
        if($request->has('company')){
            $brands->company = $request->company;
        }
        if($request->has('information')){
            $brands->information = $request->information;
        }
        if($request->has('photos')){
            $brands->photos = $request->photos;
        }
        $brands->update();

        return new BrandDetailResource($brands);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if (is_null($brand)) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
        // if (Gate::denies('delete', $brand)) {
        //     return response()->json([
        //         'message' => 'you are no allowed',
        //     ]);
        // }
        $brand->delete();

        return response()->json([
            'message' => 'Brand Delete Successfully',
        ]);
    }
}
