<?php

namespace app\controllers;

use app\models\Buyer;
use app\models\Seller;

class Register extends \app\core\Controller{

    function buyer(){
        require 'app/views/layout/header.php';
        require 'app/views/Register/buyer-register.php';
        require 'app/views/layout/footer.php';
    }


    function buyerSave(){
        if(isset($_POST['save'])){
            $buyer = new Buyer();
            $check = $buyer->get($_POST['username']);

            if(!$check){
                $buyer->username = $_POST['username'];
                $buyer->first_name = $_POST['first_name'];
                $buyer->last_name = $_POST['last_name'];
                $buyer->street_name = $_POST['street_name'];
                $buyer->postal_code = $_POST['postal_code'];
                $buyer->city = $_POST['city'];
                $buyer->phone_number = $_POST['phone_number'];
                $buyer->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $buyer->create();
                header("location:/Login/buyer");
            }else{
                //header("location:/Register/buyer");
               header("location:/Register/buyer?error=The username $_POST[username] is already in use. Select another.");
            }

        }else{
            header("location:/Register/buyer");
        }

    }


    function seller(){
        require 'app/views/layout/header.php';
        require 'app/views/Register/seller-register.php';
        require 'app/views/layout/footer.php';
    }

    function sellerSave(){
        if(isset($_POST['save'])){
            $seller = new Seller();
            $check = $seller->get($_POST['username']);

            if(!$check){
                $seller->username = $_POST['username'];
                $seller->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $seller->create();
                header("location:/Login/seller");
            }else{
                //header("location:/Register/buyer");
                header("location:/Register/seller?error=The username $_POST[username] is already in use. Select another.");
            }

        }else{
            header("location:/Register/seller");
        }

    }
}