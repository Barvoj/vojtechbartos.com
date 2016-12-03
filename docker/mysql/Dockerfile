FROM bartos/mysql
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./create.sql /docker-entrypoint-initdb.d/create.sql

RUN chmod -R 755 /docker-entrypoint-initdb.d