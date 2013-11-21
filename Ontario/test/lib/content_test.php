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
	public static function test_get_text() {
		$override = true;
		self::assertTrue(TestContent::init("content/test.log"), $override);
		echo "Getting\n";
		$text = TestContent::get_text('test_1', ['key_1' => 'result']);
		echo "Ending\n";
		self::assertTrue(strpos($text, 'result') !== FALSE);
		$text = TestContent::get_text('test_2', ['key_2' => 'magic']);
		self::assertTrue(strpos($text, 'magic') !== FALSE);
	}

	public static function test_count_content() {
		self::assertTrue(TestContent::init("content/test.log", true));
		self::assertEquals(TestContent::count_content('test_1'), 2);
		self::assertEquals(TestContent::count_content('test_2'), 2);
	}
}
