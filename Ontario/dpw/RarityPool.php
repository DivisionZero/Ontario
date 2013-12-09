<?
class RarityPool extends TypeObjectList {
	private $probability_sum;
	private $sum_list;

	public function __construct($anything = null) {
		parent::__construct($anything, Rarity::get_object_type());
		$this->add_default('precision', Rarity::DEFAULT_PRECISION);
		$this->update_pool();
	}

	public function choose_rarity_index() {
		return $this->get_rarity(true);
	}

	public function choose_rarity() {
		return $this->get_rarity(false);
	}

	public function add_element(Rarity $rarity) {
		parent::add_element($rarity);
		$this->add_rarity($rarity);
	}

	public function remove_element(Rarity $rarity) {
		parent::remove_element($rarity);
		$this->update_pool();
	}

	private function update_pool() {
		$this->probability_sum = 0;
		$this->sum_list = array();
		foreach($this->list as $rarity) {
			$this->add_rarity($rarity);
		}
	}

	private function add_rarity(Rarity $rarity) {
		$probability = $rarity->get_probability();
		$this->probability_sum += $probability;
		$this->sum_list[] = $this->probability_sum;
	}

	private function get_rarity($return_index = true) {
		$precision = pow(10, $this->get_value('precision'));
		$sum = $this->probability_sum * $precision;
		$random = rand(1, $sum);
		$random /= $precision;
		foreach($this->sum_list as $target => $prob_sum) {
			if($random < $prob_sum) {
				if($return_index) {
					return $target;
				} else { 
					return $this->get_object_by_index($target);
				}
			}
		}
		return null;
	}
}
