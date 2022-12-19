<form action=$contract[''] method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nhân viên ký hợp đồng: </label>
        <select name="employee" id="" class="form-control">
            <?php foreach ($data['employees'] as $employee) : ?>
                <option value="<?php echo $employee['MaNV'] ?>" <?php
                                                                if (isset($_POST['employee']) && $_POST['employee'] == $employee['MaNV']) {
                                                                    echo "selected";
                                                                } else if ($employee['MaNV'] == $contract['MaNV']) {
                                                                    echo "selected";
                                                                }
                                                                ?>>
                    <?php echo $employee['HoTen'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="duration">Thời hạn: </label>
        <input type="text" class="form-control" id="duration" placeholder="Enter duration" name="duration" value="<?php echo isset($_POST['duration']) ? $_POST['duration'] : $contract['ThoiHan'] ?>">
    </div>
    <div class="form-group">
        <label for="from">Từ ngày: </label>
        <input type="date" class="form-control" id="from" placeholder="Enter from" name="from" value="<?php echo isset($_POST['from']) ? $_POST['from'] : $contract['TuNgay'] ?>">
    </div>
    <div class="form-group">
        <label for="to">Đến ngày: </label>
        <input type="date" class="form-control" id="to" placeholder="Enter to" name="to" value="<?php echo isset($_POST['to']) ? $_POST['to'] : $contract['DenNgay'] ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=employee&action=index" class="btn btn-warning">Back</a>
    </div>
</form>