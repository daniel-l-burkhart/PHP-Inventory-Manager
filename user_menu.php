<nav class="navbar navbar-inverse">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#inv-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Inventory System</a>
        </div>

        <div class="collapse navbar-collapse" id="inv-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="/project2/home.php">                    <i class="glyphicon glyphicon-home"></i>
                        Home <span class="sr-only">(current)</span></a></li>

                <li class="nav-item">
                    <a class="nav-link" href="/project2/category/category.php" >
                        <i class="glyphicon glyphicon-indent-left"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-th-large"></i>
                        Products <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="/project2/product/product.php">Manage products</a></li>
                    </ul>
                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-th-list"></i>
                        Sales <span class="caret"></span></a>

                    <ul class="dropdown-menu">

                        <li> <a class="dropdown-item" href="/project2/product/add_sale.php">Add Sale</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/project2/profile.php?id=<?php echo (int)$user['id']; ?>">
                                <i class="glyphicon glyphicon-user"></i>
                                Profile
                            </a>

                        </li>

                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="/project2/logout.php">
                                <i class="glyphicon glyphicon-off"></i>
                                Logout
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>

        </div>
</nav>