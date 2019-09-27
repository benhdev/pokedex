<?php

namespace Module\Main;

// use the composer package for PokePHP
use PokePHP\PokeApi;
$api = new PokeApi;

// use the \Model\Pokemon class
use Model\Pokemon;

// get the resource list for pokemons
$limit = 18;
$offset = 0;
$intNextPage = 2;
$intPreviousPage = 0;

// check if path info exists
if(!empty($_SERVER['PATH_INFO'])) {
	$pathInfo = trim($_SERVER['PATH_INFO'], '/');
	$arrPathInfo = explode('/', $pathInfo);
}

// set path and id variables
$path = array_shift($arrPathInfo);
$id = array_shift($arrPathInfo);

// No search term or page number, go to default
if(empty($id)) {
	return header("Location: /all/1");
}

// pagination if id is integer
// allows pagination if search term is an integer (id)
if(intval($id)) {
	$intPage = $id;
	if($id < 1) {
		$intPage = 1;
	}

	$intNextPage = $id + 1;

	if($id > 1) {
		$intPreviousPage = $id - 1;
	} else {
		$disablePreviousPage = true;
	}

	// $id-1 here because on front end
	// we don't want to display page 0 when
	// on the first page of results
	$offset = ($id-1) * $limit;
} else {
	$disableNextPage = true;
	$disablePreviousPage = true;
}

// switch for what path we are on
switch($path) {
	case 'search':
		// if there is a search, we show 1 result

		try {
			$modelPokemon = Pokemon::getByName($id);
			include("includes/pokemon.phtml");
		} catch(\Exception $e) {
			// show 'No results' message
			echo $e->getMessage();

			// disable buttons
			$disableNextPage = true;
			$disablePreviousPage = true;
		}

		break;
	case 'all':
		// call static function getAll -> returns object of resource (paginated with offset)
		$objResource = Pokemon::getAll($offset);

		// no results, back to first page
		if(empty($objResource->results)) {
			// no results, go back to first page
			return header('Location: /all/1');
		}

		// no next page, disable button
		if(empty($objResource->next)) {
			$disableNextPage = true;
		}

		// go through each result
		foreach($objResource->results as $objResult) {
			try {
				$modelPokemon = Pokemon::getByName($objResult->name);
				include("includes/pokemon.phtml");
			} catch(\Exception $e) {
				// no results for this pokemon, display that on front end
				$arrPokemonNoResults = [
					'name' => $objResult->name,
					'no_result' => true
				];

				$objPokemonNoResults = (object) $arrPokemonNoResults;
				$modelPokemon = new Pokemon($objPokemonNoResults);
				include("includes/pokemon.phtml");
			}

			// set $modelPokemon to null
			$modelPokemon = null;
		}

		break;
	default:
		// send them back to the default page
		return header('Location: /all/1');
}

?>