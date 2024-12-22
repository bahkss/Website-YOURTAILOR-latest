<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "test_sewingBook"; // The database name you created

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $add_date = $_POST['date'];
    $add_time = $_POST['time'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO add_time (date, time) VALUES (?, ?)");
    $stmt->bind_param("ss", $add_date, $add_time); // "ss" means both parameters are strings

    // Execute the query
    if ($stmt->execute()) {
        echo "<p>New time slot added successfully</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Time</title>
  <link rel="stylesheet" href="mystyle.css">
  <style>
    body {
      font-family: Inria Serif;
      background-color: #FDF1E4;
      margin: 0;
      padding: 0;
    }

    /* Header Section */
    .header-container {
      display: flex; /*Arrange item in a row*/
      align-items: center;
      justify-content: space-between;
      background-color: #514644;
      padding: 10px 30px;
      color: #fff;
    }

    .logo img {
      flex:1;
      height: 60px;
    }

    .centre-links {
      display: flex;
      align-items: center;
      position: absolute; /* Centering the nav-buttons */
      left: 35%;
      gap: 20px;
    }

    .centre-links a {
      text-decoration: none;
      color: white;
      font-size: 16px;
      display: flex;
      align-items: center;
    }

    .centre-links a .link-icon {
      margin-right: 5px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #ccc;
      object-fit: cover;
    }

    .nav-button {
      text-align: center; /* Center the button in its container */
      margin: 20px 0;
    }

    .logout-button {
      display: inline-block;
      padding: 10px 20px;
      background-color:rgb(180, 153, 148);
      color:#514644;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s; /* Add hover transition */
    }

    .logout-button:hover {
      background-color: rgb(180, 153, 148)1; /* Darker red on hover */
    }

    /* Main Content */
    .timeslot{
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin: 20px;
    }

    .timeslot h1{
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 50px;
    }
    
    .addtime{
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin-left: 300px;
    }

    /* Add Time Form */
    .add-time-container{
      width: 500px;
      height: 300px;
      display: flex;
      justify-content: flex-start;
      flex-direction: column;
      gap: 15px;
      background-color:rgb(126, 107, 105);
      margin: 10px 300px 20px 300px;
      border-radius: 20px;
    }

    .form-group{
      display: flex;
      flex-direction: column;
      margin: 30px 100px 20px 100px;
    }

    .submit-btn{
      margin: 20px 450px 20px 450px;
    }
    

    /* Footer Section */
    .lower-footer {
      text-align: center;
      background-color: #514644;
      color: #fff;
      padding: 10px;
      font-size: 14px;
      margin-top: 20px;
    }

  </style>
</head>
<body>
  <!-- Header Container -->
  <div class="header-container">
    <div class="logo">
      <img src="images/Logo.jpg" alt="Logo">
    </div>
    <div class="centre-links">
      <a href="adminDashboard.php" class="dashboard-link" style="font-family: Inria Serif;">
        <span>Admin Dashboard</span>
      </a>
      <a href="transaction_lists.php" class="transaction-link" style="font-family: Inria Serif;">
        <span>Transaction Report</span>
      </a>
      <a href="booking_list_page.php" class="bookinglist-link" style="font-family: Inria Serif;">
        <span>Member’s Request</span>
      </a>
    </div>
    <div class="nav-button">
      <a href="login.php" class="logout-button" style="font-family: Inria Serif;">Logout</a>
    </div>
  </div>

  <!-- Main Section -->
  <main>
    <div class="timeslot">
      <h1>Time Slot’s List</h1>
    </div>
    <div class="addtime">
      <h3>Add New Time</h3>
    </div>
    
    <!-- Form to Add Time Slot -->
    <form action="" method="POST">
      <div class="add-time-container">
        <div class="form-group">
          <label for="date">Add Date</label>
          <input type="date" id="date" name="date" class="input-date" required>
        </div>
        <div class="form-group">
          <label for="time">Add Time</label>
          <input type="time" id="time" name="time" class="input-time" required>
        </div>
      </div>
      <div>
        <button type="submit" class="submit-btn">Add Time Slot</button>
      </div>
    </form>
  </main>

  <!-- Lower Footer -->
  <div class="lower-footer">
    <p>&copy; 2024 Admin Panel. All Rights Reserved.</p>
  </div>
</body>
</html>
