<?php
session_start();
echo "<p><b>Guessing Game</b></p>";

echo "<p style=\"color: blue;\">The hidden number was: ". $_SESSION["gnum"]. "</p>";

echo "<p><a href=\"startover.php\">Start Over</a></p>"

?>