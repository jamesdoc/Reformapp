#!/usr/bin/env bash

sudo apt-get update

# Go install a LAP stack
sudo apt-get -q -y install php5-gd apache2 php5

# Configure apache to look at the correct folder, and enable symlinks
rm -rf /var/www
ln -fs /vagrant/www /var/www
a2enmod rewrite
sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default
service apache2 restart

echo 'And away we go...'