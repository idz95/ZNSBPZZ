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
trajanje int,
domacin_score int,
gost_score int,
opis text(500),
sudac int not null,
delegat int not null,
domacin int not null,
gost int not null,
izvjestaj int not null,
dogadaj int not null,
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
liga varchar(20) not null
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
	liga varchar(20) not null
);

create table klub(
 sifra int not null primary key auto_increment,
 naziv_kluba varchar(20) NOT NULL,
 mjesto varchar(20) not null,
 naziv_stadiona varchar(20) not null,
 boja_dresa_domaca varchar(20) not null,
boja_dresa_gost varchar(20) not null
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

create table dogadaj(
 sifra int not null primary key auto_increment,
 vrsta_dogadaj varchar(20) not null,
 minuta int not null,
 opis text(500)
 );
 
 create table izvjestaj(
  sifra int not null primary key auto_increment,
  opis_utakmice text(500) not null
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
alter table utakmica add foreign key (izvjestaj) references izvjestaj(sifra);
alter table utakmica add foreign key (dogadaj) references dogadaj(sifra);
alter table igrac add foreign key (klub) references klub(sifra);

insert into klub(sifra, naziv_kluba, mjesto, naziv_stadiona, boja_dresa_domaca, boja_dresa_gost) values
(null,'NK SLOGA','Jaruge', 'Stari Hrast', 'Plava', 'Žuta'),
(null,'NK SLOGA','Vrpolje', 'Random', 'Plava', 'Žuta'),
(null,'NK Raketa','Bervaci', 'mrtvi', 'Plava', 'Žuta'),
(null,'NK SLOGA','Gundinci', 'Stari Hrast', 'Plava', 'Žuta');

insert into igrac(sifra, broj_registracije, oib, ime, prezime, datum_rodjenja, mjesto_rodjenja, drzavljanstvo, broj_golova, klub) values
(null, 555, 51000805082, 'Ivo', 'Marić', 1995-04-09, 'Osijek','Hrvatsko', 0, 1),
(null, 557, 51000805084, 'Ivica', 'Marić', 1995-06-09, 'Osijek','Hrvatsko', 0, 2),
(null, 5577, 51000805084, 'Marin', 'Marić', 1995-01-19, 'Osijek','Hrvatsko', 0, 3);

insert into admin(sifra, ime, prezime,email, lozinka,uloga) values
(null, 'Admin', 'Džambo', 'admin@hns.hr',md5('ivica'), 'admin');

insert into sudac(sifra, ime, prezime, email, lozinka, datum_rodjenja, mjesto, mobitel, liga) values
(null, 'Ivo', 'Marić', 'ivom@hns.hr', md5('sudac'), 1995-04-09, 'Vrpolje','095 856 7600','1.ŽNL'),
(null, 'Ante', 'Marjanović', 'antem@hns.hr', md5('sudac'), 1995-05-09, 'Jaruge','095 856 7600','2.ŽNL'),
(null, 'Lovro', 'Marić', 'lovrom@hns.hr', md5('sudac'), 1993-04-09, 'Bervaci','095 856 7600','1.ŽNL');

insert into delegat(sifra, ime, prezime, email, lozinka, datum_rodjenja, mjesto, mobitel, liga) values
(null, 'Ivo', 'Marić', 'ivom@hns.hr', md5('sudac'), 1995-04-09, 'Vrpolje','095 856 7600','1.ŽNL'),
(null, 'Ante', 'Marjanović', 'antem@hns.hr', md5('sudac'), 1995-05-09, 'Jaruge','095 856 7600','2.ŽNL'),
(null, 'Karlo', 'Marić', 'lovrom@hns.hr', md5('sudac'), 1993-04-09, 'Bervaci','095 856 7600','1.ŽNL');
