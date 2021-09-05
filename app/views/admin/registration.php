<div class="container-full d-flex justify-content-md-center mt-5">
    <div class="row col-6">
        <form action="/admin/registration" method="post">

            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" >
            </div>

            <div class="form-group mt-2">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" >
            </div>
            <input type="hidden" name="csrf" value="<?=$csrf;?>">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>



