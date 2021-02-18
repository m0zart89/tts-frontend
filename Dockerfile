FROM php:7-apache
COPY /app /var/www/html/
COPY docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["httpd-foreground"]
