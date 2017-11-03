<nav class="navbar navbar-inverse">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#inv-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/~dburkhart1//project2/home.php">Inventory System</a>
        </div>

        <div class="collapse navbar-collapse" id="inv-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="nav-item">
                    <a href="/~dburkhart1/project2/admin.php">
                        <i class="glyphicon glyphicon-home"></i>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/~dburkhart1/project2/category/category.php">
                        <i class="glyphicon glyphicon-indent-left"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/~dburkhart1/project2/user/users.php">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>User Management</span>
                    </a>
                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"> <i class="glyphicon glyphicon-th-large"></i>
                        Products <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/product/product.php">Manage
                                products</a></li>
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/product/add_product.php">Add
                                product</a></li>
                    </ul>
                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"> <i class="glyphicon glyphicon-th-list"></i>
                        Sales <span class="caret"></span></a>

                    <ul class="dropdown-menu">

                        <li><a class="dropdown-item" href="/~dburkhart1/project2/sale/sales.php">Manage Sales</a></li>
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/sale/add_sale.php">Add Sale</a></li>
                    </ul>

                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-signal"></i>
                        Sales Report <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/report/sales_report.php">Sales by
                                dates</a></li>
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/report/monthly_sales.php">Monthly
                                sales</a></li>
                        <li><a class="dropdown-item" href="/~dburkhart1/project2/report/daily_sales.php">Daily sales</a>
                        </li>

                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <?php echo $user['name'] ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/~dburkhart1/project2/profile.php?id=<?php echo (int)$user['id']; ?>">
                                <i class="glyphicon glyphicon-user"></i>
                                Profile
                            </a>

                        </li>

                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="/~dburkhart1/project2/logout.php">
                                <i class="glyphicon glyphicon-off"></i>
                                Logout
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>

        </div>
</nav>