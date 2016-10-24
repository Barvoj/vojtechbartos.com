#!/bin/bash

docker run --rm --volumes-from vojtechbartoscom_data_1 --name npm -w '/project' npm --no-bin-link
docker rm npm