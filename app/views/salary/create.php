<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="bac_luong">Bậc lương: </label>
        <input type="text" class="form-control" id="bac_luong" placeholder="Enter ..." name="bac_luong" value="<?php echo isset($_POST['bac_luong']) ? $_POST['bac_luong'] : "" ?>">
    </div>
    <div class="form-group">
        <label for="luong_cb">Lương cơ bản: </label>
        <input type="text" class="form-control" id="luong_cb" placeholder="Enter luong_cb" name="luong_cb" value="<?php echo isset($_POST['luong_cb']) ? $_POST['luong_cb'] : "" ?>">
    </div>
    <div class="form-group">
        <label for="he_so">Hệ số lương: </label>
        <input type="text" class="form-control" id="he_so" placeholder="Enter he_so" name="he_so" value="<?php echo isset($_POST['he_so']) ? $_POST['he_so'] : "" ?>">
    </div>
    <div class="form-group">
        <label for="phu_cap">Phụ cấp: </label>
        <input type="text" class="form-control" id="phu_cap" placeholder="Enter phu_cap" name="phu_cap" value="<?php echo isset($_POST['phu_cap']) ? $_POST['phu_cap'] : "" ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Create" name="submit" class="btn btn-primary">
        <a href="index.php?controller=user&action=index" class="btn btn-warning">Back</a>
    </div>
</form>