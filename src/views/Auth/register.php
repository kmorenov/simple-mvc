<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Sign Up</h1>      
        <?php if ($this->hasFlash('registerError')) { ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh snap!</strong> <?= $this->getFlash('registerError') ?>
        </div>
        <?php } ?>
        <div class="account-wall">
            <form class="form-signin" action="<?= $this->path('register') ?>" method="post">
                <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="password" name="password2" class="form-control" placeholder="Repeat Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                <span class="clearfix"></span>
            </form>
        </div>
        <a href="<?= $this->path('loginForm') ?>" class="text-center new-account">Sign In</a>
    </div>
</div>