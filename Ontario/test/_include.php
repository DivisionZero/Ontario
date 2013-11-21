<?
spl_autoload_register(function ($class) {
	if (is_file(__DIR__."/../library/{$class}.php")) {
		include __DIR__."/../library/{$class}.php";
	} else if (__DIR__."../dpw/{$class}.php") {
		include __DIR__."/../dpw/{$class}.php";
	}
});

DPWContent::init(__DIR__."/../content/dpw.log");

function make_object_list() {
	$ol = new ObjectList();
	$ol->add_element(new Object(1, 'Object1'));
	$ol->add_element(new Object(2, 'Object2'));
	return $ol;
}

function make_price() {
	$sp1 = new Spike(rand(1,40), rand(1,100)/100);
	$sp2 = new Spike(rand(1,60), rand(1,100)/100);
	$range = new Range(rand(1,100), rand(100, 200));
	return new Price($range, $sp1, $sp2);
}

function make_rarity() {
	return new Rarity(rand(1,5), rand(1,100) / 100);
}

function make_product($id, $name) {
	return new Product($id, $name, make_price(), make_rarity());
}

function make_product_list() {
	$pl = new ProductList();
	$pl->add_element(make_product(1,'Diamonds'));
	$pl->add_element(make_product(2,'Pearls'));
	$pl->add_element(make_product(3,'Sapphires'));
	$pl->add_element(make_product(4,'Rubies'));
	$pl->add_element(make_product(5,'Emeralds'));
	return $pl;
}

function make_unique_object_list() {
}

function make_player() {
	return new Player(1, 'Jon Doe', make_product_list());
}
