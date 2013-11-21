<?
include_once("_include.php");

class RarityPoolTest extends PHPUNit_Framework_TestCase {
	public static function test_add_element() {
		$rp = new RarityPool();
		$rarity = make_rarity();
		$rp->add_element(make_rarity());
		$rp->add_element(make_rarity());
		$rp->add_element($rarity);
		$rp->add_element(make_rarity());
		self::assertTrue(!is_null($rp->get_object($rarity)));
	}

	public static function test_remove_element() {
		$rp = new RarityPool();
		$rarity = make_rarity();
		$rp->add_element(make_rarity());
		$rp->add_element(make_rarity());
		$rp->add_element($rarity);
		$rp->add_element(make_rarity());
		$rp->remove_element($rarity);
		self::assertTrue($rp->count() == 3);
	}

	public static function test_choose_rarity() {
		$rarity1 = new Rarity(1, 1.00, 'blabla1');
		$rarity2 = new Rarity(2, 0.0, 'blabla2');
		$rp = new RarityPool();
		$rp->add_element($rarity1);
		$rp->add_element($rarity2);
		$chosen = $rp->choose_rarity();
		self::assertTrue($chosen->get_id() == $rarity1->get_id());
		$rp->remove_element($rarity2);
		$rarity3 = new Rarity(3, 1.00, 'blabla3');
		$rp->add_element($rarity3);
		$rp->choose_rarity();
		$chosen = $rp->choose_rarity()->get_id();
		self::assertTrue($chosen == $rarity1->get_id() || $chosen == $rarity3->get_id());
	}

}
