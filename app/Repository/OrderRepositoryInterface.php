<?php
/**
 * Created by PhpStorm.
 * User: NGUYENIT
 * Date: 18/03/2018
 * Time: 9:21 CH
 */

namespace App\Repository;


interface OrderRepositoryInterface
{
    public function getList();
    public function getOrderDetailById($order_id);
}
