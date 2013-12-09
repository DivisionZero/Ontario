<?
include_once("_include.php");

class TestContent extends Content {
	protected static function test_1() {
		return ['key_1'];
	}

	protected static function test_2() {
		return ['key_2'];
	}
}

class ContentTest extends PHPUNit_Framework_TestCase {
	private static $content;

	public static function setUpBeforeClass() {
		self::$content = new TestContent("content/test.log");
	}

	public static function test_get_text() {
		$text = self::$content->get_text('test_1', ['key_1' => 'result']);
		self::assertTrue(strpos($text, 'result') !== FALSE);
		$text = self::$content->get_text('test_2', ['key_2' => 'magic']);
		self::assertTrue(strpos($text, 'magic') !== FALSE);
	}

	public static function test_count_content() {
		self::assertEquals(self::$content->count_content('test_1'), 2);
		self::assertEquals(self::$content->count_content('test_2'), 2);
	}
}
