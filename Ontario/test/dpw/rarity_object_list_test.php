<?
include_once("_include.php");

class RarityObjectListTest extends PHPUNit_Framework_TestCase {
	public static function test_get_random_objects() {
		$type = new Type(1, 'Unique');
		$ro = new RarityObjectList($type);
		$ro->add_element(new RarityObject(1, 'RO1', $type, make_rarity(), true));
		$ro->add_element(new RarityObject(2, 'RO2', $type, make_rarity(), false));
		$ro->add_element(new RarityObject(3, 'RO3', $type, make_rarity(), true));
		$ro->add_element(new RarityObject(4, 'RO4', $type, make_rarity(), true));
		$ro->add_element(new RarityObject(5, 'RO5', $type, make_rarity(), false));

		$return = $ro->get_random_object();
		self::assertTrue($return instanceof Object);
		$return = $ro->get_random_objects(5);
		self::assertTrue($return->count() == 5);
		$return = $ro->get_random_objects(3);
		self::assertTrue($return->count() == 3);
		$return = $ro->get_random_objects(1);
		self::assertTrue($return->count() == 1);

		$ro2 = new RarityObjectList($type);
		$ro2->add_element(new RarityObject(1, 'RO1', $type, make_rarity(), false));
		$ro2->add_element(new RarityObject(2, 'RO2', $type, make_rarity(), false));
		$return = $ro2->get_random_objects(3);
		self::assertTrue($return->count() == 3);
	}
}
