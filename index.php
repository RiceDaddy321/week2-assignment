<!-- This is the main login page -->
<?php
// session_start();

// function loggsing($name, $password) {
//     if ($name )
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Please login using the form below</h1>
    <form action="logged.php" method="post">
        <input type="text" name="user" id="user-text" placeholder="Username" onsubmit="<?php  ?>">
        <input type="password" name="password" id="password-text" placeholder="password">
        <input type="submit">
    </form>
</body>
</html>