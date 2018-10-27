<!doctype html>

<html>

<head>
    <!--
    Project 02_06_01
    Author: Jaggar Hample
    Date: 10/23/18  
    Filename: PostGuest.php
    -->
    <title>Guest Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $name = stripslashes($_POST['name']);
        $email = stripslashes($_POST['email']);
        $name = str_replace("~","-", $name);
        $email = str_replace("~","-", $email);
        $existingEmail = array();
        if(file_exists("Guests.txt") && filesize("Guests.txt") > 0) {
            $messageArray = file("Guests.txt");
            $count = count($messageArray);
            for ($i = 0; $i < $count; $i++) {
                $currMsg = explode("~", $messageArray[$i]);
                $existingEmail[] = $currMsg[0];
            }
        }
        if (in_array($email, $existingEmail)) {
            echo "<p>The email you entered\"$subject\" is already in use <br>\n";
            echo "Please re-enter the email<br>\n";
            $email = "";
        }
        else {
            $messageRecord = "$name~$email\n";
            $fileHandle = fopen("Guests.txt", "ab");
            if (!$fileHandle) {
            echo "There was an error\n";
            }
            // Else, the information was successfully submitted
            else {
                fwrite($fileHandle, $messageRecord);
                fclose($fileHandle);
                echo "The information was submitted\n";
                $name = "";
                $email = "";
            }
        }
    }
    else {
        $name = "";
        $email = "";
    }
    ?>
    <h1>Register Guest</h1>
    <!--Registration Form-->
    <form action="PostGuest.php" method="post">
        <p>Name<br><input type="text" name="name"></p>
        <p>Email<br><input type="text" name="email"></p>
    <!--Reset-->
        <input type="reset" name="reset" value="Reset Form">
    <!--Submit-->
        <input type="submit" name="submit" value="Submit Form">
    </form>
        <p>
            <a href="GuestBook.php">View Guests</a>
        </p>

</body>

</html>
