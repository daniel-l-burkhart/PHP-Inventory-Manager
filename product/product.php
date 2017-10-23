<?php
$page_title = 'All Product';
require_once('../includes/load.php');

$products = get_all_products();
?>
<?php include_once('../header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">

                    <?php if (get_user_level() === 2 || get_current_user() === 1): ?>
                        <div class="pull-right">
                            <a href="add_product.php" class="btn btn-primary">Add New</a>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>

                            <th> Product Title</th>
                            <th class="text-center"> Category</th>
                            <th class="text-center" > In stock</th>

                            <?php if (get_user_level() === '1' || get_current_user() === '2'): ?>
                                <th class="text-center"> Buying Price</th>
                            <?php endif; ?>
                            <th class="text-center"> Selling Price</th>

                            <?php if (get_user_level() === '1' || get_current_user() == '2'): ?>

                                <th class="text-center" > Product Added</th>
                                <th class="text-center"> Actions</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo count_id(); ?>
                                </td>

                                <td>
                                    <?php echo remove_junk($product['name']); ?>
                                </td>

                                <td class="text-center">
                                    <?php echo remove_junk($product['category']); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo remove_junk($product['quantity']); ?>
                                </td>

                                <?php if (get_user_level() == '1' || get_current_user() === '2'): ?>
                                    <td class="text-center">
                                        <?php echo remove_junk($product['buy_price']); ?>
                                    </td>
                                <?php endif; ?>

                                <td class="text-center">
                                    <?php echo remove_junk($product['sale_price']); ?>
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