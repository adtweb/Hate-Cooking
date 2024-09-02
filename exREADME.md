# Inetstudio Laravel Sail Template
Шаблон для разработки Laravel проектов/сервисов в компании Inetstudio


## Laravel Sail
Документация: [https://laravel.com/docs/11.x/sail](https://laravel.com/docs/10.x/sail)


## Развертывание
Для начала разработки необходимо выполнить следующие шаги:
1. Клонировать git репозиторий этого шаблона
2. Переинициализировать git с новым хостом
   1. Удалить папку `.git`. Она содержит в себе git конфиги и историю шаблона
   2. Инициализировать новый git репозиторий
   3. Привязать созданный репозиторий к другому хосту
3. Скопировать с заменой:
   1. `project.Readme.md` > `Readme.md`
   2. `project.gitlab-ci.yml` > `.gitlab-ci.yml`
4. Заменить плейсхолдеры: 
   1. **docker-compose.yml** - Название основного контейнера `laravel`
   2. **composer.json** - Атрибуты `name` и `description`
   3. **.env.example** - Переменная `APP_SERVICE`, должно иметь одинаковое значение с названием контейнера
   4. **Readme.md** - `ProjectName` и `ProjectDescription`
   5. **.gitlab-ci.yml** - Переменные `swarm_stack_name`, `swarm_service_name`, `develop_environment_url`
5. Скопировать `.env.example` в `.env`
6. Добавить в `.env` свой ключ glpat
7. Запустить установку пакетов командой `make sail-init`
8. Запустить сборку проекта - `./vendor/bin/sail up -d` или `make up`


## Полезности

### Sail Terminal Alias
Для того чтобы упростить написание sail команд, можно добавить алиас в свой терминал:
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Строка добавляется в зависимости от используемого терминала по-умолчанию
- **zsh** - `~/.zshrc`
- **bash** - `~/.bashrc`
- **PowerShell** - _TODO_

После перезапуска терминала команды будет писать проще.
```shell
sail tinker # === ./vendor/bin/sail tinker
```

### Настройка XDebug

#### Переменные окружения
- **SAIL_XDEBUG_MODE** - переключение режимов XDebug (включить: `develop,debug`, выключить: `off`)
- **SAIL_XDEBUG_CONFIG** - конфигурация XDebug
  - **client_host** - хост для отправки запросов XDebug 
    - MacOS, Windows: `host.docker.internal`
    - Linux: Результат выполнения команды `docker inspect -f {{range.NetworkSettings.Networks}}{{.Gateway}}{{end}} <container-name>`
  - **idekey** - Ключ для фильтрации запросов

Пример:
```dotenv
SAIL_XDEBUG_MODE=develop,debug
SAIL_XDEBUG_CONFIG="client_host=host.docker.internal idekey=Docker"
```

#### Настройка сервера для приема XDebug для **PhpStorm**:
- Добавить сервер: _Preferences > PHP > Servers > "+"_
  - **Name**: `{Любой:-Docker}`
  - **Host**: `{хост laravel :-localhost}`
  - **Port**: `{внешний порт laravel :-80}`
  - **Debugger**: `XDebug`
  - **Use path mappings**: `true`
  - Указать mapping для файлов проекта: `/var/www/html`
- Добавить переменную окружения **PHP_IDE_CONFIG** `"serverName={имя_созданного_сервера:-Docker}"`
- Создать дебаг конфигурацию: _Run/Debug Configurations > "+" > PHP Remote Debug_
  - **Name**: `{Любой :-Docker}` 
  - **Filter debug connections...**: `true`
  - **Server**: `{Созданный ранее сервер :-Docker}`
  - **IDE Key**: `{Любой :-Docker}`

#### Настройка сервера для приема XDebug для **VSCode**:
- _TODO_



## Изменения
- Установлен **Laravel Horizon** и добавлен в `supervisor.conf`
- Установлен **crontab** и добавлен в `supervisor.conf`
- Изменен часовой пояс по-умолчанию на **Europe/Moscow**
- Установлен линтер **pint**: https://laravel.com/docs/11.x/pint
- Добавлена авторизация в приватном **Gitlab Composer Registry** через токен `gplat` (env: `COMPOSER_REPO_TOKEN`)
- Добавлены пакеты: 
  - `laravel-json-api/laravel`, 
  - `laravel-json-api/testing`, 
  - `laravel/pint`, 
  - `laravel/horizon`
- Добавлен **Healthcheck** для контейнера `laravel` в `docker-compose.yml` через встроенный `/up` (https://laravel.com/docs/11.x/deployment#the-health-route)
- Добавлен **Makefile** с привычными для Inetstudio командами
- Добавлен автоматический запуск команды `php artisan migrate` при старте контейнера
- Изменен **язык приложения** по-умолчанию на `ru_RU`


## TODO
- [ ] .gitlab.ci.yml для проверки сборки
- [ ] Добавить Filament
- [ ] `program:php-laravel-migrate` `autorestart` `(exit status 0; not expected)`
- [ ] Правильный порядок запуска программ в `supervisor`. Сначала `php-laravel-migrate`, затем группа `laravel-application:*`
- [x] .gitlab.ci.example.yml с полным ci для приложения. Стадии: Lint check, Build, Test, Publish, Deploy
- [x] Перенести конфигурацию xdebug и написать документацию по его включению