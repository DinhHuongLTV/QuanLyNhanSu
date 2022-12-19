<h2>Danh sách phòng ban</h2>
<a href="index.php?controller=department&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>Mã phòng ban</th>
        <th>Tên phòng ban</th>
        <th>Địa chỉ phòng ban</th>
        <th>Số điện thoại phòng ban</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $department) : ?>
            <tr>
                <td><?php echo $department['MaPB'] ?></td>
                <td><?php echo $department['TenPB'] ?></td>
                <td><?php echo $department['DiaChi'] ?></td>
                <td><?php echo $department['SDTPB'] ?></td>
                <td><?php
                    $url_update = "index.php?controller=department&action=update&MaPB=" . $department['MaPB'];
                    $url_delete = "index.php?controller=department&action=delete&MaPB=" . $department['MaPB'];
                    ?>
                    <a title="Cập nhật" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<?php //echo $pages; 
?>