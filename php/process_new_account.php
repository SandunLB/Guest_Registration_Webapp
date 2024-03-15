<?php
session_start();
include 'connection.php';

// Initialize variables to store entered values
$name = "";
$employee_id = "";

// Retrieve stored values from session if they exist
if (isset($_SESSION['entered_name'])) {
    $name = $_SESSION['entered_name'];
}

if (isset($_SESSION['entered_employee_id'])) {
    $employee_id = $_SESSION['entered_employee_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $employee_id = $_POST['employee_id'];
    $confirm_employee_id = $_POST['confirm_employee_id'];

    if ($confirm_employee_id !== $employee_id) {
        $_SESSION['error'] = "Employee IDs do not match!";
        $_SESSION['entered_name'] = $name; 
        $_SESSION['entered_employee_id'] = $employee_id; 
        header("Location: Employe_Account_Create.php");
        exit();
    }

    $check_query = "SELECT * FROM login WHERE employee_id = '$employee_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = "Account already created!";
        $_SESSION['entered_name'] = $name; 
        $_SESSION['entered_employee_id'] = $employee_id; 
        header("Location: Employe_Account_Create.php");
        exit();
    }

    $insert_query = "INSERT INTO login (name, employee_id) VALUES ('$name', '$employee_id')";
    $insert_result = $conn->query($insert_query);

    if (!$insert_result) {
        die("Error: " . $conn->error);
    }

    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Created</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                margin: 0;
                padding: 0;
                background-image: url("../css/IMAGES/Omega.jpg");
                background-size: cover;
                background-attachment: fixed;
                overflow-x: hidden;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: #fff;
                height: 100vh;
            }

            .glass-container {
                max-width: 400px;
                width: 90%;
                padding: 20px;
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(2px);
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                text-align: center;
                animation: fadeIn 2s;
                overflow: hidden;
            }

            h1 {
                margin-bottom: 20px;
                color: #3DD589;
                font-size: 2em;
            }

            .success-info {
                background: rgba(255, 255, 255, 0.6);
                padding: 20px;
                border-radius: 10px;
                margin-top: 20px;
            }

            p {
                font-size: 1.2em;
                color:#000;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @media screen and (max-width: 768px) {
                .glass-container {
                    width: 95%;
                }
            }
        </style>
    </head>
    <body>
        <div class="glass-container">
            <h1>Account Created Successfully!</h1>
            <div class="success-info">
                <p>Name: ' . $name . '</p>
                <p>Employee ID: ' . $employee_id . '</p>
            </div>
        </div>
    </body>
    </html>';

    unset($_SESSION['error']);
    unset($_SESSION['entered_name']);
    unset($_SESSION['entered_employee_id']);

    // Redirect to the login page after displaying the success message
    header("refresh:4;url=login.php");
    exit();
}

$conn->close();
?>
