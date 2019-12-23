<?php

namespace App\Repository;

use App\Models\Categories;
use App\Services\ImageServicesInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $imageServices;

    public function __construct(ImageServicesInterface $imageServices)
    {
        $this->imageServices = $imageServices;
    }

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
            $this->imageServices->createThumbnail($smallthumbnailpath, 1920, 300);

            if (!empty($category->image)) {
                unlink(public_path('storage' . $category->image));
            }
            $category->image = $path.$smallthumbnail;
        }else {
            $category->image = "";
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
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
            $this->imageServices ->createThumbnail($smallthumbnailpath, 1920, 300);

            if (!empty($category->image)) {
                unlink(public_path('storage' . $category->image));
            }
            $category->image = $path.$smallthumbnail;
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
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

    public function getListParentCategory()
    {
        // TODO: Implement getListCategory() method.
        $pr_categories = DB::table('categories')->whereNull('parent_id')->get();
        return $pr_categories;
    }

    public function getEditCategory($id)
    {
        // TODO: Implement getEditCategory() method.
        $category = Categories::find($id);
        return $category;
    }
}
