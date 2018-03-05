<div class="alert alert-info">
    <?php
        if($this->hasFlash('registerSuccess')){
            echo 'Confirm your account by email ';
            echo $this->getFlash('registerSuccess');
        }else{
            echo false;
        }
    ?>
</div>