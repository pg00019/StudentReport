<html>

<head>
  <style>
    .heading {
      padding: 10px;
    }
    body{
      background-image: linear-gradient(to bottom, rgba(255,0,0,0), rgba(105,105,105));
    }
  </style>
</head>

<body>
  <?php

  $user = $_POST["username"];
  $pass = $_POST["password"];
  // creating database
  $dbSql = "CREATE DATABASE IF NOT EXISTS dashboard";

  // database connectivity establishment
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "Student";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  //check connectivity
  $connection = true;
  if ($conn->connect_error) {
    $connection = false;
  }

  //creating database
  $dbSql = "CREATE DATABASE IF NOT EXISTS Student";

  $dbExists = false;
  if ($conn->query($dbSql) === TRUE) {
    $dbExists = true;
  }

  // connecting to database
  mysqli_select_db($conn, $dbname);

  // checking if table exists
  $tableExists = $conn->query('select 1 from records LIMIT 1');

  // // creating table if doesn't exists
  if ($tableExists == false && $dbExists == true) {
    $tableSql = "CREATE TABLE score (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    fullname	     varchar(10)  NOT NULL,
        lastname       varchar(10)  NOT NULL,
        PRN            varchar(11)  NOT NULL,
        program        varchar(5)   NOT NULL,
        username       varchar(22)  NOT NULL,
        pasword        varchar(10)  NOT NULL,
        subject1       varchar(30)  NOT NULL,
        ClassTest      Double       NOT NULL,
        Assignment     Double       NOT NULL,
        Labwork        Double       NOT NULL,
        Viva           Double       NOT NULL,
        Total_marks    Double       NOT NULL,
        Grade          char(2)      NOT NULL,
        comments       varchar(30)  NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";

    if ($conn->query($tableSql) === TRUE) {
      $tableExists = true;
    } else {
      $tableExists = false;
    }
  }
// select values from database
  $sql = " SELECT firstname,lastname,PRN,program,subject1,ClassTest,Assignment,Labwork,Viva,Total_marks,Grade,comments
 FROM score WHERE username='$user' AND pasword='$pass'";
  $result = $conn->query($sql);

  if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<center>";
      echo "<h2> Report </h2>";
      echo "<div>";
      echo "<b> Name    :</b> " . $row["firstname"] . " " . $row["lastname"] . "&nbsp&nbsp&nbsp&nbsp" .
           "<b> Program :</b> " . $row["program"]   . "&nbsp&nbsp&nbsp&nbsp" .
           "<b> PRN     :</b> " . $row["PRN"]       . "   " .
  "<br><br><b>Subject   :</b> " . $row["subject1"]  . "<br><br>";
      echo "</div>";

      echo "<table border='1'>
      <tr>          
      <th class='heading'>ClassTest(20)</th>
      <th class='heading'>Assignment(15)</th>
      <th class='heading'>Labwork(10)</th>
      <th class='heading'>Viva(5)</th>
      <th class='heading'>Total Marks(50)</th>
      <th class='heading'>Grade</th>
      <th class='heading'>Comments</th>
      </tr>";

      echo "<tr>";
      echo "<td class='heading'>" . $row['ClassTest']   . "</td>";
      echo "<td class='heading'>" . $row['Assignment']  . "</td>";
      echo "<td class='heading'>" . $row['Labwork']     . "</td>";
      echo "<td class='heading'>" . $row['Viva']        . "</td>";
      echo "<td class='heading'>" . $row['Total_marks'] . "</td>";
      echo "<td class='heading'>" . $row['Grade']       . "</td>";
      echo "<td class='heading'>" . $row['comments']    . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "</center>";
  }
  else 
  {
    echo "Sorry! No Results found";
  }
  // end of PHP
  ?>
</body>

</html>
