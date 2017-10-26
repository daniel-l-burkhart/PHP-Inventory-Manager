<?php
require_once('../includes/load.php');

validate_access_level(1);
?>
<?php
$delete_id = delete_by_id('users', (int)$_GET['id']);
if ($delete_id) {
    $session->msg("success", "User deleted.");
    redirect_to_page('users.php');
} else {
    $session->msg("danger", "User deletion failed Or Missing Prm.");
    redirect_to_page('users.php');
}
?>
