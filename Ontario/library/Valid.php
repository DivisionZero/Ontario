<?
class Valid {
	public static function id($id) {
		return (self::integer($id) && $id > 0);
	}

	public static function integer($integer) {
		return is_numeric($integer) ? intval($integer) == $integer : false;
	}

	public static function zero($value) {
		return $value === 0 || $value === '0';
	}

	public static function higher($high, $low) {
		if(is_numeric($high) && is_numeric($low)) {
			return $high > $low;
		} else {
			return false;
		}
	}

	public static function percent($percent) {
		if(!is_numeric($percent)) {
			return false;
		}
		if($percent < 0 || $percent > 1) {
			return false;
		}
		return true;
	}

	public static function positive_int($value) {
		if(Valid::integer($value) && $value >= 0) {
			return true;
		} else {
			return false;
		}
	}
}
