<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-FIT Splash Screen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        #background {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #11998e, #38ef7d);
            background-size: 600% 600%;
            animation: gradientShift 12s ease infinite;
            z-index: 0;
            transition: opacity 1.5s ease;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 100%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 0%; }
            100% { background-position: 0% 50%; }
        }

        #logo-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 1;
            opacity: 1;
            transition: opacity 1.5s ease;
        }

        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 15px #f2a900);
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            text-shadow: 0 0 10px #f2a900;
        }

        .subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 10px;
            text-shadow: 0 0 8px #ffffff88;
        }

        .tagline {
            font-size: 1.2rem;
            font-weight: 400;
            margin-top: 15px;
            color: #f2a900;
            text-shadow: 0 0 6px #f2a90088;
        }
        @media (max-width: 480px) {
    .logo {
        width: 130px;
    }

    .title {
        font-size: 1.8rem;
    }

    .subtitle {
        font-size: 1.2rem;
    }

    .tagline {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <div id="background"></div>
    <div id="logo-container">
        <img src="logo.png" alt="B-FIT Logo" class="logo">
        <div class="title">Fitness & Nutrition</div>
        <div class="subtitle">Transform Your Health</div>
        <div class="tagline">One Step Towards a Healthy Life</div>
    </div>

    <script>
        window.onload = () => {
            const logo = document.getElementById('logo-container');
            const background = document.getElementById('background');

            setTimeout(() => {
                [logo, background].forEach(el => {
                    el.style.opacity = "0";
                });
            }, 7000); // Fade out after 7s

            setTimeout(() => {
                window.location.href = 'login.html';
            }, 8500); // Redirect after 8.5s
        };
    </script>
</body>
</html>
