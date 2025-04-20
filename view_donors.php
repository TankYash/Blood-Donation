<?php
include 'db_connect.php';

// Handle Edit Submission
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];

    mysqli_query($conn, "UPDATE donors SET name='$name', blood_group='$blood_group', location='$location', contact='$contact' WHERE id=$id");
    header("Location: view_donors.php?updated=1");
    exit();
}

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM donors WHERE id=$id");
    header("Location: view_donors.php?deleted=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Donors</title>
  <link rel="stylesheet" href="style.css" />
  <style>
     body {
    background: #f44336;
    background-image: url("image.jpg");
    font-family: Arial, sans-serif;
    color: white;
    text-align: center;
    padding-top: 50px;
  }

  .container {
    width: 90%;
    max-width: 900px;
    margin: auto;
    background: white;
    color: #333;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  }

  table {
    margin-top: 20px;
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: left;
  }

  th {
    background-color: #f44336;
    color: white;
  }

  .btn {
    padding: 6px 12px;
    margin: 2px;
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 4px;
  }

  .btn:hover {
    background-color: #d32f2f;
  }

  input[type="text"], input[type="submit"] {
    padding: 10px;
    width: 200px;
    margin: 10px 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  form {
    margin-bottom: 20px;
  }

  </style>
</head>
<body>
  <div class="container">
    <h2>Registered Donors</h2>

    <!-- Success messages -->
    <?php if (isset($_GET['updated'])) echo "<p style='color:green;'>Donor updated successfully!</p>"; ?>
    <?php if (isset($_GET['deleted'])) echo "<p style='color:red;'>Donor deleted successfully!</p>"; ?>

    <!-- Search Form -->
    <form method="GET" action="view_donors.php">
      <input type="text" name="blood_group" placeholder="Search by blood group (e.g. O+)" value="<?php echo isset($_GET['blood_group']) ? htmlspecialchars($_GET['blood_group']) : ''; ?>" />
      <input type="submit" value="Search" />
    </form>

    <?php
    // Edit Mode
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_result = mysqli_query($conn, "SELECT * FROM donors WHERE id=$id");
        if ($edit_result && mysqli_num_rows($edit_result) > 0) {
            $edit_row = mysqli_fetch_assoc($edit_result);
        ?>
        <h3>Edit Donor</h3>
        <form method="POST" action="view_donors.php">
          <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
          <input type="text" name="name" value="<?php echo $edit_row['name']; ?>" required>
          <input type="text" name="blood_group" value="<?php echo $edit_row['blood_group']; ?>" required>
          <input type="text" name="location" value="<?php echo $edit_row['location']; ?>" required>
          <input type="text" name="contact" value="<?php echo $edit_row['contact']; ?>" required>
          <input type="submit" name="update" value="Update Donor">
        </form>
    <?php
        }
    }
    ?>

    <!-- Donor Table -->
    <table>
      <tr>
        <th>Name</th>
        <th>Blood Group</th>
        <th>Location</th>
        <th>Contact</th>
        <th>Actions</th>
      </tr>
      <?php
      $filter = '';
      if (isset($_GET['blood_group']) && $_GET['blood_group'] !== '') {
          $blood_group = mysqli_real_escape_string($conn, $_GET['blood_group']);
          $filter = "WHERE blood_group = '$blood_group'";
      }

      $result = mysqli_query($conn, "SELECT * FROM donors $filter ORDER BY id DESC");
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['name']}</td>
                  <td>{$row['blood_group']}</td>
                  <td>{$row['location']}</td>
                  <td>{$row['contact']}</td>
                  <td>
                    <a class='btn' href='view_donors.php?edit={$row['id']}'>Edit</a>
                    <a class='btn' href='view_donors.php?delete={$row['id']}' onclick=\"return confirm('Delete this donor?');\">Delete</a>
                  </td>
                </tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
