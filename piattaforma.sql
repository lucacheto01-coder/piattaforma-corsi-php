drop database if exists piattaforma;
create database piattaforma;
use piattaforma;

create table utente(
    id int primary key auto_increment,
    username text unique,
    pass_word text,
    nome text,
    cognome text,
    email text,
    cf text,
	created_at timestamp,
	updated_at timestamp
);

create table corso(
    id int primary key auto_increment,
    denominazione text,
	created_at timestamp,
	updated_at timestamp
);

create table iscrizione(
    id int primary key auto_increment,
    id_utente int,
    id_corso int,
	created_at timestamp,
	updated_at timestamp,
    foreign key(id_utente) references utente(id),
    foreign key(id_corso) references corso(id)	
);

insert into utente (username, pass_word, nome, cognome, email, cf) values
   ("user44", "202627", "Mario", "Rossi", "Mariorossi81@gmail.com", "MRIKRA30D62H618S"),
   ("FrancoB", "FB78?!", "Francesco", "Balducci", "FrancescoBald32@gmail.com", "FBTHSR97R03I558D"),
   ("Bia65", "BiaBiaBia", "Biagio", "Baiano", "BiagioBaianoBia@gmail.com", "BBUMYV27H12A445V");


insert into corso (denominazione) values
   ("Web Developer"),
   ("AutoCad"),
   ("PhotoShop");



insert into iscrizione (id_utente, id_corso) values
   (1, 3),
   (2, 1),
   (3, 2);