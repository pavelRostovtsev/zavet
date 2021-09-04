<div class="container d-flex justify-content-center mt-5">
    <row>
        <div>
            <h2>Article id: <?=$article['id']?></h2>
            <p>Title: <?=$article['title']?></p>
            <p>Description: <?=$article['description']?></p>
            <p>Дата рождения: <?=$article['created_at']?></p>
        </div>
        <div class="mt-5">
            <button type="submit" class="btn btn-warning"><a class="badge text-dark" href="/user/edit/<?=$article['id']?>">Изменить</a></button>
            <button type="submit" class="btn btn-danger"><a class="badge text-dark" href="/user/destroy/<?=$article['id']?>">Удалить</a></button>
        </div>
    </row>
</div>