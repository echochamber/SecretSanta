# Secret Santa Project

Description: Takes a list of people and assigns them each a secret santa

List is expected to be of the format:

    first_name space family_name space <email> newline
    first_name space family_name space <email> newline
    first_name space family_name space <email> newline
    first_name space family_name space <email> newline

Example:

    Big Lebowski <biglebowski@thedude.com>
    Scooby Doo <scoobydoo@mysteryinc.com>
    Tom Hanks <thanks@you.com>
    Yogi Bear <ybear@yellowstone.com>

## Setup

1. [Install Composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
2. Run Composer install: `user@machine:/var/www/secretsanta$ ./composer.phar install`

## Testing

From project root, after installing via composer run phpunit: `user@machine:/var/www/secretsanta$ php vendor/bin/phpunit`

[Travis](https://travis-ci.org/echochamber/SecretSanta)

## Usage

After you install the app you can see an example run through by passing your textfile as an arguement to run-app.php

`php ./run-app.php santa-list.txt`

To actually use SecretSantaApp:

    //Create a list loader
    $ListLoader = new \Echochamber\SecretSanta\ListLoader;

    //Use it to create a SecretSantaApp
    $SecretSantaApp = new \Echochamber\SecretSanta\SecretSantaApp($ListLoader);

    //Load your participants
    $listFile = file_get_contents('somelist.txt');
    $SecretSantaApp->loadParticipants($listFile);

    //Print the randomly paired participants
    $SecretSantaApp->printPartnersList() . "\n";