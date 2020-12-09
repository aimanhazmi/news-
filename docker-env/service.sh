#!/usr/bin/env bash


set -e
ARVG_1=$1
imagesTag="docker-env"
imagesVersion="1.0"

CURRENTPATH=$(cd `dirname $0`; pwd)
LOCK_FILE=$CURRENTPATH/locked

init(){
    mkdir -p /data/database/mysql5.6/data
    mkdir -p /data/database/mysql5.6/sock
    mkdir -p /data/database/redis40
    chmod -R 777 /data/database
    chown -R nobody:nobody /data/database

    # chmod -R 777 /data/web/itv/web/assets
    # chmod -R 777 /data/web/itv/runtime
    echo "init finish!\n";
}

reload(){
    if [ $(docker ps | grep ${imagesTag} | wc -l) -gt 0 ]; then
       echo "docker ps | grep ${imagesTag} | awk '{print \$1 }' | xargs docker rm -f \n"
       docker ps | grep ${imagesTag} | awk '{print $1 }' | xargs docker rm -f
    fi;
    docker-compose build
    docker-compose up -d
    if [ $(docker images | grep none | wc -l) -gt 0 ]; then
       docker images | grep none | awk '{print $3 }' | xargs -r docker rmi -f
    fi;
    echo "up finish!\n";
}

if [ $ARVG_1 == 'init' ]; then
    init
    reload
fi

if [ $ARVG_1 == 'reload' ]; then
    reload
fi

# */1 * * * * /service.sh reboot-server >> /service.log

if [ $ARVG_1 == 'reboot-server' ]; then
    if [ -a ${LOCK_FILE} ]; then
        docker-compose stop
        docker-compose start
        rm -rf $LOCK_FILE
        echo "reboot-server finish! \n";
    fi
fi

