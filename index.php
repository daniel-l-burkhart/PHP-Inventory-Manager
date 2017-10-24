<?php
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
    redirect_to_page('home.php', false);
}
?>
<?php include_once('indexHeader.php'); ?>

<div class="container">
<div class="jumbotron text-center">
    <h2>Welcome to the inventory system!</h2>
</div>
<br/>
<div class="login-page">

    <div class="text-center">
        <h3>Login</h3>
    </div>

    <?php echo make_alert_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info  pull-right">Login</button>
        </div>
    </form>
</div>

    <div class="col-md-12">
    <h2 class="text-center"> <a href="/project2/product/product.php">Or just browse products as a guest. </a></h2>

</div>
</div>

<?php include_once('footer.php'); ?>
