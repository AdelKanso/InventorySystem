<!-- /.navbar-top-links -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="">
                <a href="/" style="color:#0275d8;font-size: 18px;"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li class="">
                <a href="/items_sold" style="color:#0275d8;font-size: 18px;"><img src="dist/asas.jpg" alt="" width="24" height="20">Plasma Operations</a>
            </li>
            <li class="">
                <a href="/items_soldd" style="color:#0275d8;font-size: 18px;"><img src="dist/asss.png" alt="" width="24" height="20">Router Operations</a>
            </li>
            <li class="">
                <a href="/customers" style="color:#0275d8;font-size: 18px;"><i class="fa fa-users fa-fw"></i>Customers</a>
            </li>
            <li class="">
                <a href="/machineConsumable" style="color:#0275d8;font-size: 18px;"><img src="dist/sparePart.png" width="24" height="20">Machine Consumables</a>
            </li>
            <li class="">
                <a href="/stocks" style="color:#0275d8;font-size: 18px;"><i class="fa fa-archive fa-fw"></i>Stock</a>
            </li>
            <li class="">
                <a href="/merchants" style="color:#0275d8;font-size: 18px;"><i class="fa fa-industry fa-fw"></i>Merchants</a>
            </li>
            <li class="">
                <a href="/products" style="color:#0275d8;font-size: 18px;"><i class="fa fa-shopping-bag fa-fw"></i>Products</a>
            </li>
            <li class="">
                <a href="/print" style="color:#0275d8;font-size: 18px;"><i class="fa fa-print fa-fw"></i>Invoice</a>
            </li>
            <?php
            if ($_SESSION['admin'] == 1) {
            ?>
                <li class="">
                    <a href="/employees" style="color:#0275d8;font-size: 18px;"><i class="fa fa-black-tie fa-fw"></i>Employees</a>
                </li>
                <li class="">
                    <a href="/users" style="color:#0275d8;font-size: 18px;"><i class="fa fa-user-plus fa-fw"></i>Users</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->