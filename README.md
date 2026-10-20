# Piattaforma Corsi — PHP & MySQL

## Descrizione del progetto

Applicazione web sviluppata in **PHP nativo e MySQL** per la gestione delle iscrizioni a corsi di formazione.

La piattaforma permette agli utenti di registrarsi, effettuare il login, visualizzare i corsi disponibili e iscriversi ai corsi desiderati attraverso un'area personale.

Il progetto è stato realizzato durante il mio percorso formativo in **Web Development Full Stack**, con l'obiettivo di approfondire lo sviluppo backend e l'integrazione tra PHP e database relazionali.

---

## Tecnologie utilizzate

- **PHP** — Logica backend e gestione delle sessioni
- **MySQL** — Database relazionale
- **HTML** — Struttura delle pagine
- **CSS** — Stile dell'interfaccia
- **MySQLi** — Connessione e interrogazione del database
- **XAMPP** — Ambiente di sviluppo locale

---

## Funzionalità principali

### Registrazione utenti

- Registrazione tramite modulo HTML
- Salvataggio dei dati nel database MySQL
- Protezione delle password tramite `password_hash()`

### Login e autenticazione

- Accesso tramite username e password
- Verifica delle credenziali con `password_verify()`
- Gestione dell'autenticazione tramite sessioni PHP
- Protezione dell'area personale dagli accessi non autenticati

### Gestione dei corsi

- Visualizzazione dei corsi disponibili
- Iscrizione ai corsi di formazione
- Visualizzazione dei corsi associati all'utente
- Recupero dei dati tramite query SQL

### Logout

- Chiusura della sessione PHP
- Reindirizzamento alla pagina di login
- Blocco dell'accesso all'area personale dopo il logout

---

## Struttura del database

Il database `piattaforma` è composto da tre tabelle principali.

### Tabella `utente`

Contiene i dati degli utenti registrati.

Campi principali:
- `id` — Chiave primaria
- `username` — Nome utente
- `pass_word` — Hash della password
- `nome` — Nome
- `cognome` — Cognome
- `email` — Indirizzo email
- `cf` — Codice fiscale

### Tabella `corso`

Contiene i corsi di formazione disponibili.

Campi principali:
- `id` — Chiave primaria
- `denominazione` — Nome del corso

### Tabella `iscrizione`

Gestisce le associazioni tra utenti e corsi.

Campi principali:
- `id` — Chiave primaria
- `id_utente` — Chiave esterna verso `utente(id)`
- `id_corso` — Chiave esterna verso `corso(id)`

Le relazioni sono gestite tramite **Foreign Key**.

---

## Struttura del progetto

```text
piattaforma-corsi-php/
├── login.php
├── iscrizione.php
├── corsi.php
├── nuovo_corso.php
├── logout.php
├── style.css
├── piattaforma.sql
└── README.md
```

---

## Installazione e avvio

### Requisiti

- PHP
- MySQL
- Apache
- XAMPP (consigliato per l'ambiente locale)

### Procedura

1. Installare e avviare XAMPP.
2. Avviare i servizi **Apache** e **MySQL**.
3. Copiare la cartella del progetto in `C:\xampp\htdocs`.
4. Aprire phpMyAdmin all'indirizzo `http://localhost/phpmyadmin`.
5. Importare il file `piattaforma.sql` in un ambiente di test.
6. Verificare che le credenziali di connessione nei file PHP corrispondano alla configurazione locale di MySQL.
7. Aprire nel browser:

   `http://localhost/piattaforma-corsi-php/login.php`

8. Registrare un nuovo utente e accedere alla piattaforma.

**Attenzione:** lo script SQL contiene un comando `DROP DATABASE IF EXISTS piattaforma`, che elimina un eventuale database omonimo prima di ricrearlo. Eseguire lo script soltanto in un ambiente di test e dopo aver verificato che non contenga dati da conservare.

---

## Sicurezza

Il progetto implementa alcune misure di sicurezza di base:

- Hashing delle password con `password_hash()`
- Verifica delle password tramite `password_verify()`
- Query preparate per l'interazione con MySQL
- Gestione delle sessioni PHP
- Controllo dell'accesso alle pagine riservate
- Chiusura della sessione tramite logout

Il progetto è destinato a scopi didattici e non è stato sottoposto a un audit di sicurezza completo.

---

## Competenze applicate

- Sviluppo backend con PHP
- Integrazione PHP e MySQL
- Gestione dei moduli HTML
- Autenticazione e sessioni
- Operazioni SQL e relazioni tra tabelle
- Utilizzo di query preparate
- Gestione delle iscrizioni tramite database
- Sviluppo e test in ambiente locale

---

## Note

Il progetto utilizza **PHP nativo, senza framework**.

L'applicazione richiede un server PHP e un database MySQL, pertanto non può essere eseguita direttamente tramite GitHub Pages.

---

## Autore

Luca Carotenuto.

Progetto realizzato durante il percorso formativo **Web Developer Full Stack**.

**GitHub:** [lucacheto01-coder](https://github.com/lucacheto01-coder)



Passaggio 79 — Salviamo
