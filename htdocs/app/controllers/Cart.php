<?php

namespace app\controllers;

class Cart  extends \app\core\Controller
{
    public function __construct()
    {
        //if not login
        if(empty($_SESSION['buyer_id'])){
            header("location:/Login/buyer?error=Please login before add to cart");
        }
    }

    function index(){
        $cartModel = new \app\models\Cart();
        $carts = $cartModel->getByBuyerId();

        require 'app/views/layout/header.php';
        require 'app/views/buyer/cart.php';
        require 'app/views/layout/footer.php';

    }
    function add($productId){

        if(isset($_POST['cart'])){
            //Add to cart
            $cart = new \app\models\Cart();
            $buyerId = $_SESSION['buyer_id'];

            //check for this buyer already added this product
            $checkCart = $cart->checkIsAdded($productId, $buyerId);

            //if already added in cart then update
            if($checkCart){
                $cart->qty = $checkCart->qty + $_POST['qty'];
                $cart->updateById($checkCart->cart_id);
            }
            //else add new entry
            else{
                $cart->buyer_id = $buyerId;
                $cart->product_id = $productId;
                $cart->qty = $_POST['qty'];
                $cart->create();
            }

            header("location:/Cart/index");
        }

    }

    public function delete($cartId){
        $cartModel = new \app\models\Cart();
        $cartModel->delete($cartId);
        header("location:/Cart/index");
    }

    public function update($cartID){
        if(isset($_POST['updateCart'])){
            $cart = new \app\models\Cart();
            $cart->qty = $_POST['qty'];
            $cart->updateById($cartID);
            header("location:/Cart/index");
        }
    }

}