<!DOCTYPE html>
<?php include('../includes/header.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <script>
        // Use sessionStorage to keep track of the last visited page
        if (!sessionStorage.getItem("currentPage")) {
            sessionStorage.setItem("currentPage", window.location.href);
        }

        // Override the default browser back button behavior
        window.onpopstate = function(event) {
            // Check if the current page is the same as the last visited page
            if (sessionStorage.getItem("currentPage") === window.location.href) {
                // If they are the same, prevent the default back behavior
                history.pushState(null, null, sessionStorage.getItem("currentPage"));
            }

            // Update the last visited page
            sessionStorage.setItem("currentPage", window.location.href);

            // Add your custom logic here, such as showing/hiding elements based on the page
            // For example, you might want to handle different states of a single-page application
        };

        // Function to navigate to a new page
        function navigateTo(page) {
            // Use pushState to update the URL without triggering a full page reload
            history.pushState(null, null, page);

            // Update the last visited page in sessionStorage
            sessionStorage.setItem("currentPage", page);

            // Add your custom logic here if needed
        }
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../css/IMAGES/Omega.jpg');
            background-size: cover;
            background-attachment: fixed;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s;
            overflow: hidden;
            margin: 8vh auto; /* Adjusted margin value */
        }

        h2, .sub-heading {
            color: #3DD589;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Adjusted gap for more compact mobile view */
        }

        label {
            font-size: 0.9em; /* Adjusted font size for more compact mobile view */
            margin-bottom: 3px; /* Adjusted margin for more compact mobile view */
        }

        input {
            padding: 8px;
            font-size: 0.9em; /* Adjusted font size for more compact mobile view */
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 16px); /* Adjusted width for all inputs */
        }

        button {
            background-color: #3DD589;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #2CA478;
        }

        button[type="button"] {
            background-color: #ccc;
            color: #000;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            padding: 8px 12px; /* Adjusted padding for smaller size */
            font-size: 0.8em; /* Adjusted font size for smaller size */
        }

        button[type="button"]:hover {
            background-color: #999;
            color: #fff;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media screen and (max-width: 768px) {
            .container {
                margin: 10vh auto; /* Adjusted margin for more compact mobile view */
                padding: 7px; /* Adjusted padding for more compact mobile view */
                width: 90%;
            }

            h2, .sub-heading {
                font-size: 1em; /* Adjusted font size for more compact mobile view */
            }

            form {
                gap: 5px; /* Adjusted gap for more compact mobile view */
            }

            label {
                font-size: 0.8em; /* Adjusted font size for more compact mobile view */
            }

            input {
                padding: 6px; /* Adjusted padding for more compact mobile view */
                font-size: 0.9em; /* Adjusted font size for more compact mobile view */
            }

            button {
                padding: 8px 16px; /* Adjusted padding for more compact mobile view */
                font-size: 1em; /* Adjusted font size for more compact mobile view */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome to Omega Company</h2>
    <p class="sub-heading">Employee Form</p>

    <form id="yourFormId" method="POST" action="process_employee_form.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>

        <label for="employeeID">Employee ID:</label>
        <input type="text" id="employeeID" name="employeeID" required>

        <label for="guestName">Guest Name:</label>
        <input type="text" id="guestName" name="guestName" required>

        <label for="nic">NIC:</label>
        <input type="text" id="nic" name="nic" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" name="phoneNumber">

        <label for="arrivalDate">Arrival Date:</label>
        <input type="date" id="arrivalDate" name="arrivalDate" required>

        <label for="arrivalTime">Arrival Time:</label>
        <input type="time" id="arrivalTime" name="arrivalTime" required>

        <label for="vehicleNumber">Vehicle Number:</label>
        <input type="text" id="vehicleNumber" name="vehicleNumber" required>

        <label for="purposeOfVisit">Purpose of Visit:</label>
        <input type="text" id="purposeOfVisit" name="purposeOfVisit">


        <button type="button" id="customResetButton" onclick="confirmReset()">Reset</button>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    function confirmReset() {
        var confirmation = confirm("Are you sure you want to reset the form?");
        if (confirmation) {
            document.getElementById("yourFormId").reset(); 
        }
    }
</script>
<?php include('../includes/footer.php'); ?>
</body>
</html>
