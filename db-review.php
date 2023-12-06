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
        <span class="udb-inst"><?php echo $BIZBOOK['REVIEWS']; ?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE']; ?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['ALL_RECEIVEDS_REVIEW'];?></h2>
            <?php include "page_level_message.php"; ?>
            <?php /*<ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#received"><?php echo $BIZBOOK['ALL_RECEIVEDS_REVIEW'];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sent"><?php echo $BIZBOOK['ALL_RECEIVEDS_SEND'];?></a>
                </li>

            </ul>*/?>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="received" class="container tab-pane active"><br>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th><?php echo $BIZBOOK['S_NO']; ?></th>
                            <th><?php echo $BIZBOOK['LISTING_NAME']; ?></th>
                            <th><?php echo $BIZBOOK['USER']; ?></th>
                            <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                            <th><?php echo $BIZBOOK['PHONE']; ?></th>
                            <th><?php echo $BIZBOOK['CITY']; ?></th>
                            <th><?php echo $BIZBOOK['RATINGS']; ?></th>
                            <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                            <th>Respuesta</th>
                            <?php /*<th><?php echo $BIZBOOK['DELETE']; ?></th>*/?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ri = 1;
                        //To check the review type using user type

                        $reviewfunction = getAllReceivedReviews($_SESSION['user_id']);

                        foreach ($reviewfunction as $rreviewsqlrow) {

                            $rreview_list_id = $rreviewsqlrow['listing_id'];
                            $rlisting_user_id = $rreviewsqlrow['listing_user_id'];
                            $rrating = $rreviewsqlrow['price_rating'];

                            $rrev_listrs = getAllListingUserListing($rlisting_user_id,$rreview_list_id);

                            ?>
                            <tr>
                                <td><?php echo $ri; ?></td>
                                <td><?php echo $rrev_listrs['listing_name']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_name']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_email']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_mobile']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_city']; ?></td>
                                <td>
                                    <label class="rat">
                                        <?php
                                        for ($i = 1; $i <= $rrating; $i++) {
                                            ?>
                                            <i class="material-icons">star</i>
                                            <?php
                                        }
                                        ?>
                                        <?php /* <i class="material-icons">star</i>
                                                <i class="material-icons">star</i>
                                                <i class="material-icons">star</i>
                                                <i class="material-icons">star_half</i>*/?>
                                    </label>
                                </td>
                                <td><?php echo $rreviewsqlrow['review_message']; ?></td>
                                <td>
                                    <a href="review_response?review=<?php echo $rreviewsqlrow['review_id']; ?>"><span
                                            class="db-list-edit">Responder</span> </a></td>
                                <?php /*<td>
                                    <a href="review_trash?way=1&&reviewreviewreviewreviewreviewreview=<?php echo $rreviewsqlrow['review_id']; ?>"><span
                                            class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></span> </a></td>*/?>

                            </tr>
                            <?php
                            $ri++;
                        }

                        ?>

                        </tbody>
                    </table>
                </div>
                <?php /*<div id="sent" class="container tab-pane fade"><br>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th><?php echo $BIZBOOK['S_NO']; ?></th>
                            <th><?php echo $BIZBOOK['LISTING_NAME']; ?></th>
                            <th><?php echo $BIZBOOK['USER']; ?></th>
                            <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                            <th><?php echo $BIZBOOK['PHONE']; ?></th>
                            <th><?php echo $BIZBOOK['CITY']; ?></th>
                            <th><?php echo $BIZBOOK['RATINGS']; ?></th>
                            <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                            <th><?php echo $BIZBOOK['DELETE']; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ri = 1;
                        //To check the review type using user type

                        $reviewfunction = getAllSentReviews($_SESSION['user_id']);

                        foreach ($reviewfunction as $rreviewsqlrow) {

                            $rreview_list_id = $rreviewsqlrow['listing_id'];
                            $rlisting_user_id = $rreviewsqlrow['listing_user_id'];
                            $rrating = $rreviewsqlrow['price_rating'];

                            $rrev_listrs = getAllListingUserListing($rlisting_user_id, $rreview_list_id);

                            ?>
                            <tr>
                                <td><?php echo $ri; ?></td>
                                <td><?php echo $rrev_listrs['listing_name']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_name']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_email']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_mobile']; ?></td>
                                <td><?php echo $rreviewsqlrow['review_city']; ?></td>
                                <td>
                                    <label class="rat">
                                        <?php
                                        for ($i = 1; $i <= $rrating; $i++) {
                                            ?>
                                            <i class="material-icons">star</i>
                                            <?php
                                        }
                                        ?>
                                        <?php /* <i class="material-icons">star</i>
                                                <i class="material-icons">star</i>
                                                <i class="material-icons">star</i>
                                                <i class="material-icons">star_half</i>
                                    </label>
                                </td>
                                <td><?php echo $rreviewsqlrow['review_message']; ?></td>

                                <td>
                                    <a href="review_trash?way=1&&reviewreviewreviewreviewreviewreview=<?php echo $rreviewsqlrow['review_id']; ?>"><span
                                            class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></span> 
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $ri++;
                        }

                        ?>

                        </tbody>
                    </table>
                </div>*/?>
            </div>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>