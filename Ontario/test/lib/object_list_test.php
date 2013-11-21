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
		$ol1 = make_object_list();
		self::assertTrue(ObjectList::validate_object_list($ol1->get_list()));

		$array[] = new Range(1,2);
		$array[] = new Range(3,7);
		self::assertTrue(!ObjectList::validate_object_list($array));
	}

	public static function test_iterator() {
		$ol = make_object_list();
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

	public static function test_remove_element() {
		$object1 = new Object(1, 'YoObject');
		$object2 = new Object(2, 'YoObject2');
		$object3 = new Object(3, 'YoObject3');
		$ol = new ObjectList();
		$ol->add_element($object1);
		$ol->add_element($object2);

		$found = $ol->remove_element($object3);
		self::assertTrue(!$found);
		$found = $ol->remove_element($object1);
		self::assertTrue($found);

		$found = $ol->get_object($object1->get_id());
		self::assertTrue(is_null($found));

		$found = $ol->get_object($object2->get_id());
		self::assertTrue(!is_null($found));
	}

	public static function test_update_object() {
		$object1 = new Object(1, 'YoObject1', new Type(1, 'Block'));
		$object2 = new Object(2, 'YoObject2', new Type(1, 'Block'));
		$object3 = new Object(1, 'YoObject3', new Type(1, 'Block'));
		$object4 = new Object(1, 'YoObject4', new Type(2, 'Bla'));
		$ol = new ObjectList();
		$ol->add_element($object1);
		$ol->add_element($object2);
		self::assertTrue($ol->update_object($object3));
		self::assertTrue(!$ol->update_object($object4));
	}
}
