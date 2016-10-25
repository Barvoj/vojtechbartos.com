FROM ubuntu
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./ /project
COPY ./db/create /docker-entrypoint-initdb.d

RUN chown -R www-data:www-data /project
RUN chmod -R 777 /project
RUN umask 777 /project/temp /project/log

RUN chown -R www-data:www-data /docker-entrypoint-initdb.d
RUN chmod -R 777 /docker-entrypoint-initdb.d

VOLUME /project
VOLUME /docker-entrypoint-initdb.d

CMD ["true"]