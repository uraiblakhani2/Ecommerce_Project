<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">

    <div class="row">
        <div class="col-sm-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4><?= _('Seller Login') ?></h4>
                </div>
                <div class="card-body">
                    <form action="/Login/sellerLogin" method="post">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for=""><?= _('Username') ?></label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for=""><?= _('Password') ?></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-danger"><?php if(!empty($_GET['error'])){echo $_GET['error'];} ?></p>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="login" class="btn btn-success"><?= _('Submit') ?></button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>