<?php

namespace app\controllers;

use app\models\Buyer;
use app\models\Seller;

class Login extends \app\core\Controller
{
    public function buyer(){

        $this->view('Login/buyer-login');
    }

    public function buyerLogin(){
        if(isset($_POST['login'])){
            $buyer = new Buyer();
            $user = $buyer->get($_POST['username']);

            if($user){
                $username = $_POST['username'];

                if(password_verify($_POST['password'], $user->password_hash)) {
                    $_SESSION['buyer_id'] = $user->buyer_id;
                    $_SESSION['buyer_name'] = $user->first_name;
                    $_SESSION['is_logged_in'] = 'buyer';

                    header("location:/home/index");
                }else{
                    header("location:/Login/buyer?error=Invalid Password");
                }

            }else{
                header("location:/Login/buyer?error=Invalid user name");
            }

        }else{
            header("location:/Login/buyer");
        }
    }


    public function seller(){
        $this->view('Login/seller-login');
    }

    public function sellerLogin(){
        if(isset($_POST['login'])){
            $seller = new Seller();
            $user = $seller->get($_POST['username']);

            if($user){
                $username = $_POST['username'];

                if(password_verify($_POST['password'], $user->password_hash)) {
                    $_SESSION['seller_id'] = $user->seller_id;
                    $_SESSION['seller_username'] = $user->seller_username;
                    $_SESSION['is_logged_in'] = 'seller';

                    header("location:/SellerProduct/index");
                }else{
                    header("location:/Login/seller?error=Invalid Password");
                }

            }else{
                header("location:/Login/seller?error=Invalid user name");
            }

        }else{
            header("location:/Login/buyer");
        }
    }

    public function logout(){
        session_destroy();
        header("location:/Home/index");
    }
}