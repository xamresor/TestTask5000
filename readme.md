# Test Task
done by Romans Sereda
- PHP 7.3.8
- MySql 10.4.6-MariaDB
- Apache 2.4
- JQuery 3.3.1

- Sql Export File can be found in folder resources

Concept wasn't done in OOP due to: "...līdz ar to, svarīgs ir iespējami īss izstrādes laiks, bet paredzot attīstības potenciālu..."

## Concepts
The project covers these concepts:

Darba uzdevums:
- [x] Klients aizpilda pieteikuma formu. Formā ir sekojoši ievades lauki: e-pasts un summa;
- [x] Formas dati tik saglabāti datubāzes tabulā “applications”;
- [x] Ir divi partneri, kuriem nosūtīt klienta pieteikums: “A” un “B”.
“A” jāsūta pieteikumi, ja summa lielāka par 5000, “B” ja summa mazāka 5000.
- [x] Sūtīšana partnerim -nozīmē:
1. datubāzes tabulā “deals” tiek izveidots ieraksts, kurā tiek pieglabāts kurš pieteikums nosūtīts
kuram partnerim;
2. partnerim tiek nosūtīts e-pasts;
- [x] Katram šādam ierakstam (turpmāk sauksim – dīls) ir statuss: “ask” vai “offer”. Pēc noklusējuma –
“ask”.
- [x] Nomainot dīla statusu uz “offer”, klientam tiek nosūtīts e-pasts.
Ņemiet vēra, ka uzdevumā nav precizēts kas un kā dīla statusu noma, šeit jāparedz vien mehānisms, kā
var nodemonstrēt šo funkcionalitāti.
Svarīgi!
- [x] Pievērsiet uzmanību prototipa arhitektūrai, programmēšanas paterniem, koda atbilstībai
programmēšanas un noformēšanas standartiem;
- [x] Prototipam nav autorizācijas, bet ir datu ievades forma;
- [x] Kļūdu apstrāde;
- [x] Šis ir prototips, līdz ar to, svarīgs ir iespējami īss izstrādes laiks, bet paredzot attīstības potenciālu
nākotnē.
Nav svarīgi:
- [x]Komponentes drīkst pilnībā neizstrādāt; svarīgi ir ilustrēt, ko konkrētā komponente/metode
darīs un kāds būs tās rezultāts; Šo klātienes intervijā būs iespēja izvērstāk izstāstīt;
- [x]E-pasta sūtīšanas mehānisms drīkst aprobežoties ar tukšu metodi, kura neko nesūta;
- [x]Ievades formai jābūt vizuāli saprotamai, frontend izpildījums nav svarīgs.

### requested ConceptsTechnologies to be used:
- Linux
- Apache 2.4
- PHP 7.3
- MariaDB 10.3
