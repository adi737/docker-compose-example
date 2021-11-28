W pliku `docker-compose.yml` znajdują się zdefiniowane dwa serwisy - serwer http nginx o nazwie "webserver", 
   oraz interpreter PHP o nazwie "php-fpm". W katalogu `/app` znajduje się "aplikacja", która powinna wyśiwetlać wiadomości z bazy danych.
   Do jej działania należy dodać do pliku `docker-compose.yml` serwis z baza danych MariaDB. 

1. Dodaje serwis z bazą danych MariaDB, obraz(mariadb:10.4). Ustaw zmienne środowiskowe zgodnie z danymi z pliku `app/db.config.php`.
Przykład ustawienia zmiennnych środowiskowcyh (env):
```
- MYSQL_ROOT_PASSWORD=root
- MYSQL_DATABASE=database_name
- MYSQL_USER=database_user
- MYSQL_PASSWORD=database_user
```
Sprawdź https://hub.docker.com/_/mariadb

W pliku `app/db.config.php` uzupełnij wartość hosta bazy danych (DB_HOST), która jest nazwą twojego serwisu z pliku `docker-compose.yml`.

2. Dodaj serwis phpMyAdmin https://hub.docker.com/r/phpmyadmin/phpmyadmin/ Ustaw 3 zmienne środowiskowe
   `PMA_HOST`, `PMA_USER` i `PMA_PASSWORD` zgodnie z wartościami z pkt 1, tak żeby apliakcja mogła połączyć się z stworzoną baza danych.
   Ustaw port zewnętrzny na 8001.
   
3. Uruchom `docker-compose up`, otwórz przeglądarkę i sprawdź działanie aplikacji http://localhost:8000, strona powinna wyśiwetlić wiadomość: `News count: 0`

4. Uruchom w przeglądarce phpMyAdmin http://localhost:8001, wybierz bazę danych i wykonaj zapytanie:

```
CREATE TABLE news ( 
    id INT NOT NULL AUTO_INCREMENT, 
    title VARCHAR(255) NOT NULL, 
    content TEXT NOT NULL,
    created DATETIME NOT NULL, 
    PRIMARY KEY (id)
) ENGINE = InnoDB;
```

Nastepnie wstaw do utworzonej tabeli `news` przynajmniej jeden rekord poprzez zapytanie: 

```INSERT INTO news ...```

5. Uruchom ponownie aplikację http://localhost:8000, powinna wyświetlić "News count: 1" i pokazać wpis, który dodałeś/aś do bazy danych.

