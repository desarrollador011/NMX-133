<?php
if ($_GET['randomId'] != "iNVJStciBy0AFFHVzXwDHS03NDIlIGhgymVpl5YTvx66d3kzbe8EcL0mij9JxwP0") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
