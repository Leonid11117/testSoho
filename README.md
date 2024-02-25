##  Реализация проекта:
Использовал админ панель [Orchid](https://orchid.software/ru/docs/)
Выполнил CRUD для Book - App/Orchid/Screens/Author/AuthorEditScreen
Выполнил CRUD для Author - App/Orchid/Screens/Book/BookEditScreen
Выполинл валидацию для Book и Author - app/Http/Requests.
Выполнил фильтрацию книг по названию, автору и цене - App/Orchid/Layouts/Book/BookListLayout. Можно проверить по API(http://localhost:8001/admin/books/list), после развёртывания.

## Для развёртывания:
1. Клонирование репозитория
```sh
git clone https://github.com/Leonid11117/testSoho.git
```
2. Формирование контейнеров для докера:
```sh
docker-compose build
```
3. Запуск контейнеров:
```sh
docker-compose up -d 
```
4. Заходим в контейнер php:
```sh
docker exec -it php bash
```
5. Устанавливаем все дополнительные файлы конфигурации в контейнере:
```sh
composer install
```
6. Выполняем команду для генерации ключа в контейнере:
```sh
php artisan key:generate
```
7. Запуск миграций:
```sh
php artisan migrate
```
8. Создание пользователя в orchid:
```sh
php artisan orchid:admin admin admin@admin.com password
```
## Api 
- http://localhost:8001/admin - вход в админ панель
- http://localhost:8001/admin/authors/list - список авторов
- http://localhost:8001/admin/authors - создание автора
- http://localhost:8001/admin/authors/{id} - обновление автора
- http://localhost:8001/admin/books/list - список всех книг
- http://localhost:8001/admin/books - создание книги
- http://localhost:8001/admin/books/{id} - обновление книги
