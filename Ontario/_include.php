<?
spl_autoload_register(function ($class) {
	include __DIR__."/library/{$class}.php";
});
/*
require_once(__DIR__."/../library/Object.php");
require_once(__DIR__."/../library/Type.php");
require_once(__DIR__."/../library/Valid.php");
require_once(__DIR__."/../library/Range.php");
require_once(__DIR__."/../library/ObjectList.php");
require_once(__DIR__."/../library/Error.php");
require_once(__DIR__."/../library/TypeObjectList.php");
require_once(__DIR__."/../library/RangeObject.php");
 */
