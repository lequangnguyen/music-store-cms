<?php

namespace App\Http\Controllers\Admin;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

    }

    public function index()
    {
        return view('admin.category.index', ['categories' => $this->categoryRepository->getListCategory()]);
    }

    public function getAdd()
    {
        return view('admin.category.form');
    }

    public function getEdit($id)
    {
        return view("admin.category.form", ['category' => $this->categoryRepository->getEditCategory($id)]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Please input name field',
            ]);
        $this->categoryRepository->addCategory($request);
        return redirect()-> route('Admin::category@index')->with('Notice', 'Successfully add!');

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',

            ],
            [
                'name.required' => 'Please input name field',

            ]);

        $this->categoryRepository->updateCategory($request, $id);
        return redirect()-> route('Admin::category@index')->with('Notice', 'Successfully Edit');
    }

    public function getDelete($id)
    {
        $this->categoryRepository->deleteCategory($id);
        return redirect()-> route('Admin::category@index')->with("Notice", "Successfully Delete");
    }

}