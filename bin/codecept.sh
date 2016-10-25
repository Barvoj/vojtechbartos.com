#!/bin/bash

docker run --rm --volumes-from vb_data --link firefox --net vojtechbartoscom_default --name codeception codeception/codeception $@