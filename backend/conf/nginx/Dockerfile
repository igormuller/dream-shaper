FROM nginx:1.25.3-alpine
RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY ./vhost.conf /etc/nginx/conf.d
