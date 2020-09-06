FROM nginx:1.18-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=Asia/Tokyo

RUN apk update && \
    apk add --update --no-cache --virtual=.build-dependencies g++

COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /work/backend