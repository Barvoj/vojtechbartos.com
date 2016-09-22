FROM ubuntu
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./ /project
COPY ./db/create /docker-entrypoint-initdb.d

RUN chown -R www-data:www-data /project
RUN chmod -R 777 /project

VOLUME /project
VOLUME /docker-entrypoint-initdb.d

CMD ["true"]