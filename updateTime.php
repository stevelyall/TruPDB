<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

echo "retry: 1000\n";  // 1000 msec

$count = 0;
while (true) {
    echo "event: updateTime\n";

    $time = date('F n, Y g:i:s A');
    echo "data: $time \n\n";
    ob_flush();
    flush();

    sleep(1);  // every second
}
