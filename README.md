# PitchHitRun
Score registration application for Giants Hengelo. Nothing special but maybe useful as reference.
The application is divided in a PHP REST Api and a HTML/JS front-end powered by AngularJS, which is Dutch by the way.

Abilities:
* Manage participants
* Manage categories for participation
* Manage different game elements
* Manage scores
* Filter and show results

## Database structure
```sql
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Scores`
--

CREATE TABLE IF NOT EXISTS `Scores` (
`id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `score` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Sections`
--

CREATE TABLE IF NOT EXISTS `Sections` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
`id` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Categories`
--
ALTER TABLE `Categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `Scores`
--
ALTER TABLE `Scores`
 ADD PRIMARY KEY (`id`), ADD KEY `userId` (`userId`), ADD KEY `sectionId` (`sectionId`);

--
-- Indexen voor tabel `Sections`
--
ALTER TABLE `Sections`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`id`), ADD KEY `UserCategory` (`categoryId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Categories`
--
ALTER TABLE `Categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT voor een tabel `Scores`
--
ALTER TABLE `Scores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT voor een tabel `Sections`
--
ALTER TABLE `Sections`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Scores`
--
ALTER TABLE `Scores`
ADD CONSTRAINT `Scores_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `Scores_ibfk_2` FOREIGN KEY (`sectionId`) REFERENCES `Sections` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `Users`
--
ALTER TABLE `Users`
ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `Categories` (`id`) ON DELETE SET NULL;

```

## Improvements
For future improvements the use of Bower or a similar package manager should be used. In addition Gulp, Grunt or another tool could be used to create a minified and combined version of the development version.

## Kudos
Many thanks to the authors of the used plugins!
In random order:

* [mgcrea / angular-strap](https://github.com/mgcrea/angular-strap)
* [mgonto / restangular](https://github.com/mgonto/restangular)
* [avbdr / PHP-MySQLi-Database-Class](https://github.com/avbdr/PHP-MySQLi-Database-Class)
* [angular-ui/ui-select](https://github.com/angular-ui/ui-select)
* [jacwright/RestServer](https://github.com/jacwright/RestServer)
* [lodash/lodash](https://github.com/lodash/lodash)
* [ianwalter/ng-breadcrumbs](https://github.com/ianwalter/ng-breadcrumbs)
* [angular/angular.js](https://github.com/angular/angular.js)
* [twbs/bootstrap](https://github.com/twbs/bootstrap)
* [jquery/jquery](https://github.com/jquery/jquery)