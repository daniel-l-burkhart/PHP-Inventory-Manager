<?php
$page_title = 'All Product';
require_once('../includes/load.php');

$products = get_all_products();
?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center">
        <h1>View Products!</h1>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <?php echo make_alert_msg($msg); ?>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">

                    <?php if (get_user_level() === '1' OR get_current_user() === '2'): ?>
                        <div class="pull-right">
                            <a href="add_product.php" class="btn btn-primary">Add New</a>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> Product Title</th>
                            <th class="text-center"> Category</th>
                            <th class="text-center" > In stock</th>

                            <?php if (get_user_level() === '1' OR get_current_user() === '2'): ?>
                                <th class="text-center"> Buying Price</th>
                            <?php endif; ?>
                            <th class="text-center"> Selling Price</th>

                            <?php if (get_user_level() === '1' OR get_current_user() == '2'): ?>

                                <th class="text-center" > Product Added</th>
                                <th class="text-center"> Actions</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <?php echo make_HTML_compliant($product['name']); ?>
                                </td>

                                <td class="text-center">
                                    <?php echo make_HTML_compliant($product['category']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo make_HTML_compliant($product['quantity']); ?>
                                </td>

                                <?php if (get_user_level() == '1' || get_current_user() === '2'): ?>
                                    <td class="text-center">
                                        <?php echo make_HTML_compliant($product['buy_price']); ?>
                                    </td>
                                <?php endif; ?>

                                <td class="text-center">
                                    <?php echo make_HTML_compliant($product['sale_price']); ?>
                                </td>

                                <?php if (get_user_level() === '1' || get_current_user() === '2'): ?>

                                    <td class="text-center">
                                        <?php echo read_date($product['date']); ?>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="edit_product.php?id=<?php echo (int)$product['id']; ?>"
                                               class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a href="delete_product.php?id=<?php echo (int)$product['id']; ?>"
                                               class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
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