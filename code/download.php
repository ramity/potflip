<?php
$jsonString = file_get_contents("https://rsbuddy.com/exchange/summary.json");
file_put_contents("summary.json", $jsonString);
