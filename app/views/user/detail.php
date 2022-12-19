<?php
?>
<h2>Chi tiết admin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $data['id'] ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $data['username'] ?></td>
    </tr>
    <tr>
        <th>Password</th>
        <td><?php echo $data['password'] ?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <img height="80" src="assets/uploads/<?php echo $data['avatar'] ?>" />
        </td>
    </tr>
</table>
<a href="index.php?controller=employee&action=index" class="btn btn-default">Back</a>