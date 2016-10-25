#!/bin/bash

docker run --rm --volumes-from vb_data --net vojtechbartoscom_default --name npm -w '//project' node npm $@