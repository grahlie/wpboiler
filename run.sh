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

echo "Grunt deploy"
if [[ $inputVariable == 'production' ]]; then
    grunt production
elif [[ $inputVariable == 'dev' ]]; then
    grunt dev
fi

echo "==============="
echo ""

echo "Build docker"
cd ./docker
if [[ $inputVariable == 'production' ]]; then
    ./compose_build.sh production
elif [[ $inputVariable == 'fresh' ]]; then
    echo "Fresh docker-compose.yml file"
    rm docker-compose.yml
    ./compose_build.sh dev
elif [[ $inputVariable == 'dev' ]]; then
    ./compose_build.sh dev
fi

if [[ ! $inputVariable == 'production' ]]; then
    echo "==============="
    echo ""

    echo "Run docker"

    FILE="../config.json"
    DOMAIN=$(jq .docker.domain $FILE)
    DOMAIN="${DOMAIN%\"}"
    DOMAIN="${DOMAIN#\"}"

    ./compose_run.sh $DOMAIN
fi