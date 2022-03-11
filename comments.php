<html>
    <head>
        <script src="src/cDg-min.js"></script>
    </head>
    <body>
<?php
// https://stackoverflow.com/questions/67279678/instagram-web-api-get-err-blocked-by-response/67293454#67293454

//    echo $_GET["post"];
//    echo "<br>";
//    echo "<br>";

    $commentsStorePath = "";
    $commentsPythonPath = "getComments.py ";
    $dynamoDBPath = "http://localhost:8088/comments/";
    
    $command = "python3 " . $commentsStorePath . $commentsPythonPath . $_GET["username"] . " " . $_GET["password"] . " " . $_GET["post"];
//    echo $command;

$output=null;
$retval=null;
exec($command, $output, $retval);
//echo "Returned with status $retval and output:\n";
//print_r($output);

    $commenters = file_get_contents($dynamoDBPath . "post-id/" . $_GET["post"]);
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

    echo "<br>";
//    echo $commentersJson;
//    echo "<br>";
//    echo $commentersJson->commenters;

?>

<form method="post" action="chooseCommenter.php">
    <input type="hidden" name="username" value=<?php echo $_GET["username"]; ?> >
    <input type="hidden" name="postId" value=<?php echo $_GET["post"]; ?> >
    <input type="submit" value="Pick a user">
</form>


    </body>
</html>
