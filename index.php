<?php

const ERROR_REQUIRED_FIELD = "This field is required";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = extractPostData('username');
    $email = extractPostData('email');
    $password = extractPostData('password');
    $repPassword = extractPostData('repeat-password');
    $cv = extractPostData('cv');

    $formFieldsNames = array('username', 'email', 'password', 'repPassword', 'cv');

    foreach ($formFieldsNames as $field) {
        static $fieldCounter = 0;
        if (!$$field)
            $errors[$formFieldsNames[$fieldCounter]] = ERROR_REQUIRED_FIELD;
        $fieldCounter++;
    }

    if (!isset($errors['username']))
        if (strlen($username) < 6 || strlen($username) > 16)
            $errors['username'] = 'Invalid username length';

    if (!isset($errors['email']))
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Invalid email address';
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
                <input type="text" name="username" id="username" <?php echo isset($errors['username']) ? 'class="bad-input"' : '' ?>>
                <div id="username-capacity">Min 6 and max 16 characters</div>
                <div class="empty-field">
                    <?php echo $errors['username'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="email-block" class="input-block">
                <label for="email">E-mail</label> <br>
                <input type="text" name="email" id="email" <?php echo isset($errors['email']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['email'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="password-block" class="input-block">
                <label for="password">Password</label> <br>
                <input type="password" name="password" id="password" <?php echo isset($errors['password']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['password'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="repeat-password-block" class="input-block">
                <label for="repeat-password">Repeat password</label> <br>
                <input type="password" name="repeat-password" id="repeat-password" <?php echo isset($errors['repPassword']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['repPassword'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="cv-block" class="input-block">
                <label for="cv">Your CV link</label> <br>
                <input type="text" placeholder="https://www.example.com/my-cv" name="cv" id="cv" <?php echo isset($errors['cv']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['cv'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <input type="submit" value="Register" name="register" id="register">
        </form>
    </div>
</body>

</html>