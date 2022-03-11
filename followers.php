<?php
//    echo $_POST["username"];
//    echo "<br>";
//    echo $_POST["password"];
//    echo "<br>";

$dynamoDBPath = "http://localhost:8088/followers/";

echo "<b>Follors of " . $_POST["username"] . ":</b>";
echo "<br><br>";
    
    $followersData = file_get_contents($dynamoDBPath . $_POST["userId"]);
    
    $followersJson = json_decode($followersData, false);
    
    for($i=0; $i<count($followersJson->followers); $i++) {
        echo $followersJson->followers[$i];
        echo "<br>";
    }
    echo "<br>";
?>

<form method="post" action="chooseFollower.php">
    <input type="hidden" name="username" value=<?php echo $_POST["username"]; ?> >
    <input type="hidden" name="userId" value=<?php echo $_POST["userId"]; ?> >
    <input type="submit" value="Pick a user">
</form>
