<?php

// API Docs
$app->get('/docs', 'RabbleRouser\ApiAutoDoc\Http\Controllers\DocumentationController@index');
$app->get('docs/{resource_name}', 'RabbleRouser\ApiAutoDoc\Http\Controllers\DocumentationController@show');