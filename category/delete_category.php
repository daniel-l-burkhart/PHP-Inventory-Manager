<?php
require_once('../includes/load.php');

validate_access_level(1);
?>
<?php

$category = find_record_by_id('categories', (int)$_GET['id']);
if (!$category) {
    $session->msg("danger", "Missing Category id.");
    redirect_to_page('category.php');
}

?>
<?php

$delete_id = delete_by_id('categories', (int)$category['id']);

if ($delete_id) {
    $session->msg("success", "Category deleted.");
    redirect_to_page('category.php');
} else {
    $session->msg("success", "Category deletion failed.");
    redirect_to_page('category.php');
}
?>
