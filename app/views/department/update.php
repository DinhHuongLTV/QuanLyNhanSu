<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Tên phòng ban (*): </label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $data['TenPB'] ?>">
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ (*): </label>
        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $data['DiaChi'] ?>">
    </div>
    <div class="form-group">
        <label for="phone">Điện thoại phòng ban (*): </label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $data['SDTPB'] ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=level&action=index" class="btn btn-warning">Back</a>
    </div>
</form>