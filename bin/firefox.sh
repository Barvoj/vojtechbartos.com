#!/bin/bash

if [ "$1" = "stop" ]; then
    docker stop firefox
    docker rm firefox
else
    docker run -d -p 4444:4444 -p 5900:5900 --name firefox selenium/standalone-firefox-debug:2.53.0
fi

