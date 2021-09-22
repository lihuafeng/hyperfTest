<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST', 'HEAD'], '/breaker', 'App\Controller\IndexController@breaker');
Router::addRoute(['GET', 'POST', 'HEAD'], '/sleep', 'App\Controller\IndexController@sleep');

Router::addRoute(['GET', 'POST', 'HEAD'], '/cacheClear', 'App\Controller\IndexController@clearCache');
Router::addRoute(['GET', 'POST', 'HEAD'], '/cacheTest', 'App\Controller\IndexController@cacheTest');


Router::addRoute(['GET', 'POST', 'HEAD'], '/user_save', 'App\Controller\UserController@userSave');
Router::addRoute(['GET', 'POST', 'HEAD'], '/get_all_user', 'App\Controller\UserController@getAllUser');

Router::get('/favicon.ico', function () {
    return '';
});
