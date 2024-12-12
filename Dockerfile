# Menggunakan image PHP bawaan dengan server Apache
FROM php:8.1-apache

# Salin semua file dari proyek ke dalam direktori /var/www/html di container
COPY . /var/www/html

# Berikan izin pada folder
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
