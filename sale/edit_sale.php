<?php
$page_title = 'Edit sale';
require_once('../includes/load.php');
validate_access_level(2);

$sale = find_record_by_id('sales', (int)$_GET['id']);
if (!$sale) {
    $session->msg("d", "Missing product id.");
    redirect_to_page('sales.php');
}
$product = find_record_by_id('products', $sale['product_id']);

if (isset($_POST['update_sale'])) {
    $req_fields = array('title', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);
    if (empty($errors)) {
        $p_id = $db->escape((int)$product['id']);
        $s_qty = $db->escape((int)$_POST['quantity']);
        $s_total = $db->escape($_POST['total']);
        $date = $db->escape($_POST['date']);
        $s_date = date("Y-m-d", strtotime($date));

        $sql = "UPDATE sales SET";
        $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
        $sql .= " WHERE id ='{$sale['id']}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', "Sale updated.");
            redirect_to_page('edit_sale.php?id=' . $sale['id'], false);
        } else {
            $session->msg('d', ' Sorry failed to updated!');
            redirect_to_page('sales.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect_to_page('edit_sale.php?id=' . (int)$sale['id'], false);
    }
}

?>
<?php include_once('../header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo make_alert_msg($msg); ?>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Sales</span>
                </strong>
                <div class="pull-right">
                    <a href="sales.php" class="btn btn-primary">Show all sales</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <th> Product title</th>
                    <th> Qty</th>
                    <th> Price</th>
                    <th> Total</th>
                    <th> Date</th>
                    <th> Action</th>
                    </thead>
                    <tbody id="product_info">
                    <tr>
                        <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                            <td id="s_name">
                                <input type="text" class="form-control" id="sug_input" name="title"
                                       value="<?php echo make_HTML_compliant($product['name']); ?>">
                                <div id="result" class="list-group"></div>
                            </td>
                            <td id="s_qty">
                                <input type="text" class="form-control" name="quantity"
                                       value="<?php echo (int)$sale['qty']; ?>">
                            </td>
                            <td id="s_price">
                                <input type="text" class="form-control" name="price"
                                       value="<?php echo make_HTML_compliant($product['sale_price']); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="total"
                                       value="<?php echo make_HTML_compliant($sale['price']); ?>">
                            </td>
                            <td id="s_date">
                                <input type="date" class="form-control datepicker" name="date" data-date-format=""
                                       value="<?php echo make_HTML_compliant($sale['date']); ?>">
                            </td>
                            <td>
                                <button type="submit" name="update_sale" class="btn btn-primary">Update sale</button>
                            </td>
                        </form>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

<?php include_once('../footer.php'); ?>