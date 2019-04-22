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

echo "1) NPM Install"
if [[ ! -d 'node_modules' ]]; then
    npm install
else
    if [[ $inputVariable == 'fresh' ]]; then
        echo "Fresh npm install"
        npm install
    else
        echo "node_modules already exists"
    fi
fi

echo "==============="
echo ""

echo "2) Grunt deploy"
if [[ $inputVariable == 'production' ]]; then
    grunt production
elif [[ $inputVariable == 'dev' ]]; then
    grunt dev
fi

echo "==============="
echo ""

echo "3) Build docker"
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

echo "==============="