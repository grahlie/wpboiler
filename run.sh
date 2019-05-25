#!/usr/bin/env bash
inputVariable=$1

if [[ $inputVariable < 1 ]]; then
    echo "Variable is empty, printing help for script!"
    echo "Run this script with one of these commands:"
    echo ""
    echo ""
    echo "--------------------------------------------------------"
    echo "|    production -- for a fully production ready web    |"
    echo "|    dev        -- a web without compressed files      |"
    echo "|    fresh      -- for a new clean install             |"
    echo "--------------------------------------------------------"
    echo ""
    echo ""
    exit;
fi

echo "NPM Install"
if [ ! -d 'node_modules' ] || [[ $inputVariable == 'fresh' ]]; then
    npm install
else
    echo "NPM already installed"
fi

echo "==============="
echo ""

echo "Composer install"
if [ ! -d 'vendor' ] || [[ $inputVariable == 'fresh' ]]; then
    composer install
else
    echo "Composer already installed"
fi

echo "==============="
echo ""

echo "Install JSON parser"
which jq >/dev/null
if [[ $? == 1 ]]; then 
    UNAME=`uname`
    if [[ "$UNAME" == 'Linux' ]]; then
        # TODO: this doesn't work
        sudo apt-get --assume-yes install jq
    elif [[ "$UNAME" == 'Darwin' ]]; then
        brew install jq
    fi
else
    echo "JQ already installed"
fi

echo "==============="
echo ""

echo "Grunt"
if [[ $inputVariable == 'production' ]]; then
    grunt production
elif [[ $inputVariable == 'dev' ]]; then
    grunt dev
fi

echo "==============="
echo ""

echo "Docker"
cd ./docker
FILE="../config.json"
if [[ $inputVariable == 'production' ]]; then
    FILE="../config.prod.json"

    if [ ! -f $FILE ]; then
        echo "config.prod.json Doesn't exists you need to create this first!"
        echo "exiting script here"
        exit;
    fi

    rm docker-compose.yml
elif [[ $inputVariable == 'fresh' ]]; then
    rm docker-compose.yml
fi

DOCKERCOMPOSE="./docker-compose.yml"
if [[ ! -e $DOCKERCOMPOSE ]]; then
    ./compose_build.sh $inputVariable $FILE
fi

if [[ $inputVariable == 'dev' ]]; then
    ./compose_run.sh
fi