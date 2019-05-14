# ADATMODELL
A táblaszerkezet mindenképpen két fő egységből áll. Felhasználó kezelés és a logika táblái. Semmiképp nem keveredhetnek a továbbiakban kialakítandó funkciók integritásának megőrzése érdekében.
# JOGOK
## 1. lehetőség
Az általában megszokott 3 rétegű jogosultsági rendszert követjük: vendég, regisztrált felhasználó, admin.
Regisztrált felhasználót flag-elni szükséges, miszerint tanár-e, vagy diák. (A "mindkettő" esetet zárjuk ki első körben)
Az egyes funkciók elérhetősége ezen szerepkörök szerint oszlik meg. - feladatspecifikusan a funkciók eltérők lehetnek. Konkretizálás csak adott feladat mellett való döntés idején esedékes.
## 2. lehetőség
Alapvetően két típust különböztetünkmeg: vendég és felhasználó (session változóban tárolt adatokkal)
A felhasználókat egy RBAC (hierarchikus jogosultság rendszer) különbözteti meg
Minden regisztrált felhasználó megkapja a diák jogosultságot
Az adminisztrátorok tudnak adni tanár és admin jogokat
Egy felhasználóhoz csak egy jogosultásg tartozik. Ha több lenne, a legerősebb az érvényes, de jogosultság módosításakor minden korábbi kapcsolatot törlünk az adatbázisból
# ADMINISZTRÁTORI SZEREPKÖR
Az adminisztrátor a 0. körben a későbbiekben automatizálható feladatokat látja el, úgymint felhasználó regisztrálás, felhasználó szerkesztés, jogosultságok beállítása, felhasználó törlés.
A későbbikben ezen funkciók jó része nem manuálisan fog történni, ennek kidolgozása és mértéke megrendelői igénytől függ, amely egyeztetést kíván.
# A PONTOS FUNKCIÓK, AMIKET ELSŐ KÖRBEN MEGVALÓSÍTUNK
## Adminisztrátori funkciók
- Felhasználó regisztrálás. Első körben ez nem is olyan fontos, mert a felhasználók maguk is regisztrálhatnak. Ennek ellenére célszerű megvalósítani.
- Felhasználó szerkesztés. Ezt át kell gondolni, hogy mit szerkeszthet az adminisztrátor. Első körben szintén nem fontos funkció.
- Jogosultság beállítás. Az adminisztrátornak be kell tudnia állítani a jogosultságokat a felhasználókhoz. Csak az adminisztrátor adhat vagy vehet el tanári jogosultságot.
- Felhasználó törlés. Ez is kérdéses, hogy adminisztrátori jogkörbe tartozik-e. Elsődlegesen minden felhasználónak tudnia kéne törölnie magát. Ennek ellenére első körben itt valósítjuk meg.
## Felhasználó
- Kijelentkezés
### Tanári jogosultsággal rendelkező felhasználók
- Feladat feltöltés. Még egyeztetés alatt.
- Feladatokhoz megoldások feltöltése. Egyeztetés alatt.
### Tanári és diák jogosultsággal rendelkező felhasználók
- Feladat megjelenítése. Egyeztetés alatt.
## Vendég felhasználó
- Információs főoldal. Röviden leírja, hogy ki milyen szolgáltatást nyújt ez az oldal
- Regisztráció. Minden vendégnek joga van tanulóként regisztrálni. Tanári jogkört csak az adminisztrátor adhat.
- Bejelentkezés. Első körben mindenki vendégként van nyilvántartva, de a regisztráltak itt beléphetnek.
### Megjegyzés
Ha a Jogok menüpontból a második lehetőséget választjuk, akkor a felhasználó jog = diák jog
