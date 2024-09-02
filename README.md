# [ProjectName]
[ProjectDescription]


## Развертывание
Для начала разработки необходимо выполнить следующие шаги:
1. Скопировать `.env.example` в `.env`
2. Добавить в `.env` в переменную `COMPOSER_REPO_TOKEN` свой ключ glpat 
   - Создание токена: https://docs.gitlab.com/ee/user/profile/personal_access_tokens.html#create-a-personal-access-token
3. Запустить первичную установку пакетов командой `make sail-init`
4. Запустить сборку проекта - `./vendor/bin/sail up -d` или `make up`


## Полезные ссылки
- Sail Terminal Alias - [Тык](https://inetstudio.gitlab.yandexcloud.net/inetstudio/blueprints/laravel/laravel-sail-template#sail-terminal-alias)
- Настройка XDebug - [Тык](https://inetstudio.gitlab.yandexcloud.net/inetstudio/blueprints/laravel/laravel-sail-template#%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%BA%D0%B0-xdebug)
