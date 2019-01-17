create database if not exists verkkokauppa;

use verkkokauppa;

create table tuoteryhma (
    id int primary key auto_increment,
    nimi varchar(50) unique not null
);

create table tuote (
    id int primary key auto_increment,
    nimi varchar(100) not null,
    hinta double not null,
    tuoteryhma_id int not null,
    index (tuoteryhma_id),
    foreign key (tuoteryhma_id) references tuoteryhma(id),
    Kuva varchar(100),
    on delete restrict
);

create table resepti (
    id int primary key auto_increment,
    nimi varchar(100) not null
    
);

create table ainesosa (
    tuote_id int not null,
    index (tuote_id),
    foreign key (tuote_id) references tuote(id),
    maara varchar(50),
    resepti_id int not null,
    index (resepti_id),
    foreign key (resepti_id) references resepti(id)
     
);


create table asiakas (
    id int primary key auto_increment,
    sukunimi varchar(100) not null,
    etunimi varchar(100) not null
);

create table tilaus (
    id int primary key auto_increment,
    tilattu timestamp default current_timestamp,
    asiakas_id int not null,
    index (asiakas_id),
    foreign key (asiakas_id) references asiakas(id)
    on delete restrict
);



create table tilausrivi (
    tuote_id int not null,
    index (tuote_id),
    foreign key (tuote_id) references tuote(id)
    on delete restrict,
    tilaus_id int not null,
    index (tilaus_id),
    foreign key (tilaus_id) references tilaus(id)
    on delete restrict
);

create table kayttaja (
    id int primary key auto_increment,
    tunnus varchar(50) not null,
    salasana varchar(255) not null
);

insert into tuoteryhma (nimi) value ('HeVi');
insert into tuoteryhma (nimi) value ('Liha');
insert into tuoteryhma (nimi) value ('Kala');
insert into tuoteryhma (nimi) value ('Juusto,munat');
insert into tuoteryhma (nimi) value ('Maito');
insert into tuoteryhma (nimi) value ('Kuiva-aine');
insert into tuoteryhma (nimi) value ('Valmisruoka');
insert into tuoteryhma (nimi) value ('Leivonta ja mausteet');
insert into tuoteryhma (nimi) value ('Pakasteet');

insert into tuote (nimi,hinta,tuoteryhma_id, kuva) values ('porkkana',1.50,1, 'porkkana.jpg');
insert into tuote (nimi,hinta,tuoteryhma_id, kuva) values ('jauheliha',8,2,'jauheliha.jpg');
insert into tuote (nimi,hinta,tuoteryhma_id, kuva) values ('lohi',14,3,'lohi.jpg');
insert into tuote (nimi,hinta,tuoteryhma_id, kuva) values ('Oltermanni-juusto',8, 4, 'oltermanni.jpg');

<!--Tähän reseptissä tarvittavat ainesosat ja määrät -->
insert into ainesosa (tuote_id, maara, resepti_id) values(3, '1kpl ruodoton filee', 1);
insert into ainesosa (tuote_id, maara, resepti_id) values(5, '400 g', 1);
insert into ainesosa (tuote_id, maara, resepti_id) values(1, '500 g', 1);

insert into kayttaja (tunnus,salasana) values ('kissaihmiset',md5('kissat'));

<!-- Uusi resepti tietokantaan -->
insert into resepti(nimi, ohje, kuva, ravintoarvot) values ('Uunilohi satokauden vihanneksilla','Kuumenna uuni 180 asteeseen. Pese ruusukaalit ja porkkanat. Voit kuoria porkkanat halutessasi. Halkaise ruusukaalit, pilko porkkanat noin 2 cm kokoisiksi paloiksi. Lado vihannekset uunivuokaan, lorauta päälle öljyä ja mausta ripauksella suolaa. Anna kypsyä 25 minuuttia. Irrota lohifileestä nahka, mausta suolalla ja mustapippurilla. Lisää uunivuokaan ja anna kypsyä vielä 20 minuuttia. Sekoita kastikkeet ainesosat yhteen, tarjoile lohen ja vihannesten kanssa.','uunilogi.jpg ', '173 kcal/724 kJ,proteiinia 15,3 g, hiilihydraatteja 1,67 g, rasvaa 11,7 g' ) ;



<!--käytä näitä jos haluat päivittää jo tietokannassa olevaa reseptiä -->
update resepti set kuva='uunilohi.jpg' where id=1;
update resepti set ohje='' where id=1;












