<?php

namespace App\Repository;

use App\Models\OrderDetail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;


class OrderRepository implements OrderRepositoryInterface
{

    public function getList()
    {
        // TODO: Implement getList() method.
        $orders = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->paginate(10);
        return $orders;

    }

    public function getOrderDetailById($order_id)
    {
        // TODO: Implement getOrderDetailById() method.
        $orderDetails = new OrderDetail();
        $orderDetails = $orderDetails->newQuery();
        $results = $orderDetails->leftJoin('products', 'order_detail.product_id', '=', 'products.id')
            ->leftJoin('orders', 'order_detail.order_id', '=', 'orders.id')
//            ->leftJoin('users', 'order_detail.user_id', '=', 'users.id')
            ->select('order_detail.*', 'products.name as product_name', 'orders.code as order_code', 'orders.user_id as user_id', 'products.price as price')
            ->where('order_detail.order_id', $order_id)->get();
        return [$results, array_sum($results->pluck('cost')->toArray())];

    }
}
