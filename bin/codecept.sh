#!/bin/bash

docker run --rm --volumes-from vojtechbartoscom_data_1 --link firefox --net vojtechbartoscom_default --name codeception codeception/codeception $@