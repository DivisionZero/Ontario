<?
include_once("_include.php");

class DefaultListClassTest extends DefaultList {
	public function __construct($default = null) {
		parent::__construct($default);
	}

	public function add_default($default) {
		return parent::add_default($default);
	}

	public function add_defaults($defaults) {
		return parent::add_defaults($defaults);
	}

	public function set_value($key, $value) {
		return parent::set_value($key, $value);
	}

	public function get_value($key) {
		return parent::get_value($key);
	}

	public function has_default($default) {
		return parent::has_default($default);
	}

	public function add_default_by_pair($key, $value) {
		return parent::add_default_by_pair($key, $value);
	}
}

class DefaultListTest extends PHPUNit_Framework_TestCase {
	public static function test_construct() {
		$list = new DefaultListClassTest();
		self::assertTrue($list instanceof DefaultList);
		$list = new DefaultListClassTest(new DefaultField('key', 'value'));
		self::assertTrue($list instanceof DefaultList);
		$list = new DefaultListClassTest($list);
		self::assertTrue($list instanceof DefaultList);
		$list = new DefaultListClassTest(array(['key'=>'value']));
		self::assertTrue($list instanceof DefaultList);
	}

	public static function test_add_default() {
		$default = new DefaultField('key', 'value', 'bla');
		$list = new DefaultListClassTest();
		$list->add_default($default);
		self::assertTrue($list->has_default($default));
	}

	public static function test_add_default_by_pair() {
		$list = new DefaultListClassTest();
		$list->add_default_by_pair('key', 'value');
		self::assertTrue($list->has_default('key'));
	}

	public static function test_add_defaults() {
		$default1 = new DefaultField('key1', 'value', 'bla');
		$default2 = new DefaultField('key2', 'value', 'bla');
		$list1 = new DefaultListClassTest();
		$list1->add_default($default1);
		$list1->add_default($default2);
		$list2 = new DefaultListClassTest();
		$list2->add_defaults($list1);
		self::assertTrue($list2->has_default('key1'));

		$values = array(
			'key1' => 'value',
			'key2' => 'value',
		);
		$list3 = new DefaultListClassTest();
		$list3->add_defaults($values);
		self::assertTrue($list3->has_default('key1'));
	}

	public static function test_has_default() {
		$default1 = new DefaultField('key1', 'value', 'bla');
		$list1 = new DefaultListClassTest($default1);
		self::assertTrue($list1->has_default($default1));
		self::assertTrue($list1->has_default($default1->get_key()));
	}

	public static function test_set_value() {
		$default1 = new DefaultField('key1', 'value', 'bla');
		$list1 = new DefaultListClassTest($default1);
		$list1->set_value('key1', 'changed');
		self::assertEquals($list1->get_value('key1'), 'changed');
	}
}
