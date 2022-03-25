<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="active">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Bảng trạng thái</a>
        </li>
        <li>
            <a href="employees.php"><i class="fa fa-fw fa-users"></i> Nhân viên</a>
        </li>
        <li>
            <a href="users.php"><i class="fa fa-fw fa-users"></i> Khách hàng </a>
        </li>
        <li>
            <a href="bill.php"><i class="fa fa-fw fa-dollar"></i> Hóa đơn </a>
        </li>
        <?php if ($_SESSION['account'] == 0): ?>
        <li>
            <a href="table_price.php"><i class="fa fa-fw fa-adjust"></i> Cập nhật giá điện </a>
        </li>
        <?php endif; ?>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
