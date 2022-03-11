<html>
    <head>
        <script src="src/cDg-min.js"></script>
    </head>
    <body>
<?php
// https://stackoverflow.com/questions/67279678/instagram-web-api-get-err-blocked-by-response/67293454#67293454

    $dynamoDBPath = "http://localhost:8088/posts/";

    $postData = file_get_contents($dynamoDBPath . "account-id/" . $_POST["userId"]);
    $postJson = json_decode($postData, false);
    
    for($i=0; $i<count($postJson); $i++) {
        $imgUrl = $postJson[$i]->postURL;
        $imgUrl = "<img id=\"image" . $i . "\" src=\"" . $imgUrl . "\" width=200 height=200>";
        echo "<a href=\"comments.php?post=" . $postJson[$i]->postId . "&username=" . $_POST["username"] . "&password=" . $_POST["password"] . "\">" . $imgUrl . "</a> ";
    }
    echo "<script>";
    
    for($i=0; $i<count($postJson); $i++) {
        echo "let newUri" . $i . " = new cDg(\"image" . $i . "\").view();\n";
    }
    echo "</script>";

?>
    </body>
</html>
