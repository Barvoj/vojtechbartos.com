FROM bartos/php
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./ /project

RUN chown -R www-data:www-data /project
RUN chmod -R 755 /project

WORKDIR /project

VOLUME /project/www