<?php
$page_title = 'Add Sale';
require_once('../includes/load.php');

validate_access_level(3);
?>
<?php

if (isset($_POST['add_sale'])) {

    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');

    validate_fields($req_fields);

    if (empty($errors)) {

        $p_id = $db->get_escape_string((int)$_POST['s_id']);
        $s_quantity = $db->get_escape_string((int)$_POST['quantity']);
        $s_total = $db->get_escape_string($_POST['total']);
        $date = $db->get_escape_string($_POST['date']);

        $sql = "INSERT INTO sales (product_id,quantity,price,date) VALUES ('{$p_id}','{$s_quantity}','{$s_total}',NOW());";

        if ($db->run_query($sql)) {

            update_product_qty($s_quantity, $p_id);
            $session->msg("success", "Sale added. ");
            redirect_to_page('add_sale.php', false);

        } else {
            $session->msg("danger", ' Sorry failed to add sale!');
            redirect_to_page('add_sale.php', false);
        }

    } else {
        $session->msg("danger", $errors);
        redirect_to_page('add_sale.php', false);
    }
}

?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center">
        <h1>Add Sale!</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo make_alert_msg($msg); ?>
            <form method="post" action="suggestion.php" autocomplete="off" id="sug-form">
                <div class="form-group">
                    <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
                        <input type="text" id="sug_input" class="form-control" name="title"
                               placeholder="Search for product name">
                    </div>
                    <ul id="result" class="list-group">

                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Add Sale</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="add_sale.php">
                        <table class="table table-bordered">

                            <thead>
                            <th> Item</th>
                            <th> Price</th>
                            <th> Quantity</th>
                            <th> Total</th>
                            <th> Date</th>
                            <th> Action</th>
                            </thead>

                            <tbody id="product_info"></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../footer.php'); ?>
