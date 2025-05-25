## Шаги по установке
### Клонируйте репозиторий GitHub
1. Откройте Cmd в папке, в которую вы хотите установить проект
2. Введите приведенную ниже команду и нажмите enter
```bash
git clone https://github.com/fufikcfg/utip-l.git
```
3. Затем перейдите в папку, используя приведенную ниже команду
```bash
cd utip-l
```

### Установите все зависимости Composer
1. Используйте приведенную ниже команду для установки всех зависимостей, затем дождитесь завершения всего процесса
```bash
composer install
```
### Создайте файл .env
1. Дублируйте *.env.example* файл в *.env* файла
2. Заполните информацию о вашей базе данных и прочее
```dotenv
DB_CONNECTION=sqlite
```
## Запуск
0. Установите sail alias
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```
1. Используйте приведенную ниже команду и дождитесь завершения исполнения
```bash
sail up -d
```
2. Используйте приведенную ниже команду и дождитесь завершения всех миграций
```bash
sail artisan migrate --seed
```
3. Используйте приведенную ниже команду и дождитесь её завершения
```bash
sail artisan key:generate
```
4. Если при миграции не был установлен SQLite
```bash
touch database/database.sqlite
```

## REST API

### Users

<table>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>Описание</th>
    </tr>
    <tr>
        <td>name</td>
        <td>varchar</td>
        <td>Имя</td>
    </tr>
    <tr>
        <td>email</td>
        <td>varchar</td>
        <td>Email</td>
    </tr>
        <td>password</td>
        <td>varchar</td>
        <td>Password</td>
    </tr>
        <td>is_admin</td>
        <td>boolean</td>
        <td>Админ ли (максимально упрощенная роль)</td>
    </tr>
        <td>avatar</td>
        <td>varchar</td>
        <td>Path to file</td>
    </tr>
</table>

#### Registration

POST `/v1/users/authorization/registration`
```JSON
{
	"name": "{% faker 'randomFirstName' %}",
	"email": "{% faker 'randomEmail' %}",
	"password": "{% faker 'randomPassword' %}" 
}
```
Response 200:
```JSON
{
    {
	"data": {
		"name": "Freida",
		"email": "Jaycee89@gmail.com",
		"token": "10|GZgQX15dAy30k4DUB16Q07hFhMKtTy5VnQzsp58F8d5acd06"
	}
}
}
```

#### Login

POST `/v1/users/authorization/login`
```JSON
{
	"email":"uwitting@example.org",
	"password":"123"
}
```
Response 200:
```JSON
{
	"data": {
		"name": "Tremayne Harber",
		"email": "uwitting@example.org",
		"token": "11|DkiaKZXv0GqTmXRbXUNHYw3EDs32tlbso090WLa893461a62"
	}
}
```

#### Exit

GET `/v1/users/authorization/exit`

* Auth: Bearer `token`

Response 200:
```JSON
{
	"data": {
		"name": "Tremayne Harber",
		"email": "uwitting@example.org",
		"token": "11|DkiaKZXv0GqTmXRbXUNHYw3EDs32tlbso090WLa893461a62"
	}
}
```

#### Verify

GET `/v1/users/authorization/verify`

* Auth: Bearer `token`

Response 200:
```JSON
{
	"data": {
		"name": "Tremayne Harber",
		"email": "uwitting@example.org"
	}
}
```

#### Avatar

GET `/v1/users/authorization/avatar`

* Auth: Bearer `token`

* Body: avatar: file.jpg

Response 201

### Posts

<table>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>Описание</th>
    </tr>
    <tr>
        <td>title</td>
        <td>varchar</td>
        <td>Заголовок</td>
    </tr>
    <tr>
        <td>content</td>
        <td>Text</td>
        <td>Контент</td>
    </tr>
        <td>category_id</td>
        <td>FK</td>
        <td>FK категории</td>
    </tr>
        <td>user_id</td>
        <td>FK</td>
        <td>FK автора</td>
</table>

#### Index

GET `/v1/posts?fields=title,category_id&expand=category&page=2&sort_field=title&tag_id=3&user_id=1&category_id=3`

* ?fields=title,category_id

* ?expand=category

* ?page=2

* ?sort_field=title

* ?tag_id=3

* ?user_id=1

* ?category_id=3

Response 200:
```JSON
{
	"data": [
		{
			"title": "Тестовый пост",
			"category_id": 1,
			"category": {
				"id": 1,
				"name": "omnis",
				"created_at": "2025-05-24T14:38:50.000000Z",
				"updated_at": "2025-05-24T14:38:50.000000Z"
			}
		}
	],
	"links": {
		"first": "http:\/\/localhost\/api\/v1\/posts?page=1",
		"last": "http:\/\/localhost\/api\/v1\/posts?page=3",
		"prev": "http:\/\/localhost\/api\/v1\/posts?page=1",
		"next": "http:\/\/localhost\/api\/v1\/posts?page=3"
	},
	"meta": {
		"current_page": 2,
		"from": 16,
		"last_page": 3,
		"links": [
			{
				"url": "http:\/\/localhost\/api\/v1\/posts?page=1",
				"label": "&laquo; Previous",
				"active": false
			}
		],
		"path": "http:\/\/localhost\/api\/v1\/posts",
		"per_page": 15,
		"to": 30,
		"total": 40
	}
}
```

#### Show

GET `/v1/posts/1?expand=category&fields=title,category_id`

Response 200:
```JSON
{
	"data": [
		{
			"title": "Aut quidem et maxime qui culpa.",
			"category_id": 21,
			"category": {
				"id": 21,
				"name": "ducimus",
				"created_at": "2025-05-24T14:38:54.000000Z",
				"updated_at": "2025-05-24T14:38:54.000000Z"
			}
		}
	]
}
```

#### Create

POST `/v1/posts`

* Auth: Bearer `token`

* **Need admin role**

```JSON
{
  "title": "Тестовый пост",
  "content": "Контент поста",
  "category_id": 1,
  "tags": [3, 5, 8]
}
```

Response 200:
```JSON
{
	"data": {
		"title": "Тестовый пост",
		"content": "Контент поста...",
		"category_id": 1,
		"user_id": 1,
		"updated_at": "2025-05-25T11:40:16.000000Z",
		"created_at": "2025-05-25T11:40:16.000000Z",
		"id": 43
	}
}
```

#### Update

PUT `/v1/posts/43`

* Auth: Bearer `token`

* **Need admin role**

* **Need user creator**

```JSON
{
  "title": "Тестовый пост14",
  "content": "Контент поста...1243"
}
```

Response 201

#### Delete

DELETE `/v1/posts/43`

* Auth: Bearer `token`

* **Need admin role**

* **Need user creator**

Response 200

## CLI API

### Users

#### Create

```bash
sail artisan user:create "Имя" user@email.com пароль123 --admin
```

# Вывод

* Сделаны все пункты, кроме: 3.8, 3.6, 3.4, 3.2

* Будет возращаться 500 ошибка при проблемах с токеном: это ошибка пакета

* /InsomniaDoc.json - тут коллекция запросов, можно импортировать в Insomnia, в postman не знаю
