<?phpsession_start();if (file_exists('config/info.php')) {    include('config/info.php');}if ($_SERVER['HTTP_HOST'] == 'oficinadeprofesionales.com') {    header('Location: '.$webpage_full_link.'admin');}?><!doctype html><html lang="en"><head>    <title>Landing pages - Download Request</title>    <!--== META TAGS ==-->    <meta charset="utf-8">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    <meta name="theme-color" content="#76cef1" />    <meta name="description" content="">    <meta name="keyword" content="">    <!--== FAV ICON(BROWSER TAB ICON) ==-->    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">    <!--== GOOGLE FONTS ==-->    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">    <!--== CSS FILES ==-->    <link rel="stylesheet" href="../css/jquery-ui.css">    <link rel="stylesheet" href="../css/bootstrap.css">    <link rel="stylesheet" href="css/admin-style.css">    <link rel="stylesheet" href="../css/fonts.css">    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->    <!--[if lt IE 9]>	<script src="../js/html5shiv.js"></script>	<script src="../js/respond.min.js"></script>	<![endif]--></head><body>        <!-- START -->    <!--PRICING DETAILS-->    <section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg ad-login-reg">        <div class="container">            <div class="row">                <div class="login-main">                     <div class="log-bor">&nbsp;</div>                    <span class="udb-inst">Super Admin</span>                    <div class="log log-1">                        <div class="login">                            <h4>Admin Login</h4>                            <?php include "../page_level_message.php"; ?>                             <form name="directory_login" method="post" action="login_check.php">                                 <div class="form-group">                                  <?php /*  <input type="text" name="admin_email" id="admin_email"  class="form-control" placeholder="Enter email*" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="Invalid email address" required>*/?>                                  <input type="text" name="admin_email" id="admin_email"  class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*"  title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required>                                </div>                                 <div class="form-group">                                  <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_PASSWORD'];?>*" required>                                </div>                                <button type="submit" value="submit" name="admin_submit" class="btn btn-primary"><?php echo $BIZBOOK['SIGN_IN'];?></button>                            </form>                        </div>                    </div>                <div class="log log-3">                        <div class="login">                            <h4><?php echo $BIZBOOK['FORGOT_PASSWORD'];?></h4>                             <form>                                 <div class="form-group">                                  <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="Invalid email address" required>                                </div>                                <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SIGN_IN'];?></button>                            </form>                        </div>                    </div>                    <div class="log-bot">                        <ul>                            <li>                                <span class="ll-1">¿Login?</span>                            </li>                            <li>                                <span class="ll-3">¿<?php echo $BIZBOOK['FORGOT_PASSWORD'];?>?</span>                            </li>                        </ul>                    </div>                </div>            </div>        </div>    </section>    <!--END PRICING DETAILS-->    <!-- Optional JavaScript -->    <!-- jQuery first, then Popper.js, then Bootstrap JS -->    <script src="../js/jquery.min.js"></script>    <script src="../js/popper.min.js"></script>    <script src="../js/bootstrap.min.js"></script>    <script src="../js/jquery-ui.min.js"></script>    <script src="../js/custom.min.js"></script></body></html>