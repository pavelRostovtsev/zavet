<div class="container-full d-flex justify-content-md-center mt-5">
    <div class="row col-6">
        <form action="/articles/update/<?=$article['id']?>" method="post">

            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title"  value="<?=$article['title']?>">
            </div>

            <div class="form-group mt-2">
                <label for="description">Description</label>
                <input name="description" type="text" class="form-control" id="description" value="<?=$article['title']?>">
            </div>

            <div class="form-group mt-2">
                <label for="text">Text</label>
                <textarea name="text" type="text" class="form-control" id="text"><?=$article['text']?></textarea>
            </div>
            <input type="hidden" name="csrf" value="<?=$csrf;?>">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>



