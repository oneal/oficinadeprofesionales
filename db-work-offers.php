<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

$user_id = $_SESSION['user_id'];

?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['ALL_WORK_OFFERS']; ?></span>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['WORK_OFFER_DETAILS']; ?></h2>
            <?php include "page_level_message.php"; ?>
            <a href="create-new-work-offer" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_OFFER']; ?></a>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th><?php echo $BIZBOOK['S_NO']; ?></th>
                    <th><?php echo $BIZBOOK['TITLE']; ?></th>
                    <th><?php echo $BIZBOOK['VIEWS']; ?></th>
                    <th><?php echo $BIZBOOK['EDIT']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>
                    <th><?php echo $BIZBOOK['PREVIEW']; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $si = 1;
                foreach (getAllUserWorkOffer($user_id) as $workofferrow) {
                    
                    ?>
                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><?php echo $workofferrow['work_offer_name']; ?> <span><?php echo dateFormatconverter($workofferrow['work_offer_cdt']); ?></span></td>
                        <td><span class="db-list-rat"><?php  echo blog_pageview_count($workofferrow['work_offer_id']); ?></span></td>
                        <td><a href="edit-work-offer?code=<?php echo $workofferrow['work_offer_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                        <td><a href="delete-work-offer?code=<?php echo $workofferrow['work_offer_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                        <td><a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo preg_replace('/\s+/', '-', strtolower($workofferrow['work_offer_slug'])); ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
                    </tr>
                    <?php
                    $si++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>