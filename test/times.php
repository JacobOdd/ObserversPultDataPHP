<?php

date_default_timezone_set('Europe/Kiev');

$timestamp = time() + 60*10; // + 10 minutes

$time = date('Y-m-d,H:i', $timestamp);

echo $time;

