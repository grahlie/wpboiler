#!/usr/bin/env bash

echo "==============="
echo "Running $(basename $0)"
echo "==============="

ENVIRONMENT=$1
FILE=$2
source ./parse-config.sh $FILE

if [[ ! -f "../docker/docker-compose.yml" ]]; then
    echo "version: '2'"                                                     >> ../docker/docker-compose.yml
    echo "services:"                                                        >> ../docker/docker-compose.yml
    echo "  "$NAME"-db:"                                                    >> ../docker/docker-compose.yml
    echo "    image: mariadb"                                               >> ../docker/docker-compose.yml
    echo "    restart: always"                                              >> ../docker/docker-compose.yml
    echo "    environment:"                                                 >> ../docker/docker-compose.yml
    echo "      MYSQL_ROOT_PASSWORD: wordpress"                             >> ../docker/docker-compose.yml
    echo "      MYSQL_DATABASE:" $DBNAME                                    >> ../docker/docker-compose.yml
    echo "      MYSQL_USER:" $DBUSER                                        >> ../docker/docker-compose.yml
    echo "      MYSQL_PASSWORD:" $DBPASS                                    >> ../docker/docker-compose.yml
    echo "    container_name: " $NAME"-db"                                  >> ../docker/docker-compose.yml
    echo "  "$NAME":"                                                       >> ../docker/docker-compose.yml
    echo "    build:"                                                       >> ../docker/docker-compose.yml
    echo "      context: ."                                                 >> ../docker/docker-compose.yml
    echo "      dockerfile: Dockerfile"                                     >> ../docker/docker-compose.yml
    echo "      args:"                                                      >> ../docker/docker-compose.yml
    echo "        DBNAME:" $DBNAME                                          >> ../docker/docker-compose.yml
    echo "        DBUSER:" $DBUSER                                          >> ../docker/docker-compose.yml
    echo "        DBPASS:" $DBPASS                                          >> ../docker/docker-compose.yml
    echo "        DBHOST:" $NAME"-db"                                       >> ../docker/docker-compose.yml
    echo "        DOMAIN:" $DOMAIN                                          >> ../docker/docker-compose.yml
    echo "        MULTISITE:" $MULTISITE                                    >> ../docker/docker-compose.yml
    echo "        DEBUGMODE:" $DEBUG                                        >> ../docker/docker-compose.yml
    echo "        HTTPS:" $SSL                                              >> ../docker/docker-compose.yml
    echo "    expose:"                                                      >> ../docker/docker-compose.yml
    echo "      - 80"                                                       >> ../docker/docker-compose.yml
    echo "    depends_on:"                                                  >> ../docker/docker-compose.yml
    echo "      - "$NAME"-db"                                               >> ../docker/docker-compose.yml
    echo "    restart: always"                                              >> ../docker/docker-compose.yml
    echo "    environment:"                                                 >> ../docker/docker-compose.yml
    echo "      VIRTUAL_HOST:" $DOMAIN", www."$DOMAIN                       >> ../docker/docker-compose.yml
    echo "    container_name: " $NAME                                       >> ../docker/docker-compose.yml
    if [[ $ENVIRONMENT == 'dev' ]]; then
        echo "    volumes:"                                                 >> ../docker/docker-compose.yml
        echo "      - ../"$FOLDER"/wp/:/var/www"                            >> ../docker/docker-compose.yml
        echo "  nginx:"                                                     >> ../docker/docker-compose.yml
        echo "    image: jwilder/nginx-proxy"                               >> ../docker/docker-compose.yml
        echo "    container_name: nginx-proxy"                              >> ../docker/docker-compose.yml
        echo "    ports:"                                                   >> ../docker/docker-compose.yml
        echo "      - '80:80'"                                              >> ../docker/docker-compose.yml
        echo "    volumes:"                                                 >> ../docker/docker-compose.yml
        echo "      - /var/run/docker.sock:/tmp/docker.sock:ro"             >> ../docker/docker-compose.yml
    fi
    echo "networks:"                                                        >> ../docker/docker-compose.yml
    echo "  default:"                                                       >> ../docker/docker-compose.yml
    echo "    external:"                                                    >> ../docker/docker-compose.yml
    echo "      name: nginx-proxy"                                          >> ../docker/docker-compose.yml
fi