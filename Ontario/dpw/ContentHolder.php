<?
class ContentHolder {
	public static $content;

	public static function init($filename) {
		self::$content = new DPWContent($filename);
	}
}
