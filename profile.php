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
<?php include_once('header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel profile">
                <div class="jumbotron text-center bg-red">
                    <h3><?php echo uppercase_first_letter($user_p['name']); ?></h3>
                </div>

                <table class="table table-bordered">
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
<?php include_once('footer.php'); ?>
