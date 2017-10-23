<?php
$page_title = 'My profile';
require_once('includes/load.php');
validate_access_level(3);
?>
<?php
$user_id = (int)$_GET['id'];
if (empty($user_id)):
    redirect('home.php', false);
else:
    $user_p = find_by_id('users', $user_id);
endif;
?>
<?php include_once('header.php'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="panel profile">
            <div class="jumbotron text-center bg-red">
                <h3><?php echo first_character($user_p['name']); ?></h3>
            </div>

            <div class="container">
                <ul class="list-group">
                    <li class="list-group-item"> <?php echo remove_junk(ucwords($user_p['name'])) ?></li>
                    <li class="list-group-item"> <?php echo remove_junk(ucwords($user_p['username'])) ?></>
                    <li class="list-group-item"> <?php echo remove_junk(ucwords($user_p['group_name'])) ?></li>
                    <li class="list-group-item"> <?php echo read_date($user_p['last_login']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>
