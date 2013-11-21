<?
include_once("_include.php");

class ValidTest extends PHPUNit_Framework_TestCase {
	public static function test_id() {
		self::assertTrue(Valid::id(1));
		self::assertTrue(!Valid::id(-1));
		self::assertTrue(!Valid::id(1.1));
		self::assertTrue(!Valid::id('hello'));
	}

	public static function test_integer() {
		self::assertTrue(Valid::integer(1));
		self::assertTrue(Valid::integer(-1));
		self::assertTrue(!Valid::integer(1.1));
		self::assertTrue(!Valid::integer('hello'));
	}

	public static function test_zero() {
		self::assertTrue(Valid::zero(0));
		self::assertTrue(Valid::zero('0'));
		self::assertTrue(!Valid::zero(''));
		self::assertTrue(!Valid::zero(1));
	}

	public static function test_higher() {
		self::assertTrue(Valid::higher(1,0));
		self::assertTrue(!Valid::higher(1,1));
		self::assertTrue(!Valid::higher(0,1));
		self::assertTrue(!Valid::higher(1,'two'));
	}

	public static function test_percent() {
		self::assertTrue(Valid::percent(0));
		self::assertTrue(Valid::percent('1'));
		self::assertTrue(Valid::percent(.25));
		self::assertTrue(!Valid::percent(1.25));
		self::assertTrue(!Valid::percent('x'));
	}
}
