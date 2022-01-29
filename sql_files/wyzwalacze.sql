#------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER data_zlec_wyzwalacz
BEFORE INSERT ON Zlecenia
FOR EACH ROW 
SET NEW.data_zlecenia=now();
#------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER data_wystFakt_wyzwalacz
BEFORE INSERT ON Faktury
FOR EACH ROW 
SET NEW.data_wystawienia=now();
#------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER data_wystPara_wyzwalacz
BEFORE INSERT ON Paragony
FOR EACH ROW 
SET NEW.data_wystawienia=now();
#------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER Faktury_U_wyzwalacz
BEFORE UPDATE ON Faktury
FOR EACH ROW 
SIGNAL SQLSTATE VALUE '99999'
SET MESSAGE_TEXT = 'Nie mozna edytowac Faktur';
#------------------------------------------------------------------------------------------------------------------
CREATE TRIGGER Paragony_U_wyzwalacz
BEFORE UPDATE ON Paragony
FOR EACH ROW 
SIGNAL SQLSTATE VALUE '99999'
SET MESSAGE_TEXT = 'Nie mozna edytowac Paragonow';
#------------------------------------------------------------------------------------------------------------------
