<?php
require("connection.php");
if (isset($_GET['rem']) && $_GET['rem'] > 0) {
    $query = "SELECT * FROM `contactus` WHERE `sno`='$_GET[rem]'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);
    $query = "DELETE FROM `contactus` WHERE `sno`='$_GET[rem]'";
    if (mysqli_query($con, $query)) {
        header("location: contact.php?success=removed");
    } else {
        header("location: contact.php?alert=remove_failed");
    }
}
?>
