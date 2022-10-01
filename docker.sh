#!/bin/bash

# idiomatic parameter and option handling in sh
while test $# -gt 0
do
    case "$1" in
       start) docker-compose up -d;docker logs changethegame_apache_php -f
        ;;
       stop) docker-compose stop
        ;;
       bash) docker exec --user devandapache -it changethegame_apache_php /bin/bash
        ;;
	   logs) docker logs changethegame_apache_php -f
        ;;
	   build) docker-compose build
	    ;;
       *) echo "start/stop/bash/logs/build"
        ;;
    esac
    shift
done

exit 0
