<?
include_once("_include.php");

class RangeTest extends PHPUNit_Framework_TestCase {
	public static function test_move_middle() {
		$r1 = new Range(1,100, 23);
		$r2 = new Range(50,75);

		self::assertEquals(23, $r1->get_middle());
		self::assertEquals(63, $r2->get_middle());

		$r1->move_middle(12);
		self::assertEquals(12, $r1->get_middle());
		$r2->move_middle(62);
		self::assertEquals(62, $r2->get_middle());
	}

	public static function test_create_middle() {
		$middle = Range::create_middle(1, 50, Range::CEIL);
		self::assertEquals($middle, 26);
		$middle1 = Range::create_middle(1, 50, Range::FLOOR);
		self::assertEquals($middle1, 25);
		$middle2 = Range::create_middle(1, 50, Range::FLOAT);
		self::assertEquals($middle2, 25.5);

		$r1 = new Range(1, 50, $middle1);
		self::assertEquals(25, $r1->get_middle());
	}
}
