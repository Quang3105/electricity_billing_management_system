   <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered table-condensed" id="list1">
        <colgroup>
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <thead>
            <tr>
                <!-- <th>#</th> -->
                <th>Khách hàng</th>
                <th>Số điện</th>
                <th>Ngày lập đơn</th>
                <th>Hạn thanh toán</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id=$_SESSION['aid'];
            $result = get_bill_data();

            while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <form action="generate_bill.php" method="post" name="form_gen_bill">
                    <?php
                        $query3 = "SELECT bdate as bdate1 from bill ,user WHERE user.id=bill.uid and user.id={$row['uid']} ORDER BY bill.id DESC ";
                        $result3 = mysqli_query($con,$query3);
                        $flag=0;
                        while($row2 = mysqli_fetch_assoc($result3)){
                            if($row2['bdate1']==$row['bdate']) $flag=1;
                        }
                        
                        if($flag==0)
                        {
                     ?>
                        <input type="hidden" name="uid" value=<?php echo $row['uid'] ?> >
                        <input type="hidden" name="uname" value=<?php echo $row['uname'] ?> >
                        
                        <td height="50">
                            <?php echo $row['uname'] ?>
                        </td>
                        <td>                                                
                            <input class="form-control" type="number" name="units" placeholder="Nhập số điện">
                        </td>
                        <td>
                            <?php echo $row['bdate'] ?> 
                        </td>
                        <td>
                            <?php echo $row['ddate'] ?>
                        </td>
                        <td>
                            <button type="submit" name="generate_bill" class="btn btn-success form-control">Tạo hóa đơn </button>
                        </td>
                    <?php 
                        } 
                    ?>
                    </form>
                </tr>                
                <?php 
                    } 
                ?>
            </tbody>                
        </table>
    </div><!-- ./table-responsive -->