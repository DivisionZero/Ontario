<?
include_once("_include.php");

class ObjectTest extends PHPUNit_Framework_TestCase {
	public static function test_object() {
		$obj = new Object(1, 'Test');
		self::assertTrue($obj instanceof Object);
		self::assertEquals($obj->get_id(), 1);
		self::assertEquals($obj->get_name(), 'Test');

		$obj2 = new Object(null, 'bla');
		self::assertTrue($obj2 instanceof Object);
		self::assertEquals($obj2->get_id(), 2);
		self::assertEquals($obj2->get_name(), "bla"); 

		$obj3 = new Object(null, 'bla');
		self::assertTrue($obj3 instanceof Object);
		self::assertEquals($obj3->get_id(), 3);
		self::assertEquals($obj3->get_name(), "bla"); 
	}
}
