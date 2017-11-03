<?php
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn() == true) {
    redirect_to_page('home.php', false);
}
?>

<?php include_once('indexHeader.php'); ?>

<div class="container">

    <div class="jumbotron text-center row">
        <h1>Welcome to the inventory system!</h1>
    </div>
</div>

<?php echo make_alert_msg($msg); ?>

<div class="container">

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Login</span>
                </strong>
            </div>

            <div class="panel-body">

                <form method="post" action="auth.php" class="clearfix">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="name" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="Password" class="control-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success  pull-right">Login</button>
                    </div>
                </form>
            </div>

        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Request User Account</span>
                </strong>
            </div>
            <div class="panel-body text-center">
                <h2>New Employee?</h2>
                <a href="/~dburkhart1/project2/user/add_user.php">Click here to request account.</a>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Browse as Guest </span>
                </strong>
            </div>
            <div class="panel-body">
                <h2 class="text-center"><a href="/~dburkhart1/project2/product/product.php">Or just browse products as a
                        guest. </a></h2>
            </div>
        </div>
    </div>


</div>

<?php include_once('footer.php'); ?>
