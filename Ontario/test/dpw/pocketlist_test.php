<?
include_once("_include.php");

class PocketListTest extends PHPUNit_Framework_TestCase {
	public static function test_add_pockets() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue(!$pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_pockets(-50));
	}

	public static function test_add_product() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_product(make_product(1, 'Diamond'), 50));
		self::assertTrue($pocketlist->add_product(make_product(2, 'Pearls'), 40));
		self::assertTrue(!$pocketlist->add_product(make_product(3, 'Sapphires'), 50));
		self::assertTrue($pocketlist->add_product(make_product(1, 'Diamond'), 5));
		self::assertTrue($pocketlist->add_pockets(50));
		self::assertTrue($pocketlist->add_product(make_product(3, 'Sapphires'), 50));
	}

	public static function test_remove_product() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue($pocketlist->add_product(make_product(2, 'Pearls'), 5));
		self::assertTrue(!$pocketlist->remove_product(make_product(2, 'Pearls'), 10));
		self::assertTrue(!$pocketlist->remove_product(make_product(1, 'Diamonds'), 5));
	}

	public static function test_get_product_count() {
		$pocketlist = new PocketList(make_product_list());
		$product = make_product(2, 'Pearls');
		self::assertTrue($pocketlist->get_product_count($product) === 0);
		$pocketlist->add_product($product, 5);
		self::assertTrue($pocketlist->get_product_count($product) === 5);
	}

	public static function test_get_random_product() {
		$pocketlist = new PocketList(make_product_list());
		self::assertTrue(is_null($pocketlist->get_random_product()));
		$product = make_product(2, 'Pearls');
		$pocketlist->add_product($product, 5);
		$product = make_product(3, 'Rubies');
		$pocketlist->add_product($product, 5);
		self::assertTrue($pocketlist->get_random_product() instanceof Product);
	}
}
