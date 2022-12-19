<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Trình độ: </label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $data['TenTDHV'] ?>">
    </div>
    <div class="form-group">
        <label for="major">Chuyên ngành: </label>
        <input type="text" class="form-control" id="major" placeholder="Enter major" name="major" value="<?php echo isset($_POST['major']) ? $_POST['major'] : $data['ChuyenNganh'] ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=level&action=index" class="btn btn-warning">Back</a>
    </div>
</form>