<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "test_sewingBook"; // The database name you created

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from service_booking table
$sql = "SELECT name, contact_numb, address, select_service, choose_date, choose_time 
        FROM service_booking";

$result = $conn->query($sql);

// Check if there are results
$bookingData = [];
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $bookingData[] = $row;
    }
} else {
    $bookingData = [];  // Empty array if no results are found
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking List</title>
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
    .booklist-container{
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin: 20px;
    }

    .booklist-container h1{
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

    .bookinglist-btn, .timelist-btn{
      background-color: #514644;
      color: white;
      margin-right: 20px;
    }

    /* Booking List Table */
    .booking-table{
      width: 700px;
      height: 600px;
      display: flex;
      justify-content: center;
      align-items: first baseline;
      background-color: #fff;
      border-radius: 20px;
      border-collapse: collapse;
      gap: 50px;
      margin: 20px 150px 20px 200px;
      padding: 20px;
    }

    .booking-table th, td, tr{
      border: 1px solid black;
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
    <div class="booklist-container">
      <h1 class="booklist">Booking's List</h1>
      <div class="action-buttons">
        <button class="bookinglist-btn" onclick="location.href='booking_list_page.php'">Booking list</button>
        <button class="timelist-btn" onclick="location.href='time_list_page.php'">Time slot list</button>
      </div>
    </div>
    <div class="booking-table">
        <table>
          <thead>
            <tr>
              <th>Member's Name</th>
              <th>Contact Number</th>
              <th>Address</th>
              <th>Services</th>
              <th>Date</th>
              <th>Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($bookingData)) { ?>
                <tr>
                    <td colspan="7" class="no-data">No bookings found.</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($bookingData as $booking) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking["name"]); ?></td>
                        <td><?php echo htmlspecialchars($booking["contact_numb"]); ?></td>
                        <td><?php echo htmlspecialchars($booking["address"]); ?></td>
                        <td><?php echo htmlspecialchars($booking["select_service"]); ?></td>
                        <td><?php echo htmlspecialchars($booking["choose_date"]); ?></td>
                        <td><?php echo htmlspecialchars($booking["choose_time"]); ?></td>
                        <td>
                            <button class="delete-btn" onclick="deleteBooking('<?php echo htmlspecialchars($booking['name']); ?>')">🗑️</button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </main>

  <!-- Lower Footer -->
  <div class="lower-footer">
    <p>&copy; 2024 Admin Panel. All Rights Reserved.</p>
  </div>
  <script>
    function deleteBooking(name) {
        if (confirm("Are you sure you want to delete the booking for " + name + "?")) {
            // Replace with actual implementation to delete the booking
            alert("Booking for " + name + " deleted (placeholder action).");
        }
    }
  </script>
</body>
</html>
