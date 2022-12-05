<html>
<head>
<title>2fa check</title>
<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

</head>
<body>
	<h3><center>Hi <?=$_SESSION['buyer_name']?>. Provide your 2-factor authentication code.</center></h3>

	<div class="container mt-5">

<div class="row">
	<div class="col-sm-4 m-auto">
		<div class="card">
			<div class="card-header">
				<h4>Verify 2fa</h4>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-12 mb-3">
						<label for="">Enter Code Generated by 2fa app</label>
						<input type="text" name="currentCode" class="form-control" required>
						</div>
                            <div class="col-sm-12">
                                <p class="text-danger"><?php if(!empty($_GET['error'])){echo $_GET['error'];} ?></p>
                            </div>

						<div class="col-sm-12">
							<button type="submit" name="action"  value = "Verify Code" class="btn btn-success">Submit</button>
						</div>

					</div>

				</form>
			</div>
		</div>
	</div>

</div>
</div>



</body>
</html>


