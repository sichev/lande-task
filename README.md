## Setup

To run this application you need a docker locally. [Docker for Desktop](https://www.docker.com/products/docker-desktop)
is simple and powerful solution for any platform - Windows, Mac or Linux. Also, you'll need a **git** and any kind of 
**terminal** which supports **docker** command. By default, this service is configured for a http://localhost:80/ address. 
So port 80 on the localhost should be free.

In the terminal run this commands:

```shell
git clone git://gihub.com/sichev/lande-task
cd lande-task
```

create a new **.env** file:
```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:/lr1wf0m/f55YbfVHNp735Y2qBRRxTZ0bbnC+/oSqPk=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mariadb
DB_HOST=db
DB_PORT=3306
DB_DATABASE=lande_task
DB_USERNAME=lande
DB_PASSWORD=password
```

Continue to starting up an application: 
```shell
docker compose up -d
docker exec -it lande-task-webapp-1 composer install
docker exec -it lande-task-webapp-1 composer init-app
```

Now you can test application with your favorite API client.


To run tests:
```shell
docker exec -it lande-task-webapp-1 php artisan test
```

## Application details

To simplify configuration, for this app was intentionally disabled any authentication. 

Here we have 2 types of calculator. 
- **App\Math\SimpleCalculator**
- **App\Math\StructuredCalculator**

First one is pretty simple and straight-forward. Second one is pretty complex and depends on the pack of data classes 
(to store a complex structures), process or manipulate data, etc. To switch between them - just put a correct setting 
in the **\App\Providers\AppServiceProvider**. For a simplicity these calculators are part of application. But honestly, 
it should be extracted to own libraries and connected with composer. Just to not clutter the main application.
