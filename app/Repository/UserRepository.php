<?php

namespace App\Repository;

use App\Models\Users;
use Illuminate\Support\Facades\DB;


class UserRepository implements UserRepositoryInterface
{

    public function addUser($data)
    {
        // TODO: Implement addUser() method.
        $user = new Users();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->save();


    }

    public function updateUser($data, $id)
    {
        // TODO: Implement editUser() method.
        $user = Users::find($id);
        $user->name = $data->name;
        $user->email = $data->email;
        if ($data->password) {
            $user->password = bcrypt($data->password);
        }

        $user->save();
    }

    public function deleteUser($id)
    {
        // TODO: Implement deleteUser() method.
        $user = Users::find($id);
        $user->delete();
    }

    public function getList()
    {
        // TODO: Implement getList() method.
        $users = DB::table('users')->whereNull('deleted_at')->paginate(10);
        return $users;

    }

    public function getEdit($id)
    {
        // TODO: Implement getEdit() method.
        $user = Users::find($id);
        return $user;
    }
}