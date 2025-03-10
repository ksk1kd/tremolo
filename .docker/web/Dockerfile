FROM nginx:stable-alpine
COPY ./.docker/web/default.conf /etc/nginx/conf.d/default.conf
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add -U shadow
RUN usermod -u 1000 nginx && groupmod -g 1000 nginx
WORKDIR /var/www/html
