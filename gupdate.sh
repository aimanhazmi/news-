#!/usr/bin/env bash
pushd /home/itv && git pull && popd
rsync -ap --delete --timeout=30 ./itv/* /data/web/itv
# rsync -rRtapW --delete --timeout=30 ./itv /data/web/itv
chmod -R 777 /data/web/itv/runtime
chmod -R 777 /data/web/itv/easyim/logs
chmod -R 777 /data/web/itv/web/uploads
chmod -R 777 /data/web/itv/web/assets
cd /data/web/itv/docker-env && ./init.sh