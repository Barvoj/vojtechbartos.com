#!/bin/bash

docker run --rm --volumes-from vb_data --net vojtechbartoscom_default --name composer bartos/composer $@