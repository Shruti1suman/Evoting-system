<?php 
    require_once("../../admin/inc/config.php");
    

    if(isset($_POST['e_id']) AND isset($_POST['c_id']) AND isset($_POST['v_id']))
    {

        mysqli_query($db, "INSERT INTO vote(e_id, v_id, c_id)
         VALUES('". $_POST['e_id'] ."', '". $_POST['v_id'] ."','". $_POST['c_id'] ."')") or die(mysqli_error($db));

        echo "Success";
    }

?>