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
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="repeat-password">Repeat password</label>
            <input type="text" name="repeat-password" id="repeat-password">
            <label for="cv">Your CV link</label>
            <input type="url" name="cv" id="cv">
            <input type="submit" name="register" id="register">
        </form>
    </div>
</body>

</html>