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
?>
			<!--CENTER SECTION-->
			<div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['ALL_LISTING']; ?></span>
				<?php
				if ($user_details_row['user_status'] == 'Inactive') {
					?>
                    <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
                    <?php
				}
				?>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['LISTING_DETAILS']; ?></h2>
                    <?php include "page_level_message.php"; ?>
                    <a href="add-listing-start" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_LISTING']; ?></a>
                    <table class="responsive-table bordered">
							<thead>
								<tr>
									<th><?php echo $BIZBOOK['S_NO']; ?></th>
                                    <th><?php echo $BIZBOOK['LISTING_NAME']; ?></th>
									<th><?php echo $BIZBOOK['RATING']; ?></th>
									<th><?php echo $BIZBOOK['VIEWS']; ?></th>
<!--									<th>Expiry on</th>-->
									<th><?php echo $BIZBOOK['STATUS']; ?></th>
									<th><?php echo $BIZBOOK['EDIT']; ?></th>
									<th><?php echo $BIZBOOK['DELETE']; ?></th>
									<th><?php echo $BIZBOOK['PREVIEW']; ?></th>
									<th><?php echo $BIZBOOK['PROMOTE']; ?></th>
									<th><?php echo "Auto ". $BIZBOOK['PROMOTE']; ?></th>
								</tr>
							</thead>
							<tbody>
							<?php

							$si = 1;
							foreach (getAllListingUser($_SESSION['user_id']) as $listrow) {

							$reviewlisting_id = $listrow['listing_id'];

							//  List Rating. for Rating of Star starts
                                
								foreach (getListingReview($reviewlisting_id) as $Star_rateRow) {
//                            $Star_rateRow = getListingReview($reviewlisting_id);

									if ($Star_rateRow["rate_cnt"] > 0) {
										$Star_rate_times = $Star_rateRow["rate_cnt"];
										$Star_sum_rates = $Star_rateRow["total_rate"];
										$star_rate_one = $Star_sum_rates / $Star_rate_times;
										//$star_rate_one = (($Star_rate_value)/5)*100;
										$star_rate_two = number_format($star_rate_one, 1);
										$star_rate = floatval($star_rate_two);

									} else {
										$rate_times = 0;
										$rate_value = 0;
										$star_rate = 0;
									}
								}
							//  List Rating. for Rating of Star Ends

							?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><img
											src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
												echo "images/listings/" . $listrow['profile_image'];
											} else {
												echo "images/listings/hot4.jpg";
											} ?>"><?php echo $listrow['listing_name']; ?> <span><?php echo dateFormatconverter($listrow['listing_cdt']); ?></span></td>
									<td><span class="db-list-rat"><?php echo $star_rate; ?></span></td>
									<td><span class="db-list-rat"><?php  echo pageview_count($listrow['listing_id']); ?></span></td>
<!--									<td><span class="db-list-ststus">8 June 2020</span></td>-->
									<td><span class="db-list-ststus"><?php echo $listrow['listing_status']; ?></span></td>
									<td><a href="edit-listing-step-1?row=<?php echo $listrow['listing_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
									<td><a href="delete-listing?row=<?php echo $listrow['listing_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
									<td><a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
                                    <td><a href="promote_now?code=<?php echo $listrow['listing_code']; ?>&type=listing" class="db-list-edit"><?php echo $BIZBOOK['PROMOTE'];?></a></td>
                                    <?php
                                    if($listrow['credit_frequency']!= 0) {
                                        ?>
                                        <td>
                                            <a href="stop_promote?code=<?php echo $listrow['listing_code']; ?>&&type=listing"
                                               class="db-list-edit"><?php echo "Stop"; ?></a></td>
                                        <?php
                                    }else {
                                        ?>
                                        <td>
<!--                                            <a href="#!" readonly="readonly" class="db-list-edit">--><?php //echo "N/A"; ?><!--</a>-->
                                        </td>
                                        <?php
                                    }
                                        ?>
                                </tr>

                                <?php
                                $si++;
                            }
                            ?>
								
							</tbody>
						</table>
                </div>
            </div>
			<!--RIGHT SECTION-->
<?php
include "dashboard_right_pane.php";
?>