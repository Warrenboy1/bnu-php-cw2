<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");


      // build an sql statment to update the student details
      $sql = "SELECT * from student";
            
      $result = mysqli_query($conn,$sql);

     // prepare page content
     $data['content'] .= "<table border='1'>";
     $data['content'] .= "<tr><th colspan='9' align='center'>Students</th></tr>";
     $data['content'] .= "<tr><th>studentID</th><th>DoB</th><th>FirstName</th>
                            <th>LastName</th><th>house</th><th>Town</th><th>County</th>
                            <th>Country</th><th>PostCode</th></tr>";
     // Display the students within the html table
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
        $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
        $data['content'] .= "<td> $row[house] </td><td> $row[town] </td>";
        $data['content'] .= "<td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td></tr>";

     }
     $data['content'] .= "</table>";

     // render the template
     echo template("templates/default.php", $data);

  } else {
     header("Location: index.php");
  }


    echo template("templates/partials/footer.php");


?>
