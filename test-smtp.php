<?php

$ip = gethostbyname('smtp.gmail.com');

echo "IP: $ip\n";

$fp = @fsockopen($ip, 465, $errno, $errstr, 10);

if (!$fp) {
    echo "ERROR 465: $errno - $errstr\n";
} else {
    echo "SMTP OK 465\n";
    fclose($fp);
}

$fp = @fsockopen($ip, 587, $errno, $errstr, 10);

if (!$fp) {
    echo "ERROR 587: $errno - $errstr\n";
} else {
    echo "SMTP OK 587\n";
    fclose($fp);
}