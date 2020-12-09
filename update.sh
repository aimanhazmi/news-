#!/usr/bin/env bash
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH

currentPath=$(cd `dirname $0`; pwd)

initProjectPermissions(){
        init777PermissionsPath $currentPath/web/uploads
        init777PermissionsPath $currentPath/runtime
        init777PermissionsPath $currentPath/easyim/logs
        # rm -rf $currentPath/runtime
        chmod -R 777 $currentPath/update.sh
    echo $currentPath
    echo 'end!'
}

init777PermissionsPath(){
        local path=$1
        if [ ! -d ${path} ]; then
                mkdir -p ${path}
        fi
        chmod -R 777 ${path}
}

init(){
        /usr/bin/git pull
        # git pull origin master
        initProjectPermissions
        echo "Post Project success!"
}
init


