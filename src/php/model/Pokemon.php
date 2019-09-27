<?php

namespace Model;

use PokePHP\PokeApi;

class Pokemon {

	const LIMIT = 18;
	
	private static $endpoint = 'pokemon';

	private $arrAbilities;
	private $intHeight;
	private $intWeight;
	private $strImageUrl;
	private $strName = "Test";
	private $strSpecies;

	private $badResult;

	public function __construct($objPokemon) {
		// construct the model Pokemon object instance

		// divide height and weight by 10
		// to get the value in meters/kilograms

		if(isset($objPokemon->no_result)) {
			$this->badResult = true;
		}

		$this->arrAbilities = [];
		if(isset($objPokemon->height)) {
			$this->intHeight = $objPokemon->height/10;
		}
		if(isset($objPokemon->weight)) {
			$this->intWeight = $objPokemon->weight/10;
		}
		if(isset($objPokemon->sprites) and isset($objPokemon->sprites->front_default)) {
			$this->strImageUrl = $objPokemon->sprites->front_default;
		}

		// set the name
		if(isset($objPokemon->name)) {
			$this->strName = $objPokemon->name;
		}

		// set the species name
		if(isset($objPokemon->species) and isset($objPokemon->species->name)) {
			$this->strSpecies = $objPokemon->species->name;
		}

		// set the image url to the front default sprite
		// echo json_encode($objPokemon);

		if(empty($this->getImage()) and isset($this->strSpecies) and $this->getName() !== $this->getSpecies()) {
			$modelPokemon = self::getByName($this->strSpecies);
			$this->strImageUrl = $modelPokemon->getImage();
		}

		if(isset($objPokemon->abilities)) {
			foreach($objPokemon->abilities as $objAbility) {
				$this->arrAbilities[] = $objAbility->ability->name;
			}
		}
	}

	// getter functions to return values
	// of private variables
	public function getAbilities() {
		return $this->arrAbilities;
	}

	public function getImage() {
		return $this->strImageUrl;
	}

	public function getHeight() {
		return $this->intHeight;
	}

	public function getName() {
		return $this->strName;
	}

	public function getSpecies() {
		return $this->strSpecies;
	}

	public function getWeight() {
		return $this->intWeight;
	}

	public function isBadResult() {
		return empty($this->badResult) ? false : true;
	}



	public static function getAll($offset) {

		if(array_key_exists("pokemonResponse-$offset", $_SESSION)) {
			return json_decode($_SESSION["pokemonResponse-$offset"]);
		}

		$api = new PokeApi;
		$response = $api->resourceList(self::$endpoint, self::LIMIT, $offset);
		$_SESSION["pokemonResponse-$offset"] = $response;

		$objResponse = json_decode($response);
		return $objResponse;
	}
	// static function to get a Pokemon by its name
	public static function getByName($name) {
		// initialize the PokeApi

		// check if we have already saved a result to the session
		if(array_key_exists("pokemon-$name", $_SESSION)) {
			// json decode the saved result
			$objPokemon = json_decode($_SESSION["pokemon-$name"]);
			// return a new model Pokemon object instance
			return new self($objPokemon);
		}

		// no saved result so hit the api
		$api = new PokeApi;
		$responsePokemon = $api->pokemon($name);
		// json decode the result into object
		$objResponse = json_decode($responsePokemon);
		// check the decoded json is a valid object 
		if(!is_object($objResponse)) {
			throw new \Exception("No results");
		}
		// save the raw result to the session
		$_SESSION["pokemon-$name"] = $responsePokemon;
		// return a new model Pokemon object instance
		return new self($objResponse);
	}

}

?>