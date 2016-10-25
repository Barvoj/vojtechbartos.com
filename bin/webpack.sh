#!/usr/bin/env bash

docker run --rm --volumes-from vb_data --net vojtechbartoscom_default --name webpack -w '//project' node node_modules/webpack/bin/webpack.js