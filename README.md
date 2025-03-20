### Предварительные требования

* PHP ^8.2
* Make
* Composer
* Docker

### Запуск через докер

1. Установить зависимости
    ```sh
    make i
    ```

2. Подготовить конфигурационный файл
     ```sh
    make prepare-env
    ```

3. Настроить параметры в .env если необходимо
    ```dotenv
    DB_USERNAME=
    DB_PASSWORD=
    ```

4. Запуск контейнеров
    ```sh
    make up
    ```

5. Предварительные установки
    ```sh
    make setup
    ```

Postman коллекция запросов:
https://drive.google.com/file/d/1dZ0p6yceXtznE6ye1ZuSDE_gnb5-lUqX/view?usp=sharing
