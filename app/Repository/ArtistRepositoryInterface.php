<?php

namespace App\Repository;


use Illuminate\Http\Request;

interface ArtistRepositoryInterface
{
    public function add(Request $request);

    public function update(Request $request, $id);

    public function delete($id);

    public function getList();

    public function getEdit($id);

}
