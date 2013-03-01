<?php

require_once __DIR__ . '/container_builder.php';

if (PHP_SAPI === 'cli') {
    // This action will rebuild the container if the cache is not fresh.
    get_new_container(true);
}
