<?php
include "header.php";
?>

<?php if($admin_row['admin_user_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">General User Details</span>
                <div class="ud-cen-s2">
                    <h2>General Users - 2460</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <a href="admin-add-new-user.php" class="db-tit-btn">Add new user</a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>User ID</th>
                            <th>User Type</th>
                            <?php /*
                            <th>Blog posts</th>
                            <th>Events</th>*/?>
                            <th>Followings</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Preview</th>
                            <th>More</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        $user_type = 'General';

                        foreach (getAllTypeUser($user_type) as $row) {
                            $session_user_id = $row['user_id'];
                            $user_plan = $row['user_plan'];

                            $plan_type_row = getPlanType($user_plan);
                            
                            $all_following_count = getCountUserFollowing($session_user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img src="../images/user/<?php if(($row['profile_image'] == NULL) || empty($row['profile_image'])){  echo "1.jpg";}else{ echo $row['profile_image']; } ?>" title="<?php echo $row['first_name']; ?>" alt="<?php echo $row['first_name']; ?>"><?php echo $row['first_name']; ?> <span>Join:
                                        <?php  echo dateFormatconverter($row['user_cdt']); ?></span>
                                </td>
                                <td><?php echo $row['user_code']; ?> </td>
                                <td><?php echo $row['user_type']; ?> </td>
<!--                                <td><span class="db-list-rat">52</span></td>-->
<!--                                <td><span class="db-list-rat">124</span></td>-->
                                <td><span class="db-list-rat"><?php echo $all_following_count; ?></span></td>
                                <td><a href="admin-my-profile-edit.php?row=<?php echo $session_user_id; ?>&path=3" class="db-list-edit">Edit</a></td>
                                <td><a href="admin-my-profile-delete.php?row=<?php echo $session_user_id; ?>&path=3" class="db-list-edit">Delete</a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>profesional<?php echo $row['user_slug']; ?>" class="db-list-edit" target="_blank">Preview</a></td>
                                <td><a href="admin-user-full-details.php?row=<?php echo $session_user_id; ?>" class="db-list-edit">More</a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ad-pgnat">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
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