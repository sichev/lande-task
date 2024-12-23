## Setup

To run this application you need a docker locally. [Docker for Desktop](https://www.docker.com/products/docker-desktop)
is simple and powerful solution for any platform - Windows, Mac or Linux. Also, you'll need a **git** and any kind of 
**terminal** which supports **docker** command. By default, this service is configured for a http://localhost:80 address. 
So port 80 on the localhost should be free.

In the terminal run this commands:

```shell
git clone git://gihub.com/sichev/lande-task
cd lande-task
docker compose up -d
docker exec -it lande-task-webapp-1 composer install
docker exec -it lande-task-webapp-1 composer init-app
```

To run tests:

```shell
docker exec -it lande-task-webapp-1 php artisan test
```
