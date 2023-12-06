<?php
include "header.php";
?>
    <!-- START -->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> fedback">
            <img src="images/feedback.jpg" title="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" alt="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" class="fed">
        <div class="fed-box">
            <div class="lhs">
                <h3><?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?></h3>
                <?php include "page_level_message.php"; ?>
                <form name="feedback_form" id="feedback_form" method="post" action="feedback_submit.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" placeholder="<?php echo $BIZBOOK['NAME'];?>*" name="feedback_name" id="feedback_name" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" required="required"
                               name="feedback_email"
                               pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                               title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" id="feedback_mobile" name="feedback_mobile"
                               placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *" required="">
                    </div>
                    <div class="form-group">
                        <textarea name="feedback_message" id="feedback_message" required="required" placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>*"></textarea>
                    </div>
                    <div class="form-check" style="margin-bottom: 10px;">
                        <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="required">
                        <label class="form-check-label" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#contactoPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a></label>
                    </div>
                    <button type="submit" id="feedback_submit" name="feedback_submit"
                            class="btn btn-primary">
                        <?php echo $BIZBOOK['SUBMIT'];?>
                    </button>
                </form>
            </div>
            <div class="rhs">
                <h2><?php echo $BIZBOOK['YOUR_FEEDBACK'];?></h2>
                <p><?php echo $BIZBOOK['YOUR_FEEDBACK_MESSAGE'];?></p>
                <?php /*<ul>
                    <li><a href="#"><img src="images/icon/facebook.png" title="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" alt="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>"></a></li>
                    <li><a href="#"><img src="images/icon/twitter.png" title="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" alt="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>"></a></li>
                    <li><a href="#"><img src="images/icon/linkedin.png" title="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" alt="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>"></a></li>
                    <li><a href="#"><img src="images/icon/whatsapp.png" title="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>" alt="<?php echo $BIZBOOK['SEND_YOUR_FEEDBACKS'];?>"></a></li>
                </ul>*/?>
                <h4><?php echo $BIZBOOK['WHY_SEND_FEEDBACK'];?></h4>
                <p><?php echo $BIZBOOK['USEFUL_FEATURE_UPDATE'];?></p>
                <p><?php echo $BIZBOOK['HELPER_CUSTOMER_FEEDBACK'];?></p>
            </div>
        </div>
	</section>
	<!--END-->

<?php
include "modal_politca_privacidad.php";
?> 
<?php
include "footer.php";
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>

