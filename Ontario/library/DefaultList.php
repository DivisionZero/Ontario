<?
class DefaultList {
	private $list;

	public function __construct($defaults = null) {
		if (is_null($defaults)) {
			$this->list = array();
		} else if ($defaults instanceof DefaultField) {
			$this->add_default($defaults);
		} else if ($defaults instanceof DefaultList) {
			$this->add_defaults($defaults);
		} else if (is_array($defaults)) {
			$this->add_defaults($defaults);
		} else {
			throw new Exception("Improper Default Type");
		}
	}

	protected function add_default(DefaultField $default) {
		if (!$this->has_default($default)) {
			$this->list[$default->get_key()] = $default;
		} else {
			throw new Exception("Default Field already exists!");
		}
	}

	protected function add_default_by_pair($key, $value) {
		$default = new DefaultField($key, $value, null);
		$this->add_default($default);
	}

	protected function add_defaults($defaults) {
		if ($defaults instanceof DefaultList) {
			foreach ($defaults->get_default_list() as $key => $default) {
				$this->add_default($default);
			}
		} else if (is_array($defaults)) {
			foreach ($defaults as $key => $value) {
				$this->add_default_by_pair($key, $value);
			}
		} else {
			throw new Exception("Improper Default Type");
		}
	}

	protected function has_default($default) {
		if ($default instanceof DefaultField) {
			$default = $default->get_key();
		}
		return isset($this->list[$default]);
	}

	protected function get_default_list() {
		return $this->list;
	}

	protected function set_value($key, $current) {
		if ($this->has_default($key)) {
			$this->list[$key]->set_current($current);
		} else {
			throw new Exception("Key {$key} does not exist");
		}
	}

	protected function get_value($key) {
		if ($this->has_default($key)) {
			return $this->list[$key]->get_value();
		} else {
			throw new Exception("Key {$key} does not exist");
		}
	}

	public function reset_default($key, $default_value) {
		if ($this->has_default($key)) {
			$this->list[$key]->reset_default($default_value);
		} else {
			throw new Exception("Key {$key} does not exist");
		}
	}
}
