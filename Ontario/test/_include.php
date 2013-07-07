<?
spl_autoload_register(function ($class) {
	include __DIR__."/../library/{$class}.php";
});
