MACHINE=$1
DOMAIN=$2

if [ ! $MACHINE == 'none' ]; then
    HOSTIP="$(docker-machine ip $MACHINE)"
fi

if [ "docker network ls | grep nginx" ]; then
    docker network create nginx-proxy
fi

echo "3.5) Compose up"
docker-compose up -d

echo "==============="
echo ""

echo "3.6) Configure hosts file"
if grep -Fxq "$HOSTIP $DOMAIN" /etc/hosts; then
    echo "Already exists in host file"
else
    echo "Added to host file"
    sudo cp /etc/hosts /etc/hosts.backup
    sudo -- sh -c "echo $HOSTIP $DOMAIN >> /etc/hosts"
fi

echo "7) You're up and running buddy!"
echo "The website is running on http://$DOMAIN"
echo "Next command you can run is grunt watch to start develop your theme"
echo "==============="