<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username (*): </label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : $data['username'] ?>">
    </div>
    <div class="form-group">
        <label for="avatar">Avatar (*): </label>
        <img src="assets/uploads/<?php echo $data['avatar'] ?>" alt="">
        <input type="file" class="form-control-file" id="avatar" name="avatar">
    </div>
    <div class="form-group">
        <label for="password">Password (*): </label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : $data['password'] ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=employee&action=index" class="btn btn-warning">Back</a>
    </div>
</form>