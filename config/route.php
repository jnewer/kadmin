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
use app\controller\DictController;
use app\controller\RoleController;
use app\controller\UserController;
use app\controller\MediaController;
use app\controller\ConfigController;
use app\controller\AccountController;
use app\controller\LoginLogController;
use app\controller\OperationLogController;
use app\controller\PermissionController;

Route::group('/auth', function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group('/account', function () {
    Route::post('/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/update/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::post('/changePassword', [AccountController::class, 'changePassword'])->name('account.changePassword');
});

Route::group('/user', function () {
    Route::get('/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/view/{id}', [UserController::class, 'view'])->name('user.view');
    Route::post('/create', [UserController::class, 'create'])->name('user.create');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::patch('/status/{id}', [UserController::class, 'status'])->name('user.status');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

Route::group('/role', function () {
    Route::get('/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('/view/{id}', [RoleController::class, 'view'])->name('role.view');
    Route::post('/create', [RoleController::class, 'create'])->name('role.create');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('/options', [RoleController::class, 'options'])->name('role.options');
});

Route::group('/permission', function () {
    Route::get('/index', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/view/{id}', [PermissionController::class, 'view'])->name('permission.view');
    Route::post('/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::put('/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
    Route::get('/options', [PermissionController::class, 'options'])->name('permission.options');
});

Route::group('/media', function () {
    Route::get('/index', [MediaController::class, 'index'])->name('media.index');
    Route::get('/view/{id}', [MediaController::class, 'view'])->name('media.view');
    Route::post('/create', [MediaController::class, 'create'])->name('media.create');
    Route::put('/update/{id}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/delete/{id}', [MediaController::class, 'delete'])->name('media.delete');
});

Route::group('/dict', function () {
    Route::get('/index', [DictController::class, 'index'])->name('dict.index');
    Route::get('/items/{pid}', [DictController::class, 'items'])->name('dict.items');
    Route::get('/view/{id}', [DictController::class, 'view'])->name('dict.view');
    Route::post('/create', [DictController::class, 'create'])->name('dict.create');
    Route::put('/update/{id}', [DictController::class, 'update'])->name('dict.update');
    Route::put('/status/{id}', [DictController::class, 'status'])->name('dict.status');
    Route::delete('/delete/{id}', [DictController::class, 'delete'])->name('dict.delete');
    Route::get('/options/{value}', [DictController::class, 'options'])->name('dict.options');
});

Route::group('/config', function () {
    Route::get('/index', [ConfigController::class, 'index'])->name('config.index');
    Route::get('/view/{id}', [ConfigController::class, 'view'])->name('config.view');
    Route::post('/create', [ConfigController::class, 'create'])->name('config.create');
    Route::put('/update/{id}', [ConfigController::class, 'update'])->name('config.update');
    Route::delete('/delete/{id}', [ConfigController::class, 'delete'])->name('config.delete');
});

Route::group('/loginLog', function () {
    Route::get('/index', [LoginLogController::class, 'index'])->name('loginLog.index');
    Route::get('/view/{id}', [LoginLogController::class, 'view'])->name('loginLog.view');
});

Route::group('/operationLog', function () {
    Route::get('/index', [OperationLogController::class, 'index'])->name('operationLog.index');
    Route::get('/view/{id}', [OperationLogController::class, 'view'])->name('operationLog.view');
});
