# benhdev/pokédex

## Requirements
- PHP
- [Composer](https://getcomposer.org/doc/00-intro.md#globally)
- git

## Getting started
Clone the repository  
`git clone https://github.com/benhdev/pokedex.git`

Enter the repository  
`cd pokedex`

Run the composer update command, this updates the composer packages and runs phptest.sh & build.sh  
`php composer.phar update` or `composer update` if you installed composer globally

## Test
`sh phptest.sh` or `./phptest.sh` if the file is executable

## Build
`sh build.sh` or `./build.sh` if the file is executable; this will also run phptest.sh

## Run
`sh runlocal.sh` or `./runlocal.sh` if the file is executable

Navigate to [localhost](http://localhost/)