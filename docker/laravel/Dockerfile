FROM inetstudio.gitlab.yandexcloud.net:5050/inetstudio/utilities/laravel-sail:0.0.1


ARG WWWGROUP
RUN groupadd --force -g ${WWWGROUP:-$(id -g)} sail
RUN usermod -a -G ${WWWGROUP:-$(id -g)} sail


COPY ./ ./


ARG COMPOSER_REPO_TOKEN
ARG COMPOSER_AUTH="{\"gitlab-domains\":[\"inetstudio.gitlab.yandexcloud.net\"],\"gitlab-token\":{\"inetstudio.gitlab.yandexcloud.net\":\"${COMPOSER_REPO_TOKEN}\"}}"
ENV COMPOSER_AUTH="${COMPOSER_AUTH}"

RUN composer install --no-scripts --ignore-platform-reqs --ansi


RUN php artisan storage:link