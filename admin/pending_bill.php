<div class="table-responsive">
    <table class="table table-hover table-bordered table-striped" id="list2">
        <thead>
        <tr>
            <th>SHĐ</th>
            <th>Khách hàng</th>
            <th>Ngày lập</th>
            <th>Số điện</th>
            <th>Số tiền</th>
            <th>Phạt quá hạn</th>
            <th>Tổng tiền</th>
            <th>Hạn thanh toán</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $id=$_SESSION['aid'];
        $result = get_bills_pending($_SESSION['aid']);
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <form action="pending_bill_accept.php" method="post" name="form_accept_bill" onsubmit="return checkInp()">
                    <input type="hidden" name="bid" value=<?php echo $row['bid'] ?> >
                    <input type="hidden" name="uid" value=<?php echo $row['user'] ?> >
                    <td><?php echo $row['bid']?></td>
                    <td height="50"><?php echo $row['user'] ?></td>
                    <td><?php echo $row['bdate'] ?></td>
                    <td><?php echo $row['units'] ?></td>
                    <td><?php echo $row['amount'].' VNĐ' ?></td>
                    <td><?php echo $row['dues'].' VNĐ' ?></td>
                    <td><?php echo $row['pay'].' VNĐ' ?></td>
                    <td><?php echo $row['ddate'] ?></td>
                    <td><?php echo'<span class="badge" style="background: greenyellow;">'.$row["status"].'</span>' ?></td>
                    <td class="text-center">
                        <button type="submit" name="accept_bill" class="btn btn-success form-control fa fa-fw fa-check"></button>
                        <button type="submit" name="decline_bill" class="btn btn-success form-control fa fa-fw fa-close" style="background-color: red"></button>
                    </td>
                </form>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<!-- .table-responsive -->