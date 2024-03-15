<?php
session_start();

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check login credentials
    $login_query = "SELECT * FROM login WHERE name = '$username' AND employee_id = '$password'";
    $login_result = $conn->query($login_query);

    if ($login_result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: employee_form.php"); // Redirect to the dashboard or another page
        exit();
    } else {
        // Login failed
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>

<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            justify-content: space-between;
            min-height: 100vh;
            color: #000;
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
            color: #000; 
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
        <h2>Login</h2>

        <?php
        // Check if there is an error message
        if (isset($_SESSION['login_error'])) {
            echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form method="POST" action="login.php">
            <label for="username">Username (Name):</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Employee ID:</label>
            <input type="text" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <p>If not registered yet, <a href="Employe_Account_Create.php">create a new account</a>!</p>
    </div>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
