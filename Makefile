# vim: set tabstop=8 softtabstop=8 noexpandtab:
cs:
	composer install --no-interaction --no-progress --working-dir=tools
	tools/vendor/bin/php-cs-fixer fix --config=.php_cs.dist --diff --diff-format=udiff --verbose

test:
	php vendor/bin/phpunit -v
