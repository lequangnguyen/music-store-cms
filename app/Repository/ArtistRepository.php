<?php

namespace App\Repository;

use App\Models\Artists;
use App\Services\ImageServicesInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistRepository implements ArtistRepositoryInterface
{
    private $imageServices;

    public function __construct(ImageServicesInterface $imageServices)
    {
        $this->imageServices = $imageServices;
    }
    public function add(Request $request)
    {
        // TODO: Implement addCategory() method.
        $artist = new Artists();
        $path = "/artist_images/";
        //main_picture
        if ($request->hasFile('image')) {
            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;
            //Upload File
            $request->file('image')->storeAs('public/artist_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/artist_images/'.$smallthumbnail);
            $this->imageServices->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($artist->image)) {
                unlink(public_path('storage' . $artist->image));
            }
            $artist->image = $path.$smallthumbnail;
        }else {
            $artist->image = "";
        }
        $artist->name = $request->name;
        $artist->type = $request->type;
        $artist->description = $request->description;
        $artist->save();
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement updateCategory() method.
        $artist = Artists::find($id);
        $path = "/artist_images/";
        //main_picture
        if ($request->hasFile('image')) {
            //get filename with extension
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;
            //Upload File
            $request->file('image')->storeAs('public/artist_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/artist_images/'.$smallthumbnail);
            $this->imageServices->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($artist->image)) {
                unlink(public_path('storage' . $artist->image));
            }
            $artist->image = $path.$smallthumbnail;
        }
        $artist->name = $request->name;
        $artist->type = $request->type;
        $artist->description = $request->description;
        $artist->save();
    }

    public function delete($id)
    {
        // TODO: Implement deleteCategory() method.
        $artist = Artists::find($id);
        $artist->delete();
    }

    public function getList()
    {
        // TODO: Implement getListCategory() method.
        $artists = DB::table('artists')->paginate(10);
        return $artists;
    }

    public function getEdit($id)
    {
        // TODO: Implement getEditCategory() method.
        $artist = Artists::find($id);
        return $artist;
    }
}
