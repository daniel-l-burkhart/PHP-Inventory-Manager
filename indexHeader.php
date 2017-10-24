<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
            echo make_HTML_compliant($page_title);
        elseif (!empty($user))
            echo ucfirst($user['name']);
        else echo "Simple inventory System"; ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
    <link rel="stylesheet" href="/project2/libs/css/main.css"/>
</head>
<body>

<div class="page">
    <div class="container-fluid">