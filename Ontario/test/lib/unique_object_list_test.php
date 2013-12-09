<?
include_once("_include.php");

class UniqueObjectListTest extends PHPUNit_Framework_TestCase {
	public static function test_unique_object_list() {
		$obj = array();
		$obj[] = new Object(1, 'Obj1');
		$obj[] = new Object(2, 'Obj1');
		$obj[] = new Object(3, 'Obj1');
		$objectlist = new ObjectList($obj);
		$uol = new UniqueObjectList($type, $objectlist);
		self::assertTrue($uol instanceof UniqueObjectList);
	}


	public static function test_add_element() {
		$uol = new UniqueObjectList(new Object(1, 'Obj1'));
		self::assertTrue($uol instanceof UniqueObjectList);
		$uol->add_element(new Object(2, 'Obj2'));
		self::assertTrue($uol instanceof UniqueObjectList);
	}
}
