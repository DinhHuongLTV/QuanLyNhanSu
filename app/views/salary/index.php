<h2>Danh sách bậc lương</h2>
<a href="index.php?controller=salary&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>Bậc lương</th>
        <th>Lương cơ bản</th>
        <th>Hệ số lương</th>
        <th>Phụ cấp</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $salary) : ?>
            <tr>
                <td><?php echo $salary['BacLuong'] ?></td>
                <td><?php echo $salary['LuongCB'] ?></td>
                <td><?php echo $salary['HSL'] ?></td>
                <td><?php echo $salary['PhuCap'] ?></td>
                <td>
                    <?php
                    $url_update = "index.php?controller=salary&action=update&BacLuong=" . $salary['BacLuong'];
                    $url_delete = "index.php?controller=salary&action=delete&BacLuong=" . $salary['BacLuong'];
                    ?>
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