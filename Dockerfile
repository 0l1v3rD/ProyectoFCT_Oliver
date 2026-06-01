FROM dunglas/frankenphp:latest

WORKDIR /app

COPY . /app

COPY Caddyfile /etc/caddy/Caddyfile

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
