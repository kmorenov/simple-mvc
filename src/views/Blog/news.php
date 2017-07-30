
<div class="row">
    <?php foreach ($news as $article) { ?> 

    <div class="col-md-4">
        <h2><?= $article['title'] ?></h2>
        <p><?= $article['content'] ?></p>
        <p><a class="btn btn-default" href="<?= $this->path('article', ['slug' => $article['slug'] ]) ?>" role="button">View details &raquo;</a></p>
    </div>
    <?php } ?>
</div>