<?php


spl_autoload_register(function ($class) {    // Adapt this depending on your directory structure
    $parts = explode('\\', $class);

    include join('/', $parts) . '.php';
});


//spl_autoload_register(function ($class_name) {
////    include 'exceptions/' . $class_name . '.php';
//    include $class_name . '.php';
//});

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
