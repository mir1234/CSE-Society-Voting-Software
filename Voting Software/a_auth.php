    <?php
    //Start session
    session_start();
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if(!isset($_SESSION['ADMIN_ID']) || (trim($_SESSION['ADMIN_ID']) == '')) {
    header("location: index.php");
    exit();
    }
    ?>