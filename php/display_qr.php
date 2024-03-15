<!DOCTYPE html>
<?php include('../includes/header.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            background: url('../css/IMAGES/Omega.jpg') center/cover fixed;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s;
            overflow: hidden;
            backdrop-filter: blur(50px);
            margin: auto; 
            
        }

        h1 {
            color: #3DD589;
            margin-bottom: 20px;
            font-size: 2em;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.5s ease-in-out;
        }

        p {
            margin: 0;
            font-size: 1.2em;
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
        @media screen and (max-width: 600px) {
            .container {
                width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data added successfully!</h1>
        <img src="<?php echo $_GET['qrCodePath'] ?? ''; ?>" alt="QR Code">
        <p>Guest Name: <?php echo $_GET['name'] ?? ''; ?></p>
        <p>Guest ID: <?php echo $_GET['guestID'] ?? ''; ?></p>
        <br>
        <button onclick="downloadQR()">Download QR</button>
    </div>

    <script>
        function downloadQR() {
            var link = document.createElement("a");
            link.href = "<?php echo $_GET['qrCodePath'] ?? ''; ?>";
            link.download = "<?php echo $_GET['name'] ?? ''; ?>__qrcode.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
