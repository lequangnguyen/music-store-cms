<?php

namespace App\Repository;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function addCategory(Request $request)
    {
        // TODO: Implement addCategory() method.
        $category = new Categories();
        $path = "/category_images/";
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
            $request->file('image')->storeAs('public/category_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/category_images/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($category->image)) {
                unlink(public_path('storage' . $category->image));
            }
            $category->image = $path.$smallthumbnail;
        }else {
            $category->image = "";
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
    }

    public function updateCategory(Request $request, $id)
    {
        // TODO: Implement updateCategory() method.
        $category = Categories::find($id);
        $path = "/category_images/";
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
            $request->file('image')->storeAs('public/category_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/category_images/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($category->image)) {
                unlink(public_path('storage' . $category->image));
            }
            $category->image = $path.$smallthumbnail;
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
    }

    public function deleteCategory($id)
    {
        // TODO: Implement deleteCategory() method.
        $category = Categories::find($id);
        $category->delete();
    }

    public function getListCategory()
    {
        // TODO: Implement getListCategory() method.
        $categories = DB::table('categories')->paginate(10);
        return $categories;
    }

    public function getEditCategory($id)
    {
        // TODO: Implement getEditCategory() method.
        $category = Categories::find($id);
        return $category;
    }
}
