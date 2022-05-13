# parkrun Reporter

A tool for generating parkrun reports.
The tool responsibly scrapes data from the parkrun website to get a summary of a parkrun event and converts that into
report details and facts to form a run report.

## Commands used for Dev

### Build
```
docker-compose run --rm php composer
docker-compose run --rm php81 composer update
docker-compose run --rm php81 composer install

docker-compose run --rm php81 composer check
```

### Commands
```
# Run a report.
docker-compose run --rm php bin/cli.php

# Run a report for an event number.
docker-compose run --rm php bin/cli.php -e=560

# Run a report for a location and event.
docker-compose run --rm php bin/cli.php -l=linfordwood -e=230
```

## ToDo
* Restructure
* Change dependencies to not be local path
* Improve Readme
* Changelog
* Formalise the CLI
* Convert to library and create report-api, consider report serverless
* Remote build process
* SonarScan? SonarServer
* Validation (Event Names, Event Ids)
