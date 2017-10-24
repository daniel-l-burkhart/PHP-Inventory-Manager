<?php
$page_title = 'All User';
require_once('../includes/load.php');
?>
<?php

validate_access_level(1);
$unapproved_users = find_unapproved_users();
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
                        <th class="text-center"">#</th>
                        <th>Name </th>
                        <th>Username</th>
                        <th class="text-center">User Role</th>
                        <th>Last Login</th>
                        <th class="text-center" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($unapproved_users as $a_user): ?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['name']))?></td>
                            <td><?php echo make_HTML_compliant(ucwords($a_user['username']))?></td>
                            <td class="text-center"><?php echo make_HTML_compliant(ucwords($a_user['group_name']))?></td>

                            <td><?php echo read_date($a_user['last_login'])?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once('../footer.php'); ?>
