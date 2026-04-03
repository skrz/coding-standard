### Skrz coding standards

##### phpstan
make include in your phpstan.neon
````
parameters:
	level: max

includes:
	- vendor/phpstan/phpstan-strict-rules/rules.neon
	- vendor/skrz/coding-standard/phpstan.neon
	- vendor/skrz/coding-standard/phpstan-extended.neon

````

##### phpcs
include rules into your ruleset
````
<?xml version="1.0"?>
<ruleset name="Your name of ruleset">
    <rule ref="vendor/skrz/coding-standard/phpcs.xml"/>
</ruleset>

````
