#!/usr/bin/env php
<?php

require_once __DIR__.'/bootstrap.php.cache';
require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;

$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'), getenv('SYMFONY_ENV') ?: 'dev');
$debug = !$input->hasParameterOption(array('--no-debug', ''));

$kernel = new AppKernel($env, $debug);
$application = new Application($kernel);
$application->run();