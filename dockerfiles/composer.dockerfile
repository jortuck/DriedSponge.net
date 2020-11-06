FROM composer:latest

WORKDIR /app
CMD [ "composer","update","--ignore-platform-reqs" ]