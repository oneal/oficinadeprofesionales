<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['NEW_CREDIT'];?></span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['NEW_CREDIT'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        
                        <form id="credit_add" name="credit_add" method="post" action="insert_credit_type.php">
                            
                            <tbody>
                            <tr>
                                <td><?php echo $BIZBOOK['NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="credit_name"
                                               name="credit_name"
                                                required="required"
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