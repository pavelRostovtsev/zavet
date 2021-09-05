<div class="container-full d-flex justify-content-md-center mt-5">
    <div class="row col-6">
        <form action="/articles/store" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" >
            </div>

            <div class="form-group mt-2">
                <label for="description">Description</label>
                <input name="description" type="password" class="form-control" id="description" >
            </div>

            <div class="form-group mt-2">
                <label for="text">Text</label>
                <textarea name="text" type="text" class="form-control" id="text"> </textarea>
            </div>

            <div class="form-group mt-2">
                <label for="img">img</label>
                <input name="img" type="file" class="form-control" id="img" >
            </div>

            <input type="hidden" name="csrf" value="<?=$csrf;?>">

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>



