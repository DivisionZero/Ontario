<?
include_once("_include.php");

class ObjectListTest extends PHPUNit_Framework_TestCase {
	public static function test_object_list() {
		$ol1 = new ObjectList();
		self::assertEquals($ol1->current(), null);
		$ol2 = new ObjectList($ol1);
		self::assertEquals($ol1->current(), null);
		$ol3 = new ObjectList(null);
		self::assertEquals($ol1->current(), null);

		$object = new Object(1, 'YoObject');
		$ol4 = new ObjectList($object);
		self::assertEquals('YoObject', $ol4->current()->get_name());
	}

	public static function test_validate_object_list() {
		$ol1 = self::make_object_list();
		self::assertTrue(ObjectList::validate_object_list($ol1->get_list()));

		$array[] = new Range(1,2);
		$array[] = new Range(3,7);
		self::assertTrue(!ObjectList::validate_object_list($array));
	}

	public static function test_iterator() {
		$ol = self::make_object_list();
		self::assertEquals($ol->current()->get_id(), 1);
		self::assertEquals(0, $ol->key());
		$ol->next();
		self::assertEquals($ol->current()->get_id(), 2);
		$ol->rewind();
		self::assertEquals($ol->current()->get_id(), 1);
		self::assertTrue($ol->valid());
		$ol->next();
		$ol->next();
		self::assertTrue(!$ol->valid());

		$ol1 = new ObjectList();
		self::assertTrue(!$ol1->valid());
	}

	private static function make_object_list() {
		$ol = new ObjectList();
		$ol->add_element(new Object(1, 'Object1'));
		$ol->add_element(new Object(2, 'Object2'));
		return $ol;
	}
}
