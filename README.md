# RestWB_Symfony

Web service REST per interagire con un database di misurazioni di temperatura e umidità  
Repository del client: https://github.com/rikigianga24/restclient

## Requisiti
- PHP 7.4.x
- [Database MySQL](https://www.mysql.com/it/downloads/)
- [Composer](https://getcomposer.org/download)
- [Symfony CLI](https://symfony.com/download)

## Installazione
```bash
composer install
```

## Creazione del database
Per prima cosa, creare l'utente MySQL:
```sql
sudo mysql
CREATE USER <db_user>@localhost IDENTIFIED BY '<db_password>';
GRANT ALL PRIVILEGES ON <db_name>.* TO <db_user>@localhost WITH GRANT OPTION;
```
Creare il file ```.env.local``` e inserire all'interno l'URL di connessione al database:
```
DATABASE_URL="mysql://<db_user>:<db_password>@127.0.0.1:3306/<db_name>"
```
Eseguire i seguenti comandi per creare il database, lo schema e importare i dati:
```bash
symfony console doctrine:database:create
symfony console doctrine:schema:create
```
Importare il database contenuto nel file 2019.csv

## Esecuzione
Per avviare il WebService (resterà in ascolto sulla porta 8000):
```bash
symfony serve
```
