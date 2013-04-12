<?php
$conn = mysql_connect("localhost", "root", "m@rio");
if(!$conn)
{
    die('Could not connect:' .mysql_error());
}

mysql_close($conn)

?>