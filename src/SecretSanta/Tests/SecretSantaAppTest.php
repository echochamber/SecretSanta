<?php

namespace Echochamber\SecretSanta\Tests;

use Mockery;
use Echochamber\SecretSanta\ListLoader;
use Echochamber\SecretSanta\SecretSantaApp;

class SecretSantaAppTest extends \PHPUnit_Framework_TestCase
{

    public function testTest()
    {
        $this->assertTrue(true);
    }

    public function testLoadParticipants()
    {
        $listLoader = \Mockery::mock('\Echochamber\SecretSanta\ListLoader');
        $listLoader->shouldReceive('loadList');
        $listLoader->shouldReceive('clearList');
        $secretSantaApp = new SecretSantaApp($listLoader);

        $secretSantaApp->loadParticipants('IrreleventString');
    }

    /**
     * @dataProvider createPartnersProvider
     */
    public function testPrintPartnersList($participants)
    {
        $listLoader = \Mockery::mock('\Echochamber\SecretSanta\ListLoader');
        $listLoader
            ->shouldReceive('getEntries')
            ->andReturn($participants);
        $secretSantaApp = new SecretSantaApp($listLoader);

        $result = $secretSantaApp->printPartnersList();

        $numLines = substr_count($result, "\n") + 1;
        $numParticipants = count($participants);
        $this->assertEquals($numParticipants, $numLines);
    }

    /**
     * @dataProvider createPartnersProvider
     */
    public function testCreatePartnersNoSelfAssigment($participants)
    {
        $listLoader = \Mockery::mock('\Echochamber\SecretSanta\ListLoader');
        $listLoader
            ->shouldReceive('getEntries')
            ->andReturn($participants);
        $secretSantaApp = new SecretSantaApp($listLoader);

        $pairings = $secretSantaApp->createPartnersList();

        foreach($pairings as $i => $pairedParticipant)
        {
             $this->assertNotEquals($i, $pairedParticipant['partnerId']);
        }
    }

    public function createPartnersProvider()
    {
        return array(
            array(
                array(
                    array(
                        'firstName' => 'Locke',
                        'lastName' => 'Lamora',
                        'email' => 'lola@camorr.com',
                    ),

                    array(
                        'firstName' => 'Jean',
                        'lastName' => 'Tannen',
                        'email' => 'jeta@camorr.com',
                    ),

                    array(
                        'firstName' => 'Calo',
                        'lastName' => 'Sanza',
                        'email' => 'Casa@camorr.com',
                    ),

                    array(
                        'firstName' => 'Galo',
                        'lastName' => 'Sanza',
                        'email' => 'Gasa@camorr.com',
                    )
                )
            )
        );
    }
}