<?php

declare(strict_types = 1);

require __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use Tak\Liveproto\Utils\Helper;

var_dump(Helper::generateRandomLong());

$file = __DIR__.'/people.txt';

$current = "John Smith\n";

file_put_contents($file, $current);

?>
