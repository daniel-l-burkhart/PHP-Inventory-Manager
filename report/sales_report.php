<?php
$page_title = 'Sale Report';
require_once('../includes/load.php');
validate_access_level(1);
?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron text-center row">
        <h1>Sales Report by Date!</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php echo make_alert_msg($msg); ?>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-list-alt"></span>
                    <span>Sales Report by Date Range</span>
                </strong>
            </div>
            <div class="panel-body">

                <form class="clearfix" method="post" action="sale_report_process.php">
                    <div class="form-group">
                        <label class="form-label">Date Range</label>
                        <div class="input-group">
                            <input type="text" class="datepicker form-control" name="start-date" placeholder="From">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                            <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
</div>

<?php include_once('../footer.php'); ?>
