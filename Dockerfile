FROM docker.io/bitnami/laravel:9.1.1

WORKDIR /app

COPY . .

RUN composer install

ENTRYPOINT [ "/opt/bitnami/scripts/laravel/entrypoint.sh" ]
CMD [ "/opt/bitnami/scripts/laravel/run.sh" ]
