<?php

namespace Echochamber\SecretSanta;

class SecretSantaApp 
{
	/**
	 * List loader object.
	 * @var \Echochamber\SecretSanta\ListLoader
	 */
	protected $listLoader;

	public function __construct(\Echochamber\SecretSanta\ListLoader $listLoader)
	{
		$this->listLoader = $listLoader;
	}

	public function loadParticipants($participants)
	{
		$this->listLoader->clearList();
		$this->listLoader->loadList($participants);
	}

	public function createPartnersList()
	{
		$participants = $this->listLoader->getEntries();

		$pairings = $this->pairPartnersCircular($participants);
		return $pairings;
	}

	public function printPartnersList()
	{
		$pairings = $this->createPartnersList();

		$output = '';

		foreach ($pairings as $i => $pairedParticipant)
		{
			$output .= $pairedParticipant['firstName'] . ' ' . 
			           $pairedParticipant['lastName'];
			$output .= ' - ';
			$output .= $pairings[$pairedParticipant['partnerId']]['firstName'] . ' ' .
					   $pairings[$pairedParticipant['partnerId']]['lastName'];
			$output .= "\n";
		}
		$output = substr($output, 0, -1);
		return $output;
	}

	private function pairPartnersCircular($participants)
	{
		$pairings = array();
		$randomizedParticipants = $participants;
		shuffle($randomizedParticipants);

		$i = 0;
		foreach ($randomizedParticipants as $participant)
		{
			$partnerId = $i + 1;
			if( $partnerId === count($randomizedParticipants))
			{
				$partnerId = 0;
			}

			$participant['partnerId'] = $partnerId;
			$pairings[$i] = $participant;
			
			$i++;
		}
		return $pairings;
	}
}