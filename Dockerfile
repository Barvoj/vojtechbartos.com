FROM ubuntu
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./ /var/www/project
#COPY ./db /docker-entrypoint-initdb.d

RUN chown -R www-data:www-data /var/www/project
RUN chmod -R 777 /var/www/project

VOLUME /var/www/project
#VOLUME /docker-entrypoint-initdb.d

CMD ["true"]