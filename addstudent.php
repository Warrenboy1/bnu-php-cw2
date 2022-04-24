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
        $firstname = $_POST['txtfirstname'];
        $lastname = $_POST['txtlastname'];
        $house = $_POST['txthouse'];
        $town = $_POST['txttown'];
        $county = $_POST['txtcounty'];
        $country = $_POST['txtcountry'];
        $postcode = $_POST['txtpostcode'];
        $studentid = $_POST['txtstudentid'];

        // build an sql statment to update the student details
        $sql = "INSERT INTO student (firstname, lastname, house, town,
        county, country, postcode, studentid) VALUES ($firstname,
        $lastname, $house, $town, $county, $country, $postcode, $studentid)";
      
        if(mysqli_query($conn,$sql)) {
          echo "New record successfully created!";
        }else{
          echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
      

      $data['content'] = "<p>Your details have been updated</p>";

    }
    else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      //$sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      //$result = mysqli_query($conn,$sql);
      //$row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

        <h2>My Details</h2>
        <form action="" method="post">
        First Name :
        <input name="txtfirstname" type="text" /><br/>
        Surname :
        <input name="txtlastname" type="text" /><br/>
        Number and Street :
        <input name="txthouse" type="text" /><br/>
        Town :
        <input name="txttown" type="text" /><br/>
        County :
        <input name="txtcounty" type="text" /><br/>
        Country :
        <input name="txtcountry" type="text" /><br/>
        Postcode :
        <input name="txtpostcode" type="text" /><br/>
        StudentID :
        <input name="txtstudentid" type="number" /><br/>
        <input type="submit" value="Save" name="submit"/>
        </form>

    EOD;

   }

   // render the template
   echo template("templates/default.php", $data);


    echo template("templates/partials/footer.php");
}
?>
