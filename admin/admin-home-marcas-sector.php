<?php
include "header.php";
?>

<?php if ($admin_row['admin_home_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['MARCAS'];?></span>
                <div class="ud-cen-s2 hcat-cho">
                    <h2><?php echo $BIZBOOK['MARCAS'];?></h2>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Buscar..">
                    </div>
                    <a href="admin-add-new-home-marca.php" class="db-tit-btn">Nueva marca</a>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['IMAGE'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;

                        foreach (getAllMarcas() as $row) {

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $row['marca_name']; ?></td>
                                <td>
                                    <img src="../images/services/<?php echo $row['marca_image']; ?>" title="<?php echo $row['marca_name']; ?>" alt="<?php echo $row['marca_name']; ?>">
                                </td><td><a href="admin-home-marca-sector-edit.php?row=<?php echo $row['marca_id']; ?>"
                                            class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-home-marca-sector-delete.php?row=<?php echo $row['marca_id']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        <?php /*
                            <tr>
                                <td>2</td>
                                <td>Guym and fitness</td>
                                <td>
                                   <img src="../images/services/2.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Hospital and midicals</td>
                                <td>
                                   <img src="../images/services/3.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Car and bike</td>
                                <td>
                                   <img src="../images/services/4.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Yoga training</td>
                                <td>
                                   <img src="../images/services/5.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Education and university</td>
                                <td>
                                   <img src="../images/services/6.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Real estate</td>
                                <td>
                                   <img src="../images/services/2.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                             <tr>
                                <td>8</td>
                                <td>Tour and travels</td>
                                <td>
                                   <img src="../images/services/1.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
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
if (isset($_GET['pord'])) {
    dbUpdateDrop($conn);
}
?>
</body>

</html>