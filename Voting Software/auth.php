    <?php
    //Start session
    session_start();
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if(!isset($_SESSION['MEMBER_ID']) || (trim($_SESSION['MEMBER_ID']) == '')) {
    header("location: index.php");
    exit();
    }
    ?>