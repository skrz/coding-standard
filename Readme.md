### Skrz coding standards

##### phpstan
make include in your phpstan.neon
````
includes:
     - vendor/skrz/coding-standard/phpstan.neon
````

##### phpcs
include rules into your ruleset
````
<?xml version="1.0"?>
<ruleset name="Your name of ruleset">
    <rule ref="vendor/skrz/coding-standard/phpcs.xml"/>
</ruleset>

````
