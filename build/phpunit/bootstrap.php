<?php

/**
 * @author      pfroch <info@easySolutionsIT.de>
 * @link        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 * @version     1.0.0
 * @since       21.07.22 - 09:54
 */

declare(strict_types=1);

 if (!defined('__DIR__') || empty(__DIR__)) {
     define('__DIR__', realpath(__FILE__));
 }

$buildDir       = __DIR__ . '/..';
$rootDir        = __DIR__ . '/../..';
$testCase       = __DIR__ . '/EsitTestCase.php';

 if (substr_count(__DIR__, '/src/Esit/')) {
     $arrPaths = explode('/src/Esit/', __DIR__);
 } elseif (substr_count(__DIR__, '/vendor/')) {
     $arrPaths = explode('/vendor/', __DIR__);
 } else {
     $arrPaths = explode('/build/phpunit', __DIR__);
 }

 if (is_array($arrPaths)) {
     define('PROJECT_ROOT', $arrPaths[0]);
 } else {
     define('PROJECT_ROOT', '');
 }

$globalComposerAutoloadPath = PROJECT_ROOT . '/vendor/autoload.php';
$autoloadFound              = false;

 if (is_file($globalComposerAutoloadPath)) {
     // Globalen Composer Autoload einbinden
     include_once($globalComposerAutoloadPath);
     $autoloadFound = true;
 }

 if (false === $autoloadFound) {
     throw new \Exception("No autoload found");
 }

if (is_file($testCase)) {
    include_once($testCase);
} else {
    throw new \Exception('Testcase is missing: ' . $testCase);
}
