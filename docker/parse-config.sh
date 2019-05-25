#!/bin/bash
FILE=$1

NAME=$(jq .name $FILE)
FOLDER=$(jq .deploy $FILE)
DOMAIN=$(jq .docker.domain $FILE)
DBNAME=$(jq .docker.dbname $FILE)
DBUSER=$(jq .docker.dbuser $FILE)
DBPASS=$(jq .docker.dbpass $FILE)
DBPASS=$(jq .docker.dbpass $FILE)
DEBUG=$(jq .docker.debug $FILE)
SSL=$(jq .docker.ssl $FILE)
MULTISITE=$(jq .docker.multisite $FILE)

# Remove JSON specialchars
NAME="${NAME%\"}"
NAME="${NAME#\"}"
DOMAIN="${DOMAIN%\"}"
DOMAIN="${DOMAIN#\"}"
DBNAME="${DBNAME%\"}"
DBNAME="${DBNAME#\"}"
DBUSER="${DBUSER%\"}"
DBUSER="${DBUSER#\"}"
DBPASS="${DBPASS%\"}"
DBPASS="${DBPASS#\"}"
DEBUG="${DEBUG%\"}"
DEBUG="${DEBUG#\"}"
SSL="${SSL%\"}"
SSL="${SSL#\"}"
MULTISITE="${MULTISITE%\"}"
MULTISITE="${MULTISITE#\"}"
FOLDER="${FOLDER%\"}"
FOLDER="${FOLDER#\"}"