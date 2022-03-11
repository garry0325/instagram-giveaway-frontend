<?php

$dynamoDBPath = "http://localhost:8088/comments/";


    $commenters = file_get_contents($dynamoDBPath . "post-id/" . $_POST["postId"]);
    $commentersJson = json_decode($commenters, false);

    echo count($commentersJson);
    echo " commenters:";
    echo "<br><br>";

    for($i=0; $i<count($commentersJson); $i++) {
        $link = "<a href=\"http://instagram.com/" . $commentersJson[$i]->accountName . "\">";
        echo $link;
        echo $commentersJson[$i]->accountName;
        echo "</a>";
        echo "<br>";
    }

    $selectedCommenter = file_get_contents($dynamoDBPath . "post-id/" . $_POST["postId"] . "/pick");
    $selectedCommenterJson = json_decode($selectedCommenter, false);

    echo "<br>";
    echo "<b>Selected user:</b><br>";
    echo $selectedCommenterJson->accountName;

?>
