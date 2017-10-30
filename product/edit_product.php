<?php
$page_title = 'Edit product';
require_once('../includes/load.php');

validate_access_level(2);
?>
<?php

$single_product = find_record_by_id('products', (int)$_GET['id']);
$all_categories = get_all_from_table('categories');

if (!$single_product) {
    $session->msg("danger", "Missing product id.");
    redirect_to_page('product.php');
}

?>
<?php
if (isset($_POST['product'])) {

    $req_fields = array('product-title', 'product-category', 'product-quantity', 'cost-price', 'selling-price');
    validate_fields($req_fields);

    if (empty($errors)) {

        $p_name = make_HTML_compliant($db->get_escape_string($_POST['product-title']));
        $p_cat = (int)$_POST['product-category'];
        $p_quantity = make_HTML_compliant($db->get_escape_string($_POST['product-quantity']));
        $p_cost = make_HTML_compliant($db->get_escape_string($_POST['cost-price']));
        $p_sale = make_HTML_compliant($db->get_escape_string($_POST['selling-price']));

        $query = "UPDATE products SET";
        $query .= " name ='{$p_name}', quantity ='{$p_quantity}', cost_price ='{$p_cost}', sale_price ='{$p_sale}', category_id ='{$p_cat}' ";
        $query .= " WHERE id ='{$single_product['id']}'";

        $result = $db->run_query($query);

        if ($result && $db->affected_rows() === 1) {
            $session->msg("success", "Product updated ");
            redirect_to_page('product.php', false);
        } else {
            $session->msg("danger", ' Information unchanged or error - product not updated!');
            redirect_to_page('edit_product.php?id=' . $single_product['id'], false);
        }

    } else {
        $session->msg("danger", $errors);
        redirect_to_page('edit_product.php?id=' . $single_product['id'], false);
    }

}

?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center">
        <h1>Edit Products!</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo make_alert_msg($msg); ?>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span>Edit Product</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-10">
                    <form method="post" action="edit_product.php?id=<?php echo (int)$single_product['id'] ?>">
                        <div class="form-group">
                            <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                                <input type="text" class="form-control" name="product-title"
                                       value="<?php echo make_HTML_compliant($single_product['name']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" name="product-category">
                                        <option value=""> Select a category</option>
                                        <?php foreach ($all_categories as $cat): ?>
                                            <option value="<?php echo (int)$cat['id']; ?>"
                                                <?php if ($single_product['category_id'] === $cat['id']): echo "selected"; endif; ?> >
                                                <?php echo make_HTML_compliant($cat['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product-quantity">Quantity</label>
                                        <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                                            <input type="number" class="form-control" name="product-quantity"
                                                   value="<?php echo make_HTML_compliant($single_product['quantity']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cost-price">Cost price</label>
                                        <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                                            <input type="number" class="form-control" name="cost-price"
                                                   value="<?php echo make_HTML_compliant($single_product['cost_price']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="selling-price">Selling price</label>
                                        <div class="input-group">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                                            <input type="number" class="form-control" name="selling-price"
                                                   value="<?php echo make_HTML_compliant($single_product['sale_price']); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="product" class="btn btn-danger">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../footer.php'); ?>
