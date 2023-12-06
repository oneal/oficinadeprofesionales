<?php/*
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
				<span class="udb-inst"><?php echo $BIZBOOK['ALL_EVENTS']; ?></span>
                <?php
                if ($user_details_row['user_status'] == 'Inactive') {
                    ?>
                    <div class="log-error use-act-err"><p>Important: Your Profile has not been activated yet. You can create your Listings, Events, Blogs. But it will be posted after profile activation.</p></div>
                    <?php
                }
                ?>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['EVENT_DETAILS']; ?></h2>
                    <?php include "page_level_message.php"; ?>
                    <a href="create-new-event" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_EVENT']; ?></a>
                    <table class="responsive-table bordered">
							<thead>
								<tr>
									<th><?php echo $BIZBOOK['S_NO']; ?></th>
                                    <th><?php echo $BIZBOOK['EVENT_NAME']; ?></th>
									<th><?php echo $BIZBOOK['EVENT_DATE']; ?></th>
									<th><?php echo $BIZBOOK['VIEWS']; ?></th>
									<th><?php echo $BIZBOOK['EDIT']; ?></th>
									<th><?php echo $BIZBOOK['DELETE']; ?></th>
									<th><?php echo $BIZBOOK['PREVIEW']; ?></th>
								</tr>
							</thead>
							<tbody>

                            <?php
                            $si = 1;
                            foreach (getAllUserEvents($_SESSION['user_id']) as $eventrow) {

                                ?>

                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $eventrow['event_name']; ?> <span><?php echo dateFormatconverter($eventrow['event_cdt']); ?></span></td>
                                    <td><?php   echo dateFormatconverter($eventrow['event_start_date']); ?></td>
                                    <td><span class="db-list-rat"><?php  echo event_pageview_count($eventrow['event_id']); ?></span></td>
                                    <td><a href="edit-event?code=<?php echo $eventrow['event_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                                    <td><a href="delete-event?code=<?php echo $eventrow['event_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                                    <td><a href="<?php echo $webpage_full_link; ?>event/<?php echo preg_replace('/\s+/', '-', strtolower($eventrow['event_slug'])); ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
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
