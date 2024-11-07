#!/bin/bash
#   --dry-run \

case $1 in
start)
    ssh -MNf moaddi
    ;;

push)
    rsync -zPrc \
        --exclude 'node_modules' \
        --exclude '.git' \
        --exclude '.htaccess' \
        --exclude '.vscode' \
        --exclude 'dashbord/admin/connect.php' \
        --exclude 'dashbord/admin/nsharat_uploads' \
        --exclude 'dashbord/edara/member_panding_conc.php' \
        --exclude '404.php' \
        --exclude 'rsync.sh' \
        --exclude 'package-lock.json' \
        --exclude '.env' \
        --exclude 'composer.json' \
        --exclude 'composer.lock' \
        . moaddi:/home/moaddi-net/htdocs/moaddi.net
    ;;

pull)
    rsync -zPrc \
         --exclude 'node_modules' \
        --exclude '.git' \
        --exclude '.htaccess' \
        --exclude 'academy/connect.php' \
        --exclude 'academy/nsharat_uploads' \
        --exclude '404.php' \
        --exclude 'rsync.sh' \
        --exclude 'package-lock.json' \
        --exclude '.env' \
        --exclude 'composer.json' \
        --exclude 'composer.lock' \
        moaddi:/home/moaddi-net/htdocs/moaddi.net .
    ;;

stop)
    ssh -O exit moaddi
    ;;
esac
