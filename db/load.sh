#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U miespacio -d miespacio < $BASE_DIR/miespacio.sql
fi
psql -h localhost -U miespacio -d miespacio_test < $BASE_DIR/miespacio.sql
