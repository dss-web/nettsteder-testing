# Nettsteder 2.0 - Testing

This is not live yet -- under development.

## TeamCity

Builds and tests are managed through TeamCity. Deployments too.

## Buildbox setup

You need a VM with CentOS installed. You may use Vagrant and VirtualBox: `vagrant init centos/7`

We need a couple of extra repos:

```
sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
```

Install packages:

```
sudo yum install -y mariadb-server git nginx php71w-fpm php71w-cli php71w-common php71w-gd php71w-mbstring php71w-mcrypt php71w-mysqlnd php71w-xml php71w-imap php71w-ldap php71w-opcache php71w-pdo php71w-pecl-imagick php71w-pecl-libsodium php71w-pecl-redis php71w-pecl-apcu php71w-soap
```

Install Composer:

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

Install WP-CLI:

```
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
```

Start and configure DB:

```
sudo systemctl enable mariadb
sudo systemctl start mariadb
```

Now, create a database and grant a user access to it. WordPress will use this.


1. `mysql -u root`
1. `CREATE DATABASE wordpress_db COLLATE utf8mb4_danish_ci;`
1. `GRANT ALL ON wordpress_db.* to wordpress_usr@localhost identified by "wordpress_db_pass";`


Configure and start PHP-FPM and Nginx:
TODO: CONFIGURATION SETUP MISSING HERE!

Make SElinux less disturbing:

```
sudo setenforce permissive
```

Start PHP-FPM and Nginx:

```
sudo systemctl enable php-fpm
sudo systemctl start php-fpm
sudo systemctl enable nginx
sudo systemctl start nginx
```

Clone the repo and install WordPress:

```
git clone git@github.com:dss-web/nettsteder.git .
export ACF_PRO_KEY="YOU MUST SET THIS"
composer install
wp core multisite-install --prompt
```

TODO: composer should install wp in the above command, using wp core is-installed as check.


## Setup test environment (Codeception)

This may be a useful reference: [Codeception for WordPress](http://codeception.com/for/wordpress)

1. Go to the `testing` directory.
1. Run `composer install`
1. Edit `testing/tests/acceptance.suite.yml` to suit your environment.

## Run tests

`vendor/bin/codecept run acceptance`

## Create new test

Example:

`vendor/bin/codecept g:cest acceptance 001-login-`
