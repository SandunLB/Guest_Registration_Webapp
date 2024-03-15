<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Guest Details</title>
    <link rel="stylesheet" href="CSS/stylesforadmin.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('../css/IMAGES/Omega.jpg') center/cover fixed;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
        }

        .header {
            background-color: rgba(61, 213, 137, 0.5);
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        .container {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            padding: 20px;
            text-align: center;
            max-width: 95%;
            width: 100%;
            margin: 50px auto;
            
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #fff;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            transition: box-shadow 0.3s;
            background: rgba(255, 255, 255, 0.9); 
        }

        th,
        td {
            border: 1px solid #bdc3c7;
            padding: 10px;
            text-align: left;
            transition: background-color 0.2s;
        }

        th {
            background-color: #3DD589;
            color: #000;
            font-size: 14px;
        }

        td {
            background-color: #ecf0f1;
            font-size: 13px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        input[type='submit'] {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        input[name='accept'] {
            background-color: #3DD589;
            color: #fff;
        }

        input[name='decline'] {
            background-color: #e74c3c;
            color: #fff;
            font-size: 12px;
            opacity: 0.7;
        }

        .highlight {
            background-color: #e74c3c;
            color: #ecf0f1;
        }

        table:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        th:hover,
        td:hover {
            background-color: #2CA47850;
        }

        .total-guests {
            margin-top: 20px;
            color: #000;
        }

        @media (max-width: 600px) {
            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Registered Guest Details</h1>
    </div>


    <div class="container">
    <form method="post" action="">
    <input type="submit" name="viewAll" value="View All Guests">
    </form>
        <?php
        // Include database connection code here
        include 'connection.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['viewAll'])) {
                // Toggle viewAll session variable
                if (isset($_SESSION['viewAll'])) {
                    unset($_SESSION['viewAll']);
                } else {
                    $_SESSION['viewAll'] = true;
                }
            }
        }

        if (isset($_SESSION['viewAll'])) {
            // Fetch all guests without date condition
            $query = "SELECT g.*, p.ContactPerson, p.Purpose, vd.Date as VehicleDate, vd.VehicleNumber, v.Date as VisitDate, v.Time, v.OutTime
                FROM guestdetails g
                LEFT JOIN purpose p ON g.GuestID = p.GuestID
                LEFT JOIN vehicledate vd ON g.GuestID = vd.GuestID
                LEFT JOIN visits v ON g.GuestID = v.GuestID";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div class='table-container'>";
                echo "<table border='1'>
                    <tr>
                        <th>GuestID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Phone Number</th>
                        <th>Contact Person</th>
                        <th>Purpose</th>
                        
                        <th>Vehicle Number</th>
                        <th>Visit Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['GuestID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['NIC']}</td>
                        <td>{$row['PhoneNumber']}</td>
                        <td>{$row['ContactPerson']}</td>
                        <td>{$row['Purpose']}</td>
                        
                        <td>{$row['VehicleNumber']}</td>
                        <td>{$row['VisitDate']}</td>
                        <td>{$row['Time']}</td>
                        <td>{$row['Status']}</td>
                        <td>";

                    // Check if the guest is from the future, then show buttons
                    if (strtotime($row['VehicleDate']) >= strtotime(date('Y-m-d')) || strtotime($row['VisitDate']) >= strtotime(date('Y-m-d'))) {
                        echo "<form method='post' action=''>
                                <input type='hidden' name='guestID' value='{$row['GuestID']}'>
                                <input type='submit' name='accept' value='Accept'>
                                <input type='submit' name='decline' value='Decline'>
                            </form>";
                    } else {
                        echo "Past Guest";
                    }

                    echo "</td></tr>";
                }

                echo "</table>";
                echo "</div>";
            } else {
                echo "Error fetching data: " . mysqli_error($conn);
            }
        } else {
            // Fetch data from the database with a condition for current dates onwards
            $currentDate = date('Y-m-d');
            $query = "SELECT g.*, p.ContactPerson, p.Purpose, vd.Date as VehicleDate, vd.VehicleNumber, v.Date as VisitDate, v.Time, v.OutTime
                FROM guestdetails g
                LEFT JOIN purpose p ON g.GuestID = p.GuestID
                LEFT JOIN vehicledate vd ON g.GuestID = vd.GuestID
                LEFT JOIN visits v ON g.GuestID = v.GuestID
                WHERE (vd.Date >= '$currentDate' OR v.Date >= '$currentDate')";

            // Execute the query and fetch data
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div class='table-container'>";
                echo "<table border='1'>
                    <tr>
                        <th>GuestID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Phone Number</th>
                        <th>Contact Person</th>
                        <th>Purpose</th>
                       
                        <th>Vehicle Number</th>
                        <th>Visit Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['GuestID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['NIC']}</td>
                        <td>{$row['PhoneNumber']}</td>
                        <td>{$row['ContactPerson']}</td>
                        <td>{$row['Purpose']}</td>
                        
                        <td>{$row['VehicleNumber']}</td>
                        <td>{$row['VisitDate']}</td>
                        <td>{$row['Time']}</td>
                        <td>{$row['Status']}</td>
                        <td>";

                    // Check if the guest is from the future, then show buttons
                    if (strtotime($row['VehicleDate']) >= strtotime($currentDate) || strtotime($row['VisitDate']) >= strtotime($currentDate)) {
                        echo "<form method='post' action=''>
                                <input type='hidden' name='guestID' value='{$row['GuestID']}'>
                                <input type='submit' name='accept' value='Accept'>
                                <input type='submit' name='decline' value='Decline'>
                            </form>";
                    } else {
                        echo "Past Guest";
                    }

                    echo "</td></tr>";
                }

                echo "</table>";
                echo "</div>";
            } else {
                echo "Error fetching data: " . mysqli_error($conn);
            }
        }

        // Process form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['accept'])) {
                updateStatus($_POST['guestID'], 'Accept');
            } elseif (isset($_POST['decline'])) {
                updateStatus($_POST['guestID'], 'Decline');
            }
        }

        // Function to update status
        function updateStatus($guestID, $status)
        {
            global $conn;

            $updateQuery = "UPDATE guestdetails SET Status = '$status' WHERE GuestID = $guestID";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "Status updated successfully for GuestID $guestID";
            } else {
                echo "Failed to update status for GuestID $guestID: " . mysqli_error($conn);
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
   

</body>

</html>
