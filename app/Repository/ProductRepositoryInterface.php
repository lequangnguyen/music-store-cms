<?php

namespace App\Repository;


use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function addProduct( Request $request);
    public function updateProduct(Request $request, $id);
    public function getListProducts();
    public function getListProductsByCategoryId($id);
    public function getProduct($id);

    public function searchProducts($id, $search);

}
