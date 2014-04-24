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

## Project Setup

_How do I, as a developer, start working on the project?_ 

1. [Install Composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
2. Run Composer install: `user@machine:/var/www/secretsanta$ ./composer.phar install`

## Testing

From project root, after installing via composer run phpunit: `user@machine:/var/www/secretsanta$ php vendor/bin/phpunit`

## Usage

1. Do Stuff