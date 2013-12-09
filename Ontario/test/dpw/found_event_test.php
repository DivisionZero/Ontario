<?
include_once("_include.php");

class FoundEventTest extends PHPUNit_Framework_TestCase {
	private static $location;
	private static $player;
	private static $event;

	public static function setUpBeforeClass() {
		self::$location = new Location(1,'San Francisco', false);
		self::$location->add_product_list(make_product_list());
		self::$player = make_player();
		self::$event = new FoundEvent(make_rarity(), make_range());
	}

	public static function test_event() {
		$product = self::$event->handle_event(self::$location, self::$player);
		self::assertTrue($product instanceof Product);
		$count = self::$player->pockets->get_product_count($product);
		self::assertTrue($count > 0);
	}
}
