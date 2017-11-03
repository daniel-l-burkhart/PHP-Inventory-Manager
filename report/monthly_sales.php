<?php
$page_title = 'Monthly Sales';
require_once('../includes/load.php');
validate_access_level(1);
?>
<?php
$year = date('Y');
$sales = get_sales_for_the_month($year);
?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center row">
        <h1>Monthly Sales!</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php echo make_alert_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Monthly Sales</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> Product name</th>
                        <th class="text-center"> Quantity sold</th>
                        <th class="text-center"> Total</th>
                        <th class="text-center"> Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?php echo make_HTML_compliant($sale['name']); ?></td>
                            <td class="text-center"><?php echo (int)$sale['quantity']; ?></td>
                            <td class="text-center"><?php echo make_HTML_compliant($sale['total_selling_price']); ?></td>
                            <td class="text-center"><?php echo $sale['date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once('../footer.php'); ?>
