#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Adresy (
  ID_adresu int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  kraj varchar(20) NOT NULL,
  miasto varchar(30) NOT NULL,
  kod_pocztowy varchar(6) NOT NULL,
  ulica varchar(50) NOT NULL,
  nr_domu varchar(5) NOT NULL,
  nr_mieszkania int(5) DEFAULT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Dostawcy (
  ID_dostawcy int(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(50) NOT NULL,
  ID_adresu int(3) UNSIGNED NOT NULL,
  telefon varchar(12) NOT NULL,
  email varchar(30) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Dostawy (
  ID_dostawy int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_dostawcy int(2) UNSIGNED NOT NULL,
  rejestracja_samochodu varchar(10) NOT NULL,
  data_dostawy date NOT NULL,
  ID_pracownika int(3) UNSIGNED NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Faktury (
  nr_faktury int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data_wystawienia date DEFAULT NULL,
  ID_zlecenia int(4) UNSIGNED DEFAULT NULL,
  ID_klienta int(3) UNSIGNED DEFAULT NULL,
  ID_pracownika int(3) UNSIGNED DEFAULT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Klienci (
  ID_klienta int(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwisko varchar(40) NOT NULL,
  imie varchar(30) NOT NULL,
  telefon varchar(12) NOT NULL,
  nr_rachunku varchar(26) NOT NULL,
  ID_adresu int(3) UNSIGNED NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Paliwa (
  ID_paliwa int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(20) NOT NULL,
  cena_litr double(3,2) NOT NULL,
  rodzaj varchar(15) NOT NULL,
  opis varchar(100) DEFAULT NULL,
  vat int(2) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Paragony (
  nr_paragonu int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data_wystawienia date DEFAULT NULL,
  ID_zlecenia int(4) UNSIGNED DEFAULT NULL,
  ID_pracownika int(3) UNSIGNED DEFAULT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Pracownicy (
  ID_pracownika int(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwisko varchar(40) NOT NULL,
  imie varchar(30) NOT NULL,
  stanowisko varchar(30) NOT NULL,
  telefon varchar(12) NOT NULL,
  wyplata double(7,2) NOT NULL,
  nr_rachunku varchar(26) NOT NULL,
  ID_adresu int(3) UNSIGNED NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Towary (
  ID_towaru int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(35) NOT NULL,
  cena double(4,2) NOT NULL,
  rodzaj varchar(25) NOT NULL,
  kod varchar(12) NOT NULL,
  opis varchar(100) DEFAULT NULL,
  vat int(2) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Uslugi (
  ID_uslugi int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(30) NOT NULL,
  cena double(4,2) NOT NULL,
  opis varchar(100) DEFAULT NULL,
  vat int(2) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE Zlecenia (
  ID_zlecenia int(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data_zlecenia date DEFAULT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE ZleceniaPaliwa (
  ID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_zlecenia int(4) UNSIGNED NOT NULL,
  ID_paliwa int(2) UNSIGNED NOT NULL,
  ilosc double(6,2) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE ZleceniaTowary (
  ID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_zlecenia int(4) UNSIGNED NOT NULL,
  ID_towaru int(2) UNSIGNED NOT NULL,
  ilosc int(3) NOT NULL
);
#------------------------------------------------------------------------------------------------------------------
CREATE TABLE ZleceniaUslugi (
  ID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_zlecenia int(4) UNSIGNED NOT NULL,
  ID_uslugi int(2) UNSIGNED NOT NULL,
  ilosc int(3) NOT NULL
);
#--KLUCZE-OBCE----------------------------------------------------------------------------------------------
ALTER TABLE Dostawcy
  ADD CONSTRAINT FK_adresy_dostawcy FOREIGN KEY (ID_adresu) REFERENCES Adresy (ID_adresu);

ALTER TABLE Dostawy
  ADD CONSTRAINT FK_dostawy_dostawcy FOREIGN KEY (ID_dostawcy) REFERENCES Dostawcy (ID_dostawcy),
  ADD CONSTRAINT FK_dostawy_pracownicy FOREIGN KEY (ID_pracownika) REFERENCES Pracownicy (ID_pracownika);

ALTER TABLE Faktury
  ADD CONSTRAINT FK_faktury_klienci FOREIGN KEY (ID_klienta) REFERENCES Klienci (ID_klienta) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_faktury_pracownicy FOREIGN KEY (ID_pracownika) REFERENCES Pracownicy (ID_pracownika) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_zlecenia_faktury FOREIGN KEY (ID_zlecenia) REFERENCES Zlecenia (ID_zlecenia) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE Klienci
  ADD CONSTRAINT FK_adresy_klienci FOREIGN KEY (ID_adresu) REFERENCES Adresy (ID_adresu);

ALTER TABLE Paragony
  ADD CONSTRAINT FK_paragony_pracownicy FOREIGN KEY (ID_pracownika) REFERENCES Pracownicy (ID_pracownika) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_paragony_zlecenia FOREIGN KEY (ID_zlecenia) REFERENCES Zlecenia (ID_zlecenia) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE Pracownicy
  ADD CONSTRAINT FK_adresy_pracownicy FOREIGN KEY (ID_adresu) REFERENCES Adresy (ID_adresu);

ALTER TABLE ZleceniaPaliwa
  ADD CONSTRAINT FK_zlec_pal_1 FOREIGN KEY (ID_paliwa) REFERENCES Paliwa (ID_paliwa),
  ADD CONSTRAINT FK_zlec_pal_2 FOREIGN KEY (ID_zlecenia) REFERENCES Zlecenia (ID_zlecenia) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ZleceniaTowary
  ADD CONSTRAINT FK_zlec_tow_1 FOREIGN KEY (ID_towaru) REFERENCES Towary (ID_towaru),
  ADD CONSTRAINT FK_zlec_tow_2 FOREIGN KEY (ID_zlecenia) REFERENCES Zlecenia (ID_zlecenia) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE ZleceniaUslugi
  ADD CONSTRAINT FK_zlec_usl_1 FOREIGN KEY (ID_uslugi) REFERENCES Uslugi (ID_uslugi),
  ADD CONSTRAINT FK_zlec_usl_2 FOREIGN KEY (ID_zlecenia) REFERENCES Zlecenia (ID_zlecenia) ON DELETE CASCADE ON UPDATE CASCADE;