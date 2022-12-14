<html>
<head>
	<title>Account page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
<?php
if(isset($_GET['error'])){
?>
<div class="alert alert-danger" role="alert">
	<?=$_GET['error']?>
</div>
<?php
}
?>
<?php
if(isset($_GET['message'])){
?>
<div class="alert alert-success" role="alert">
	<?=$_GET['message']?>
</div>
<?php
}
?>



<div class="container mt-5">

    <div class="row">
        <div class="col-sm-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>My Account</h4>
                </div>
                <div class="card-body">
                    <form action="/Login/buyerLogin" method="post">
                        <div class="row">

                            <div class="col-sm-12 mb-3">
                                <label for="">Old Password</label>
								<input type="password" name="old_password" class="form-control" required />
                                </div>

                            <div class="col-sm-12 mb-3">
                                <label for="">New Password</label>
								<input type="password" name="password" class="form-control" required />
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for="">Confirm password</label>
                                <input type="password" name="password_confirm" class="form-control" required>
                                
                            </div>
                            <?php if (is_null($_SESSION['secret_key2'])) { ?> 

                            <a href="/Login/setup2fa">set up 2-factor authentication</a>
                            <?php } ?>
                                

                           
                            <div class="col-sm-12">
                                <p class="text-danger"><?php if(!empty($_GET['error'])){echo $_GET['error'];} ?></p>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="login" class="btn btn-success">Submit</button>
                            </div>

             
                            <a href="/home/index">Take me home</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


</body>
</html>