<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ProductRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    public function index()
    {
        return view('admin.product.index', ['products' => $this->productRepository->getListProducts(),'categories'=>$this->categoryRepository->getListCategory()]);
    }

    public function getAdd()
    {
        return view('admin.product.form',['categories'=>$this->categoryRepository->getListCategory()]);
    }

    public function getEdit($id)
    {
        return view("admin.product.form", ['product' => $this->productRepository->getProduct($id),'categories'=>$this->categoryRepository->getListCategory()]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Please input name field',
                'category_id.required' => 'Please choose name category',

            ]);



       $this->productRepository->addProduct($request);
        return redirect()-> route('Admin::product@index') ->with('Notice', 'Successfully added!');

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Please input name field',
                'category_id.required' => 'Please choose name category',

            ]);
        $this->productRepository->updateProduct($request, $id);
        return redirect()-> route('Admin::product@index') ->with('Notice', 'Successfully Updated');
    }

    public function getDelete($id)
    {
        $this->productRepository->deleteProduct($id);
        return redirect()-> route('Admin::product@index')->with("Notice", "Successfully Deleted");
    }


}	
