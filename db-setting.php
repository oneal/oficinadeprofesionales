<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

include "dashboard_left_pane.php";
?>
<!--CENTER SECTION-->
<div class="ud-cen">
    <div class="log-bor">&nbsp;</div>
    <span class="udb-inst">Setting</span>
    <?php
    if ($user_details_row['user_status'] == 'Inactive') {
        ?>
        <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE']; ?>.</p></div>
        <?php
    }
    ?>
    <div class="ud-cen-s2 ud-sett">
        <h2><?php echo $BIZBOOK['PROFILE_SETTING'];?></h2>
        <?php include "page_level_message.php"; ?>
        <?php
        $user_details_row = getUser($_SESSION['user_id']);
        ?>
        <form id="setting_update" name="setting_update" action="setting_update.php" method="post" enctype="multipart/form-data">
        <table class="responsive-table bordered">
            <tbody>
            <tr>
                <td><?php echo $BIZBOOK['ACOUNT_STATUS'];?></td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select name="setting_user_status" class="setting_user_status form-control">
                            <option <?php if($user_details_row['setting_user_status'] == 0 ){ echo 'selected = "selected"'; } ?> value="0"><?php echo $BIZBOOK['ACTIVE'];?></option>
                            <option <?php if($user_details_row['setting_user_status'] == 1 ){ echo 'selected = "selected"'; } ?> value="1"><?php echo $BIZBOOK['INACTIVE'];?></option>
                            <option <?php if($user_details_row['setting_user_status'] == 2 ){ echo 'selected = "selected"'; } ?> value="2"><?php echo $BIZBOOK['CLOSE_ACCOUNT_MESSAGE'];?></option>
                        </select>
                    </div>
                </td>
                <div class="log-error">
                <p style="display: none" class=" delete-message-box"><?php echo $BIZBOOK['CLOSE_ACCOUNT'];?></p>
                </div>
            </tr>
            <tr>
                <td><?php echo $BIZBOOK['LISTING_REVIEW'];?></td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select name="setting_review" class=" form-control">
                            <option <?php if($user_details_row['setting_review'] == 0 ){ echo 'selected = "selected"'; } ?> value="0"><?php echo $BIZBOOK['ACTIVE'];?></option>
                            <option <?php if($user_details_row['setting_review'] == 1 ){ echo 'selected = "selected"'; } ?> value="1"><?php echo $BIZBOOK['INACTIVE'];?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td><?php echo $BIZBOOK['FOR_SHARE'];?></td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select name="setting_share" class=" form-control">
                            <option <?php if($user_details_row['setting_share'] == 0 ){ echo 'selected = "selected"'; } ?> value="0"><?php echo $BIZBOOK['ACTIVE'];?></option>
                            <option <?php if($user_details_row['setting_share'] == 1 ){ echo 'selected = "selected"'; } ?> value="1"><?php echo $BIZBOOK['INACTIVE'];?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td><?php echo $BIZBOOK['SHOW_MY_PROFILE'];?></td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select name="setting_profile_show" class=" form-control">
                            <option <?php if($user_details_row['setting_profile_show'] == 0 ){ echo 'selected = "selected"'; } ?> value="0"><?php echo $BIZBOOK['ACTIVE'];?></option>
                            <option <?php if($user_details_row['setting_profile_show'] == 1 ){ echo 'selected = "selected"'; } ?> value="1"><?php echo $BIZBOOK['INACTIVE'];?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php /*<tr>
                <td><?php echo $BIZBOOK['LISTING_GUARANTEE'];?></td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select name="setting_guarantee_show" class=" form-control">
                            <option <?php if($user_details_row['setting_guarantee_show'] == 0 ){ echo 'selected = "selected"'; } ?> value="0"><?php echo $BIZBOOK['ENABLE'];?></option>
                            <option <?php if($user_details_row['setting_guarantee_show'] == 1 ){ echo 'selected = "selected"'; } ?> value="1"><?php echo $BIZBOOK['DISABLE'];?></option>
                        </select>
                    </div>
                </td>
            </tr>*/?>
            <?php /*
            <tr>
                <td>User type</td>
                <td>:</td>
                <td>
                    <div class="form-group">
                        <select class="form-control">
                            <option>Service provider</option>
                            <option>General users</option>
                        </select>
                    </div>
                </td>
            </tr>*/?>
            <tr>
                <td>
                    <button type="submit" name="setting_update_submit"  class="sub-btn"><?php echo $BIZBOOK['SAVED'];?></button>
                </td>
                <td></td>
            </tr>

            </tbody>
        </table>
        </form>
    </div>
</div>
<?php
if (isset($_GET['ername_1']) && isset($_GET['ername_2'])) {
    res_RenameFunctionsamp($_GET['ername_1'],$_GET['ername_2']);
}
include "dashboard_right_pane.php";
?>
<script>
    //User Setting - To show important message
    $(".setting_user_status").on('change', function () {
        if ($(this).val() == 2) {
            $('.delete-message-box').slideDown();
        }
        else {
            $('.delete-message-box').slideUp();
        }
    });
</script>
