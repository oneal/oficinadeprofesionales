<?php
include "header.php";
?>

<?php if($admin_row['admin_mail_template_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['MAIL_TEMPLATES'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['MAIL_TEMPLATES'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['TOPIC'];?></th>
                            <th><?php echo $BIZBOOK['VIEW'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        foreach (getAllMailTemplates() as $row_f) {

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $row_f['mail_template_name']; ?></td>
                                <td><a href="admin-mail-view.php?row=<?php echo $row_f['mail_id']; ?>"
                                       class="db-list-ststus"><?php echo $BIZBOOK['VIEW'];?></a></td>
                                <td><a href="admin-mail-edit.php?row=<?php echo $row_f['mail_id']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>

                        </tbody>
                    </table>
                    <?php /*
                    <div class="ud-notes">
                       <p><b>Notes:</b> This window you can get <b>security and update</b> notification from rn53themes.net. This will helpful and stay away from warm attacks and other security threats.</p>
                    </div>*/?>
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
</body>

</html>