#!/bin/bash
echo ""
echo "==============="
echo "Running compose_build.sh"
echo "==============="
echo ""

echo "Set some variables"
ENVIRONMENT=$1
FILE=$2
source ./parse-config.sh $FILE

echo "==============="
echo ""

echo "Create compose file"
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
echo "        DEBUGMODE:" $DEBUG                                        >> ./docker-compose.yml
echo "        HTTPS:" $SSL                                              >> ./docker-compose.yml
echo "    expose:"                                                      >> ./docker-compose.yml
echo "      - 80"                                                       >> ./docker-compose.yml
echo "    depends_on:"                                                  >> ./docker-compose.yml
echo "      - "$NAME"-db"                                               >> ./docker-compose.yml
echo "    restart: always"                                              >> ./docker-compose.yml
echo "    environment:"                                                 >> ./docker-compose.yml
echo "      VIRTUAL_HOST:" $DOMAIN", www."$DOMAIN                       >> ./docker-compose.yml
echo "    container_name: " $NAME                                       >> ./docker-compose.yml
if [[ $ENVIRONMENT == 'dev' ]]; then
    echo "    volumes:"                                                 >> ./docker-compose.yml
    echo "      - "$FOLDER":/var/www/wp-content/themes/"$NAME           >> ./docker-compose.yml
    echo "  nginx:"                                                     >> ./docker-compose.yml
    echo "    image: jwilder/nginx-proxy"                               >> ./docker-compose.yml
    echo "    container_name: nginx-proxy"                              >> ./docker-compose.yml
    echo "    ports:"                                                   >> ./docker-compose.yml
    echo "      - '80:80'"                                              >> ./docker-compose.yml
    echo "    volumes:"                                                 >> ./docker-compose.yml
    echo "      - /var/run/docker.sock:/tmp/docker.sock:ro"             >> ./docker-compose.yml
fi
echo "networks:"                                                        >> ./docker-compose.yml
echo "  default:"                                                       >> ./docker-compose.yml
echo "    external:"                                                    >> ./docker-compose.yml
echo "      name: nginx-proxy"                                          >> ./docker-compose.yml
