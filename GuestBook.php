<!doctype html>

<html>

<head>
    <!--
    Project 02_06_01
    Author: Jaggar Hample
    Date: 10/23/18  
    Filename: GuestBook.php
    -->
    <title>Guest Book</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
        <!-- HTML Form -->
        <h1>Regestered Guest</h1>
        <?php
        if (isset($_GET['action'])) {
            if (file_exists("Guests.txt") && filesize("Guests.txt") != 0) {
                $guestArray = file("Guests.txt");
                switch ($_GET['action']) {
                case 'Delete First Guest':
                    array_shift($guestArray);
                    break;
                case 'Delete Guest':
                    array_splice($guestArray, $_GET['Guests'],1);
                    break;
                case 'Remove Duplicates':
                    $guestArray = array_unique($guestArray);
                    $guestArray = array_values($guestArray);
                    break;
                }
         if (count($guestArray) > 0) {
                echo "Remaining Guests<br>";
                    $newGuest = implode($guestArray);
                    $fileHandle = fopen("Guests.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error.\n";
                    }
                    else {
                        fwrite($fileHandle, $newGuest);
                        fclose($fileHandle);
                    }
                }
        else {
            unlink("Guests.txt");
                }
            } 
        }
        if (!file_exists("Guests.txt") || 
        filesize("Guests.txt") == 0) {
            echo "<p>There are no registered guests</p>\n";
        }
        else {
            $guestArray = file("Guests.txt");
            $count = count($guestArray);
            for ($i = 0; $i < $count; $i++) {
                $currMsg = explode ("~", $guestArray[$i]);
            }
        }
        ?>
        <p>
            <a href="PostGuest.php">Register New Guest</a><br>
            <a href="GuestBook.php?action=Deletet%20First">Remove First Guest</a><br>
            <a href="GuestBook.php">Sort Guest A-Z</a><br>
            <a href="GuestBook.php?action=Sort%20Descending">Sort Guest Z-A</a><br>
            <a href="GuestBook.php?action=Delete%20Last">Delete Last Guest</a><br>
        </p>
</body>

</html>