<?php

/**
 * Loading this file makes all vendors and the service container available.
 */

// Register all vendors.
require_once __DIR__ . '/vendor/autoload.php';

/*
 * Available application environments (pulled from $_ENV['MWP_ENV']):
 *  - prod
 *  - dev
 *  - test
 *
 * Defaults to 'prod'.
 *
 * This allows us to use load different configurations depending on the environment.
 * For instance, use mock database in 'test' environment, or lazily rebuild the
 * service container on every request in 'dev' environment.
 */

$appEnv = getenv('MWP_ENV');

if (!in_array($appEnv, array('prod', 'dev', 'test'))) {
    $appEnv = 'prod';
}

/**
 * Since container is built after composer installation/update, we can count on
 * it right away, and don't need to load the container builder. Development mode
 * is an exception, since files can be modified then.
 */
if ($appEnv === 'dev') {
    \MWP\ScriptHandler::refreshContainer();
}

require_once __DIR__ . '/cache/container.php';

/*
 * At this point we can instantiate MWPContainer and pull services from it.
 * The constructor can be defined in \MWP\Container.
 */
