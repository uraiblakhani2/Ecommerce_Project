<?php
namespace app\filters;
//defining the Login attribute
#[\Attribute]
class Login extends \app\core\AccessFilter{
	public function execute(){
		if(!isset($_SESSION['buyer_id'])){
			header('location:/Login/buyer?error=You must be logged in to access this location.');
			return true;
		}elseif($_SESSION['secret_key']!=null){
			header('location:/Login/check2fa');
			return true;
		}else
			return false;
	}
}