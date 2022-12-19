<h2>Danh sách chức vụ</h2>
<a href="index.php?controller=position&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>Mã công việc</th>
        <th>Tên</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $position) : ?>
            <tr>
                <td><?php echo $position['MaCV'] ?></td>
                <td><?php echo $position['TenCV'] ?></td>
                <td>
                    <?php
                    $url_update = "index.php?controller=position&action=update&MaCV=" . $position['MaCV'];
                    $url_delete = "index.php?controller=position&action=delete&MaCV=" . $position['MaCV'];
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