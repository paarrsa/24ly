<?php

// ################################################## //

// Request processing ------------------------------- //
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[1];
// -------------------------------------------------- //

// ################################################## //

// Create connection to database -------------------- //
$servername = "";
$username = "";
$password = "";
$db = "";
$conn = mysqli_connect($servername, $username, $password, $db);
// -------------------------------------------------- //

// ################################################## //

// Searching the database --------------------------- //
$uri = bin2hex($uri);
$result = mysqli_query($conn, "SELECT * FROM `links` WHERE `Alias`= UNHEX('$uri')");
$result = mysqli_fetch_assoc($result);
// -------------------------------------------------- //

// ################################################## //

// Result processing -------------------------------- //
if($result['URL'] != null) {
    $url = $result['URL'];
    header("Location: $url");
    exit();
}
// -------------------------------------------------- //

// ################################################## //
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
    body{ 
    display: flex;
    width: 100vw;
    height: 100vh;
    align-items: center;
    justify-content: center;
    margin: 0;
    background: #131515;
    color: #00E3C8;
    font-size: 96px;
    font-family: 'Poppins', sans-serif;
    letter-spacing: -7px;
    }

    div{
    animation: glitch 1s linear infinite;
    }

    @keyframes glitch{
    2%,64%{
        transform: translate(2px,0) skew(0deg);
    }
    4%,60%{
        transform: translate(-2px,0) skew(0deg);
    }
    62%{
        transform: translate(0,0) skew(5deg); 
    }
    }

    div:before,
    div:after{
    content: attr(title);
    position: absolute;
    left: 0;
    }

    div:before{
    animation: glitchTop 1s linear infinite;
    clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
    }

    @keyframes glitchTop{
    2%,64%{
        transform: translate(2px,-2px);
    }
    4%,60%{
        transform: translate(-2px,2px);
    }
    62%{
        transform: translate(13px,-1px) skew(-13deg); 
    }
    }

    div:after{
    animation: glitchBotom 1.5s linear infinite;
    clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
    -webkit-clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
    }

    @keyframes glitchBotom{
    2%,64%{
        transform: translate(-2px,0);
    }
    4%,60%{
        transform: translate(-2px,0);
    }
    62%{
        transform: translate(-22px,5px) skew(21deg); 
    }
    }
    </style>
</head>
<body>
    <div title="404">404</div>
</body>
</html>