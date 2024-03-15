<?php
include 'php/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch admin data from the database based on the provided username
    $query = "SELECT * FROM admin_login WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, redirect to the admin panel
                header('Location: php/dashboard.php');
                exit();
            } else {
                $error_message = 'Invalid password';
            }
        } else {
            $error_message = 'Invalid username';
        }
    } else {
        $error_message = 'Error querying the database';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('css/IMAGES/Omega.jpg');
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
            color: #000; /* Adjusted color */
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
        <h2>Admin Login</h2>

        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>

