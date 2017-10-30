<?php
$page_title = 'Manager Dashboard';
require_once('includes/load.php');

validate_access_level(2);
?>
<?php
$products_sold   = find_highest_selling_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales    = find_recent_sale_added('5');

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
                <h1>Hello Manager!</h1>
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
                        <span class="glyphicon glyphicon-th"></span>
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
                        <?php foreach ($products_sold as  $product_sold): ?>
                            <tr>
                                <td><?php echo make_HTML_compliant(uppercase_first_letter($product_sold['name'])); ?></td>
                                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                                <td><?php echo (int)$product_sold['totalQty']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Latest Sales</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Date</th>
                            <th>Total Sale</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($recent_sales as  $recent_sale): ?>
                            <tr>
                                <td>
                                    <a href="sale/edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
                                        <?php echo make_HTML_compliant(uppercase_first_letter($recent_sale['name'])); ?>
                                    </a>
                                </td>
                                <td><?php echo make_HTML_compliant(ucfirst($recent_sale['date'])); ?></td>
                                <td>$<?php echo make_HTML_compliant(uppercase_first_letter($recent_sale['price'])); ?></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Recently Added Products</span>
                    </strong>
                </div>
                <div class="panel-body">

                    <div class="list-group">
                        <?php foreach ($recent_products as  $recent_product): ?>
                            <a class="list-group-item clearfix" href="product/edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                                <h4 class="list-group-item-heading">
                                    <span class="glyphicon glyphicon-tag"></span>
                                    <?php echo make_HTML_compliant(uppercase_first_letter($recent_product['name']));?>
                                    <span class="label label-warning pull-right">
                 $<?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                                </h4>
                                <span class="list-group-item-text pull-right">
                <?php echo make_HTML_compliant(uppercase_first_letter($recent_product['category'])); ?>
              </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once('footer.php'); ?>
