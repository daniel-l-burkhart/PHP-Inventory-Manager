<?php
$page_title = 'Employee Dashboard';
require_once('includes/load.php');
validate_access_level(3);
?>

<?php
$products_sold = find_highest_selling_product('10');
?>

<?php include_once('header.php'); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo make_alert_msg($msg); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="jumbotron text-center row">
                <h1>Hello Employee!</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-usd"></span>
                        <span>Highest Selling Products</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Total Sold</th>
                            <th>Total Quantity</th>
                        <tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products_sold as $product_sold): ?>
                            <tr>
                                <td>
                                    <?php echo make_HTML_compliant(capitalize_first_letter($product_sold['name'])); ?>
                                </td>
                                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                                <td><?php echo (int)$product_sold['totalQty']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<?php include_once('footer.php'); ?>
