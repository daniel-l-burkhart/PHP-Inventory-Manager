<?php
$page_title = 'Add User';
require_once('../includes/load.php');

$groups = get_all_from_table('user_groups');
?>
<?php

if (isset($_POST['add_user'])) {

    $req_fields = array('full-name', 'username', 'password', 'level');
    validate_fields($req_fields);

    if (empty($errors)) {

        $name = make_HTML_compliant($db->get_escape_string($_POST['full-name']));
        $username = make_HTML_compliant($db->get_escape_string($_POST['username']));
        $password = make_HTML_compliant($db->get_escape_string($_POST['password']));
        $user_level = (int)$db->get_escape_string($_POST['level']);
        $password = sha1($password);

        $query = "INSERT INTO users (name,username,password,user_level,status) VALUES ('{$name}', '{$username}', '{$password}', '{$user_level}','0')";

        if ($db->run_query($query)) {

            $session->msg('success', "User account has been requested! ");
            redirect_to_page('add_user.php', false);
        } else {
            $session->msg('danger', ' Sorry failed to create request!');
            redirect_to_page('add_user.php', false);
        }
    } else {
        $session->msg("danger", $errors);
        redirect_to_page('add_user.php', false);
    }
}
?>

<?php include_once('../header.php'); ?>

<?php echo make_alert_msg($msg); ?>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span>Add New User</span>
                </strong>
            </div>
            <div class="panel-body">

                <form method="post" action="add_user.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="full-name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="level">User Role</label>
                        <select class="form-control" name="level">
                            <?php foreach ($groups as $group): ?>
                                <option value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" name="add_user" class="btn btn-success">Request User Account</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include_once('../footer.php'); ?>
