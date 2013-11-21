<?
include_once("_include.php");

class UniqueObjectListTest extends PHPUNit_Framework_TestCase {
	public static function test_unique_object_list() {
		$type = new Type(1, 'Unique');
		$obj = array();
		$obj[] = new Object(1, 'Obj1', $type);
		$obj[] = new Object(2, 'Obj1', $type);
		$obj[] = new Object(3, 'Obj1', $type);
		$objectlist = new ObjectList($obj);
		$uol = new UniqueObjectList($objectlist);
		self::assertTrue($uol instanceof UniqueObjectList);
	}


	public static function test_add_element() {
		$type = new Type(1, 'Unique');
		$uol = new UniqueObjectList(new Object(1, 'Obj1', $type));
		self::assertTrue($uol instanceof UniqueObjectList);
		$uol->add_element(new Object(2, 'Obj2', $type));
		self::assertTrue($uol instanceof UniqueObjectList);
	}
}
