<?
include_once("_include.php");

class LoseEventTest extends PHPUNit_Framework_TestCase {
	private static $location;
	private static $player;
	private static $event;

	public static function setUpBeforeClass() {
		self::$location = new Location(1,'San Francisco', false);
		self::$location->add_product_list(make_product_list());
		self::$player = make_player();
		self::$event = new LoseEvent(make_rarity(), make_range());
	}

	public static function test_event() {
		$product = self::$event->handle_event(self::$location, self::$player);
		self::assertTrue(!$product);
		self::$player->pockets->add_product(make_product(2, 'Diamonds'), 5);
		$product = self::$event->handle_event(self::$location, self::$player);
		self::assertTrue($product instanceof Product);	
	}
}
