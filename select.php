<?php
ob_implicit_flush(true);
ob_end_flush();

        echo "Hello, " . $_POST["username"];
        echo "<br>";
//      echo $_POST["password"];
        echo "<br>";
        echo "<br>";

$userInfoStorePath = "";
$userInfoPythonPath = "getUserInfo.py ";
$dynamoDBPath = "http://localhost:8088/followers/";

$command = "python3 " . $userInfoStorePath . $userInfoPythonPath . $_POST["username"] . " " . $_POST["password"];

$output=null;
$retval=null;
exec($command, $output, $retval);
//echo "Returned with status $retval and output:\n";
//print_r($output);
$userId = $output[count($output) - 1]
?>

<form method="post" action="followers.php">
    <input type="hidden" name="username" value=<?php echo $_POST["username"]; ?> >
    <input type="hidden" name="password" value=<?php echo $_POST["password"]; ?> >
    <input type="hidden" name="userId" value=<?php echo $userId; ?> >
    <input type="submit" value="Followers">
</form>

<form method="post" action="posts.php">
    <input type="hidden" name="username" value=<?php echo $_POST["username"]; ?> >
    <input type="hidden" name="password" value=<?php echo $_POST["password"]; ?> >
    <input type="hidden" name="userId" value=<?php echo $userId; ?> >
    <input type="submit" value="Posts">
</form>
