.PHONY: install deploy

deploy:
	ssh o2switch 'cd sites/simonhonore.fr/ && git pull origin master && make install'

install: vendor/autoload.php
	php bin/console doctrine:migrations:migrate -n
	npm install
	php bin/console importmap:install
	php bin/console tailwind:build --minify
	php bin/console asset-map:compile
	composer dump-env prod
	php bin/console cache:clear

vendor/autoload.php: composer.lock composer.json
	composer install --no-dev --optimize-autoloader
	touch vendor/autoload.php
