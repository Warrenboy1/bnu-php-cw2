<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

    

        if(isset($_POST['confirm'])) {
            $check = $_SESSION['theCookie'];
            foreach($check as $studentid) {
            mysqli_query($conn,"DELETE FROM student WHERE studentid=".$studentid);

            }
            $data['content'] = "<p>Your details have been updated</p>";

        }
              
        

    
    //$data['content'] = "<p>Your details have been updated</p>";

    echo template("templates/default.php", $data);

        echo template("templates/partials/footer.php");
}

?>