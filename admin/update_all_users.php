<?php 

if (file_exists('config/info.php')) {
    include('config/info.php');
}
$select_user = '<select name="user_id" required="required" class="form-control" id="user_id">
    <option value="">'.$BIZBOOK['CHOOSE_USER'].' *</option>';
        
    foreach (getAllUser() as $row) {
        $select_user .= '<option value="'.$row['user_id'].'">'.$row['first_name'].'</option>';
    }
$select_user .= '</select>';

echo $select_user;