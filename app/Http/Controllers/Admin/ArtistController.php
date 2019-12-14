<?php

namespace App\Http\Controllers\Admin;
use App\Repository\ArtistRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    private $artistRepository;

    public function __construct(ArtistRepositoryInterface $artistRepository)
    {
        $this->artistRepository = $artistRepository;

    }

    public function index()
    {
        return view('admin.artist.index', ['artists' => $this->artistRepository->getList()]);
    }

    public function getAdd()
    {
        return view('admin.artist.form');
    }

    public function getEdit($id)
    {
        return view("admin.artist.form", ['artist' => $this->artistRepository->getEdit($id)]);
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
        $this->artistRepository->add($request);
        return redirect()-> route('Admin::artist@index')->with('Notice', 'Successfully add!');

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

        $this->artistRepository->update($request, $id);
        return redirect()-> route('Admin::artist@index')->with('Notice', 'Successfully Edit');
    }

    public function getDelete($id)
    {
        $this->artistRepository->delete($id);
        return redirect()-> route('Admin::artist@index')->with("Notice", "Successfully Delete");
    }

}
