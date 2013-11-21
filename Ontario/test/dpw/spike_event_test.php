<?
include_once("_include.php");

class SpikeEventTest extends PHPUNit_Framework_TestCase {
	public static function test_event() {
		$event = new SpikeEvent(make_rarity(), make_rarity(), make_rarity());
		$location = new Location(1,'San Francisco', false);
		$location->add_product_list(make_product_list());

		$product = $event->handle_event($location, make_player());
		self::assertTrue($product->data() instanceof Product);
		self::assertTrue(strlen($event->get_current_message()) > 0);
	}

}
