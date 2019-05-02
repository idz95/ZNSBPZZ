# sipavanje baze
# c:\xampp\mysql\bin>mysql.exe -uedunova -pedunova --default_character_set=utf8 < C:\xampp\htdocs\1_FERITIJADA\feritijada.sql


drop database if exists znsbpz;
create database znsbpz character set utf8 collate utf8_croatian_ci;

#za byethost
#alter database character set utf8 collate utf8_croatian_ci;


use znsbpz;

create table admin(
sifra int not null primary key auto_increment,
email varchar(50) not null,
lozinka char(32) not null,
ime varchar(50) not null,
prezime varchar(50) not null,
uloga varchar(20) not null
);

create table utakmica(
sifra int not null primary key auto_increment,
mjesto varchar(20) not null,
pocetak datetime not null,
kolo int not null,
domacin_score int,
gost_score int,
opis text(500),
delegat_potvrdio bit,
sudac int not null,
delegat int not null,
domacin int not null,
gost int not null,
liga int not null
);

create table sudac(
sifra int not null primary key auto_increment,
ime varchar(20) not null,
prezime varchar(20) not null,
email varchar(50) not null,
lozinka char(32) not null,
datum_rodjenja datetime not null,
mjesto varchar(20) not null,
mobitel varchar(20) not null,
liga varchar(20) not null,
uloga varchar(20) not null
);

create table delegat(
	sifra int not null primary key auto_increment,
	ime varchar(20) not null,
	prezime varchar(20) not null,
	email varchar(50) not null,
	lozinka char(32) not null,
	datum_rodjenja datetime not null,
	mjesto varchar(20) not null,
	mobitel varchar(20) not null,
	liga varchar(20) not null,
  uloga varchar(20) not null
);

create table klub(
 sifra int not null primary key auto_increment,
 naziv_kluba varchar(20) NOT NULL,
 mjesto varchar(20) not null,
 naziv_stadiona varchar(20) not null,
 boja_dresa_domaca varchar(20) not null,
boja_dresa_gost varchar(20) not null,
liga int not null
 );



 
 create table igrac(
 sifra int not null primary key auto_increment,
 broj_registracije int not null,
 oib int not null,
ime varchar(20) not null,
prezime varchar(20) not null,
datum_rodjenja datetime not null,
mjesto_rodjenja varchar(20) not null,
drzavljanstvo varchar(20) not null,
broj_golova int,
klub int not null
);


  create table liga(
  sifra int not null primary key auto_increment,
	razina int not null,
  smjer varchar(20) not null,
	kategorija varchar(20) not null
);


alter table utakmica add foreign key (liga) references liga(sifra);
alter table utakmica add foreign key (sudac) references sudac(sifra);
alter table utakmica add foreign key (delegat) references delegat(sifra);
alter table utakmica add foreign key (domacin) references klub(sifra);
alter table utakmica add foreign key (gost) references klub(sifra);

alter table igrac add foreign key (klub) references klub(sifra);
alter table klub add foreign key (liga) references liga(sifra);



insert into admin(sifra, ime, prezime,email, lozinka, uloga) values
(null, 'Admin', 'Džambo', 'admin@hns.hr',md5('ivica'), 'admin');

insert into sudac(sifra, ime, prezime, email, lozinka, datum_rodjenja, mjesto, mobitel, liga, uloga) values
(null, 'Ivo', 'Marić', 'ivom@hns.hr', md5('sudac'), '1995-04-09', 'Vrpolje','095 856 7600','1.ŽNL', 'sudac'),
(null, 'Ante', 'Marjanović', 'antem@hns.hr', md5('sudac'), '1995-04-09', 'Jaruge','095 856 7600','2.ŽNL', 'sudac'),
(null, 'Lovro', 'Marić', 'lovrom@hns.hr', md5('sudac'), '1995-04-09', 'Bervaci','095 856 7600','1.ŽNL', 'sudac');

insert into delegat(sifra, ime, prezime, email, lozinka, datum_rodjenja, mjesto, mobitel, liga, uloga) values
(null, 'Ivica', 'Marić', 'ivo@hns.hr', md5('sudac'), '1995-04-09', 'Vrpolje','095 856 7600','1.ŽNL', 'delegat'),
(null, 'Antimon', 'Marjanović', 'ante@hns.hr', md5('sudac'), '1995-04-09', 'Jaruge','095 856 7600','2.ŽNL', 'delegat'),
(null, 'Roberto', 'Andrić', 'robi@hns.hr', md5('sudac'), '1995-04-09', 'Bervaci','095 856 7600','1.ŽNL', 'delegat');

insert into liga(sifra, razina, smjer, kategorija) values
(null, 1, '', 'Seniori'),
(null, 2, 'Zapad', 'Seniori'),
(null, 2, 'Istok', 'Seniori'),
(null, 2, 'Centar', 'Seniori'),
(null, 3, 'Zapad', 'Seniori'),
(null, 3, 'Istok', 'Seniori'),
(null, 3, 'Centar', 'Seniori');

insert into klub(sifra, naziv_kluba, mjesto, naziv_stadiona, boja_dresa_domaca, boja_dresa_gost, liga) values
(null,'NK TOMISLAV','Donji Andrijevci', 'Andrijevci', 'Bijela', 'Žuta', 1),
(null,'NK OMLADINAC','Gornja Vrba', 'Random', 'Plava', 'Žuta', 1),
(null,'NK MLADOST','Sibinj', 'Sibinj', 'Plava', 'Žuta', 1),
(null,'NK SVAČIĆ','Stari Slatnik', 'Stari Hrast', 'Plava', 'Žuta', 1),
(null,'NK ZADRUGAR','Oprisavci', 'Oprisavci', 'Plava', 'Žuta', 1),
(null,'NK MLADOST','Sibinj', 'Sibinj', 'Plava', 'Žuta', 1),
(null,'NK SIKIREVCI','Sikirevci', 'Sikirevci', 'Plava', 'Žuta', 1),
(null,'NK SLAVONAC','Bukovlje', 'Bukovlje', 'Plava', 'Žuta', 1),
(null,'NK BATRINA','Batrina', 'Batrina', 'Plava', 'Žuta', 1),
(null,'NK SLAVONAC','Nova Kapela', 'Nova Kapela', 'Plava', 'Žuta', 1),
(null,'NK OMLADINAC','Vrbova', 'Vrbova', 'Plava', 'Žuta', 1),
(null,'NK BUDUĆNOST','Rešetari', 'Rešetari', 'Plava', 'Žuta', 1),
(null,'NK ZVONIMIR','Donja Vrba', 'Sibinj', 'Plava', 'Žuta', 1),
(null,'NK OMLADINAC','Staro Topolje', 'Sibinj', 'Plava', 'Žuta', 1),
(null,'NK SLAVEN','Prnjoni', 'Prnjoni', 'Plava', 'Žuta', 2),
(null,'NK MLADOST','Cerenjani', 'Cerenjani', 'Plava', 'Žuta', 2),
(null,'NK SLAVIJA','Panje', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK PSUNJ-SOKOL','Petrijvci', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK GRANIČAR','Motičina', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK SLAVONIJA','Puzdravci', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK SLAVONAC','Brkići', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK MLADOST','Cernik', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK POSAVAC','Kalić', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK DINAMO','Gromačnik', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK SLOBODA','Dilj', 'Sibinj', 'Plava', 'Žuta', 2),
(null,'NK SLAVONAC','Gornja Bebrina', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK RAKETA','Beravci', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK GUNDINCI','Gundinci', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK SLOGA','Jaruge', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK DUBRAVA','Zadubravlje', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK POSAVINA','Velika Kopanica', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK GRANIČAR','Slav. Šamac', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK PERKOVCI','Stari Perkovci', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK DILJ','Klokočevik', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK SLAVONIJA','Prnjavor', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK GARDUN','Garčin', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK SLOGA','Vrpolje', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK MLADOST','Donja Bebrina', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK MLADOST','Čajkovci', 'Sibinj', 'Plava', 'Žuta', 3),
(null,'NK BONK','Bebrina', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK SLOBODNICA','Slobodnica', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK BUDAINKA','Kolonija', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK SLAVONAC','Brodski Stupnik', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK TOMICA','Tomica', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK GRANIČAR','Klakar', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK PODCRKAVLJE','Podcrkavlje', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK SVJETLOST','Lužani', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK PODVINJE','Podvinje', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK ZDENAC','Brodski Zdenac', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK POSAVAC','Ruščica', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK MV-CROATIA 1976','SL. Brod', 'Sibinj', 'Plava', 'Žuta', 4),
(null,'NK MLADOST','Malino', 'Pdaa', 'Plava', 'Žuta', 4);
insert into igrac(sifra, broj_registracije, oib, ime, prezime, datum_rodjenja, mjesto_rodjenja, drzavljanstvo, broj_golova, klub) values
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 555, 51000805082, 'Ivo', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 1),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Ivica', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 2),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 557, 51000805084, 'Marino', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 4),
(null, 5577, 51000805084, 'Marin', 'Marić', '1995-04-09', 'Osijek','Hrvatsko', 0, 3);

insert into utakmica(sifra, mjesto, pocetak, kolo, sudac, delegat, domacin, gost, liga) values
(null, 'Jaruge', '2019-05-01 16:00:00',1, 1, 1, 1, 2, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 2, 2, 3, 4, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 3, 3, 5, 6, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 1, 1, 7, 8, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 2, 2, 9, 10, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 3, 3, 11, 12, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 1, 1, 13, 14, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 2, 2, 14, 3, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 3, 3, 2, 4, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 1, 1, 5, 7, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 2, 2, 6, 8, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 3, 3, 9, 11, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 1, 2, 10, 12, 1),
(null, 'Jaruge', '2019-05-08 16:00:00',2, 2, 3, 13, 1, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 3, 1, 14, 4, 1),
(null, 'Jaruge','2019-05-15 16:00:00',3, 1, 2, 1, 5, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 2, 3, 2, 6, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 3, 1, 3, 7, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 1, 2, 11, 8, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 2, 3, 12, 9, 1),
(null, 'Jaruge', '2019-05-15 16:00:00',3, 3, 1, 13, 10, 1),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 1, 1, 15, 16, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 2, 2, 17, 18, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 3, 3, 19, 20, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 1, 1, 21, 22, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 2, 2, 23, 24, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',1, 3, 3, 25, 26, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 3, 3, 15, 26, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 1, 1, 16, 25, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 2, 2, 17, 24, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 3, 3, 18, 23, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 1, 2, 19, 22, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',2, 2, 3, 20, 21, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 3, 1, 16, 26, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 1, 2, 17, 25, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 2, 3, 18, 24, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 3, 1, 19, 23, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 1, 2, 20, 22, 2),
(null, 'Jaruge', '2019-05-01 16:00:00',3, 2, 3, 15, 21, 2);





