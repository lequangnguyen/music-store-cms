<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Products;
use App\Repository\ArtistRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    private $categoryRepository;

    public function __construct( CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request )
    {

        return view('admin.statistic.index',[
            'categories' => $this->categoryRepository->getListCategory()
        ]);
    }

    public function getStatistic(Request $request, OrderDetail $orderDetail)
    {
        $date_range = $request->get("date-range");
        $date_range = explode(" - ", $date_range);
        $start_time = date('Y-m-d 00:00:00', strtotime($date_range[0]));
        $end_time = date('Y-m-d 23:59:59', strtotime($date_range[1]));
        $cate_id = $request->get("cate_id") ?: null;
        $orders = DB::table('orders')
            ->whereBetween('finish_day', [$start_time, $end_time])->pluck('id')->toArray();
//        dd($orders);
        $orderDetail = $orderDetail->newQuery();
        $query = [];
//        $orderDetail->leftJoin('orders', 'order_detail.order_id', '=', 'orders.id')
//            ->leftJoin('products', 'order_detail.product_id', '=', 'products.id')
//            ->select('products.id as product_id','products.name as product_name', 'orders.id as order_id', "order_detail.quantity as quantity")
//            ->whereIn('order_id', $orders)
//        ;
//        $statistic = $orderDetail->get();
        $statistics = OrderDetail::groupBy('product_id')
            ->selectRaw('sum(quantity) as quantity_sum, sum(cost) as cost_sum, product_id')
            ->whereIn('order_id', $orders)
            ->get();
        $data = [];
        $total_cost = 0;
        $total_quantity = 0;
        foreach ($statistics as $statistic) {
            $product = Products::find($statistic->product_id);
            if($cate_id and $product->category_id != $cate_id)
            {
                continue;
            }
            $category = Categories::find($product->category_id);
            $statistic->cate_id = $category->id;
            $statistic->cate_name = $category->name;
            $data[] = $statistic;
            $total_cost += $statistic->cost_sum;
            $total_quantity += $statistic->quantity_sum;
        }
        dd($data, $total_quantity, $total_cost);
    }
}	
