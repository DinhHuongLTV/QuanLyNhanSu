<?php
?>
<h2>Chi tiết nhân viên</h2>
<table class="table table-bordered">
    <tr>
        <th>Mã nhân viên</th>
        <td><?php echo $data['employee']['MaNV'] ?></td>
    </tr>
    <tr>
        <th>Họ tên</th>
        <td><?php echo $data['employee']['HoTen'] ?></td>
    </tr>
    <tr>
        <th>Quê quán</th>
        <td><?php echo $data['employee']['QueQuan'] ?></td>
    </tr>
    <tr>
        <th>avatar</th>
        <td>
            <img height="80" src="assets/uploads/<?php echo $data['employee']['avatar'] ?>" />
        </td>
    </tr>
    <tr>
        <th>Giới tính</th>
        <td><?php echo $data['employee']['GioiTinh'] ?></td>
    </tr>
    <tr>
        <th>Số điện thoại</th>
        <td><?php echo $data['employee']['SDT'] ?></td>
    </tr>
    <tr>
        <th>Thuộc phòng ban</th>
        <td><?php
            foreach ($data['departments'] as $department) {
                if ($department['MaPB'] == $data['employee']['MaPB']) {
                    echo $department['TenPB'];
                }
            }
            ?></td>
    </tr>
    <tr>
        <th>Chức vụ</th>
        <td><?php
            foreach ($data['positions'] as $position) {
                if ($position['MaCV'] == $data['employee']['MaCV']) {
                    echo $position['TenCV'];
                }
            } ?></td>
    </tr>
    <tr>
        <th>Trình Độ</th>
        <td><?php
            foreach ($data['levels'] as $level) {
                if ($level['MaTDHV'] == $data['employee']['MaTDHV']) {
                    echo $level['TenTDHV'];
                }
            } ?></td>
    </tr>
    <tr>
        <th>Bậc Lương</th>
        <td><?php
            foreach ($data['salaries'] as $salary) {
                if ($salary['BacLuong'] == $data['employee']['BacLuong']) {
                    echo $salary['BacLuong'];
                }
            } ?></td>
    </tr>
</table>
<a href="index.php?controller=employee&action=index" class="btn btn-default">Back</a>