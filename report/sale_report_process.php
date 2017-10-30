<?php
$page_title = 'Sales Report';
$results = '';
require_once('../includes/load.php');
validate_access_level(3);
?>
<?php
if (isset($_POST['submit'])) {
    $req_dates = array('start-date', 'end-date');
    validate_fields($req_dates);

    if (empty($errors)) {
        $start_date = make_HTML_compliant($db->get_escape_string($_POST['start-date']));
        $end_date = make_HTML_compliant($db->get_escape_string($_POST['end-date']));
        $results = find_sale_by_dates($start_date, $end_date);
    } else {
        $session->msg("danger", $errors);
        redirect_to_page('sales_report.php', false);
    }

} else {
    $session->msg("danger", "Select dates");
    redirect_to_page('sales_report.php', false);
}
?>

<?php include_once('../header.php'); ?>

<?php if ($results): ?>
    <div class="container">
        <div class="jumbotron text-center row">
            <h1>Sales Report</h1>
            <strong><?php if (isset($start_date)) {
                    echo "From ";
                    echo $start_date;
                } ?><?php if (isset($end_date)) {
                    echo " To ";
                    echo $end_date;
                } ?> </strong>
        </div>

        <table class="table table-border">
            <thead>
            <tr>
                <th>Date</th>
                <th>Product Title</th>
                <th>Vendor Cost Price</th>
                <th>Selling Price</th>
                <th>Total Quantity</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td class=""><?php echo make_HTML_compliant($result['date']); ?></td>
                    <td><strong><?php echo make_HTML_compliant(ucfirst($result['name'])); ?></strong></td>
                    <td>$<?php echo make_HTML_compliant($result['cost_price']); ?></td>
                    <td>$<?php echo make_HTML_compliant($result['sale_price']); ?></td>
                    <td><?php echo make_HTML_compliant($result['total_sales']); ?></td>
                    <td><?php echo make_HTML_compliant($result['total_selling_price']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr class="text-right">
                <td colspan="4"></td>
                <td colspan="1">Grand Total</td>
                <td> $
                    <?php echo number_format(total_price($results)[0], 2); ?>
                </td>
            </tr>
            <tr class="text-right">
                <td colspan="4"></td>
                <td colspan="1">Profit</td>
                <td> $<?php echo number_format(total_price($results)[1], 2); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <?php
else:
    $session->msg("danger", "Sorry no sales has been found. ");
    redirect_to_page('sales_report.php', false);
endif;
?>

<?php include_once('../footer.php'); ?>

