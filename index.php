<?php
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = extractPostData('username');
    $email = extractPostData('email');
    $password = extractPostData('password');
    $repPassword = extractPostData('repeat-password');
    $cv = extractPostData('cv');

    echo "<pre>";
    echo var_dump($username, $email, $password, $repPassword, $cv);
    echo "</pre>";
}

function extractPostData($field)
{
    return htmlspecialchars(stripslashes($_POST[$field]));
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form with validation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="container">
        <form action="" method="post">
            <div id="username-block" class="input-block">
                <label for="username">Username</label> <br>
                <input type="text" name="username" id="username">
            </div>
            <div id="email-block" class="input-block">
                <label for="email">E-mail</label> <br>
                <input type="text" name="email" id="email">
            </div>
            <div id="password-block" class="input-block">
                <label for="password">Password</label> <br>
                <input type="password" name="password" id="password">
            </div>
            <div id="repeat-password-block" class="input-block">
                <label for="repeat-password">Repeat password</label> <br>
                <input type="password" name="repeat-password" id="repeat-password">
            </div>
            <div id="cv-block" class="input-block">
                <label for="cv">Your CV link</label> <br>
                <input type="text" placeholder="https://www.example.com/my-cv" name="cv" id="cv">
            </div>
            <input type="submit" value="Register" name="register" id="register">
        </form>
    </div>
</body>

</html>