<?php
$page_title = 'All User';
require_once('../includes/load.php');
?>
<?php

validate_access_level(1);
$all_users = find_all_user();
$unapproved_users = unapproved_users_count();

?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron">
        <h1> User Management!</h1>
        <h3>Use this page to add, edit or delete users.</h3>
    </div>
</div>

<div class="container">
    <div class="col-md-12">
        <?php echo make_alert_msg($msg); ?>
    </div>
</div>
<br/>

<?php if ($unapproved_users > 0): ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span>Unapproved Users</span>
                    </strong
                </div>
                <div class="panel-body">
                    <h3> There are unapproved users that need to be reviewed</h3>
                    <h4><a href="approve_user.php">Click here to approve users.</a></h4>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Users</span>
                </strong>
                <a href="add_user.php" class="btn btn-info pull-right">Add New User</a>
            </div>
            <div class="panel-body">

                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Username</th>
                        <th class="text-center">User Role</th>
                        <th>Last Login</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_users as $a_user): ?>
                        <tr>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['name'])) ?></td>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['username'])) ?></td>
                            <td class="text-center"><?php echo make_HTML_compliant(ucwords($a_user['group_name'])) ?></td>

                            <td><?php echo read_date($a_user['last_login']) ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_user.php?id=<?php echo (int)$a_user['id']; ?>"
                                       class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a href="delete_user.php?id=<?php echo (int)$a_user['id']; ?>"
                                       class="btn btn-sm btn-danger" data-toggle="tooltip" title="Remove">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </div>
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
