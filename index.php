<!-- This is the main login page -->
<?php
    session_start();

    $myfile = "../database.json";
    $json = file_get_contents($myfile)  or die("Unable to open file!");

    //set to php associative array
    $database = json_decode($json, true);
    
    //define the defaults
    $errorDisplay = false;

    // handles which form to use
    if(array_key_exists('login', $_POST)) {
        login($database, $myfile);
    }
    else if(array_key_exists('register', $_POST)) {
        
        register($myfile, $database);
    }
    function redirect($url) {
        header('Location: ' . $url);
    }
    //pass the file
    function register($file, $data) {
        $errorDisplay = true;
        $user = $password = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["newUser"];
            $password = $_POST["newPassword"];

            if(array_key_exists($user, $data)) {
                $ErrorTxt = "You cannot use that username!";
            }
            else {
                $data[$user] = $password;
                $entry = json_encode($data);
                file_put_contents($file, $entry);
                $ErrorTxt = "your account has been made successfully!";
                $errorDisplay = false;
            }
        }
    }

    function login($data, $file) {
        $user = $password = "";
        //only works when the server sends the form to itself
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["user"];
            $password = $_POST["password"];
        
    
            // check that the login exists
            if(array_key_exists($user, $data)) {
            

                //check the password
                if($password == $data[$user]) {
                    
                    $_SESSION["user"] = $user;
                    redirect("logged.php", $file);
                }
                else {
                    
                    
                    $ErrorTxt = "Your supplied information is incorrect!";
                    $errorDisplay = true;
    
                }
            }
            else {
                
                
                $ErrorTxt = "Your supplied information is incorrect!";
                $errorDisplay = true;

            }
            

    
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<!-- <style>
    .error {
        display: <?php echo $ERROR; ?>;
    }
</style> -->
<body>
    <h1>Please login using the form below</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="user" id="user-text" placeholder="Username" >
        <input type="password" name="password" id="password-text" placeholder="password">
        <input type="submit" name="login" value="Login">
    </form>
    <!-- <button onclick="<?php $errorDisplay = !$errorDisplay;?>></button> -->
    <?php if($errorDisplay) { ?>
        <span class="error" ><?php echo $ErrorTxt; ?></span>
        <div class="error">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="newUser" id="user-text" placeholder="Username" >
                <input type="password" name="newPassword" id="password-text" placeholder="password">
                <input type="submit" name="register" value="Register">
            </form>
        </div>
    <?php } ?>
</body>
</html>