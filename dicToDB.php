<?php

$json = json_decode(file_get_contents("./misc/dic.json"), true);

echo "<pre>";
print_r($json);
echo "</pre>";
