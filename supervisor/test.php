<?php

require ("../src/functions.php");
require ("../src/database.php");

$meeting_id = getMeetingID($con);

echo $meeting_id;