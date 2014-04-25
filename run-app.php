<?php

require_once __DIR__ . '/autoload.php';

$fileName = $argv[1];

$listFile = file_get_contents($fileName);

$ListLoader = new \Echochamber\SecretSanta\ListLoader;
$SecretSantaApp = new \Echochamber\SecretSanta\SecretSantaApp($ListLoader);

$SecretSantaApp->loadParticipants($listFile);
echo $SecretSantaApp->printPartnersList() . "\n";