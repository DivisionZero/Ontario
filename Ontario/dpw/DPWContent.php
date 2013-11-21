<?
class DPWContent extends Content {
	protected function spike_high() {
		return ['product'];
	}

	protected function spike_low() {
		return ['product'];
	}

	protected function buy_pockets() {
		return ['size', 'cost'];
	}

	protected function buy_tool() {
		return ['name', 'cost'];
	}

	protected function no_money_tool() {
		return ['tool'];
	}
}
