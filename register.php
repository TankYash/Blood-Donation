<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register Donor</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Donor Registration</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required /><br>
      <input type="text" name="blood_group" placeholder="Blood Group (e.g. A+)" required /><br>
      <input type="text" name="location" placeholder="Location" required /><br>
      <input type="text" name="contact" placeholder="Contact Number" required /><br>
      <input type="submit" name="submit" value="Register" class="btn" />
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $blood_group = $_POST['blood_group'];
      $location = $_POST['location'];
      $contact = $_POST['contact'];

      $sql = "INSERT INTO donors (name, blood_group, location, contact) 
              VALUES ('$name', '$blood_group', '$location', '$contact')";
      if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Donor Registered Successfully!</p>";
        echo '<meta http-equiv="refresh" content="2;url=view_donors.php">';
      } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
      }
    }
    ?>
  </div>
</body>
</html>
