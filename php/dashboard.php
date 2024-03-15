<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      height: 100vh;
      overflow: hidden;
    }

    .dashboard {
      display: flex;
      height: 100%;
    }

    .sidebar {
      width: 250px;
      background-color: #333;
      color: white;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      height: 100%;
      transition: width 0.3s;
    }

    .sidebar.closed {
      width: 60px;
    }

    .admin-info {
      text-align: center;
      margin-bottom: 20px;
    }

    .admin-info img {
      width: 100px;
      border-radius: 50%;
    }

    .menu {
      list-style: none;
      padding: 0;
      margin-top: 20px;
    }

    .menu button {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      background-color: #555;
      border: none;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .menu button:hover {
      background-color: #777;
    }

    .logout-btn {
      margin-top: auto;
      padding: 10px;
      background-color: #f00;
      border: none;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .logout-btn:hover {
      background-color: #d00;
    }

    .content {
      flex: 1;
      height: 100%;
      overflow: hidden;
      transition: margin-left 0.3s;
    }

    #content-frame {
      width: 100%;
      height: 100%;
      border: none;
    }

    .toggle-btn {
      position: absolute;
      top: 10px;
      left: 10px;
      cursor: pointer;
      font-size: 18px;
    }
  </style>
  <title>Admin Dashboard</title>
</head>
<body>
  <div class="dashboard">
    <div class="sidebar" id="sidebar">
      <div class="admin-info">
        <img src="../css/IMAGES/omegaline.png" alt="Admin Photo">
        <h3>Admin Panel</h3>
      </div>
      <ul class="menu">
        <li><button onclick="loadPage('registerd_guests.php')">Registerd Guests</button></li>
        <li><button onclick="loadPage('display_arrived_guests.php')">Arrived Guests</button></li>
        <li><button onclick="loadPage('arrivals.php')">Store Arrived Guests</button></li>
        <br>
        <br>
        <li><button onclick="loadPage('employee_guests.php')">Employee Guests</button></li>
      </ul>
      <button class="logout-btn" id="logoutBtn">Logout</button>
    </div>
    <div class="content">
      <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
      <iframe id="content-frame" src="" frameborder="0"></iframe>
    </div>
  </div>
  <script>
    function loadPage(pageUrl) {
      document.getElementById('content-frame').src = pageUrl;
    }

    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('closed');
      document.querySelector('.content').classList.toggle('closed');
    }

    // Update the time and date every second
    function updateDateTime() {
      const logoutButton = document.getElementById('logoutBtn');
      const currentDateTime = new Date();
      const currentTime = currentDateTime.toLocaleTimeString();
      const currentDate = currentDateTime.toLocaleDateString();
      logoutButton.innerText = `${currentTime} on ${currentDate}`;
    }

    // Initial call to set the time and date when the page loads
    updateDateTime();

    // Call updateDateTime every second
    setInterval(updateDateTime, 1000);
  </script>
</body>
</html>