<?php
session_start();

// Initialize variables to store entered values
$name = "";
$employee_id = "";

// Check if session variables are set
if (isset($_SESSION['entered_name'])) {
    $name = $_SESSION['entered_name'];
    unset($_SESSION['entered_name']);
}

if (isset($_SESSION['entered_employee_id'])) {
    $employee_id = $_SESSION['entered_employee_id'];
    unset($_SESSION['entered_employee_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../includes/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee Account</title>
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
            justify-content: space-between; /* Ensure space between header and footer */
            min-height: 100vh;
        }

        .container {
            max-width: 400px;
            width: 90%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s;
            overflow: hidden;
            margin: auto;
            margin-top: 20vh;
        }

        h2 {
            margin-bottom: 20px;
            color: #3DD589;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1em;
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media screen and (max-width: 768px) {
            .container {
                width: 85%;
                margin: auto;
                padding: 15px;
                margin-top: 10vh;
            }
           

            h2 {
                font-size: 1.5em;
            }

            form {
                gap: 10px;
            }

            label {
                font-size: 1em;
            }

            input {
                padding: 8px;
                font-size: 0.9em;
            }

            button {
                padding: 10px 18px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Employee Account</h2>

    <?php
    // Check if there is an error message
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="POST" action="process_new_account.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" value="<?php echo $employee_id; ?>" required>

        <label for="confirm_employee_id">Confirm Employee ID:</label>
        <input type="text" id="confirm_employee_id" name="confirm_employee_id" required>

        <button type="submit">Create Account</button>
    </form>
</div>
<?php include('../includes/footer.php'); ?>

</body>
</html>
