<?php
/**
 * Created by PhpStorm.
 * User: NGUYENIT
 * Date: 18/03/2018
 * Time: 9:21 CH
 */

namespace App\Repository;


interface UserRepositoryInterface
{
    public function addUser($data);

    public function updateUser($data, $id);

    public function deleteUser($id);

    public function getList();

    public function getEdit($id);


}