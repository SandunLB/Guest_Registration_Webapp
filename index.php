<!DOCTYPE html>
<?php include('includes/header.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Omega Line - Your destination for reliable and efficient transportation services. Employee login and guest form submission available.">
    <meta name="keywords" content="Omega Line, employee login, guest form, transportation services">
    <meta name="author" content="SLB">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/png" href="css/IMAGES/Omegaline.png"/>

    <title>Omega Line</title>
    <style>
    body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background: url('css/IMAGES/Omega.jpg') center/cover fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between; 
    min-height: 100vh;
    color: #fff;
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
    backdrop-filter: blur(4px);
}
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #fff;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .option {
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

        .option:hover {
            background-color: rgba(46, 173, 111, 1);
        }
        
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to Omega Line</h1>

        <div class="options">
            <a href="php/login.php" class="option">Employee Login</a>
            <a href="php/Guest_Form.php" class="option">Submit Guest Form</a>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>
