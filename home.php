<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Website</title>
    <style>
       *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins';
        }

        .container{
            width: 100%;
            height: 100vh;
            background-color: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content{
            text-align: center;
        }

        .content h1{
            font-size: 95px;
            color: #fbe9dd;
            margin-bottom: 50px;
            opacity: 0.3;
        }

        .content a{
            font-size: 23px;
            color: #fff;
            text-decoration: none;
            border: 2px solid #fff;
            padding: 15px 25px;
            border-radius: 50px;
            transition: 0.3s;
        }

        .content a:hover{
            background-color: #fbe9dd;
            color: #000;
        }

        .background-clip{
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        @media (min-aspect-ratio:16/9) {
            .background-clip{
                width: 100%;
                height: auto;
            }
        }

        @media (max-aspect-ratio:16/9) {
            .background-clip{
                width: auto;
                height: 100%;
            }
        }

    </style>
</head>
<body>

    <div class="container">

    <video autoplay loop muted plays-inline class="background-clip">
        <source src="resource/videos/video.mp4" type="video/mp4">
    </video>

    <div class="content">
        <h1>pharmaceutical counterfeit Detection System</h1>
        <a href="login.php">Get Started</a>
    </div>
    </div>

</body>
</html>
