<?php

/**
 * This file is called with a $app variable and you must configure the application.
 */

// MANDATORY: Configure database
$app->configureMysql('localhost:3306', 'behat_launcher', 'root', 'root');

// RECOMMENDED: Simple project creation
// $app->createProject('FMM', 'C:\MAMP\htdocs\Launcher');

// OPTIONAL: Advanced project configuration
 $app->createProject('FMM', 'C:\MAMP\htdocs\Launcher')
    ->setRunnerCount(3)           // Changes number of processes to run concurrently.
    ->setBehatBin('C:\MAMP\htdocs\Launcher\vendor\behat\behat\bin\behat');      // Path where behat is located

// Override behat.yml
//    ->createProperty('Browser')
//         ->setConfig('default.extensions.WebDriver\Behat\WebDriverExtension\Extension.browser')
//         ->setDefault('chrome')
//         ->setChoices(array('firefox' => 'Mozilla Firefox', 'chrome' => 'Google Chrome'))
//     ->endProperty();

//// Use specific behat.yml file
//// Use profile parameter
//// Use *.feature files filter based on specified tag
//$app->createProject('INT: [Smoke - Chrome]', '/var/www/bros')
//    ->setBehatYmlFile('behat_Chrome.yml')
//    // behat --profile int
//    ->setProfile('int')
//    ->setTags('@smoke')
//    // filter .feature files that contain @smoke tag
//    // (otherwise behat raises error that no scenario was found)
//    ->setFileFilter('@smoke')
//    ->setFeaturesPath('features/all');