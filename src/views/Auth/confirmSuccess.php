<?php if ($confirmSuccess){?>
    <div class="alert alert-info">
        Your email has been confirm.
    </div>
    <a href="<?= $this->path('profile') ?>" class="btn btn-default">Profile</a>
<?php }else{?>
    <div class="alert alert-danger">Confirm false</div>
<?php }?>
