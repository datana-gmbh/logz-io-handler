# vim: set tabstop=8 softtabstop=8 noexpandtab:
cs:
	symfony composer install --no-interaction --no-progress --working-dir=tools
	symfony php tools/vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --diff --verbose

test:
	symfony php vendor/bin/phpunit -v
