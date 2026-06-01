FROM dunglas/frankenphp:latest

WORKDIR /app

COPY . /app

COPY Caddyfile /Caddyfile

EXPOSE 80
