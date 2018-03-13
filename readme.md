### Установка

1. Устанавливаем пакеты
```
composer install
npm install
```

2. Создаем файл-окружения (если его нет)

```
cp .env.example .env
```

3. В файле `.env` прописываем подключение к БД

4. Выполняем миграции
```
php artisan migrate
```

5. Заполняем данными фейковыми данными
```
php artisan db:seed
```

6. Компилируем статику
```
npm run prod
```

### Запуск
```
php artisan serve
```

Сайт будет доступен по адресу http://127.0.0.1:8000/

### Тестирование

1. Создаем файл-окружения
```
cp .env.example .env.testing
```

3. В файле `.env.testing` прописываем подключение к БД

4. Выполняем миграции
```
php artisan migrate --env=testing
```

5. Запуск
```
./vendor/bin/phpunit
```
