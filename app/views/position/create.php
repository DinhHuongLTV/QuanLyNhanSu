<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Chức vụ (*): </label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : "" ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=user&action=index" class="btn btn-warning">Back</a>
    </div>
</form>