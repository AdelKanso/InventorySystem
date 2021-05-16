<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="">
                <a href="/" style="color:#0275d8;font-size: 18px;"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php
            if ($_SESSION['role'] == 'admin'||$_SESSION['role'] == 'accountant'||$_SESSION['role'] == 'engineer') {
            ?>
            <li class="">
                <a href="/plasma" style="color:#0275d8;font-size: 18px;"><img src="dist/images/plasmaImage.jpg" alt="" width="24" height="20"> Plasma Operations</a>
            </li>
            <li class="">
                <a href="/router" style="color:#0275d8;font-size: 18px;"><img src="dist/images/routerImage.png" alt="" width="24" height="20"> Router Operations</a>
            </li>
            <li class="">
                <a href="/customers" style="color:#0275d8;font-size: 18px;"><i class="fa fa-users fa-fw"></i> Customers</a>
            </li>
            <li class="">
                <a href="/machineConsumable" style="color:#0275d8;font-size: 18px;"><img src="dist/images/sparePart.png" width="24" height="20"> Machine Consumables</a>
            </li>
            <li class="">
                <a href="/stocks" style="color:#0275d8;font-size: 18px;"><i class="fa fa-archive fa-fw"></i> Stock</a>
            </li>
            <li class="">
                <a href="/merchants" style="color:#0275d8;font-size: 18px;"><i class="fa fa-industry fa-fw"></i> Merchants</a>
            </li>
            <li class="">
                <a href="/rawMaterials" style="color:#0275d8;font-size: 18px;"><i class="fa fa-shopping-bag fa-fw"></i> Raw Materials</a>
            </li>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin'||$_SESSION['role'] == 'accountant') {
            ?>
            <li class="">
                <a href="/invoice" style="color:#0275d8;font-size: 18px;"><i class="fa fa-print fa-fw"></i> Invoice</a>
            </li>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <li class="">
                    <a href="/employees" style="color:#0275d8;font-size: 18px;"><i class="fa fa-black-tie fa-fw"></i> Employees</a>
                </li>
                <li class="">
                    <a href="/users" style="color:#0275d8;font-size: 18px;"><i class="fa fa-user-plus fa-fw"></i> Users</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->