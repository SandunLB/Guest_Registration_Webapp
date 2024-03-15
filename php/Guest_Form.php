<!DOCTYPE html>
<html lang="en">
<head>
 <?php include('../includes/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Data Submit Form</title>
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
            margin: 8vh auto; 
        }

        h2, .sub-heading {
            color: #3DD589;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px; 
        }

        label {
            font-size: 0.9em; 
            margin-bottom: 3px; 
        }

        input {
            padding: 8px;
            font-size: 0.9em; 
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 16px); 
        }

        input[type="date"],
        input[type="time"] {
            width: calc(100% - 16px); 
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
            padding: 8px 12px; 
            font-size: 0.8em; 
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
                margin: 10vh auto;
                padding: 7px; 
                width: 90%;
            }

            h2, .sub-heading {
                font-size: 1em; 
            }

            form {
                gap: 5px; 
            }

            label {
                font-size: 0.8em; 
            }

            input {
                padding: 6px; 
                font-size: 0.9em; 
            }

            button {
                padding: 8px 16px; 
                font-size: 1em; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Omega Company</h2>
        <p class="sub-heading">Guest Data Submit Form</p>

        <form id="yourFormId" method="POST" action="process_form.php" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="nic">NIC:</label>
            <input type="text" id="nic" name="nic" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber">

            <label for="contactPerson">Contact Person:</label>
            <input type="text" id="contactPerson" name="contactPerson" required>

            <label for="arrivalDate">Arrival Date:</label>
            <input type="date" id="arrivalDate" name="arrivalDate" required>

            <label for="arrivalTime">Arrival Time:</label>
            <input type="time" id="arrivalTime" name="arrivalTime" required>

            <label for="vehicleNumber">Vehicle Number:</label>
            <input type="text" id="vehicleNumber" name="vehicleNumber" required>

            <label for="purposeOfVisit">Purpose Of Visit:</label>
            <input type="text" id="purposeOfVisit" name="purposeOfVisit">

            <label for="image">Upload an Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

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
