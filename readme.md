Codeigniter 3.11, PHP version 7.4.21

1. 
Priadná knižnica ION_AUTH
V controllery Auth.php  v metóde create_user pridaný generovanie unikátneho čísla UniqueRandomNumbersWithinRange(16) ktorá sa spusti ak prebehne validácia vytvorenie usera.
Povolil som registráciu.
Keď sa do  metódy pridá ako druhý argument True tak  bude generovať aj písmená, defeaultne generuje len čisla. Prvý argument je dĺzka čísel.
Metóda na vytvorenie tokenu je v helpers/general_helper.php

zmenený login pomocou unique number $config['identity']    = 'unique_number';   v thir_party/ion_aut/config/ion_auth.php
pre prihlásenie si treba z DB z tabulky user  skopirovať unique_number.

2. 
Vytvorený view create_card.php 
inputy readonly, okrem Mena ktoré treba zadať, ostantné vygeneruje po stlačení na button random generate.
v controllery som nastavil aby kazda karta mala defaulte 2000e kvoli testovaniu. 
Pridaná kontrola ak karta už existuje .


3. 
- Zobrazenie všetkých kariet s maskovaním čísla karty. Metóda na maskovanie je v general_helper.php . 1 argumet čišlo karty, 2 argument maskovanie od začiatku, 3 argument maskovanie od konca. 4 argumenent znaky ktorý mi bude maskovať default XXX


- Pridaný button ktorý cez ajax získa čišlo karty, cvv, expiration, a odmaskuje ju.
Zobrazenie Čísla,cvv,expiration karty, cez ajax odošle id  a získa z DB údaje

4. Transakcie 
- Spravil som to že v zozname všetkých kariet sa stlačí ktorou kartou chcete platiť. presmesuje 
bude tam na výber select s ostatnými kartami, kde sa vyberie karta jquery vypíše info danej karty (niektore údaje by tam nemali byť zobrazené (suma, CVV..), dal som to tam len aby bolo vidno že prebehne platba ).


ked sa odošle transakcia 
JS
- vypýta CVV skontroluje či sedí s CVV karty
- dalej skontroluje či nebola odosielaná  suma menšia alebo rovná  0 ale nie väčšia ako je stav účtu. 

PHP
- depositOrwithdraw metoda ma 3 agrumenty: 1.ID, 2.SUMA, 3. strhnuť alebo pripočítať na účet. 
- po kontrole či je dostatok penazí na účte,  prebehne strhnutie z učtu,  ak vráti id, tak uloží peniaze na účet príjemcu, inak vráti false.

5. activity log 
Pridal som log_model.php
loguje do DB uspené aj neuspené prihlásenie, transakcie, či bolo dosť penazí na učte, create user, create card, ak karta už existuje.
Pridané aj view activity_log.php, je tam zobrazený celkový počet logov, daju sa tam vyfiltrovať podla typu logu, auth, transaction, card

6. 
Front end celkovo mám nič moc. Zameriaval som sa hlavne na backend v tomto zadaní.
