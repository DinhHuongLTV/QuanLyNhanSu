<!-- <?php
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        ?> -->
<h2>Danh sách hợp đồng</h2>
<a href="index.php?controller=contract&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>Mã hợp đồng</th>
        <th>Tên nhân viên</th>
        <th>Thời hạn (năm)</th>
        <th>Từ ngày</th>
        <th>Đến ngày</th>
        <th></th>
    </tr>
    <?php if (!empty($data)) : ?>
        <?php foreach ($data['contracts'] as $contract) : ?>
            <tr>
                <td><?php echo $contract['MaHD'] ?></td>
                <td><?php
                    foreach ($data['employees'] as $employee) {
                        if ($employee['MaNV'] == $contract['MaNV']) {
                            echo $employee['HoTen'];
                        }
                    }
                    ?></td>
                <td><?php echo $contract['ThoiHan'] ?></td>
                <td><?php echo date('d-m-Y', strtotime($contract['TuNgay'])) ?></td>
                <td><?php echo date('d-m-Y', strtotime($contract['DenNgay'])) ?></td>
                <td>
                    <?php
                    $url_update = "index.php?controller=contract&action=update&MaHD=" . $contract['MaHD'];
                    $url_delete = "index.php?controller=contract&action=delete&MaHD=" . $contract['MaHD'];
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