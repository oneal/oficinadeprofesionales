<?php /*
include "header.php";
?>
    <!-- START -->
    <!--PRICING DETAILS-->
    <section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg user-type">
        <div class="container">
            <div class="row">
                <div class="user-tcon">
                    <div class="user-tc-img">
                        <img src="images/user-type.png" alt="">
                    </div>
                    <div class="user-tc-diff">
                        <ul>
                            <li>
                                <div class="pri-box">
                                <div class="c6">
                                    <img src="images/icon/service.png" alt="">
                                    <h4>Service provider can</h4>
                                </div>
                                <div class="c4">
                                    <ol>
                                        <li>User dashboard</li>
                                        <li>Profile page</li>
                                        <li>Reviews</li>
                                        <li>Like listings</li>
                                        <li>Get quote & send enquiry</li>
                                        <li>Followings</li>
                                        <li>Notifications</li>
                                        <li>How to's</li>
                                        <li>Create new listing</li>
                                        <li>Create new event</li>
                                        <li>Create new blog post</li>
                                        <li>Mange listing, event & blogs</li>
                                        <li>Lead management</li>
                                        <li>Review management</li>
                                        <li>Post your Ads</li>
                                        <li>Check Our process</li>
                                        <li>Payment invoices</li>
                                    </ol>
                                </div>
                                <div class="c5">
                                    <a href="login">Get Start</a>
                                </div>
                            </div>
                            </li>
                            <li>
                                <div class="pri-box">
                                <div class="c6">
                                    <img src="images/icon/general.png" alt="">
                                    <h4>General users can</h4>
                                </div>
                                <div class="c4">
                                    <ol>
                                        <li>User dashboard</li>
                                        <li>Profile page</li>
                                        <li>Reviews</li>
                                        <li>Like listings</li>
                                        <li>Get quote & send enquiry</li>
                                        <li>Followings</li>
                                        <li>Notifications</li>
                                        <li>How to's</li>
                                        <li class="no">Create new listing</li>
                                        <li class="no">Create new event</li>
                                        <li class="no">Create new blog post</li>
                                        <li class="no">Mange listing, event & blogs</li>
                                        <li class="no">Lead management</li>
                                        <li class="no">Review management</li>
                                        <li class="no">Post your Ads</li>
                                        <li class="no">Check Our process</li>
                                        <li class="no">Payment invoices</li>
                                    </ol>
                                </div>
                                <div class="c5">
                                    <a href="login">Get Start</a>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END PRICING DETAILS-->


    <section>
        <div class="pop-ups pop-quo">
            <!-- The Modal -->
            <div class="modal fade" id="quote">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!-- Modal Header -->
                        <div class="quote-pop">
                            <h4>Get quote</h4>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter name*" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Enter email*" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="Invalid email address" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter mobile number *" pattern="[7-9]{1}[0-9]{9}" title="Phone number starting with 7-9 and remaing 9 digit with 0-9" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="Enter your query or message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

