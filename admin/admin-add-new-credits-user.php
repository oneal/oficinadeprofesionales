<?php
include "header.php";

if(isset($_GET['row'])){
    $user_details_row = getUser($_GET['row']);
    
    if(empty($user_details_row)){
        header('Location: admin-all-users.php');
        exit;
    }
}else{
    header('Location: admin-all-users.php');
    exit;
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <form action="update_credits_user.php" class="listing_form" id="listing_form" name="listing_form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4><?php echo $BIZBOOK['NEW_CREDIT'];?></h4>
                                        <p>Hola <?php echo $user_details_row['first_name']; ?>, </br>
                                            <?php echo $BIZBOOK['YOUR_CURRENT_POINT'];?> : <b><?php echo AddingZero_BeforeNumber($user_details_row['user_credit']);?></p>
                                        <div class="form-group">
                                            <select name="credit_plan" required="required" id="credit_plan" class="form-control">
                                                <option value="" selected="selected"><?php echo $BIZBOOK['CHOOSE_YOUR_PLAN']; ?></option>
                                                <?php

                                                $credit = "SELECT * FROM " . TBL . "credits WHERE credit_status='Active' ORDER BY credit_id ASC";


                                                $rs_credit = mysqli_query($conn, $credit);

                                                $si = 1;
                                                while ($credit_row = mysqli_fetch_array($rs_credit)) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $credit_row['credit_id']; ?>"><?php echo $credit_row['credit_name'];
                                                        if ($credit_row['credit_price'] != 0) {
                                                            echo ' - ' .$footer_row['currency_symbol'] . '' . $credit_row['credit_price'] . ' / ' . $credit_row['credit_points']. ' Points';
                                                        } ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" name="credit_submit" class="btn btn-primary"><?php echo $BIZBOOK['SEND'];?></button>
                                        <input type="hidden" name="u_i" value="<?php echo $user_details_row['user_code'];?>"/>
                                        <div class="col-md-12">
                                            <a href="admin-all-users.php" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD'];?> &gt;&gt;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/select-opt.min.js"></script>
<script src="js/admin-custom.min.js"></script>

</body>

</html>
