
<div class="album py-5 bg-light">

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach($articles as $article) :?>
            <div class="col">
                <div class="card shadow-sm">
                    <img class="bd-placeholder-img card-img-top" src="/upload/<?=$article['img']?>" width="100%" height="225"</img>

                    <div class="card-body">
                        <p class="card-text"><?=$article['title']?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="articles/show/<?=$article['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                <?if($statusAuth === true) :?>
                                    <a href="articles/edit/<?=$article['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                    <a href="articles/destroy/<?=$article['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted"><?=$article['created_at']?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?endforeach; ?>
        </div>
    </div>
</div>



