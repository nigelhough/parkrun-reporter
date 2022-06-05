# parkrun Reporter

A tool for generating parkrun reports. The tool responsibly scrapes data from the parkrun website to get a summary of a
parkrun event and converts that into report details and facts to form a run report.

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
docker-compose run --rm php81 bin/cli.php

# Run a report for an event number.
docker-compose run --rm php81 bin/cli.php -e=560

# Run a report for a location and event.
docker-compose run --rm php81 bin/cli.php -l=linfordwood -e=230
```
