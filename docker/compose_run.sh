FILE="../config.json"
DOMAIN=$(jq .docker.domain $FILE)
DOMAIN="${DOMAIN%\"}"
DOMAIN="${DOMAIN#\"}"
MACHINE=$(jq .docker.machine $FILE)
MACHINE="${MACHINE%\"}"
MACHINE="${MACHINE#\"}"

if [ ! $MACHINE == 'none' ]; then
    HOSTIP="$(docker-machine ip $MACHINE)"
else
    HOSTIP='127.0.0.1'
fi

if [ "docker network ls | grep nginx-proxy > /dev/null/" ]; then
    docker network create nginx-proxy
fi

echo "Compose up"
docker-compose up -d

echo "==============="
echo ""

echo "Configure hosts file"
if grep -Fxq "$HOSTIP $DOMAIN" /etc/hosts; then
    echo "Already exists in host file"
else
    echo "Added to host file"
    sudo cp /etc/hosts /etc/hosts.backup
    sudo -- sh -c "echo $HOSTIP $DOMAIN >> /etc/hosts"
fi

echo ""
echo "You're up and running buddy!"
echo "The website is running on http://$DOMAIN"
echo "Next command you can run is grunt watch to start develop your theme"
echo "==============="