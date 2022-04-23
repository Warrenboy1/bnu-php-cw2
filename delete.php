<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$_SESSION['theCookie'] = $_POST['checkbox'];

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

    if(isset($_POST['delete'])) {
        
        $data['content'] = <<<EOD
    
        <h2>Time to Delete</h2>
        <form name="frmdelete" action="deleteconfirmation.php" method="post">
        <input type="submit" value="Are you positive you would like to delete?" name="confirm"/>
        </form>

        EOD;
    }
    //$data['content'] = "<p>Your details have been updated</p>";

    echo template("templates/default.php", $data);

        echo template("templates/partials/footer.php");
}

?>