<?php
$page_title = 'Edit User';
require_once('../includes/load.php');

validate_access_level(1);
?>
<?php
$e_user = find_record_by_id('users', (int)$_GET['id']);
$groups = get_all_from_table('user_groups');
if (!$e_user) {
    $session->msg("danger", "Missing user id.");
    redirect_to_page('users.php');
}
?>

<?php

if (isset($_POST['update'])) {
    $req_fields = array('name', 'username', 'level');
    validate_fields($req_fields);
    if (empty($errors)) {

        $id = (int)$e_user['id'];
        $name = make_HTML_compliant($db->get_escape_string($_POST['name']));
        $username = make_HTML_compliant($db->get_escape_string($_POST['username']));
        $level = (int)$db->get_escape_string($_POST['level']);
        $status = make_HTML_compliant($db->get_escape_string($_POST['status']));

        $sql = "UPDATE users SET name ='{$name}', username ='{$username}',user_level='{$level}',status='{$status}' WHERE id='{$db->get_escape_string($id)}'";

        $result = $db->run_query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('success', "Account Updated ");
            redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
        } else {
            $session->msg('danger', ' Sorry failed to updated!');
            redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
        }
    } else {
        $session->msg("danger", $errors);
        redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
    }
}
?>
<?php

if (isset($_POST['update-pass'])) {
    $req_fields = array('password');
    validate_fields($req_fields);
    if (empty($errors)) {
        $id = (int)$e_user['id'];
        $password = make_HTML_compliant($db->get_escape_string($_POST['password']));
        $h_pass = sha1($password);
        $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->get_escape_string($id)}'";
        $result = $db->run_query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('success', "User password has been updated ");
            redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
        } else {
            $session->msg('danger', ' Sorry failed to updated user password!');
            redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
        }
    } else {
        $session->msg("danger", $errors);
        redirect_to_page('edit_user.php?id=' . (int)$e_user['id'], false);
    }
}

?>

<?php include_once('../header.php'); ?>
<div class="row">
    <div class="col-md-12"> <?php echo make_alert_msg($msg); ?> </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    Update <?php echo make_HTML_compliant(ucwords($e_user['name'])); ?> Account
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id']; ?>" class="clearfix">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="name" class="form-control" name="name"
                               value="<?php echo make_HTML_compliant(ucwords($e_user['name'])); ?>">
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" name="username"
                               value="<?php echo make_HTML_compliant(ucwords($e_user['username'])); ?>">
                    </div>
                    <div class="form-group">
                        <label for="level">User Role</label>
                        <select class="form-control" name="level">
                            <?php foreach ($groups as $group): ?>
                                <option <?php if ($group['group_level'] === $e_user['user_level']) echo 'selected="selected"'; ?>
                                        value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option <?php if ($e_user['status'] === '1') echo 'selected="selected"'; ?>value="1">
                                Active
                            </option>
                            <option <?php if ($e_user['status'] === '0') echo 'selected="selected"'; ?> value="0">
                                Deactive
                            </option>
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    Change <?php echo make_HTML_compliant(ucwords($e_user['name'])); ?> password
                </strong>
            </div>
            <div class="panel-body">
                <form action="edit_user.php?id=<?php echo (int)$e_user['id']; ?>" method="post" class="clearfix">
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" name="password"
                               placeholder="Type user new password">
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="update-pass" class="btn btn-danger pull-right">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php include_once('../footer.php'); ?>
