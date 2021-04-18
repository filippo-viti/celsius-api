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
Per prima cosa, dovete creare l'utente su mysql, quindi,
utilizzando un client mysql (ex. [DBeaver](https://dbeaver.io/), [phpMyAdmin](https://www.phpmyadmin.net/)) date
i seguenti comandi sql:
```sql
CREATE USER [db_user]@localhost IDENTIFIED BY '[db_password]';
GRANT ALL PRIVILEGES ON [db_name].* TO [db_user]@localhost WITH GRANT OPTION;
```
Creare il file ```.env.local``` e inserire all'interno l'URL di connessione al database:
```
DATABASE_URL="mysql://[db_user]:[db_password]@127.0.0.1:3306/[db_name]"
```
Eseguire i seguenti comandi per creare il database, lo schema e importare i dati:
```bash
symfony console doctrine:database:create
symfony console doctrine:schema:create
symfony console doctrine:fixtures:load
```

Per inserire i dati, utilizzare un client mysql (ex. [DBeaver](https://dbeaver.io/), [phpMyAdmin](https://www.phpmyadmin.net/)) importando
il file ```2019.csv.sql```.
**N.B.**: se lavori su ambiente Unix, puoi direttamente scrivere nel terminale:
```bash
sudo mysql [dbname] < 2019.csv.sql
```

## Avvio del server
Per avviare il WebService (resterà in ascolto sulla porta 8000):
```bash
symfony serve
```

## Utilizzo 
Il formato dei datetime è ```yyyy-MM-dd HH:mm:ss```  
I parametri day, month e year sono int se non specificato  
Tutte le richieste necessitano di autenticazione tramite l'header ```X-AUTH-TOKEN```. Il token di default è "BANANA-TOKEN-2021"

### GET
GET generiche:
- ```/api/observation/```  
Per ottenere tutti i dati
- ```/api/observation/{datetime}```  
Restituisce i dati di uno specifico istante

GET per periodo:
- ```/api/observation/{from_datetime}/{to_datetime}```
- ```/api/observation/get-by-day/{date}```  
(data in formato ```yyyy-MM-dd```)
- ```/api/observation/get-by-month/{year}/{month}```  
- ```/api/observation/get-by-year/{year}```
- ```/api/observation/get-from-day-to-day/{date1}/{date2}```  
(date in formato ```yyyy-MM-dd```)
- ```/api/observation/get-from-month-to-month/{year1}/{month1}/{year2}/{month2}```
- ```/api/observation/get-from-year-to-year/{year1}/{year2}```

GET dei valori medi:
- ```/api/observation/get-avg-on/{day}/{field}```
- ```/api/observation/get-year-avg/{year}/{field}```  
Field disponibili ```time```, ```aTemp```, ```aHum```, ```bTemp```, ```bHum```, ```extTemp```, ```extHum```

### POST
```/api/observation/```  
Passare la risorsa in formato JSON nel body della richiesta. Esempio:
```json
{
  "time": "2019-12-31 23:30:00",
  "aTemp": "15.6",
  "aHum": "90",
  "bTemp": "15.4",
  "bHum": "99.9",
  "extTemp": "4.4",
  "extHum": "87.7"
}
```
### PUT
```/api/observation/{id}```   
Come POST ma nell'URL bisogna specificare l'id
### DELETE
```/api/observation/{id}```