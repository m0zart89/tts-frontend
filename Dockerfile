FROM php:7-apache
COPY /app /var/www/html/
COPY run.sh /
RUN chmod +x /run.sh
CMD ["/run.sh"]
