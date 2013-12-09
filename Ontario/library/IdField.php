<?
class IdField extends IntegerField {

	parent::__construct($key, $label = null, $default = null) {
		parent::__construct($key, $label, $default, 1);
	}
}
