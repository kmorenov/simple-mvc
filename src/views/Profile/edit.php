<?php if($this->hasFlash('editSuccess')){ ?>
    <div class="alert alert-success">
        <?= $this->getFlash('editSuccess') ?>
    </div>

<?php } ?>

<form class="form-horizontal" action="<?= $this->path('editSave') ?>" method="post">
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <div class="col-sm-5">
            <input
                value="<?php echo $user['name']?>"
                name="name" type="text" class="form-control" id="name" placeholder="Enter name">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="lastname">Last name:</label>
        <div class="col-sm-5">
            <input
                value="<?php echo $user['lastname']?>"
                name="lastname" type="text" class="form-control" id="lastname" placeholder="Enter last name">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="phone">Phone:</label>
        <div class="col-sm-5">
            <input
                value="<?php echo $user['phone']?>"
                name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>