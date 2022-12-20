<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Họ tên (*) : </label>
        <input type="text" class="form-control" id="fullname" placeholder="Enter fullname" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : $data['employee']['HoTen'] ?>">
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh (*) : </label>
        <input type="file" class="form-control-file" id="avatar" name="avatar">
    </div>
    <div class="form-group">
        <label for="">Quê quán : </label>
        <input type="text" class="form-control" id="" placeholder="Enter last name" name="que_quan" value="<?php echo isset($_POST['que_quan']) ? $_POST['que_quan'] : $data['employee']['QueQuan'] ?>">
    </div>
    <div class="form-group">
        <label for="date_of_birth">Ngày sinh (*) : </label>
        <input type="date" class="form-control" id="date_of_birth" placeholder="Enter phone number" name="date_of_birth" value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : $data['employee']['NgaySinh'] ?>">
    </div>
    <div class="form-group">
        <label for="gender">Giới tính (*) : </label>
        <select class="form-control" name="gender" id="gender">
            <option value="0">Nữ</option>
            <option value="1">Nam</option>
            <option value="2">Khác</option>
        </select>
    </div>
    <div class="form-group">
        <label for="phone">Điện thoại: </label>
        <input type="text" class="form-control" id="phone" placeholder="Enter address" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $data['employee']['SDT'] ?>">
    </div>
    <div class="form-group">
        <label for="">Phòng ban (*) : </label>
        <select class="form-control" name="department" id="">
            <?php foreach ($data['departments'] as $department) : ?>
                <option value="<?php echo $department['MaPB'] ?>" <?php if ($department['MaPB'] == $data['employee']['MaPB']) echo "selected" ?>>
                    <?php echo $department['TenPB'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Chức vụ (*) : </label>
        <select class="form-control" name="position" id="">
            <?php foreach ($data['positions'] as $position) : ?>
                <option value="<?php echo $position['MaCV'] ?>" <?php if ($position['MaCV'] == $data['employee']['MaCV']) echo "selected" ?>>
                    <?php echo $position['TenCV'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Trình độ học vấn (*) : </label>
        <select class="form-control" name="level" id="">
            <?php foreach ($data['levels'] as $level) : ?>
                <option value="<?php echo $level['MaTDHV'] ?>" <?php if ($level['MaTDHV'] == $data['employee']['MaTDHV']) echo "selected" ?>>
                    <?php echo $level['TenTDHV'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Bậc lương (*) : </label>
        <select class="form-control" name="salary" id="">
            <?php foreach ($data['salaries'] as $salary) : ?>
                <option value="<?php echo $salary['BacLuong'] ?>" <?php if ($salary['BacLuong'] == $data['employee']['BacLuong']) echo "selected" ?>>
                    <?php echo $salary['BacLuong'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Update" name="submit" class="btn btn-primary">
        <a href="index.php?controller=employee&action=index" class="btn btn-warning">Back</a>
    </div>
</form>