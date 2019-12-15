<?php

namespace App\Repository;

use App\Models\Products;
use App\Services\ImageServicesInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductRepository implements ProductRepositoryInterface
{
    private $imageServices;

    public function __construct(ImageServicesInterface $imageServices)
    {
        $this->imageServices = $imageServices;
    }
    public function addProduct(Request $request)
    {
        $product = new Products();
        $path = "/product_images/";
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
            $request->file('image')->storeAs('public/product_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/product_images/'.$smallthumbnail);
            $this->imageServices->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($product->image)) {
                unlink(public_path('storage' . $product->image));
            }
            $product->image = $path.$smallthumbnail;
        }else {
            $product->image = "";
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->artist_id = $request->artist_id;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->start_time = $request->start_time;
        $product->end_time = $request->end_time;
        $product->release_year = $request->release_year;
        $product->price = $request->price;
        $product->save();
    }

    public function updateProduct(Request $request, $id)
    {
        // TODO: Implement updateProduct() method.
        $path = "/product_images/";
        $product = Products::find($id);
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
            $request->file('image')->storeAs('public/product_images/', $smallthumbnail);
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/product_images/'.$smallthumbnail);
            $this->imageServices->createThumbnail($smallthumbnailpath, 250, 300);

            if (!empty($product->image)) {
                unlink(public_path('storage' . $product->image));
            }
            $product->image = $path.$smallthumbnail;
        }
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->artist_id = $request->artist_id;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->start_time = $request->start_time;
        $product->end_time = $request->end_time;
        $product->release_year = $request->release_year;
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
