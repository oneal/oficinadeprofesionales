<?php
if(file_exists('config/info.php'))
{
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['review_response_submit'])) {

        $review_id = $_POST['review_id'];
        $review_response_message = $_POST['review_response_message'];
        
        if($review_response_message != ""){
        
            $review_row = getReview($review_id);

            if($review_row){
                
                $review_res = mysqli_query($conn,"UPDATE  " . TBL . "review_response SET response_message ='" . $review_response_message. "' where review_id='" . $review_id . "'");

                if ($review_res) {
                    
                    $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];
                    header('Location: db-review');

                } else {

                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                    header('Location: db-review');
                }
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                header('Location: db-review');
            }
        }else{
            $_SESSION['status_msg'] = "Debes rellenar el campo respuesta.";
            $url = 'review_response?review='.$review_id;
            header('Location: '.$url);
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
        header('Location: db-review');
    }
}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    header('Location: db-review');
}