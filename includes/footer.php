<!DOCTYPE html>
<html lang="en">
<head>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
        }

        .footer {
            background-color: rgba(51, 51, 51, 0.7); 
            color: white;
            padding: 15px 0; 
            text-align: center;
            width: 100%;
            margin: 0 auto;
            
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: slideIn 0.5s ease-in-out; 
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .company-info h3 {
            margin: 0;
            font-size: 14px; 
        }

        .social-icons {
            margin-top: 8px; 
        }

        .social-icons a {
            display: inline-block;
            margin: 0 8px;
            transition: transform 0.3s ease-in-out;
        }

        .social-icons img {
            width: 18px; 
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }

        .copyright {
            margin-top: 8px; 
            font-size: 12px; 
        }

        .digital-clock {
            margin-top: 5px; 
            font-size: 10px; 
            color: white;
        }

        @media screen and (max-width: 600px) {
            
            .company-info h3 {
                font-size: 12px;
            }

            .social-icons a {
                margin: 0 6px;
            }

            .social-icons img {
                width: 16px;
            }

            .copyright {
                font-size: 10px;
            }

            .digital-clock {
                font-size: 8px;
            }
        }
    </style>
</head>
<body>

<div class="footer">
    <div class="footer-content">
        <div class="company-info">
            <h3>Omega Line Ltd</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/omegalineltd/" target="_blank"><img src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/explore/locations/1968378393450463/omega-line-ltd/" target="_blank"><img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/watch?v=GKcLvNCl1Zk" target="_blank"><img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube"></a>
                <a href="https://www.linkedin.com/company/omega-line-ltd" target="_blank"><img src="https://img.icons8.com/color/48/000000/linkedin.png" alt="LinkedIn"></a>
            </div>
        </div>

        <div class="copyright">
            &copy; <?php echo date("Y"); ?> Omega Line Ltd. All Rights Reserved.
        </div>

        <div class="digital-clock" id="clock"></div>
        <script>
            function updateClock() {
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();

                hours = (hours < 10) ? "0" + hours : hours;
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;

                var timeString = hours + ":" + minutes + ":" + seconds;
                document.getElementById("clock").innerHTML = timeString;

                setTimeout(updateClock, 1000);
            }

            updateClock(); 
        </script>
    </div>
</div>

</body>
</html>
