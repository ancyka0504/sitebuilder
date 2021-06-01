<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="dropdown">
        <img src="./img/pills_speaker.png">
        <table class="bord">
            <tr>
                <td>
                    <button class="dropbtn" style="border-right: 1px solid lightgrey;">English
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Magyar</a>
                        <a href="#">Német</a>
                    </div>
                </td>
                <td>
                    <div class="navbar1">
                        <a href="#">Contact</a>
                        <a href="#">Sitemap</a>
                    </div>
                </td>
                <td rowspan="2"><img src="./img/logo-img.svg.png"></td>
            </tr>
            <tr style="border-bottom: none;" class="navbar1">
                <td><a href="#"><img src="./img/folder-img.png"> My Collections</a></td>
                <td><a href="#"><img src="./img/close-img.png"> Logout <?php include('./logout.php'); ?></a></td>
            </tr>
        </table>
    </div>
</header>
<div class="navbar">
    <a href="#"><img src="./img/home_btn.png"></a>
    <a href="#">mpaf</a>
    <a href="#">venous</a>
    <a href="#">acs</a>
    <a href="#">kivamoxoban studies</a>
    <a href="#">background information</a>
</div>
</body>
</html>