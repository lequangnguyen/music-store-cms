<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use App\Repository\OrderRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    private $orderRepository;

    /**
     * UserController constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;

    }

    public function index(Request $request, Orders $orders)
    {
        $orders = $orders->newQuery();
        $query = [];
        $orders->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name');

        if ($request->input('code')) {
            $name = $request->input('code');
            $orders->where('orders.code', 'like', '%' . $name . '%');
            $query['name'] = $name;
        }
        if ($request->input('user_id')) {
            $user_id = $request->input('user_id');
            $orders->where('orders.user_id', '=', $user_id);
            $query['user_id'] = $user_id;
        }
        $orders = $orders->paginate(10);
        foreach ($orders as $order) {
            $order->detail = $this->detail($order->id);
        }

        return view('admin.order.index', ['orders' => $orders]);
    }

    public function detail($id)
    {
        $orderDetail = $this->orderRepository->getOrderDetailById($id);
        return $orderDetail;
//        dd($orderDetail);
//        return view("admin.user.form", ['user' => $this->orderRepository->getEdit($id)]);
    }

    public function changeStatus (Request $request){
        $order_id = $request->input('order_id');
        $status = $request->input('status');
        $order= Orders::find($order_id);
        $order->status = $status;
        $order->save();
        return  $order->status;
    }
//    public function getEdit($id)
//    {
//        return view("admin.user.form", ['user' => $this->orderRepository->getEdit($id)]);
//    }


//    public function update(Request $request, $id)
//    {
//        $this->validate($request,
//            [
//                'name' => 'required|min:2',
//                'email' => 'required|email',
//                'passwordAgain' => 'same:password'
//            ],
//            [
//                'name.required' => 'Please input name field',
//                'name.min' => 'Name has at least 2 characters',
//                'email.required' => 'Please input email field',
//                'email.email' => 'invalid email format',
//                "passwordAgain.same" => 'Password confirmed is not match',
//            ]);
//
//        $this->userRepository->updateUser($request, $id);
//        return redirect()-> route('Admin::user@index')->with('Notice', 'Successfully Edit');
//    }

}	
