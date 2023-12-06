<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['EDIT'];?> <?php echo $BIZBOOK['CREDIT'];?></span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['EDIT'];?> <?php echo $BIZBOOK['CREDIT'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <?php
                        $credit_id = $_GET['row'];
                        $row = getCreditType($credit_id);
                        ?>
                        <form id="credit_edit" name="credit_edit" method="post" action="update_credit_type.php">
                            <input type="hidden" class="validate" id="credit_id" name="credit_id"
                                   value="<?php echo $row['credit_id']; ?>" required="required">
                            <tbody>
                            <tr>
                                <td><?php echo $BIZBOOK['NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="credit_name"
                                               name="credit_name"
                                               value="<?php echo $row['credit_name']; ?>" required="required"
                                               class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['PRICE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="credit_price"
                                               name="credit_price"
                                               value="<?php echo $row['credit_price']; ?>"
                                               onkeypress="return isNumber(event)"
                                               required="required">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $BIZBOOK['CREDITS_POINTS'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="credit_points"
                                               name="credit_points"
                                               value="<?php echo $row['credit_points']; ?>"
                                               onkeypress="return isNumber(event)"
                                               required="required">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="submit" name="credit_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </form>
                    </table>
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
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>