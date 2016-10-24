#!/bin/bash

docker run --rm --volumes-from vojtechbartoscom_data_1 --net vojtechbartoscom_default --name npm -w '/project' npm --no-bin-link