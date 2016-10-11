<?php
// make a human-readable date for the response
$time      = date("g:i a \o\\n F j, Y", time());

if (!isset($_REQUEST['food_type']) || !isset($_REQUEST['taste'])) {
  header('HTTP/1.0 419 Invalid Submission');
  die("<li>At <strong>${time}</strong>: Whoa! Be more descriptive.</li>");
}

$food_type = strip_tags($_REQUEST['food_type']);
$taste     = strip_tags($_REQUEST['taste']);
?>
<li>At <strong><?= $time ?></strong>, I ate <strong><?= $taste ?> <?= $food_type ?></strong>.</li>