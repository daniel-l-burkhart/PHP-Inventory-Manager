<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php if (!empty($page_title))
            echo make_HTML_compliant($page_title);
        elseif (!empty($user))
            echo ucfirst($user['name']);
        else echo "DB Inventory System";
        ?>

    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>

<?php if ($session->isUserLoggedIn(true)): ?>

    <?php if ($user['user_level'] === '1'): ?>
        <!-- admin menu -->
        <?php include_once('admin_menu.php'); ?>

    <?php elseif ($user['user_level'] === '2'): ?>
        <!-- Special user -->
        <?php include_once('manager_menu.php'); ?>

    <?php elseif ($user['user_level'] === '3'): ?>
        <!-- User menu -->
        <?php include_once('employee_menu.php'); ?>
    <?php endif; ?>

<?php else: ?>

    <?php include_once('guest_menu.php'); ?>

<?php endif; ?>

<div class="page">
    <div class="container-fluid">
