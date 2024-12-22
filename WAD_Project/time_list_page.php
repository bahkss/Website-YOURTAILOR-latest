<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "test_sewingBook"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve time slot data
$sql = "SELECT id, date, time FROM add_time";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Time List</title>
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
    .timelist-container{
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin: 20px;
    }

    .timelist-container h1{
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 50px;
    }

    .action-buttons{
      flex: 1;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    .booklist-btn, .timelist-btn{
      background-color: #514644;
      color: white;
      margin-right: 20px;
    }

    /* Time List Table */
    .time-table{
      width: 500px;
      height: 600px;
      display: flex;
      justify-content: center;
      align-items: first baseline;
      background-color: #fff;
      border-radius: 20px;
      border-collapse: collapse;
      gap: 50px;
      margin: 20px 150px 20px 300px;
      padding: 20px;
    }

    .time-table th, td, tr{
      border: 1px solid black;
    }

    /* Add New Time Button*/
    .addbutton-container{
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .add-button{
      background-color: #D9D9D9; 
      color: #000000;
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

  <main>
    <div class="timelist-container">
      <h1>Time Slot List</h1>

      <div class="action-buttons">
        <button class="booklist-btn" onclick="location.href='booking_list_page.php'">Booking list</button>
        <button class="timelist-btn" onclick="location.href='time_list_page.php'">Time slot list</button>
      </div>
    </div>
    <div class="time-table">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                          <td>" . htmlspecialchars($row['date']) . "</td>
                          <td>" . htmlspecialchars($row['time']) . "</td>
                          <td>
                            <form method='POST' action='delete_time.php' style='display:inline;'>
                              <input type='hidden' name='id' value='" . $row['id'] . "'>
                              <button type='submit' class='delete-btn'>🗑️ Delete</button>
                            </form>
                          </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No time slots found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="addbutton-container">
        <button type="button" class="add-btn" onclick="location.href='add_time_page.php'">Add New Time Slot</button>
      </div>
  </main>
  <!-- Lower Footer -->
  <div class="lower-footer">
    <p>&copy; 2024 Admin Panel. All Rights Reserved.</p>
  </div>
</body>
</html>
<?php
$conn->close();
?>
