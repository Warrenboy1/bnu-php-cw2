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
        $image = $_FILES['profilepicture']['tmp_name']; 
        $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));


        $sql = "INSERT INTO student (firstname, lastname, house, town,
                 county, country, postcode, studentid, image) VALUES 
            ('$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$studentid', '$imagedata')";
        /* // prepare an sql statment to insert the student details
        $stmt = $conn->prepare("INSERT INTO student (firstname, lastname, house, town,
        county, country, postcode, studentid, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
        // This function binds the parameters to the SQL query and tells the database what the parameters are.
        // The s character tells mysql that the parameter is a string. i for integar.
        $stmt->bind_param("sssssssib", $firstname, $lastname, $house, $town, $county, $country, $postcode, $studentid, $image);

        // Execute the statement
        $stmt->execute(); */
        $result = mysqli_query($conn, $sql);
        $data['content'] = "<p>Your details have been updated</p>";
    }
         // if the profile picture form has been submitted
    else if (isset($_POST['change'])) {

        $image = $_FILES['profilepicture']['tmp_name']; 
        $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));

        $stmt = $conn->prepare("UPDATE student SET image=? WHERE studentid=?");
        $stmt->bind_param(1,$image);
        $stmt->bind_param(2,$_POST['txtstudentid']);
        $stmt->execute();
 


        
    }
    else {

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

        <h2>My Details</h2>
        <form enctype="multipart/form-data" action="" method="post">
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
        Profile Picture :
        <input name="profilepicture" type="file" accept="image/jpeg" /><br/>
        <input type="submit" value="Save" name="submit"/>
        </form>

        <h2>Add Profile Picture to Student?</h2>
        <form enctype="multipart/form-data" action="" method="post">
        Profile Picture :
        <input name="profilepicture" type="file" accept="image/jpeg" /><br/>
        Input student id to match to database :
        <input name="txtstudentid" type="number" /><br/>
        <input type="submit" value="Change!" name="change"/>
        </form>

    EOD;

   }

    // render the template
    echo template("templates/default.php", $data);
    echo template("templates/partials/footer.php");
}



?>
