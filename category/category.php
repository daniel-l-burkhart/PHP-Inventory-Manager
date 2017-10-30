<?php
$page_title = 'All categories';
require_once('../includes/load.php');

validate_access_level(3);

$all_categories = get_all_from_table('categories')
?>

<?php
if (isset($_POST['add_new_category'])) {

    $req_field = array('category-name');
    validate_fields($req_field);

    $new_category_name = make_HTML_compliant($db->get_escape_string($_POST['category-name']));

    if (empty($errors)) {
        $sql = "INSERT INTO categories (name) VALUES ('{$new_category_name}')";

        if ($db->run_query($sql)) {
            $session->msg("success", "Successfully Added Category");
            redirect_to_page('category.php', false);
        } else {
            $session->msg("danger", "Sorry Failed to insert.");
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
        <h1>Categories!</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo make_alert_msg($msg); ?>
        </div>
    </div>

    <?php if(get_user_level() === '1' || get_user_level() === '2'): ?>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Category</span>
                </strong>
            </div>

            <div class="panel-body">
                <form method="post" action="category.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="category-name" placeholder="Category Name">
                    </div>
                    <button type="submit" name="add_new_category" class="btn btn-primary">Add category</button>
                </form>
            </div>

        </div>
    </div>
    <?php endif; ?>


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Categories</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Categories</th>

                        <?php if(get_user_level() === '1' || get_user_level() === '2'): ?>

                        <th class="text-center">Actions</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_categories as $currCategory): ?>
                        <tr>
                            <td><?php echo make_HTML_compliant(ucfirst($currCategory['name'])); ?></td>

                        <?php if(get_user_level() === '1' || get_user_level() === '2'): ?>
                            <td class="text-center">
                                <div class="btn-group">

                                    <a href="edit_category.php?id=<?php echo (int)$currCategory['id']; ?>"
                                       class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">

                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>

                                    <a href="delete_category.php?id=<?php echo (int)$currCategory['id']; ?>"
                                       class="btn btn-sm btn-danger" data-toggle="tooltip" title="Remove">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </td>
                        <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<?php include_once('../footer.php'); ?>
