<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoDetailResource;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $photo = Photo::latest("id")->paginate(5)->withQueryString();
        return PhotoResource::collection($photo);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $savedPhotos = [];
            foreach ($photos as $photo) {
                $savedPhoto = $photo->store("public/photo");
                $savedPhotos[] = [
                    "photo" => $request->photo_id,
                    "address" => $savedPhoto,
                    'user_id' => Auth::id(),
                    "created_at" => now(),
                    "updated_at" => now()

                ];
            }
            Photo::insert($savedPhotos);
            //  foreach($photos as $photo){
            //     $savedPhoto = $photo->store("public/photo");
            //     $savedPhotos [] = [ "address" => $savedPhoto];
            //  }
            //  $article->photos()->createMany($savedPhotos);
        }
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        return response()->json([
            'message' => 'Photo deleted successfully'
        ]);
    }
}
