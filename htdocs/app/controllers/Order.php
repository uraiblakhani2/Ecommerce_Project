<?php

namespace app\controllers;

use app\models\Coupon;
use app\models\OrderModel;

class Order extends \app\core\Controller
{
    public function create()
    {
        if (isset($_POST['newOrder'])) {
            $buyerId = $_SESSION['buyer_id'];
            $couponCode = $_POST['coupon_code'];

            //get all items from the cart
            $cartModel = new \app\models\Cart();
            $carts = $cartModel->getByBuyerId();

            $couponModel = new Coupon();
            $coupon = $couponModel->getByCode($couponCode);
            $discountPer = 0;
            if($coupon){
                $discountPer = $coupon->discount_per;
            }

            //create new order
            foreach ($carts as $cart){
                $order = new OrderModel();
                $order->buyer_id = $buyerId;
                $order->product_id = $cart->product_id;
                $order->qty = $cart->qty;
                $order->price = $cart->price;
                $order->order_date = date('Y-m-d');
                $order->order_status = "New";
                $order->coupon_code = $couponCode;
                $order->discount_per = $discountPer;
                $order->create();

                $cartModel->delete($cart->cart_id);
                header("location:/Order/myorders");

            }


        } else {
            header("location:/Cart/index");
        }
    }

    public function myorders(){
        $buyerId = $_SESSION['buyer_id'];
        $orderModel = new OrderModel();
        $ship = new OrderModel();
        $orders = $orderModel->getBuyerOrders($buyerId);
        $ships = $ship->getAllships();
        
        require 'app/views/buyer/my-order.php';
    }

    public function seller(){
        $sellerId = $_SESSION['seller_id'];
        $orderModel = new OrderModel();
        $orders = $orderModel->getSellerOrders($sellerId, $_GET);
        $balance = $orderModel->getSellerBalance($sellerId);
        require 'app/views/seller/orders.php';
    }

    public function cancelOrder($orderId){
        $orderModel = new OrderModel();
        $orders = $orderModel->updateOrderStatus($orderId, "Cancelled");
        header("location:/Order/seller");
    }

    public function ship($orderId){
        require 'app/views/seller/item-ship.php';
        
    }

    public function shipped($orderId){
        if(isset($_POST['save'])){
            $ship = new OrderModel();
            //update order status
            $orders = $ship->updateOrderStatus($orderId, "Shipped");

            $ship->order_id = $orderId;
            $ship->tracking_number = $_POST['tracking_number'];
            $ship->shipCreate();

            header("location:/Order/seller");
        }

    }
}