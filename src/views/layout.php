<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">

    <title>Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse right">
            <?php if ($this->getUser()) { ?>
            <a class="navbar-brand navbar-right" href="<?= $this->path('logout')?>">logout</a>
            <a class="navbar-brand navbar-right" href="<?= $this->path('profile')?>"><?= $this->getUser()['login'] ?></a>
            <?php } else { ?>
            <a class="navbar-brand navbar-right" href="<?= $this->path('loginForm')?>">Sign in</a>
            <a class="navbar-brand navbar-right" href="<?= $this->path('registerForm')?>">Sign up</a>
            <?php } ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top: 70px;">
 
      <?php include $content; ?>

      <hr>
      <footer>
        <p>&copy; 2018 Company, Inc.</p>
      </footer>
    </div> <!-- /container -->


  </body>
</html>