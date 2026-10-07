# Domáca knižnica

Nikola Verbová

5ZYI31

## Stručný opis projektu
Domáca knižnica je webová aplikácia na evidenciu a správu domácej knižnice. Knihy budú organizované podľa miestností a políc, napríklad obývačka, spálňa alebo detská izba.

Aplikácia bude obsahovať verejnú aj prihlásenú časť. Bez prihlásenia bude možné prezerať a filtrovať všetky knihy. Po prihlásení bude používateľ môcť podľa svojich oprávnení spravovať knihy, hodnotiť ich a vypožičiavať si ich na prečítanie.

## Role v projekte
### Návštevník
- môže prezerať všetky knihy,
- môže knihy vyhľadávať a filtrovať,
- môže prejsť na prihlasovaciu stránku.
### Používateľ
- môže spravovať svoje miestnosti a police,
- môže pridávať, upravovať a mazať knihy v miestnostiach, ku ktorým má oprávnenie,
- môže hodnotiť knihy,
- môže si vypožičiavať a vracať knihy.
### Administrátor
- má rozšírené oprávnenia na správu používateľov a údajov aplikácie.

## Prípady použitia podľa rolí
### Návštevník
- zobrazí zoznam kníh,
- vyhľadá knihu,
- zaregistruje sa alebo prihlási.
### Používateľ
- spravuje police,
- pridá, upraví alebo odstráni knihu z miestnosti,
- ohodnotí knihu,
- upraví alebo odstráni svoje hodnotenie,
- vypožičia si dostupnú knihu,
- vráti vypožičanú knihu.
### Administrátor
- spravuje používateľov a ich oprávnenia,
- vytvorí, upraví alebo odstráni miestnosť,
- nastaví oprávnenia pre miestnosti,
- spravuje ostatné údaje aplikácie.

## Plánované entity
### User
- Používateľ aplikácie. Obsahuje prihlasovacie údaje, rolu používateľa a oprávnenia.
### Room
- Miestnosť, v ktorej sa nachádzajú knihy. Patrí používateľovi.
### Shelf
- Polica patriaca konkrétnej miestnosti.
### Book
- Kniha, ktorá má názov, autora, ISBN, rok vydania, umiestnenie(môže byť nezaradená), stav vypožičania a žáner.
### Review
- Súkromné hodnotenie knihy používateľom.
### Borrowing
- Informácia o vypožičaní knihy používateľom.


## Vzťahy medzi entitami
Stručne popíšte najdôležitejšie väzby medzi jednotlivými entitami, napríklad vzťahy 1:1, 1:N alebo M:N. Z opisu by malo byť zrejmé, ako spolu jednotlivé časti dátového modelu súvisia.
Hlavné vzťahy:

- User:Room 1:N = používateľ spravuje miestnosti
- Room:Shelf 1:N, Shelf:Book 1:N = v miestnosti sú police na ktorých sú usporiadané knihy
- User:Book M:N = Asociačná tabuľka = Borrowing, kniha je vypožičaná rôznymi osobami, takisto osoba si vie vypožičať viacero kníh)
- User:Review 1:N = užívateľ môže hodnotiť knihy
- Book:Review 1:N = kniha má rôzne hodnotenia

## Hlavné stránky aplikácie
- Úvodná stránka – základné informácie o aplikácii.
- Katalóg kníh – verejné zobrazenie a filtrovanie kníh.
- Prihlásenie / registrácia – autentifikácia používateľov.
- Dashboard – prehľad po prihlásení.
- Moje miestnosti – správa miestností a políc.
- Správa kníh – vytváranie, úprava a mazanie kníh.
- Moje vypožičané knihy – prehľad vypožičaných kníh.
- Moje hodnotenia – správa vlastných hodnotení.
- Administrácia – správa aplikácie administrátorom.

## Rozdelenie funkcionality

### Základná funkcionalita
- registrácia a prihlasovanie používateľov,
- používateľské role a autorizácia,
- verejné zobrazenie kníh,
- vyhľadávanie a filtrovanie kníh,
- správa miestností a políc,
- hodnotenie kníh,
- vypožičiavanie a vracanie kníh,
- bezpečné ukladanie hesiel.

### Rozširujúca funkcionalita

Podľa časových možností môže byť aplikácia rozšírená napríklad o:

- rozšírenie informácii o knihách o žáner
- import/export kníh do CSV
- časové obmedzenia na výpožičiavanie kníh