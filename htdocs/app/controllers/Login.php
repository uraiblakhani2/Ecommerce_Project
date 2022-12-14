<?php

namespace app\controllers;

use app\models\Buyer;
use app\models\Seller;
use app\models\OrderModel;

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
					$_SESSION['secret_key'] = $user->secret_key;
					$_SESSION['secret_key2'] = $user->secret_key;
					$order = new OrderModel();
					$subscription = $order->checkMembership($_SESSION['buyer_id']);
					if(!empty($subscription)){
						$_SESSION['hasMembership'] = 'yes';
					}

                    $_SESSION['is_logged_in'] = 'buyer';
                     header("location:/Login/account");
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

    #[\app\filters\Login]
	public function account(){
		//password modification
		if(isset($_POST['action'])){
			//check the old password
			$buyer = new \app\models\Buyer();
			$buyer = $buyer->get($_SESSION['buyer_id']);
			if(password_verify($_POST['old_password'],$buyer->password_hash)){
				if($_POST['password'] == $_POST['password_confirm']){
					$buyer->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$buyer->updatePassword();
					header('location:/Login/account?message=Password changed successfully.');
				}else{
					header('location:/Login/account?error=Passwords do not match.');
				}
			}else{
				header('location:/Login/account?error=Wrong old password provided.');
			}
		}else{
			$this->view('Login/account');
		}
	}


    public function makeQRCode(){
		$data = $_GET['data'];
		\QRcode::png($data);
	}

    #[\app\filters\Login]
    public function setup2fa(){
		if(isset($_POST['action'])){
			//verification of the code sent by the user
			$currentCode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify($_SESSION['secretkey'],$currentCode)){
				$user = new \app\models\Buyer();
				$user->buyer_id = $_SESSION['buyer_id'];
				$user->secret_key = $_SESSION['secretkey'];
				$user->update2fa();
				header('location:/Login/account');
			}else{
				header('location:/Login/setup2fa?error=Wrong code provided');
			}
		}else{
			$secretkey = \App\core\TokenAuth6238::generateRandomClue();
			$_SESSION['secretkey'] = $secretkey;
			$url = \app\core\TokenAuth6238::getLocalCodeUrl(
				$_SESSION['buyer_name'],
				'Awesome.com',
				$secretkey,
				'Awesome App');
			$this->view('Login/twofasetup', $url);

		}
	}

    

    function check2fa(){
		if(!isset($_SESSION['buyer_id'])){
			header('location:/Login/Buyer');
			return;
		}
		
		if(isset($_POST['action'])){
			$currentCode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify($_SESSION['secret_key'],$currentCode)){
				$_SESSION['secret_key']=null;
				header('location:/Login/account');
			}else{
				header('location:/Login/check2fa?error=Wrong code provided');
			}
		}else{
			$this->view('Login/check2fa');
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