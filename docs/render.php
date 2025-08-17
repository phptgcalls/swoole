<?php

declare(strict_types = 1);

require __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use Tak\Liveproto\Tl\DocBuilder;

putenv('DOCPATH='.__DIR__);

$_ENV['DOCPATH'] = __DIR__;

DocBuilder::start();

?>
