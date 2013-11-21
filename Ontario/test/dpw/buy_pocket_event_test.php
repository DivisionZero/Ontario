<?
include_once("_include.php");

class BuyPocketEventTest extends PHPUNit_Framework_TestCase {
	private static $location;
	private static $player;
	private static $event;

	public static function setUpBeforeClass() {
		self::$location = new Location(1,'San Francisco', false);
		self::$location->add_product_list(make_product_list());
		self::$player = make_player();
		self::$event = new BuyPocketEvent(make_rarity());
	}

	public static function test_event() {
		self::assertTrue(self::$event->handle_event(self::$location, self::$player)->passed());
		self::assertTrue(strlen(self::$event->get_current_message()) > 0);
	}

	public static function test_event_response() {
		$response = 'no';
		$first_count = self::$player->pockets->get_pocket_count();
		self::assertTrue(self::$event->handle_event_response(self::$player, $response)->passed());
		$second_count = self::$player->pockets->get_pocket_count();
		self::assertEquals($first_count, $second_count);
		$response = 'yes';
		self::assertTrue(self::$event->handle_event_response(self::$player, $response)->passed());
		$third_count = self::$player->pockets->get_pocket_count();
		self::assertEquals($first_count + BuyPocketEvent::DEFAULT_POCKET_SIZE, $third_count);
	}
}
