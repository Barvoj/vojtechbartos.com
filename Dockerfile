FROM ubuntu
MAINTAINER Vojtech Bartos <docker@vojtechbartos.com>

COPY ./ /project

RUN chown -R www-data:www-data /project
RUN chmod -R 777 /project

VOLUME /project

CMD ["true"]