<?php
$page_title = 'All sale';
require_once('../includes/load.php');

validate_access_level(3);
?>

<?php
$all_sales = find_all_sales();
?>

<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center row">
        <h1>Sales!</h1>
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
                    <span>All Sales</span>
                </strong>
                <div class="pull-right">
                    <a href="add_sale.php" class="btn btn-primary">Add sale</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> Product name</th>
                        <th class="text-center"> Quantity</th>
                        <th class="text-center"> Total</th>
                        <th class="text-center"> Date</th>
                        <?php if (get_user_level() === '1' || get_user_level() === '2'): ?>
                            <th class="text-center"> Actions</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_sales as $sale): ?>
                        <tr>

                            <td>
                                <?php echo make_HTML_compliant($sale['name']); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (int)$sale['quantity']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo make_HTML_compliant($sale['price']); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $sale['date']; ?>
                            </td>

                            <?php if (get_user_level() === '1' || get_user_level() === '2'): ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>"
                                           class="btn btn-warning btn-sm" title="Edit" data-toggle="tooltip">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>"
                                           class="btn btn-danger btn-sm" title="Delete" data-toggle="tooltip">
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
