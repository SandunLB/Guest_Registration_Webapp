<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrived Guests Form</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('../css/IMAGES/Omega.jpg') center/cover fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            color: #fff;
        }
        .header {
            background-color: rgba(61, 213, 137, 0.5);
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
            
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 80%;
            margin: auto;
            backdrop-filter: blur(10px);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #fff;
        }

        #hp {
            color: #fff;
            font-size: 1.5em;

        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;

        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #fff;
        }

        input {
            padding: 10px;
            border: 1px solid #fff;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 15px;
            background-color: rgba(61, 213, 137, 1);
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 1.2em;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: rgba(46, 173, 111, 1);
        }
    </style>
</head>

<body>
<div class="header">
        <h1>Store Arrived Guests</h1>
    </div>
    <div class="container">
        <h1>Arrived Guests Form</h1>
        <p id="hp">Use this form to store details of arrived guests.</p>
        <?php
        include 'connection.php';

        // Function to validate guestID
        function validateGuestID($guestID)
        {
            // Check if the input contains only numeric characters
            return is_numeric($guestID);
        }

        // Function to store guest details in arrived_guests table
        function storeArrivedGuestDetails($guestID)
        {
            global $conn;

            // Validate guestID
            if (!validateGuestID($guestID)) {
                // Display error message if the input is not a valid number
                echo '<p style="color: red; background: rgba(255, 0, 0, 0.3);">Invalid input. Please enter a valid Guest ID.</p>';
                return;
            }

            // Check if the guest already arrived
            $checkArrivalQuery = "SELECT * FROM arrived_guests WHERE GuestID = $guestID";
            $result = $conn->query($checkArrivalQuery);

            if ($result->num_rows > 0) {
                // Guest already arrived, display error message
                echo '<p style="color: red; background: rgba(255, 0, 0, 0.3);">Guest with ID ' . $guestID . ' already arrived.</p>';
            } else {
                // Fetch guest details from guestdetails and purpose tables
                $fetchGuestDetailsQuery = "SELECT guestdetails.GuestID, guestdetails.Name, guestdetails.NIC, guestdetails.PhoneNumber, guestdetails.Image, purpose.ContactPerson, purpose.Purpose, visits.Date, visits.Time, visits.OutTime
                           FROM guestdetails
                           LEFT JOIN purpose ON guestdetails.GuestID = purpose.GuestID
                           LEFT JOIN visits ON guestdetails.GuestID = visits.GuestID
                           WHERE guestdetails.GuestID = $guestID";


                $result = $conn->query($fetchGuestDetailsQuery);

                if ($result->num_rows > 0) {
                    // Guest exists, store details in arrived_guests
                    $guestDetails = $result->fetch_assoc();
                    $insertArrivedGuestQuery = "INSERT INTO arrived_guests (GuestID, Name, NIC, PhoneNumber, Image, ContactPerson, Purpose, ArrivalDate, ArrivalTime, OutTime)
                            VALUES (
                                {$guestDetails['GuestID']},
                                '{$guestDetails['Name']}',
                                '{$guestDetails['NIC']}',
                                '{$guestDetails['PhoneNumber']}',
                                '{$guestDetails['Image']}',
                                '{$guestDetails['ContactPerson']}',
                                '{$guestDetails['Purpose']}',
                                '{$guestDetails['Date']}',
                                '{$guestDetails['Time']}',
                                NOW() -- Current time
                            )";


                    if ($conn->query($insertArrivedGuestQuery) === TRUE) {
                        // Guest details stored successfully, display success message
                        echo '<p style="color: green; background: rgba(0, 255, 0, 0.2);">Guest details stored in arrived_guests table successfully.</p>';
                    } else {
                        // Error storing guest details, display error message
                        echo '<p style="color: red; background: rgba(255, 0, 0, 0.2);">Error storing guest details in arrived_guests table: ' . $conn->error . '</p>';
                    }
                } else {
                    // Guest does not exist, display error message
                    echo '<p style="color: red; background: rgba(255, 0, 0, 0.2);">Guest with ID ' . $guestID . ' does not exist.</p>';
                }
            }
        }

        // Function to display form
        function displayForm()
        {
            echo '
                <form method="post" action="">
                    <label for="guestID">Enter Guest ID:</label>
                    <input type="text" name="guestID" required>
                    <button type="submit">Submit</button>
                </form>';
        }

        // Example usage:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Form submitted, process the entered GuestID
            $guestID = $_POST['guestID'];
            storeArrivedGuestDetails($guestID);
        }

        // Display the form
        displayForm();

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
