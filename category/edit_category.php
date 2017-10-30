<?php
$page_title = 'Edit category';
require_once('../includes/load.php');

validate_access_level(1);
?>
<?php

$category = find_record_by_id('categories', (int)$_GET['id']);


if (!$category) {
    $session->msg("danger", "Missing category id.");
    redirect_to_page('category.php');
}
?>

<?php
if (isset($_POST['edit_cat'])) {

    $req_field = array('category-name');
    validate_fields($req_field);
    $cat_name = make_HTML_compliant($db->get_escape_string($_POST['category-name']));

    if (empty($errors)) {
        $sql = "UPDATE categories SET name='{$cat_name}'";
        $sql .= " WHERE id='{$category['id']}'";
        $result = $db->run_query($sql);

        if ($result && $db->affected_rows() === 1) {
            $session->msg("success", "Successfully updated Category");
            redirect_to_page('category.php', false);
        } else {
            $session->msg("danger", "Sorry! Failed to Update");
            redirect_to_page('category.php', false);
        }

    } else {
        $session->msg("danger", $errors);
        redirect_to_page('category.php', false);
    }
}
?>
<?php include_once('../header.php'); ?>

<div class="container">

    <div class="jumbotron text-center row">
        <h1>Edit Category</h1>
    </div>

<div class="row">
    <div class="col-md-12">
        <?php echo make_alert_msg($msg); ?>
    </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Editing <?php echo make_HTML_compliant(ucfirst($category['name'])); ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_category.php?id=<?php echo (int)$category['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="category-name"
                               value="<?php echo make_HTML_compliant(ucfirst($category['name'])); ?>">
                    </div>
                    <button type="submit" name="edit_cat" class="btn btn-primary">Update category</button>
                </form>
            </div>
        </div>
</div>

</div>

<?php include_once('../footer.php'); ?>
