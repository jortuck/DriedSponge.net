FROM composer:latest

WORKDIR /app
CMD [ "composer","install","--ignore-platform-reqs" ]
