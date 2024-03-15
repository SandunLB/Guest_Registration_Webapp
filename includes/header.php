<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmegaLine</title>
    <link rel="icon" type="image/png" href="../css/IMAGES/Omegaline.png"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .header {
            background-color: rgba(51, 51, 51, 0.7);
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }

        .logo {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-left: 30px;
        }

        .nav-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: #fff;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin: 0 15px;
        }

        .cta-button {
            background-color: #3DD589;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .cta-button:hover {
            background-color: #2CA478;
        }

        .nav-item a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease-in-out;
        }

        .nav-item a:hover {
            color: #3DD589;
        }

        @media screen and (max-width: 768px) {
    .logo {
        margin-left: 15px;
    }

    .nav-toggle {
        display: block;
        margin-right: 20px; 
    }

    .nav-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        left: 0;
        right: 0;
        background-color: rgba(51, 51, 51, 0.7);
        z-index: 999;
        opacity: 0;
        animation: fadeIn 0.7s ease forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .nav-menu.active {
        display: flex;
    }

    .nav-item {
        margin: 10px 0;
        opacity: 0;
        animation: fadeInItem 0.5s ease forwards;
    }

    @keyframes fadeInItem {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .nav-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .nav-item:nth-child(3) {
        animation-delay: 0.4s;
    }

    .nav-item:nth-child(4) {
        animation-delay: 0.6s;
    }
    .nav-item:nth-child(5) {
        animation-delay: 0.8s;
    }
}

    </style>
</head>
<body>

<div class="header">
    <div class="logo"><i>Omega Line</i></div>

    <div class="nav-toggle" onclick="toggleNavMenu()">☰</div>

    <ul class="nav-menu">
        <li class="nav-item"><a href="../index.php">Home</a></li>
        <li class="nav-item"><a href="../php/login.php">Login</a></li>
        <li class="nav-item"><a href="../php/Guest_Form.php">Guest Form</a></li>
        <li class="nav-item"><a href="../php/Employe_Account_Create.php">Create Account</a></li>

    </ul>

</div>

<script>
    function toggleNavMenu() {
        var navMenu = document.querySelector('.nav-menu');
        navMenu.classList.toggle('active');
    }
</script>

</body>
</html>
