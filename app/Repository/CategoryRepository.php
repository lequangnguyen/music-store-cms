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
        $path = "upload/category_image";
        $category->name = $request->name;
        $category->description = $request->description;
        //image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $filename;
            while (file_exists($path . $image)) {
                $image = Str::random(4) . "_" . $filename;
            }
            $file->move($path, $image);
            $category->image = $image;

        } else {
            $category->image = "";
        }
        $category->save();
    }

    public function updateCategory(Request $request, $id)
    {
        // TODO: Implement updateCategory() method.
        $category = Categories::find($id);
        $path = "upload/category_image";
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $filename;
            while (file_exists($path . $image)) {
                $image = Str::random(4) . "_" . $filename;
            }
            $file->move($path, $image);
            if (!empty($category->image)) {
                unlink($path . "/" . $category->image);
            }
            $category->image = $image;

        }
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
