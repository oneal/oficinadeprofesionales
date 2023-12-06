<?php
include "header.php";
?>

<?php if($admin_row['admin_store_options'] != 1){
    header("Location: profile.php");
}
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list posr">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst"><?php echo $BIZBOOK['DELETE_STORE'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['DELETE_STORE'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $store_codea = $_GET['code'];
                                    $store_row = getStore($store_codea);
                                    ?>
                                    <form action="trash_store.php" class="store_delete_form" id="store_delete_form" name="store_delete_form"
                                          method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="store_id" value="<?php echo $store_row['store_id']; ?>"
                                               name="store_id" class="validate">
                                        <ul>
                                            <li>
                                                <?php /*<!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select name="user_id" required="required" disabled="disabled" class="form-control" id="user_id">
                                                                <option value=""><?php $BIZBOOK['CHOOSE_USER'];?></option>
                                                                <?php
                                                                foreach (getAllUser() as $row) {

                                                                    ?>
                                                                    <option <?php if($store_row['user_id']== $row['user_id']){ echo "selected"; } ?>
                                                                        value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->*/?>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="store_name"
                                                                   value="<?php echo $store_row['store_name']; ?>" readonly="readonly" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['POST_NAME'];?> *">                                            </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['CATEGORIES'];?></label>
                                                            <select name="select-cate" id="select-cate" class="form-control" required="true" readonly="readonly">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                                <?php
                                                                foreach (getAllCategoriesWorkOffer() as $categories_row) {?>
                                                                    <option <?php if ($store_row['category_id'] == $categories_row['category_id']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                                    <?php
                                                                }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['STATES'];?></label>
                                                            <select onChange="getCities(this.value);" name="select-state" id="select-state" class="form-control" required="true" readonly="readonly">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE']; ?></option>
                                                                <?php
                                                                foreach (getAllStates(1) as $state_row) { ?>
                                                                    <option <?php if ($store_row['state_id'] == $state_row['state_id']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['SUB_REGIONS'];?></label>
                                                            <select  class="form-control" name="select-city" id="select-city" required="true" readonly="readonly">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?></option>
                                                                <?php foreach (getAllCitiesIdState($store_row['state_id']) as $city_row) {?>
                                                                    <option <?php if ($store_row['city_id'] == $city_row['city_id']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="store_submit" class="btn btn-primary"><?php echo $BIZBOOK['DELETE'];?></button>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-all-stores.php" class="skip"><?php echo $BIZBOOK['GO_TO_STORES'];?> >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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