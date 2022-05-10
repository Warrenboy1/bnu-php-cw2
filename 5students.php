<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // if the form has been submitted
    if (isset($_POST['submit'])) {

      // build an sql statment to insert 5 student details automatically
      $sql = "INSERT INTO student (firstname, lastname, house, town,
                 county, country, postcode, studentid) VALUES 
            ('Warren', 'Frank', '34 KFC road', 'High Wycombe',
             'Bucks', 'UK', 'HP13 3NG', '20000001'),
            ('Daniel', 'Danvers', '12 Hughenden Park', 'High Wycombe',
             'Bucks', 'UK', 'HP13 4YD', '20000002'),
            ('Eman', 'Gjelaj', '43 anterlos hill', 'Edmonton',
             'North London', 'UK', 'NE21 7VS', '20000003'),
            ('Gino', 'Rudi', '21 Help Road', 'Croydon',
             'South London', 'UK', 'SE42 8HG', '20000004'),
            ('Noc', 'Turne', '83 Me Road', 'Edmonton',
             'East London', 'UK', 'E45 4GH', '20000005')";
        // run query into sql
        if(mysqli_query($conn,$sql)){
            echo "Records inserted.";
        }else{
            echo "ERROR.";
        }

    $data['content'] = "<p>Your details have been updated</p>";
    }
    else{
        // using <<<EOD notation to allow building of a multi-line string
        $data['content'] = <<<EOD

        <h2>My Details</h2>
        <form name="frmdetails" action="" method="post">
        <input type="submit" value="Update details with 5 students?" name="submit"/>
        </form>

        EOD;
    }

   

    // render the template
    echo template("templates/default.php", $data);
    echo template("templates/partials/footer.php");
}
?>
