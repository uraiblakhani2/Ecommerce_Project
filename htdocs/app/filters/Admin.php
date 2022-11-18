<?php
namespace app\filters;

#[\Attribute]
class Admin extends \app\core\AccessFilter{
	public function execute(){
		if($_SESSION['role'] != 'admin'){
			header('location:/Register/account?error=You may not access the administration features.');
			return true;
		}
		return false;
	}
}
?>