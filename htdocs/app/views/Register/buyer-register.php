<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">

    <div class="row">
        <div class="col-sm-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Buyer Register</h4>
                </div>
                <div class="card-body">
                    <form action="/Register/buyerSave" method="post">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">Street Name</label>
                                <input type="text" name="street_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" required>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="">City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">Phone number</label>
                                <input type="text" name="phone_number" class="form-control" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-danger"><?php if(!empty($_GET['error'])){echo $_GET['error'];} ?></p>
                            </div>
                            <div class="col-sm-12">
                              <button type="submit" name="save" class="btn btn-success">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>