<?php

use PHPUnit\Framework\TestCase;

class PokemonTest extends TestCase  {
	private $strApiResponse = '{"id": 12,"name": "butterfree","base_experience": 178,"height": 11,"is_default": true,"order": 16,"weight": 320,"abilities": [{"is_hidden": true,"slot": 3,"ability": {"name": "tinted-lens","url": "https://pokeapi.co/api/v2/ability/110/"}}],"forms": [{"name": "butterfree","url": "https://pokeapi.co/api/v2/pokemon-form/12/"}],"game_indices": [{"game_index": 12,"version": {"name": "white-2","url": "https://pokeapi.co/api/v2/version/22/"}}],"held_items": [{"item": {"name": "silver-powder","url": "https://pokeapi.co/api/v2/item/199/"},"version_details": [{"rarity": 5,"version": {"name": "y","url": "https://pokeapi.co/api/v2/version/24/"}}]}],"location_area_encounters": [{"location_area": {"name": "kanto-route-2-south-towards-viridian-city","url": "https://pokeapi.co/api/v2/location-area/296/"},"version_details": [{"max_chance": 10,"encounter_details": [{"min_level": 7,"max_level": 7,"condition_values": [{"name": "time-morning","url": "https://pokeapi.co/api/v2/encounter-condition-value/3/"}],"chance": 5,"method": {"name": "walk","url": "https://pokeapi.co/api/v2/encounter-method/1/"}}],"version": {"name": "heartgold","url": "https://pokeapi.co/api/v2/version/15/"}}]}],"moves": [{"move": {"name": "flash","url": "https://pokeapi.co/api/v2/move/148/"},"version_group_details": [{"level_learned_at": 0,"version_group": {"name": "x-y","url": "https://pokeapi.co/api/v2/version-group/15/"},"move_learn_method": {"name": "machine","url": "https://pokeapi.co/api/v2/move-learn-method/4/"}}]}],"species": {"name": "butterfree","url": "https://pokeapi.co/api/v2/pokemon-species/12/"},"sprites": {"back_female": "http://pokeapi.co/media/sprites/pokemon/back/female/12.png","back_shiny_female": "http://pokeapi.co/media/sprites/pokemon/back/shiny/female/12.png","back_default": "http://pokeapi.co/media/sprites/pokemon/back/12.png","front_female": "http://pokeapi.co/media/sprites/pokemon/female/12.png","front_shiny_female": "http://pokeapi.co/media/sprites/pokemon/shiny/female/12.png","back_shiny": "http://pokeapi.co/media/sprites/pokemon/back/shiny/12.png","front_default": "http://pokeapi.co/media/sprites/pokemon/12.png","front_shiny": "http://pokeapi.co/media/sprites/pokemon/shiny/12.png"},"stats": [{"base_stat": 70,"effort": 0,"stat": {"name": "speed","url": "https://pokeapi.co/api/v2/stat/6/"}}],"types": [{"slot": 2,"type": {"name": "flying","url": "https://pokeapi.co/api/v2/type/3/"}}]}';

	public function test_getAbilities() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$arrExpectedAbilities = [
			'tinted-lens'
		];

		$arrActualAbilities = $modelPokemon->getAbilities();
		$this->assertEquals(
			$arrExpectedAbilities,
			$arrActualAbilities
		);
	}

	public function test_getImage() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$strExpectedImage = 'http://pokeapi.co/media/sprites/pokemon/12.png';
		$strActualImage = $modelPokemon->getImage();
		$this->assertEquals(
			$strExpectedImage,
			$strActualImage
		);
	}

	public function test_getHeight() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$intExpectedHeight = 1.1;
		$intActualHeight = $modelPokemon->getHeight();
		$this->assertEquals(
			$intExpectedHeight,
			$intActualHeight
		);
	}

	public function test_getName() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$strExpectedName = 'butterfree';
		$strActualName = $modelPokemon->getName();
		$this->assertEquals(
			$strExpectedName,
			$strActualName
		);
	}

	public function test_getSpecies() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$strExpectedSpecies = 'butterfree';
		$strActualSpecies = $modelPokemon->getSpecies();
		$this->assertEquals(
			$strExpectedSpecies,
			$strActualSpecies
		);
	}

	public function test_getWeight() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$intExpectedWeight = 32.0;
		$intActualWeight = $modelPokemon->getWeight();
		$this->assertEquals(
			$intExpectedWeight,
			$intActualWeight
		);
	}

	public function test_isBadResult() {
		$objApiResponse = json_decode($this->strApiResponse);
		$modelPokemon = new Model\Pokemon($objApiResponse);

		$bExpected = false;
		$bActual = $modelPokemon->isBadResult();
		$this->assertEquals(
			$bExpected,
			$bActual
		);
	}

	public function test_static_getAll() {
		$offset = 0;
		$_SESSION = [];

		$objResponse = Model\Pokemon::getAll($offset);
		$this->assertEquals(
			$_SESSION['pokemonResponse-0'],
			json_encode($objResponse, JSON_UNESCAPED_SLASHES)
		);

		$this->assertIsObject($objResponse);

		$this->assertObjectHasAttribute(
			'results',
			$objResponse
		);

		$this->assertIsArray($objResponse->results);

		$this->assertCount(
			18,
			$objResponse->results
		);

		$this->assertArrayHasKey(
			0,
			$objResponse->results
		);

		$objFirstResult = $objResponse->results[0];
		$this->assertObjectHasAttribute(
			'name',
			$objFirstResult
		);

		$this->assertObjectHasAttribute(
			'count',
			$objResponse
		);

		$this->assertIsNumeric($objResponse->count);

		$this->assertObjectHasAttribute(
			'next',
			$objResponse
		);

		$this->assertIsString($objResponse->next);

		$this->assertObjectHasAttribute(
			'previous',
			$objResponse
		);

		$this->assertEmpty($objResponse->previous);
	}

	public function test_static_getByName() {
		$id = 12;
		$_SESSION = [];

		$modelPokemon = Model\Pokemon::getByName($id);

		$arrExpectedAbilities = [
			'tinted-lens',
			'compound-eyes'
		];
		$bExpected = false;
		$intExpectedHeight = 1.1;
		$intExpectedWeight = 32.0;
		$strExpectedImage = 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/12.png';
		$strExpectedName = 'butterfree';
		$strExpectedSpecies = 'butterfree';

		$this->assertEquals(
			$arrExpectedAbilities,
			$modelPokemon->getAbilities()
		);

		$this->assertEquals(
			$bExpected,
			$modelPokemon->isBadResult()
		);

		$this->assertEquals(
			$intExpectedHeight,
			$modelPokemon->getHeight()
		);

		$this->assertEquals(
			$intExpectedWeight,
			$modelPokemon->getWeight()
		);

		$this->assertEquals(
			$strExpectedImage,
			$modelPokemon->getImage()
		);

		$this->assertEquals(
			$strExpectedName,
			$modelPokemon->getName()
		);

		$this->assertEquals(
			$strExpectedSpecies,
			$modelPokemon->getSpecies()
		);
	}
	
}

?>