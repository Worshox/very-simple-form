<?php

const ERROR_REQUIRED_FIELD = "This field is required";
const ERROR_PASSWORD_SHORT = "Password must contain at least 6 characters";
const ERROR_PASSWORD_WEAK = "Password must contain a number a lowercase and an uppercase";
const ERROR_PASSWORDS_DIFF = "Passwords must be the same";
$errors = [];

$username = '';
$email = '';
$password = '';
$repPassword = '';
$cv = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = extractPostData('username');
    $email = extractPostData('email');
    $password = extractPostData('password');
    $repPassword = extractPostData('repeat-password');
    $cv = extractPostData('cv');

    $formFieldsNames = array('username', 'email', 'password', 'repPassword');

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

    if ($cv && !filter_var($cv, FILTER_VALIDATE_URL))
        $errors['cv'] = 'Invalid URL address';

    if (strlen($password) < 6)
        $errors['password'] = ERROR_PASSWORD_SHORT;
    else if (!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password))
        $errors['password'] = ERROR_PASSWORD_WEAK;
    else if ($password && $repPassword && strcmp($password, $repPassword) !== 0)
        $errors['repPassword'] = ERROR_PASSWORDS_DIFF;
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
                <input type="text" value="<?php echo empty($errors) ? '' : $username ?>" name="username" id="username" <?php echo isset($errors['username']) ? 'class="bad-input"' : '' ?>>
                <div id="username-capacity">Min 6 and max 16 characters</div>
                <div class="empty-field">
                    <?php echo $errors['username'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="email-block" class="input-block">
                <label for="email">E-mail</label> <br>
                <input type="text" value="<?php echo empty($errors) ? '' : $email ?>" name="email" id="email" <?php echo isset($errors['email']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['email'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="password-block" class="input-block">
                <label for="password">Password</label> <br>
                <input type="password" value="<?php echo empty($errors) ? '' : $password ?>" name="password" id="password" <?php echo isset($errors['password']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['password'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="repeat-password-block" class="input-block">
                <label for="repeat-password">Repeat password</label> <br>
                <input type="password" value="<?php echo empty($errors) ? '' : $repPassword ?>" name="repeat-password" id="repeat-password" <?php echo isset($errors['repPassword']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['repPassword'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <div id="cv-block" class="input-block">
                <label for="cv">Your CV link</label> <br>
                <input type="text" value="<?php echo empty($errors) ? '' : $cv ?>" placeholder="https://www.example.com/my-cv" name="cv" id="cv" <?php echo isset($errors['cv']) ? 'class="bad-input"' : '' ?>>
                <div class="empty-field">
                    <?php echo $errors['cv'] ?? '&nbsp;'; ?>
                </div>
            </div>
            <input type="submit" value="Register" name="register" id="register">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors))
            echo "<div id='success'> Form data sent! </div>";
        ?>
    </div>
</body>

</html>