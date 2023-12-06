<?php
include "header.php";
?>

<?php if($admin_row['admin_home_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['FEATURE_EVENTS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['FEATURE_EVENTS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['EVENT_NAME'];?></th>
                                <th><?php echo $BIZBOOK['CREATED_BY'];?></th>
                                <th>Clicks</th>
                                <th><?php echo $BIZBOOK['VIEWS'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                                <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllTopEvents() as $row) {

                                $event_id = $row['event_id'];
                                $event_name = $row['event_name'];
                                
                                $event_sql_row = getEvent($event_name);

                                $user_id = $event_sql_row['user_id'];

                                $user_details_row = getUser($user_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $event_sql_row['event_name']; ?> <span><?php echo $BIZBOOK['EVENT_DATE'];?>: <?php echo dateFormatconverter($event_sql_row['event_start_date']); ?></span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank"><?php echo $user_details_row['first_name']; ?></a></td>
                                    <td><span class="db-list-rat">76</span></td>
                                    <td><span class="db-list-rat">76</span></td>
                                    <td><a href="admin-home-feature-events-edit.php?row=<?php echo $event_id; ?>" class="db-list-edit"
                                           data-toggle="tooltip"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><a href="<?php echo $webpage_full_link; ?>evento/<?php echo $event_sql_row['event_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a>
                                    </td>
                                </tr>
                                <?php
                                $si++;
                            }
                            ?>
                                <?php /*
                                    <tr>
                                    <td>2</td>
                                    <td>Sams villas phase 2 lunching soon <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>3</td>
                                    <td>Dance festival on 12th August 2020 <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>4</td>
                                    <td>Grand opening food stall <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>5</td>
                                    <td>MG SUV Cars lonching on this November <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>6</td>
                                    <td>Novotel Hotel on Chennai <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>7</td>
                                    <td>Sams villas phase 2 lunching soon <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>
								<tr>
                                    <td>8</td>
                                    <td>Dance festival on 12th August 2020 <span>Event Date: 12 Jan 2019</span></td>
                                    <td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
									<td><span class="db-list-rat">76</span></td>
									<td><span class="db-list-rat">76</span></td>
									<td><a href="admin-home-feature-events-change.html" class="db-list-edit" data-toggle="tooltip" title="Click to change the event and position">Change event</a></td>
									<td><a href="../event-details.html" class="db-list-edit" target="_blank">Preview</a></td>
								</tr>*/?>
							</tbody>
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
<?php
if (isset($_GET['ledname_1'])) {
    trashFolder($_GET['ledname_1']);
}
?>
</body>

</html>