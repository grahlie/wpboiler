#!/bin/bash
inputVariable=$1
echo ""
echo "==============="
echo "Running compose_build.sh in $inputVariable"
echo "==============="
echo ""

echo "3.1) Install JSON parser"
UNAME=`uname`
which jq >/dev/null
if [[ $? == 1 ]]; then 
    if [[ "$UNAME" == 'Linux' ]]; then
        # TODO: this doesn't work
        sudo apt-get --assume-yes install jq
    elif [[ "$UNAME" == 'Darwin' ]]; then
        brew install jq
    fi
fi

echo "==============="
echo ""

echo "3.2) Set some variables"
if [[ $inputVariable == 'production' ]]; then
    FILE="../config.prod.json"
    if [ ! -f $FILE ]; then
        echo "config.prod.json Doesn't exists you need to create this first!"
        echo "exiting script here"
        exit;
    fi
else
    FILE="../config.json"
fi

NAME=$(jq .name $FILE)
FOLDER=$(jq .grunt.deploy $FILE)
PORT=$(jq .docker.port $FILE)
DOMAIN=$(jq .docker.domain $FILE)
DBNAME=$(jq .docker.dbname $FILE)
DBUSER=$(jq .docker.dbuser $FILE)
DBPASS=$(jq .docker.dbpass $FILE)
DEBUGMODE=$(jq .docker.debug $FILE)
HTTPS=$(jq .docker.https $FILE)
MACHINE=$(jq .docker.machine $FILE)
MULTISITE=$(jq .docker.multisite $FILE)
VERSION=$(jq .docker.version $FILE)

echo "==============="
echo ""

echo "3.3) Strip specialchars from JSON value"
# TODO: Find a solution to loop this
NAME="${NAME%\"}"
NAME="${NAME#\"}"
FOLDER="${FOLDER%\"}"
FOLDER="${FOLDER#\"}"
PORT="${PORT%\"}"
PORT="${PORT#\"}"
DOMAIN="${DOMAIN%\"}"
DOMAIN="${DOMAIN#\"}"
DBNAME="${DBNAME%\"}"
DBNAME="${DBNAME#\"}"
DBUSER="${DBUSER%\"}"
DBUSER="${DBUSER#\"}"
DBPASS="${DBPASS%\"}"
DBPASS="${DBPASS#\"}"
DEBUGMODE="${DEBUGMODE%\"}"
DEBUGMODE="${DEBUGMODE#\"}"
HTTPS="${HTTPS%\"}"
HTTPS="${HTTPS#\"}"
MACHINE="${MACHINE%\"}"
MACHINE="${MACHINE#\"}"
MULTISITE="${MULTISITE%\"}"
MULTISITE="${MULTISITE#\"}"
VERSION="${VERSION%\"}"
VERSION="${VERSION#\"}"

echo "==============="
echo ""

echo "3.4) Create compose file"
dockercompose="./docker-compose.yml"
if [[ ! -e $dockercompose ]]; then
    echo "version: '2'"                                                     >> ./docker-compose.yml
    echo "services:"                                                        >> ./docker-compose.yml
    echo "  "$NAME"-db:"                                                    >> ./docker-compose.yml
    echo "    image: mariadb"                                               >> ./docker-compose.yml
    echo "    restart: always"                                              >> ./docker-compose.yml
    echo "    environment:"                                                 >> ./docker-compose.yml
    echo "      MYSQL_ROOT_PASSWORD: wordpress"                             >> ./docker-compose.yml
    echo "      MYSQL_DATABASE:" $DBNAME                                    >> ./docker-compose.yml
    echo "      MYSQL_USER:" $DBUSER                                        >> ./docker-compose.yml
    echo "      MYSQL_PASSWORD:" $DBPASS                                    >> ./docker-compose.yml
    echo "    container_name: " $NAME"-db"                                  >> ./docker-compose.yml
    echo "  "$NAME":"                                                       >> ./docker-compose.yml
    echo "    build:"                                                       >> ./docker-compose.yml
    echo "      context: ."                                                 >> ./docker-compose.yml
    echo "      dockerfile: Dockerfile"                                     >> ./docker-compose.yml
    echo "      args:"                                                      >> ./docker-compose.yml
    echo "        DBNAME:" $DBNAME                                          >> ./docker-compose.yml
    echo "        DBUSER:" $DBUSER                                          >> ./docker-compose.yml
    echo "        DBPASS:" $DBPASS                                          >> ./docker-compose.yml
    echo "        DBHOST:" $NAME"-db"                                       >> ./docker-compose.yml
    echo "        DOMAIN:" $DOMAIN                                          >> ./docker-compose.yml
    echo "        MULTISITE:" $MULTISITE                                    >> ./docker-compose.yml
    echo "        DEBUGMODE:" $DEBUGMODE                                    >> ./docker-compose.yml
    echo "        HTTPS:" $HTTPS                                            >> ./docker-compose.yml
    echo "    volumes:"                                                     >> ./docker-compose.yml
    echo "      - "$FOLDER":/var/www/wp-content/themes/"$NAME               >> ./docker-compose.yml
    echo "    expose:"                                                      >> ./docker-compose.yml
    echo "      - 80"                                                       >> ./docker-compose.yml
    echo "    depends_on:"                                                  >> ./docker-compose.yml
    echo "      - "$NAME"-db"                                               >> ./docker-compose.yml
    echo "    restart: always"                                              >> ./docker-compose.yml
    echo "    environment:"                                                 >> ./docker-compose.yml
    echo "      VIRTUAL_HOST:" $DOMAIN", www."$DOMAIN                       >> ./docker-compose.yml
    echo "    container_name: " $NAME                                       >> ./docker-compose.yml
    if [[ $HTTPS == 1 ]]; then
        echo "  letsencrypt:"                                               >> ./docker-compose.yml
        echo "    image: jrcs/letsencrypt-nginx-proxy-companion"            >> ./docker-compose.yml
        echo "    volumes:"                                                 >> ./docker-compose.yml
        echo "      - /var/run/docker.sock:/tmp/docker.sock:ro"             >> ./docker-compose.yml
        echo "      - "$FOLDER"../nginx/vhost.d:/etc/nginx/vhost.d"         >> ./docker-compose.yml
        echo "      - "$FOLDER"../nginx/certs:/etc/nginx/certs:rw"          >> ./docker-compose.yml
        echo "      - "$FOLDER"../nginx/html:/usr/share/nginx/html"         >> ./docker-compose.yml
    fi
    echo "  nginx:"                                                         >> ./docker-compose.yml
    echo "    image: jwilder/nginx-proxy"                                   >> ./docker-compose.yml
    echo "    container_name: nginx-proxy"                                  >> ./docker-compose.yml
    echo "    ports:"                                                       >> ./docker-compose.yml
    echo "      - '80:80'"                                                  >> ./docker-compose.yml
    if [[ $HTTPS == 1 ]]; then
        echo "      - '443:443'"                                            >> ./docker-compose.yml
    fi
    echo "    volumes:"                                                     >> ./docker-compose.yml
    echo "      - /var/run/docker.sock:/tmp/docker.sock:ro"                 >> ./docker-compose.yml
    if [[ $HTTPS == 1 ]]; then
        echo "      - "$FOLDER"../nginx/vhost.d:/etc/nginx/vhost.d"         >> ./docker-compose.yml
        echo "      - "$FOLDER"../nginx/certs:/etc/nginx/certs:rw"          >> ./docker-compose.yml
        echo "      - "$FOLDER"../nginx/html:/usr/share/nginx/html"         >> ./docker-compose.yml
    fi
    echo "networks:"                                                        >> ./docker-compose.yml
    echo "  default:"                                                       >> ./docker-compose.yml
    echo "    external:"                                                    >> ./docker-compose.yml
    echo "      name: nginx-proxy"                                          >> ./docker-compose.yml
fi

echo "==============="
echo ""

if [[ $inputVariable != 'production' ]]; then
    ./compose_run.sh $MACHINE $DOMAIN
fi