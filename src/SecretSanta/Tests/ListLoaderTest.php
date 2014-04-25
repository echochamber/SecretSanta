<?php

namespace Echochamber\SecretSanta\Tests;

use Echochamber\SecretSanta\ListLoader;

class FileLoaderTest extends \PHPUnit_Framework_TestCase
{
	public function testFirst()
	{
		$this->assertTrue(true);
	}

	/**
	 * @dataProvider loadValidDataProvider
	 */
	public function testLoadValidData($testData)
	{

		$listLoader = new ListLoader;

		$listLoader->loadList($testData);

		$entries = $listLoader->getEntries();
		$numEntries = count($entries);
		$this->assertEquals(4, $numEntries);
	}

	public function loadValidDataProvider()
	{
		$dataSets = array();
		$fixtures = glob(__DIR__ . '/Fixtures/valid_list_*.txt');

		foreach($fixtures as $fixture)
		{
			$testData = file_get_contents($fixture);
			$dataSets[] = array($testData);
		}
		return $dataSets;
	}

	/**
	 * @dataProvider loadInvalidDataProvider
	 * @expectedException \Echochamber\SecretSanta\ListLoaderException
	 */
	public function testLoadInvalidData($testData)
	{
		$listLoader = new ListLoader;
		$listLoader->loadList($testData);
		
	}

	public function loadInvalidDataProvider()
	{
		$dataSets = array();
		$fixtures = glob(__DIR__ . '/Fixtures/invalid_list_*.txt');

		foreach($fixtures as $fixture)
		{
			$testData = file_get_contents($fixture);
			$dataSets[] = array($testData);
		}
		return $dataSets;
	}

}