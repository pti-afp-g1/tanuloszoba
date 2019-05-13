# ADATMODELL
A táblaszerkezet mindenképpen két fő egységből áll. Felhasználó kezelés és a logika táblái. Semmiképp nem keveredhetnek a továbbiakban kialakítandó funkciók integritásának megőrzése érdekében.
# JOGOK
Az általában megszokott 3 rétegű jogosultsági rendszert követjük: vendég, regisztrált felhasználó, admin.
Regisztrált felhasználót flag-elni szükséges, miszerint tanár-e, vagy diák. (A "mindkettő" esetet zárjuk ki első körben)
Az egyes funkciók elérhetősége ezen szerepkörök szerint oszlik meg. - feladatspecifikusan a funkciók eltérők lehetnek. Konkretizálás csak adott feladat mellett való döntés idején esedékes.
