<?
include_once("_include.php");

class ObjectTest extends PHPUNit_Framework_TestCase {
	public static function test_object() {
		$type = new Type(1, 'Type');
		$obj = new Object(1, 'Test', $type, 'This is an object');
		self::assertTrue($type instanceof Type);
		self::assertTrue($obj instanceof Object);
		self::assertEquals($obj->get_id(), 1);
		self::assertEquals($obj->get_name(), 'Test');
		self::assertEquals($obj->get_desc(), 'This is an object');

		$obj2 = new Object(null, null, $type);
		self::assertTrue($obj2 instanceof Object);
		self::assertEquals($obj2->get_id(), 1);
		self::assertEquals($obj2->get_name(), "1:Type"); 
		self::assertEquals($obj2->get_desc(), ""); 

		$obj3 = new Object();
		self::assertTrue($obj3 instanceof Object);
		self::assertEquals($obj3->get_id(), 2);
		self::assertEquals($obj3->get_name(), ""); 
		self::assertEquals($obj3->get_desc(), ""); 
	}
}
