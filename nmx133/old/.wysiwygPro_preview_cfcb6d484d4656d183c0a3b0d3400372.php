<?php
if ($_GET['randomId'] != "SsvcjW8mv3YbzrTbH035N3qtHn6ugFkLQldtZYNGfFFgKjIMSHhp_GtwUL77LSU7") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
