<?php

namespace App\Repository;

use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{

    public function addProduct(Request $request)
    {
        $product = new Products();
        $path = "upload/product_image";
        //main_picture
        if ($request->hasFile('main_picture')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $filename;
            while (file_exists($path . $image)) {
                $image = Str::random(4) . "_" . $filename;
            }
            $file->move($path, $image);
            if (!empty($product->image)) {
                unlink($path . "/" . $product->image);
            }
            $product->image = $image;

        } else {
            $product->image = "";
        }



        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
    }

    public function updateProduct(Request $request, $id)
    {
        // TODO: Implement updateProduct() method.
        $product = Products::find($id);
        $path = "upload/product_image";
        //main_picture
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $image = Str::random(4) . "_" . $filename;
            while (file_exists($path . $image)) {
                $image = Str::random(4) . "_" . $filename;
            }
            $file->move($path, $image);
            if (!empty($product->image)) {
                unlink($path . "/" . $product->image);
            }
            $product->image = $image;
        }
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
    }

    public function getListProducts()
    {
        // TODO: Implement getListProducts() method.
        $products = DB::table('products')
            ->orderBy('id','desc')
            ->paginate(15);
        return $products;
    }
    public function getListProductsByCategoryId($id)
    {
        // TODO: Implement getListProductsByCategoryId() method.
        $products = DB::table('products')
            ->where('category_id', '=',$id)->get();

        return $products;
    }

    public function getProduct($id)
    {
        // TODO: Implement getProduct() method.
        $product = Products::find($id);
        return $product;
    }
    public function searchProducts($id, $search)
    {
        $products = DB::table('products')
            ->where([['category_id', '=',$id],['name','like','%'.$search.'%']])
            ->get();
        return $products;
    }
}
