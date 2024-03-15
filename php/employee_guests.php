<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Requests</title>
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
            font-size: 20px;
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

        h2 {
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
    <h1>Staff Requests</h1>
    </div>


    <div class="container">

    <?php
    // Include database connection code here
    include 'connection.php';

    // Fetch data from the staff table with a condition for current dates onwards
    $currentDate = date('Y-m-d');
    $queryStaff = "SELECT * FROM staff WHERE Arrival_Date >= '$currentDate'";
    $resultStaff = mysqli_query($conn, $queryStaff);

    if ($resultStaff) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Employee ID</th>
                    <th>Guest Name</th>
                    <th>NIC</th>
                    <th>Phone Number</th>
                    <th>Arrival Date</th>
                    <th>Arrival Time</th>
                    <th>Vehicle Number</th>
                    <th>Purpose of Visit</th>
                    
                    
                    
                    
                </tr>";

        while ($row = mysqli_fetch_assoc($resultStaff)) {
            echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Position']}</td>
                    <td>{$row['Employee_ID']}</td>
                    <td>{$row['Guest_name']}</td>
                    <td>{$row['NIC']}</td>
                    <td>{$row['Phone_number']}</td>
                    <td>{$row['Arrival_Date']}</td>
                    <td>{$row['Arrival_Time']}</td>
                    <td>{$row['Vehicle_Number']}</td>
                    <td>{$row['Purpose_of_visit']}</td>
                    
                    
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }


    // Close the database connection
    mysqli_close($conn);
    ?>
    </div>

</body>
</html>
