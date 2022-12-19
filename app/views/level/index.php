<h2>Trình độ học vấn</h2>
<a href="index.php?controller=level&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>Mã</th>
        <th>Trình độ</th>
        <th>Chuyên ngành</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data as $level) : ?>
            <tr>
                <td><?php echo $level['MaTDHV'] ?></td>
                <td><?php echo $level['TenTDHV'] ?></td>
                <td><?php echo $level['ChuyenNganh'] ?></td>
                <td>
                    <?php
                    $url_update = "index.php?controller=level&action=update&MaTDHV=" . $level['MaTDHV'];
                    $url_delete = "index.php?controller=level&action=delete&MaTDHV=" . $level['MaTDHV'];
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