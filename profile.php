<?php
$page_title = 'My profile';
require_once('includes/load.php');
validate_access_level(3);
?>
<?php
$user_id = (int)$_GET['id'];
if (empty($user_id)):
    redirect_to_page('home.php', false);
else:
    $user_p = find_record_by_id('users', $user_id);
endif;
?>

<?php

if (isset($_POST['update'])) {
    $req_fields = array('name', 'username');
    validate_fields($req_fields);
    if (empty($errors)) {

        $id = (int)$user_p['id'];
        $name = make_HTML_compliant($db->get_escape_string($_POST['name']));
        $username = make_HTML_compliant($db->get_escape_string($_POST['username']));

        $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$db->get_escape_string($id)}'";

        $result = $db->run_query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('success', "Account Updated ");
            redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
        } else {
            $session->msg('danger', ' Sorry failed to updated!');
            redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
        }
    } else {
        $session->msg("danger", $errors);
        redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
    }
}
?>

<?php

if (isset($_POST['update-pass'])) {
    $req_fields = array('password');
    validate_fields($req_fields);

    if (empty($errors)) {

        $id = (int)$user_p['id'];
        $password = make_HTML_compliant($db->get_escape_string($_POST['password']));
        $h_pass = sha1($password);

        $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->get_escape_string($id)}'";
        $result = $db->run_query($sql);

        if ($result && $db->affected_rows() === 1) {
            $session->msg('success', "User password has been updated ");
            redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
        } else {
            $session->msg('danger', ' Sorry failed to updated user password!');
            redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
        }

    } else {
        $session->msg("danger", $errors);
        redirect_to_page('profile.php?id=' . (int)$user_p['id'], false);
    }
}

?>

<?php include_once('header.php'); ?>

<div class="container">
    <div class="jumbotron text-center">
        <h1><?php echo capitalize_first_letter($user_p['name']); ?> Profile</h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>User Information</span>
                    </strong>
                </div>
                <div class="panel-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center"> Name</th>
                            <th class="text-center"> Username</th>
                            <th class="text-center"> User Status</th>
                            <th class="text-center"> Last login</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> <?php echo make_HTML_compliant(ucwords($user_p['name'])) ?> </td>
                            <td> <?php echo make_HTML_compliant(ucwords($user_p['username'])) ?> </td>

                            <td>

                                <?php if ($user_p['status'] === '1'): ?>
                                    <?php echo 'Administrator' ?>
                                <?php elseif ($user_p['status'] === '2'): ?>
                                    <?php echo 'Manager' ?>
                                <?php elseif ($user_p['status'] === '3'): ?>
                                    <?php echo 'Employee' ?>
                                <?php endif; ?>

                            </td>

                            <td> <?php echo read_date($user_p['last_login']) ?> </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        Update <?php echo make_HTML_compliant(ucwords($user_p['name'])); ?> Account
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="profile.php?id=<?php echo (int)$user_p['id']; ?>" class="clearfix">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                   value="<?php echo make_HTML_compliant(ucwords($user_p['name'])); ?>">
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" class="form-control" name="username"
                                   value="<?php echo make_HTML_compliant(ucwords($user_p['username'])); ?>">
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
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        Change <?php echo make_HTML_compliant(ucwords($user_p['name'])); ?> password
                    </strong>
                </div>
                <div class="panel-body">
                    <form action="profile.php?id=<?php echo (int)$user_p['id']; ?>" method="post" class="clearfix">
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

</div>


<?php include_once('footer.php'); ?>
