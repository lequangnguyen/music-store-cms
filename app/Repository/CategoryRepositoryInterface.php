<?php

namespace App\Repository;


use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function addCategory(Request $request);

    public function updateCategory(Request $request, $id);

    public function deleteCategory($id);

    public function getListCategory();

    public function getEditCategory($id);

}