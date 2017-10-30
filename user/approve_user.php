<?php
$page_title = 'All User';
require_once('../includes/load.php');
?>
<?php
validate_access_level(1);
$unapproved_users = find_unapproved_users();
?>

<?php

if (empty($errors)) {

    if (isset($_POST['radio'])) {

        $value = $db->get_escape_string($_POST['radio']);
        if ($value === 'approve') {

            $userID = make_HTML_compliant($db->get_escape_string($_POST['uID']));

            $query = "UPDATE users SET status = '1' WHERE id = '{$userID}';";

            if ($db->run_query($query)) {

                $session->msg('success', "User account has been approved! ");
                redirect_to_page('approve_user.php', false);
            } else {
                $session->msg('danger', ' Sorry failed to approve!');
                redirect_to_page('approve_user.php', false);
            }

        } elseif ($value === 'reject') {

            $userID = make_HTML_compliant($db->get_escape_string($_POST['uID']));

            $query = "DELETE FROM users WHERE id = '{$userID}';";

            if ($db->run_query($query)) {

                $session->msg('success', "Rejected User has been deleted! ");
                redirect_to_page('approve_user.php', false);
            } else {
                $session->msg('danger', ' Sorry failed to reject!');
                redirect_to_page('approve_user.php', false);
            }

        }

    }

} else {
    $session->msg("danger", $errors);
    redirect_to_page('approve_user.php', false);
}


?>

<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron">

        <h1> User Management!</h1>
        <h3>Use this page to approve users.</h3>
    </div>
</div>

<div class="container">
    <div class="col-md-12">
        <?php echo make_alert_msg($msg); ?>
    </div>
</div>
<br/>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">

                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Username</th>
                        <th class="text-center">User Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($unapproved_users as $a_user): ?>
                        <tr>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['name'])) ?></td>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['username'])) ?></td>
                            <td class="text-center"><?php echo make_HTML_compliant(ucwords($a_user['group_name'])) ?></td>

                            <td class="text-center">

                                <form method="post" action="approve_user.php">
                                    <label for="approve">Approve</label>
                                    <input id="approve" type="radio" name="radio" value="approve">
                                    <br/>

                                    <label for="reject">Reject</label>
                                    <input id="reject" type="radio" name="radio" value="reject">

                                    <input name="uID" type="hidden"
                                           value="<?php echo make_HTML_compliant($a_user['id']) ?>">

                                    <br/>
                                    <input type="submit" class="btn btn-success">

                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('../footer.php'); ?>
