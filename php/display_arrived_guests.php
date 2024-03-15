<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrived Guests Details</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('../css/IMAGES/Omega.jpg') center/cover fixed;
            flex-direction: column;
            align-items: center;
            justify-content: space-between; /* Adjusted to space between the content and footer */
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
            background: rgba(255, 255, 255, 0.5); /* Adjusted transparency */
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            padding: 20px;
            text-align: center;
            max-width: 95%;
            width: 100%;
            margin: 50px auto; /* Adjusted margin to match the provided style */
            
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
        <h1>Arrived Guests Details</h1>
    </div>

    <div class="container">
        <?php
        include 'connection.php';

        // Function to fetch and display arrived_guests details with image
        function displayArrivedGuestsDetails()
        {
            global $conn;

            $fetchArrivedGuestsQuery = "SELECT * FROM arrived_guests";
            $result = $conn->query($fetchArrivedGuestsQuery);

            if ($result->num_rows > 0) {
                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Guest ID</th>";
                echo "<th>Name</th>";
                echo "<th>NIC</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Contact Person</th>";
                echo "<th>Purpose</th>";
                echo "<th>Arrival Date</th>";
                echo "<th>Arrival Time</th>";
                echo "<th>Out Time</th>";
                echo "<th>Image</th>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['GuestID']}</td>";
                    echo "<td>{$row['Name']}</td>";
                    echo "<td>{$row['NIC']}</td>";
                    echo "<td>{$row['PhoneNumber']}</td>";
                    echo "<td>{$row['ContactPerson']}</td>";
                    echo "<td>{$row['Purpose']}</td>";
                    echo "<td>{$row['ArrivalDate']}</td>";
                    echo "<td>{$row['ArrivalTime']}</td>";
                    echo "<td>{$row['OutTime']}</td>";
                    echo "<td><img src='{$row['Image']}' alt='Guest Image' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";

                // Display total number of guests
                echo "<div class='total-guests'>";
                echo "Total Guests: " . $result->num_rows;
                echo "</div>";
            } else {
                echo "No arrived guests found.";
            }
        }

        // Call the function to display arrived_guests details
        displayArrivedGuestsDetails();

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
