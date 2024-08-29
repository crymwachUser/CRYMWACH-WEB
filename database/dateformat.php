<?php
// Create a new DateTime object
$date = new DateTime();

// Set the timezone to Philippines
$date->setTimezone(new DateTimeZone('Asia/Manila'));

// Format the date
$formattedDate = $date->format('d/m/Y');
$formattedTime = $date->format('H:i:s a');

?>
