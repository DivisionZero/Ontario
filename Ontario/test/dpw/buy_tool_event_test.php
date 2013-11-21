<?
include_once("_include.php");

class BuyToolEventTest extends PHPUNit_Framework_TestCase {
	private static $location;
	private static $player;
	private static $event;
	private static $tool;

	public static function setUpBeforeClass() {
		self::$location = new Location(1,'San Francisco', false);
		self::$location->add_product_list(make_product_list());
		self::$player = make_player();
		self::$tool = new Tool(1, 'Gun');
		self::$player->change_money(self::$tool->get_price());
		self::$event = new BuyToolEvent(make_rarity(), self::$tool);
	}

	public static function test_event() {
		self::assertTrue(self::$event->handle_event(self::$location, self::$player)->passed());
		self::assertTrue(strlen(self::$event->get_current_message()) > 0);
	}

	public static function test_event_response() {
		$response = 'yes';
		self::assertTrue(!self::$player->has_tool());
		self::assertTrue(self::$event->handle_event_response(self::$player, $response)->passed());
		self::assertTrue(self::$player->has_tool());

		$player = make_player();
		$player->add_money(-1 * $player->get_money());
		$player->change_money(self::$tool->get_price());
		self::assertTrue(!$player->has_tool());
		self::assertTrue(self::$event->handle_event_response(self::$player, $response)->failed());
		self::assertTrue(!$player->has_tool());
	}
}
