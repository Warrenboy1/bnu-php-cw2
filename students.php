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
      $data['content'] .= "<form enctype='multipart/form-data' method='post' action='delete.php'>";

      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='11' align='center'>Students</th></tr>";
      $data['content'] .= "<tr><th></th><th>studentID</th><th>DoB</th><th>FirstName</th>";
      $data['content'] .= "<th>LastName</th><th>house</th><th>Town</th><th>County</th>";
      $data['content'] .= "<th>Country</th><th>PostCode</th><th>Image</th></tr>";

      // Display the students within the html table
      
      while($row = mysqli_fetch_assoc($result)) {
      $data['content'] .= "<tr><td> <input type='checkbox' name='checkbox[]' value='".$row['studentid']."'> </td><td> $row[studentid] </td><td> $row[dob] </td>";
      $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>";
      $data['content'] .= "<td> $row[house] </td><td> $row[town] </td>";
      $data['content'] .= "<td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td>";
      $data['content'] .= "<td><img src='getjpg.php?studentid=" . $row['studentid']. "' height='100' width='100'</td></tr>";
      }
     

         $data['content'] .= "</table>";
         $data['content'] .= "<input type='submit' name='delete' id='delete' value='Delete Students' >";
         $data['content'] .= "</form>";

         // render the template
         echo template("templates/default.php", $data);

      } else {
     header("Location: index.php");
   }


   echo template("templates/partials/footer.php");


?>
