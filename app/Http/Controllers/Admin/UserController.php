<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function index()
    {
        return view('admin.user.index', ['users' => $this->userRepository->getList()]);
    }

    public function getAdd()
    {
        return view('admin.user.form');
    }

    public function getEdit($id)
    {
        return view("admin.user.form", ['user' => $this->userRepository->getEdit($id)]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2|unique:users,name',
                'email' => 'required',
                'password' => 'required',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required' => 'Please input name field',
                'name.min' => 'Name has at least 2 characters',
                'email.required' => 'Please input email field',
                'name.unique' => 'Name has existed',
                'password.required' => 'Please input password',
                'password.min' => 'Password has at least 6 characters',
                'password.max' => 'Password has max of 32 characters',
                "passwordAgain.required" => 'Please input password once more time to confirm',
                "passwordAgain.same" => 'Password confirmed is not match',
            ]);
        $this->userRepository->addUser($request);
        return redirect()-> route('Admin::user@index')->with('Notice', 'Successfully add!');

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:2',
                'email' => 'required|email',
                'passwordAgain' => 'same:password'
            ],
            [
                'name.required' => 'Please input name field',
                'name.min' => 'Name has at least 2 characters',
                'email.required' => 'Please input email field',
                'email.email' => 'invalid email format',
                "passwordAgain.same" => 'Password confirmed is not match',
            ]);

        $this->userRepository->updateUser($request, $id);
        return redirect()-> route('Admin::user@index')->with('Notice', 'Successfully Edit');
    }

    public function getDelete($id)
    {

        $this->userRepository->deleteUser($id);
        return redirect()-> route('Admin::user@index')->with("Notice", "Successfully Delete");
    }
}	
