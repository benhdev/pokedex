# benhdev/pokédex

## Requirements
- PHP
- [Composer](https://getcomposer.org/doc/00-intro.md#globally)
- git

## Getting started
1. Clone the repository
`git clone https://github.com/benhdev/pokedex.git`
2. Enter the repository
`cd pokedex`
3. Run the composer update command, this updates the composer packages and runs phptest.sh & build.sh
`php php composer.phar update` or `composer update` if you installed composer globally

## Test
`sh phptest.sh` or `./phptest.sh` if the file is executable

## Build
`sh build.sh` or `./build.sh` if the file is executable; this will also run phptest.sh

## Run
`sudo php -S localhost:80 -t public`

Navigate to [localhost](http://localhost/)