<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Sign in</h1>      
        <?php if ($this->hasFlash('authError')) { ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh snap!</strong> <?= $this->getFlash('authError') ?>
        </div>
        <?php } ?>
        <div class="account-wall">
            <form class="form-signin" action="<?= $this->path('loginCheck') ?>" method="post">
                <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <span class="clearfix"></span>
            </form>
        </div>
        <a href="<?= $this->path('registerForm') ?>" class="text-center new-account">Create an account </a>
    </div>
</div>