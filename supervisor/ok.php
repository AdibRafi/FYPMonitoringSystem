<?php

date_default_timezone_set('Asia/Singapore');

$start = new DateTime("2022-04-09 12:20:00");
$datetime_now = new DateTime();
if ($start < $datetime_now) {
    echo ("Invalid meeting time, please try again");
} else {
    echo ("Valid meeting time, please try again");
}
