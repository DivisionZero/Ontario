<?
include_once("_include.php");

class SpikeTest extends PHPUNit_Framework_TestCase {
	public static function test_get_spike() {
		$sp1 = new Spike(10, 0.2);
		self::assertTrue(is_numeric($sp1->get_spike()));
		$sp2 = new Spike(0.234, 23.34);
		self::assertTrue(is_numeric($sp1->get_spike()));
	}
}
