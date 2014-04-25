<?php

namespace Echochamber\SecretSanta;

use Echochamber\SecretSanta\ListLoaderException;

class ListLoader
{
	/**
	 * Array of all loaded list rows.
	 * @var array
	 */
	protected $listEntries;

	public function __construct()
	{
		$this->listEntries = array();
	}

	/**
	 * Loads the list.
	 * 
	 * @param  string $list
	 */
	public function loadList($list)
	{
		$lines = explode("\n", $list);
		foreach($lines as $i => $line)
		{
			// Lines are expected to be in the format
			// first_name space family_name space <email> newline
			$entryInfo = explode(" ", $line);

			if(count($entryInfo) !== 3)
			{
				throw new ListLoaderException("Too many elements on line {$i}");
			}
			$firstName = $entryInfo[0];
			$lastName = $entryInfo[1];
			$email = $entryInfo[2];

			// Email must be enclosed by <>
			if(substr($email, 0, 1) !== '<' || substr($email, -1) !== '>')
			{
				throw new ListLoaderException("Email must enclosed by <> on line {$i}");
			}
			$email = substr($email, 1, -1);

			$entry = array(
				'firstName' => $firstName,
				'lastName'  => $lastName, 
				'email'     => $email
			);
			$this->listEntries[] = $entry;
		}
	}

	public function getEntries()
	{
		return $this->listEntries;
	}
}