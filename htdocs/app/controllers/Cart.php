<?php

namespace app\controllers;

use app\models\Coupon;

class Cart extends \app\core\Controller
{
    public function __construct()
    {
        //if not login
        if (empty($_SESSION['buyer_id'])) {
            header("location:/Login/buyer?error=Please login before add to cart");
        }
    }

    public function index()
    {
        $cartModel = new \app\models\Cart();
        $carts = $cartModel->getByBuyerId();
        $code = '';
        $coupon = '';
        if (isset($_GET['apply'])) {
            $couponModel = new Coupon();
            $code = $_GET['coupon'];
            $coupon = $couponModel->getByCode($code);
        }

        require 'app/views/buyer/cart.php';

    }

    public function add($productId)
    {

        if (isset($_POST['cart'])) {
            //Add to cart
            $cart = new \app\models\Cart();
            $buyerId = $_SESSION['buyer_id'];

            //checks if for this buyer the product is already added 
            $checkCart = $cart->checkIsAdded($productId, $buyerId);

            //if already added in cart then update
            if ($checkCart) {
                $cart->qty = $checkCart->qty + $_POST['qty'];
                $cart->updateById($checkCart->cart_id);
            } //else add new entry
            else {
                $cart->buyer_id = $buyerId;
                $cart->product_id = $productId;
                $cart->qty = $_POST['qty'];
                $cart->create();
            }

            header("location:/Cart/index");
        }

    }

    public function delete($cartId)
    {
        $cartModel = new \app\models\Cart();
        $cartModel->delete($cartId);
        header("location:/Cart/index");
    }

    public function update($cartID)
    {
        $cart = new \app\models\Cart();
        $cart->qty = $_POST['qty'];
        $cart->updateById($cartID);
        // header("location:/Cart/index");
    }

}