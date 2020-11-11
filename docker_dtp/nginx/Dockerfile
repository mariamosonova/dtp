FROM nginx
COPY nginx.conf /etc/nginx/
COPY ./sites/dtp.conf /etc/nginx/sites-available/dtp.ru.conf
#COPY sites-available.api.quest.test.conf /etc/nginx/sites-available/api.quest.test
RUN mkdir /etc/nginx/sites-enabled/
RUN ln -s /etc/nginx/sites-available/dtp.ru.conf /etc/nginx/sites-enabled/
#RUN ln -s /etc/nginx/sites-available/api.quest.test /etc/nginx/sites-enabled/
RUN echo "upstream phpserver { server php_dtp:9000; }" > /etc/nginx/conf.d/upstream.conf
RUN usermod -u 1000 www-data
CMD ["nginx"]
EXPOSE 80
EXPOSE 443

