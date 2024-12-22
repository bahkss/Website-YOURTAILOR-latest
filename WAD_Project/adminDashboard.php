<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "test_sewingbook"; // The database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count total members from the signup table
$membersQuery = "SELECT COUNT(*) as total_members FROM signup";
$membersResult = $conn->query($membersQuery);
$totalMembers = $membersResult->fetch_assoc()['total_members'] ?? 0;

// Query to count total bookings from the service_booking table
$bookingsQuery = "SELECT COUNT(*) as total_bookings FROM service_booking";
$bookingsResult = $conn->query($bookingsQuery);
$totalBookings = $bookingsResult->fetch_assoc()['total_bookings'] ?? 0;

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
      .statistic-container {
        justify-content: space-between;
        align-items: center;
        background-color: rgb(180, 153, 148);
        width: 500px;
        height: 250px;
        padding: 50px;
        margin: 50px 150px 50px 300px;
      }

      .statistic-title h2 {
        width: 300px;
        height: 30px;
        justify-content: center;
        align-items: center;
        background-color: #ccc;
        margin: 20px 50px;
        padding-left: 50px;
        padding-right: 50px;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
      }

      .statistic-desc h3{
        width: 250px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        margin: 20px 120px;
        font-style: italic;
        font-size: 13px;
      }

      .stats-container{
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        background-color: #ccc;
        border-radius: 20px;
        gap: 20px;
        margin: 20px;
      }

      .stat-item{
        width: 150px;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #ccc;
        border-radius: 20px;
        text-align: center;
      }

      .stat-item h4{
        font-size: 16px;
        font-weight: bold;
      }

      .stat-item p{
        font-size: 20px;
        font-style: italic;
      }

      .booklist-container{
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .approve-btn, .pending-btn{
        background-color: #514644;
        color: white;
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
  <!-- Upper Footer (Header) -->
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

  <!-- Main Content -->
  <main>
    <!-- Statistic Container -->
    <div class="statistic-container">
      <!-- First Section: Statistic Overview -->
      <section class="statistic-title">
        <h2>Statistic Overview</h2>
        <div class="statistic-desc">
          <h3>Gain Insights into Tailor Service Performance</h3>
        </div>
        <div class="stats-container">
          <div class="stat-item">
            <h4>Total Members</h4>
            <p><?php echo $totalMembers; ?></p>
          </div>
          <div class="stat-item">
            <h4>Total Bookings</h4>
            <p><?php echo $totalBookings; ?></p>
          </div>
          <div class="stat-item">
            <h4>Pending Requests</h4>
            <p>--</p>
          </div>
        </div>
      </section>
    </div>

    <div class="booklists-container">
      <!-- Other Sections -->
      <section class="member-request-section">
        <h2 class="section-title">Member's Request Overview</h2>
        <!-- Search Bar -->
        <div class="search-bar">
          <input type="text" placeholder="Search by Member's Name, Date, or Address">
        </div>
        <!-- Buttons -->
        <div class="action-buttons">
          <button class="approve-btn" onclick="location.href='booking_list_page.php'">Booking list </button>
          <button class="pending-btn" onclick="location.href='time_list_page.php'">Time slot list </button>
        </div>
      </section>
    </div>
  </main>

  <!-- Lower Footer -->
  <div class="lower-footer">
    <p>&copy; 2024 Admin Panel. All Rights Reserved.</p>
  </div>
</body>
</html>
