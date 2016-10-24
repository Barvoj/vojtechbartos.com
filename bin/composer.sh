#!/bin/bash

docker run --rm --volumes-from vojtechbartoscom_data_1 --name composer bartos/composer $@