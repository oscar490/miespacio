#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE miespacio_test;"
    psql -U postgres -c "CREATE USER miespacio PASSWORD 'miespacio' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists miespacio
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists miespacio_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists miespacio
    sudo -u postgres psql -c "CREATE USER miespacio PASSWORD 'miespacio' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O miespacio miespacio
    sudo -u postgres createdb -O miespacio miespacio_test
    LINE="localhost:5432:*:miespacio:miespacio"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
