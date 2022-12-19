<h2>Danh sách nhân viên</h2>
<a href="index.php?controller=employee&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Quê quán</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $employee) : ?>
            <tr>
                <td><?php echo $employee['MaNV'] ?></td>
                <td><?php echo $employee['HoTen'] ?></td>
                <td><?php echo $employee['QueQuan'] ?></td>
                <td><?php echo date('d-m-Y', strtotime($employee['NgaySinh'])) ?></td>
                <td>
                    <?php if ($employee['GioiTinh'] == 0) echo "Nữ";
                    else if ($employee['GioiTinh'] == 1) echo "Nam";
                    else echo "Khác";
                    ?></td>
                <td><?php echo $employee['SDT'] ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=employee&action=detail&MaNV=" . $employee['MaNV'];
                    $url_update = "index.php?controller=employee&action=update&MaNV=" . $employee['MaNV'];
                    $url_delete = "index.php?controller=employee&action=delete&MaNV=" . $employee['MaNV'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Cập nhật" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
    <?php endif; ?>
</table>
<?php //echo $pages; 
?>