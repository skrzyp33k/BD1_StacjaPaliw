DELIMITER $$
CREATE PROCEDURE `EmaileDostawcow` ()  BEGIN
DECLARE koniec int default 0;
DECLARE c_nazwa varchar(50);
DECLARE c_email varchar(30);
DECLARE emaildostawcow CURSOR FOR SELECT Dostawcy.nazwa, Dostawcy.email FROM Dostawcy;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET koniec=1;
DROP TEMPORARY TABLE IF EXISTS tmp; 
CREATE TEMPORARY TABLE tmp(
nazwa varchar(50),
email varchar(30)
);
OPEN emaildostawcow;
petla: LOOP
FETCH emaildostawcow INTO c_nazwa, c_email;
IF koniec = 1 THEN

LEAVE petla;
END IF;
INSERT INTO tmp VALUES (c_nazwa, c_email);
END LOOP petla;
CLOSE emaildostawcow;
SELECT * FROM tmp;
DROP TEMPORARY TABLE IF EXISTS tmp; 
END$$

CREATE PROCEDURE `KlienciTankujacyWybierz` (IN `rodzaj` VARCHAR(15))  BEGIN
DECLARE koniec int default 0;
DECLARE c_imie varchar(30);
DECLARE c_nazwisko varchar(40);
DECLARE c_nazwa varchar(20);
DECLARE kliencitankujacywybierz CURSOR FOR SELECT Klienci.imie, Klienci.nazwisko, Paliwa.nazwa FROM Klienci,Faktury,Zlecenia,ZleceniaPaliwa,Paliwa WHERE Klienci.ID_klienta = Faktury.ID_klienta AND Zlecenia.ID_zlecenia = Faktury.ID_zlecenia AND Zlecenia.ID_zlecenia = ZleceniaPaliwa.ID_zlecenia AND Paliwa.ID_paliwa = ZleceniaPaliwa.ID_paliwa AND Paliwa.rodzaj = rodzaj;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET koniec=1;
DROP TEMPORARY TABLE IF EXISTS tmp; 
CREATE TEMPORARY TABLE tmp(
c_imie varchar(30),
c_nazwisko varchar(40),
c_nazwa varchar(20)
);
OPEN kliencitankujacywybierz;
petla: LOOP
FETCH kliencitankujacywybierz INTO c_imie, c_nazwisko, c_nazwa;
IF koniec = 1 THEN

LEAVE petla;
END IF;
INSERT INTO tmp VALUES(c_imie, c_nazwisko, c_nazwa);
END LOOP petla;
CLOSE kliencitankujacywybierz;
SELECT * FROM tmp;
DROP TEMPORARY TABLE IF EXISTS tmp; 
END$$

CREATE PROCEDURE `PracownicyzWarszawy` ()  BEGIN
DECLARE koniec int default 0;
DECLARE c_nazwisko varchar(40);
DECLARE c_imie varchar(30);
DECLARE c_stanowisko varchar(30);
DECLARE pracownicyzwarszawy CURSOR FOR SELECT Pracownicy.imie, Pracownicy.nazwisko, Pracownicy.stanowisko FROM  Pracownicy, Adresy WHERE Pracownicy.ID_adresu = Adresy.ID_adresu AND Adresy.miasto = "Warszawa";
DECLARE CONTINUE HANDLER FOR NOT FOUND SET koniec=1;
DROP TEMPORARY TABLE IF EXISTS tmp; 
CREATE TEMPORARY TABLE tmp(
nazwisko varchar(40),
imie varchar(30),
stanowisko varchar(30)
);
OPEN pracownicyzwarszawy;
petla: LOOP
FETCH pracownicyzwarszawy INTO c_imie, c_nazwisko, c_stanowisko;
IF koniec = 1 THEN

LEAVE petla;
END IF;
INSERT INTO tmp VALUES(c_nazwisko,c_imie,c_stanowisko);
END LOOP petla;
CLOSE pracownicyzwarszawy;
SELECT * FROM tmp;
DROP TEMPORARY TABLE IF EXISTS tmp; 
END$$

CREATE PROCEDURE `SprzedazTowarowNaParagon` ()  BEGIN
DECLARE koniec int default 0;
DECLARE c_nazwisko varchar(40);
DECLARE c_imie varchar(30);
DECLARE c_stanowisko varchar(30);
DECLARE c_nazwa varchar(35);
DECLARE towarynaparagon CURSOR FOR SELECT
Pracownicy.nazwisko,Pracownicy.imie,Pracownicy.stanowisko,Towary.nazwa
FROM Pracownicy,Paragony,Zlecenia,ZleceniaTowary,Towary WHERE Pracownicy.ID_pracownika = Paragony.ID_pracownika AND Zlecenia.ID_zlecenia = Paragony.ID_zlecenia AND
Zlecenia.ID_zlecenia = ZleceniaTowary.ID_zlecenia AND Towary.ID_towaru = ZleceniaTowary.ID_towaru;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET koniec=1;
DROP TEMPORARY TABLE IF EXISTS tmp; 
CREATE TEMPORARY TABLE tmp(
nazwisko varchar(40),
imie varchar(30),
stanowisko varchar(30),
nazwa varchar(35)
);
OPEN towarynaparagon;
petla: LOOP
FETCH towarynaparagon INTO c_nazwisko, c_imie, c_stanowisko, c_nazwa;
IF koniec = 1 THEN

LEAVE petla;
END IF;
INSERT INTO tmp VALUES(c_nazwisko,c_imie,c_stanowisko,c_nazwa);
END LOOP petla;
CLOSE towarynaparagon;
SELECT * FROM tmp;
DROP TEMPORARY TABLE IF EXISTS tmp; 
END$$

DELIMITER ;