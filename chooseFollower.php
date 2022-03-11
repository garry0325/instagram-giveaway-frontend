<?php

$dynamoDBPath = "http://localhost:8088/followers/";

echo "<b>Follors of " . $_POST["username"] . ":</b>";
echo "<br><br>";

    $followersData = file_get_contents($dynamoDBPath . $_POST["userId"]);
    
    $followersJson = json_decode($followersData, false);

    for($i=0; $i<count($followersJson->followers); $i++) {
        echo $followersJson->followers[$i];
        echo "<br>";
    }

    $selectedFollower = file_get_contents($dynamoDBPath . $_POST["userId"] . "/pick");

    echo "<br>";
    echo "<b>Selected user:</b><br>";
    echo $selectedFollower;

?>
