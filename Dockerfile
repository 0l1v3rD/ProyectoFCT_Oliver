FROM dunglas/frankenphp:latest

WORKDIR /app

COPY . /app

COPY Caddyfile /etc/caddy/Caddyfile

EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
