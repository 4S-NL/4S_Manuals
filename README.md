# 4S_Handleidingen

## Situatie

Dit is een 'legacy' project van Team 4S, uit de tijd dat het bedrijf nog 3S heette (simpelweg: Script Serpents Software). De website staat al jaren online, maar trekt nog steeds veel bezoekers. Daarom heeft 4S besloten om de applicatie toch te moderniseren. Ze hebben ook besloten om daarbij een modern framework te gebruiken, en de layout aan te pakken met Bootstrap.

Jij bent een beginnend stagiair bij 4S, en je eerste klus is het oplossen van een aantal tickets in dit project. Omdat de site niet tot de 'core bussiness' van het bedrijf behoort, is dit een heel geschikt project om mee te beginnen. Onder toeziend oog mag jij laten zien wat je kunt. Je krijgt een korte uitleg over hoe dit project in elkaar zit, en vervolgens mag je zelf een aantal opdrachten gaan uitvoeren om dit project af te maken.

Je krijgt toegang tot een GIT repository, waar een Laravel applicatie in klaar staat. De werkgever gaat ervan uit dat je geen ervaring hebt met Laravel, dus je krijgt een gids meegeleverd over hoe je de applicatie draaiend krijgt op jouw systeem, en je kunt altijd vragen stellen aan je stagebegeleider (_je docent_). Daarna is het aan jou om alle tickets aan te pakken en af te ronden.

## Repo werkend krijgen

Zie hiervoor de hulpkaarten over het installeren van composer en npm, en over het opzetten van een bestaand Laravel-project.

## Uitleg Systeem

### Files

De pagina’s die aangepast moeten worden, zijn te vinden in “4s_handleidingen/resources/views”. **ELKE PAGINA** wordt opgebouwd in deze folder via “/layouts/default.blade.php”. Elke keer als je in die file een “@include” tag tegenkomt, importeert het een ander bestand van de views folder. Zo importeert “@include(‘includes.footer’)” het bestand “/views/includes/footer.blade.php”. Je ziet dus dat deze includes hetzelfde werken als mappen, maar ze gaan ervan uit dat ze altijd in de views folder moeten zijn, en in plaats van slashes (/) om dieper in folders te gaan, gebruiken ze punten (.), en het stukje “.blade.php” mogen we aan het einde weg laten. “@include(‘includes.footer’)” is dus vrijwel hetzelfde als “require_once(‘/resources/views/includes/footer.blade.php’)”

Eveneens vind je in “default.blade.php” de “@yield” tag, die samenwerkt met de “@section” tags in de bestanden die we vinden in “/resources/views/pages”. Bij het aanroepen van **ELKE** pagina op de site wordt ook **ALTIJD** een pagina uit de “/resources/views/pages” folder aangeroepen. Als we bijvoorbeeld de homepage openen, dan wordt “/resources/views/pages/homepage.blade.php” ingeladen. In de files van deze folder zie je vaak de “@section” tag terugkomen. Wat dit betekent is dat op het moment dat de pagina geladen wordt, alles wat tussen “@section” tags met een naam staat, terecht komt op de default.blade.php pagina bin de “@yield” tags met dezelfde naam.

Dus, als we de homepage laden, laad het systeem eerst “/resources/views/layouts/default.blade.php” in. Vervolgens laden we “/resources/views/pages/homepage.blade.php” in, en plaatsen we alles wat er tussen “@section(‘content)” en “@stop” staat, bij de “@yield(‘content’)” tag in default.blade.php. Dit geldt dus voor alle “@content” en “@yield” tags die je in deze bestanden vind.

Nu we dat weten, kunnen we er altijd achter komen waar het stukje HTML staat wat we aangepast willen hebben. Echter, we gaan het makkelijk houden, dus we gaan ons alleen bezighouden met de homepagina van deze site. We gaan ons dus vooral focussen op de bestanden in “/views/includes” en de bestanden “/resources/views/layouts/default.blade.php” en “/resources/views/pages/homepage.blade.php”. Vanaf week 2, gaan wij verder kijken naar de andere pages.

### CSS en NPM

Laravel maakt gebruik van Node.js om zijn js en css files te compileren. Dit is handig, omdat wij er zo voor kunnen zorgen dat wij gewoon normaal css kunnen coderen zoals we gewend zijn. Daarna, als de website online wordt gezet, maakt Node.js er een “minified” css en js bestand van. Een “minified” bestand, is een bestand met dezelfde code als die je geschreven hebt, maar dan door de computer zo klein mogelijk gemaakt zodat hij kleiner en efficiënter is voor de browser. Helaas is dat bestand dan niet meer heel erg leesbaar voor een programmeur.  Daarom gebruiken we ook Node.js om de koppeling te leggen tussen onze geschreven code, en deze minified output bestanden. Om Node te kunnen gaan gebruiken, moeten wij deze eerst installeren op onze PC (https://nodejs.org/en/, en download/installeer de LTS versie. Herstart daarna VSCode).

Als wij in de browser onze pagina’s inspecteren, merken wij dat het css bestand dat in de browser wordt aangeroepen “css/app.css” is. In ons bestandssysteem is dit “/public/css/app.css”. Het probleem is alleen dat dit bestand continu overschreven wordt door Node.js, dus het is niet de bedoeling dat wij in dit bestand gaan programmeren. In plaats daarvan gaan wij net als bij de views, naar de “resources” folder. In “/resources/sass” zien wij het bestand app.scss staan. In dit bestand kunnen wij daadwerkelijk onze css gaan schrijven. Als wij dan straks Node.js gaan uitvoeren, dan pakt Node jouw css uit dit bestand, en zet het netjes in “/public/css/app.css” neer. Zou houden we netjes jouw code, en de efficiëntere code uit elkaar.

Als wij een aanpassing doen in app.scss, zullen we zien dat de aanpassingen niet gelijk te zien zijn. Dat komt omdat wij node handmatig aan moeten roepen om deze veranderingen toe te passen in onze public folder. Open in VSCode terminal (Terminal -> New Terminal) en voer het commando `npm run dev` uit. Node gaat dan aan het werk om alle css en js bestanden te compileren, en zodra deze klaar is, kun je je pagina verversen (ctrl+r in de browser) om de veranderingen te bekijken. Onthoud dus dat je na elke aanpassing het commando uit moet voeren.

Je kunt het jezelf iets makkelijker maken door een extra terminal te openen (op het plusje klikken in de bovenbalk van de terminal) en het commando `npm run watch` uit te voeren. Dit zorgt ervoor dat elke keer als jij iets aanpast aan je css of js bestanden, dat Node dit in de gaten heeft, en automatisch `npm run dev` uitvoert. Dan kun je die terminal window laten draaien, en hoef je het niet meer handmatig uit te voeren. Vind je dit ingewikkeld, dan is het makkelijker om gewoon handmatig `npm run dev` uit te voeren na elke aanpassing.

**LET OP**: Je hoeft alleen npm uit te voeren als je een css of js bestand aanpast. Het hoeft dus niet bij aanpassingen aan je HTML/PHP pagina’s.

Als wij ten slotte klaar zijn met al onze aanpassingen voordat we de site online zouden plaatsen, kun je ook proberen `npm run prod` uit te voeren. Dit commando zal daadwerkelijk de code optimaliseren en minifyen, terwijl `npm run dev` het enkel compileert tot een enkel bestand. Dus zolang je aan het ontwikkelen bent, gebruik je altijd `npm run dev`, en als je de site online geplaatst hebt, gebruik je `npm run prod`.

### PHP Artisan

Zoals je gemerkt hebt, hebben we bij het installeren van dit project het commando `php artisan migrate` gebruikt. Maar wat hebben we nou eigenlijk gedaan? Artisan is een tool van Laravel, waarmee we een hele hoop taken die je normaalgesproken handmatig zou doen, kunnen automatiseren.

De `migrate` commando voert de lijst met migrations die in dit project in de folder ‘/database/migrations’ staan. Migrations zijn eigenlijk blauwdrukken van hoe een database er uit moet zien. Als we dit project dus delen met een team ontwikkelaars, en zij allemaal deze migraties uitvoeren, dan heeft iedereen een database klaar staan die bij iedere ontwikkelaar exact hetzelfde is opgebouwd. Zo hoef je nooit meer een halve dag samen te zitten om ervoor te zorgen dat de database van het hele team exact hetzelfde is. Migraties voeren echter geen data toe aan de database, dus de data in de database kan bij iedereen verschillen, maar dat maakt natuurlijk niets uit.

Zo heeft Artisan nog meer verschillende functies die het ontwikkelen in laravel een stuk makkelijker maken. Zo hebben we ook de `php artisan make` commando, waarmee we een template kunnen kiezen van een bestand, die dan gelijk goed in ons bestandssysteem wordt gezet. Zo voegt het commando `php artisan make:migration create_tacos` een migratie toe, die al automatisch de code bevat om de tabel ‘tacos’ aan onze database toe te voegen. We kunnen dan die migratie verder handmatig aanpassen om alle velden die we nodig hebben in die tabel, te definiëren. Het is daarnaast ook mogelijk een migratie aan te maken, die een bestaande tabel aanpast.

We gaan nog niet enorm veel werken met Artisan in dit project, maar deze tool gaat later enorm belangrijk worden als we wat verder in Laravel gaan duiken.
