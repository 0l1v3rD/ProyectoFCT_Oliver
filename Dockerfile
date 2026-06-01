FROM dunglas/frankenphp:latest

WORKDIR /app

COPY . /app

RUN rm /etc/caddy/Caddyfile

COPY Caddyfile /etc/caddy/Caddyfile

EXPOSE 80
