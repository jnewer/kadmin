<?php

/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;
use app\controller\AuthController;
use app\controller\RoleController;
use app\controller\AdminController;
use app\controller\MediaController;
use app\controller\OptionController;
use app\controller\AccountController;
use app\controller\PermissionController;

Route::group('/auth', function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group('/account', function () {
    Route::post('/profile', [AccountController::class, 'profile']);
    Route::post('/update/{id}', [AccountController::class, 'update']);
    Route::post('/changePassword', [AccountController::class, 'changePassword']);
});

Route::group('/admin', function () {
    Route::get('/index', [AdminController::class, 'index']);
    Route::get('/view/{id}', [AdminController::class, 'view']);
    Route::post('/create', [AdminController::class, 'create']);
    Route::put('/update/{id}', [AdminController::class, 'update']);
    Route::patch('/status/{id}', [AdminController::class, 'status']);
    Route::delete('/delete/{id}', [AdminController::class, 'delete']);
});

Route::group('/role', function () {
    Route::get('/tree', [RoleController::class, 'tree']);
    Route::get('/view/{id}', [RoleController::class, 'view']);
    Route::post('/create', [RoleController::class, 'create']);
    Route::put('/update/{id}', [RoleController::class, 'update']);
    Route::delete('/delete/{id}', [RoleController::class, 'delete']);
});

Route::group('/permission', function () {
    Route::get('/tree', [PermissionController::class, 'tree']);
    Route::get('/view/{id}', [PermissionController::class, 'view']);
    Route::post('/create', [PermissionController::class, 'create']);
    Route::put('/update/{id}', [PermissionController::class, 'update']);
    Route::delete('/delete/{id}', [PermissionController::class, 'delete']);
});

Route::group('/option', function () {
    Route::get('/index', [OptionController::class, 'index']);
    Route::get('/view/{id}', [OptionController::class, 'view']);
    Route::post('/create', [OptionController::class, 'create']);
    Route::put('/update/{id}', [OptionController::class, 'update']);
    Route::delete('/delete/{id}', [OptionController::class, 'delete']);
});

Route::group('/media', function () {
    Route::get('/index', [MediaController::class, 'index']);
    Route::get('/view/{id}', [MediaController::class, 'view']);
    Route::post('/create', [MediaController::class, 'create']);
    Route::put('/update/{id}', [MediaController::class, 'update']);
    Route::delete('/delete/{id}', [MediaController::class, 'delete']);
});
