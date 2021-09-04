<div class="container d-flex justify-content-center mt-5">
    <row>
        <div>
            <h1>Title: <?=$article['title']?></h1>
            <h3>Description: <?=$article['description']?></h3>
            <h5>Text: <?=$article['text']?></h5>
            <p>Date: <?=$article['created_at']?></p>
        </div>
        <div class="mt-5">
            <button type="submit" class="btn btn-warning"><a class="badge text-dark" href="/articles/edit/<?=$article['id']?>">Изменить</a></button>
            <button type="submit" class="btn btn-danger"><a class="badge text-dark" href="/articles/destroy/<?=$article['id']?>">Удалить</a></button>
        </div>
    </row>
</div>