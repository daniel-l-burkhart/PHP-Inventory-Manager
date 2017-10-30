<?php
$page_title = 'Add Product';
require_once('../includes/load.php');

validate_access_level(2);
$all_categories = get_all_from_table('categories');

?>
<?php
if (isset($_POST['add_product'])) {

    $req_fields = array('product-title', 'product-category', 'product-quantity', 'cost-price', 'selling-price');
    validate_fields($req_fields);

    if (empty($errors)) {

        $p_name = make_HTML_compliant($db->get_escape_string($_POST['product-title']));
        $p_cat = make_HTML_compliant($db->get_escape_string($_POST['product-category']));
        $p_quantity = make_HTML_compliant($db->get_escape_string($_POST['product-quantity']));
        $p_cost = make_HTML_compliant($db->get_escape_string($_POST['cost-price']));
        $p_sale = make_HTML_compliant($db->get_escape_string($_POST['selling-price']));

        $query = "INSERT INTO products (name, quantity, cost_price, sale_price, category_id, date) VALUES ('{$p_name}', '{$p_quantity}', '{$p_cost}', '{$p_sale}', '{$p_cat}', NOW()) ON DUPLICATE KEY UPDATE name='{$p_name}'";

        if ($db->run_query($query)) {
            $session->msg('success', "Product added ");
            redirect_to_page('add_product.php', false);
        } else {
            $session->msg('danger', ' Sorry failed to added!');
            redirect_to_page('product.php', false);
        }

    } else {
        $session->msg("danger", $errors);
        redirect_to_page('add_product.php', false);
    }

}

?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center row">
        <h1>Add New Product!</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <?php echo make_alert_msg($msg); ?>
        </div>
    </div>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Product</span>
                </strong>
            </div>

            <div class="panel-body">

                <div class="col-md-12">

                    <form method="post" action="add_product.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="product-title"
                                       placeholder="Product Title">
                            </div>
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="product-category">
                                <option value="">Select Product Category</option>
                                <?php foreach ($all_categories as $cat): ?>
                                    <option value="<?php echo (int)$cat['id'] ?>">
                                        <?php echo $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>


                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                                        <input type="number" class="form-control" name="product-quantity"
                                               placeholder="Product Quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                                        <input type="number" class="form-control" name="cost-price"
                                               placeholder="Vendor Cost Price - i.e. 9.99">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                                        <input type="number" class="form-control" name="selling-price"
                                               placeholder="Selling Price - i.e. 9.99">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-success">Add product</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include_once('../footer.php'); ?>
