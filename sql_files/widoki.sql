#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Dostawy_Widok AS 
SELECT Dostawy.ID_dostawy, Dostawcy.nazwa, Dostawcy.telefon, Dostawcy.email, Dostawy.rejestracja_samochodu, Pracownicy.nazwisko, Pracownicy.imie, Dostawy.data_dostawy FROM Dostawy, 
Dostawcy, Pracownicy WHERE Dostawy.ID_pracownika=Pracownicy.ID_pracownika AND Dostawy.ID_dostawcy=Dostawcy.ID_dostawcy;
#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Stali_Klienci_Widok AS SELECT Klienci.ID_klienta, Klienci.nazwisko, Klienci.imie, Klienci.telefon, Adresy.kraj, Adresy.miasto, Adresy.ulica, Adresy.nr_domu, Adresy.nr_mieszkania 
FROM Klienci, Adresy 
WHERE Klienci.ID_adresu=Adresy.ID_adresu AND Klienci.ID_klienta IN 
(SELECT ID_klienta FROM Faktury GROUP BY ID_klienta HAVING COUNT(ID_klienta)>2);
#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Najgorszy_Sprzedawca_Widok AS SELECT Pracownicy.ID_pracownika, Pracownicy.nazwisko, Pracownicy.imie, Pracownicy.telefon, Pracownicy.wyplata, Adresy.miasto, Adresy.ulica, Adresy.nr_domu, Adresy.nr_mieszkania 
FROM Pracownicy, Adresy 
WHERE Pracownicy.stanowisko='Ekspedient' AND Pracownicy.ID_adresu=Adresy.ID_adresu AND Pracownicy.ID_pracownika IN 
(SELECT ID_pracownika FROM Paragony GROUP BY ID_pracownika HAVING COUNT(ID_pracownika)<5) LIMIT 1;
#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Najwiecej_Sprzedanych_Widok AS
SELECT DISTINCT Towary.nazwa, Towary.cena, Towary.rodzaj, Towary.opis FROM Towary, ZleceniaTowary zt, Zlecenia WHERE zt.ID_zlecenia=Zlecenia.ID_zlecenia AND zt.ID_towaru=Towary.ID_towaru AND Zlecenia.data_zlecenia>CURRENT_DATE-8 AND Zlecenia.data_zlecenia<CURRENT_DATE+1 AND Towary.ID_towaru IN (SELECT ID_towaru FROM ZleceniaTowary GROUP BY ID_towaru HAVING COUNT(ID_towaru)>3) ORDER BY Towary.cena DESC;
#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Srednie_Wyplaty_Widok AS SELECT Pracownicy.stanowisko, TRUNCATE(AVG(Pracownicy.wyplata),2) AS srednia FROM Pracownicy GROUP BY Pracownicy.stanowisko ORDER BY srednia ASC;
#-----------------------------------------------------------------------------------------------------------------
CREATE VIEW Zagraniczni_Klienci_Widok AS
SELECT Klienci.imie, Klienci.nazwisko, Klienci.telefon, Adresy.kraj, Adresy.miasto, Adresy.ulica, Adresy.nr_domu,Adresy.nr_mieszkania FROM Klienci, Adresy WHERE Klienci.ID_adresu=Adresy.ID_adresu AND Adresy.kraj!='Polska';



