# Разворачивание проекта на локальной машине
Перед началом, рекомендуется добавить пользователя www-data в свою группу:       
`sudo usermod www-data -a -G ВАША_ГРУППА`          
Для корректной работы, необходимо чтобы члены группы могли читать и писать файлы проекта

## 1. Установка NGINX
`sudo apt-get install nginx`

## 2. Установка и конфигурация php
#### Установка php-fpm 7
`sudo apt-get intall php7.4-fpm`
#### Установка xdebug для отладки
`sudo apt-get install php-xdebug` 
#### Установка mbstring для работы со строками
`sudo apt-get install php-mbstring`     
#### Установить библиотеку GD 
`sudo apt-get install php7.4-gd`    
#### Установить библиотеку Free Type Library 
`sudo apt-get install libfreetype6-dev`    

После установки всех компонентов необходимо в файле */etc/php/7.4/fpm/php.ini* 
и */etc/php/7.4/cli/php.ini* сделать следующие изменения:
* установить параметр `mbstring.internal_encoding = UTF-8`
* установить параметр `mbstring.func_overload = 2`
* установить параметр `short_open_tag = On`
* установить параметр `display_errors = On`
* установить параметр `pcre.recursion_limit=100000`     
* установить параметр `opcache.validate_timestamps=1`    
* установить параметр `opcache.revalidate_freq=0`    
* установить параметр `date.timezone=Asia/Krasnoyarsk`    

Если будут еще ошибки с требованиями изменить параметр, то битрикс скажет какой именно, 
после чего требуется записать эти требования в этот файл. 

## 3. Установка и конфигурация MySQL
#### Установка сервера
`sudo apt-get install mysql-server`
#### Установка клиента
`sudo apt-get install mysql-client`     
Важно прописать в */etc/mysql/my.cnf* под `[mysqld]`   
`sql_mode = ''`     
Если этого не сделать, то могут возникнуть проблемы разворачивания битрикса из бэкапа.
#### Создание пользователя
* Зайти в консоль MySQL, выполнив:      
    `mysql -u root -p`
* Создать пользователя:        
    `CREATE USER 'user'@'localhost' IDENTIFIED BY 'mypass';`
* Назначить права на будущую базу данных:       
    `GRANT ALL ON db.* TO 'user'@'localhost';`

## 4. Клонирование проекта
В любой удобной папке выполнить:         
`git clone URL-репозитория`     
После чего, дать папке проекта право записи для группы:      
`sudo chmod g+w ВАША_ПАПКА`  

## 5. Конфигурация сайта в NGINX
1. Создать файл */etc/nginx/site-available/ИМЯ_ПРОЕКТА*.
1. Прописать в созданном файле следующую конфигурацию:
    ```
    server {
        listen ПОРТ;
        server_name URL_ПРОЕКТА;
    
        root /ПУТЬ/ДО/ПРОЕКТА;
    
        index index.php index.html index.htm;
    
        access_log /var/log/nginx/ИМЯ_ПРОЕКТА.access.log ;
        error_log /var/log/nginx/ИМЯ_ПРОЕКТА.error.log;
    
        proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Host $host;
            client_max_body_size 1024M;
            client_body_buffer_size 4M;
        
        location / {
                    try_files       $uri $uri/ @bitrix;
            }
    
            location ~ \.php$ {
                    try_files $uri = 404;
                    include fastcgi_params;
                    fastcgi_pass  unix:/var/run/php/php7.4-fpm.sock;
                    fastcgi_index index.php;
    
            fastcgi_connect_timeout 6000;
            fastcgi_send_timeout 18000;
            fastcgi_read_timeout 18000;
    
                    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            }
    
            location @bitrix {
                    fastcgi_pass    unix:/var/run/php/php7.4-fpm.sock; #путь до сокета php-fpm
                    include fastcgi_params;
                    fastcgi_param SCRIPT_FILENAME $document_root/bitrix/urlrewrite.php;
            }
    
    }
    ```
1. Создать символьную ссылку созданного файла в папку *site_enabled*:
```sudo ln -s /etc/nginx/site-available/ФАЙЛ /etc/nginx/site-enabled/ФАЙЛ```        
1. Перезагрузить NGINX          
`sudo service nginx restart`

## 6. Прописать URL-проекта в hosts
В файл */etc/hosts* прописать строку:       
`127.4.0.1  ВАШ_URL`

## 7. Установка из бэкапа
* Скачайте файл *restore.php* с облака МЭЙКа по ссылке: `https://www.1c-bitrix.ru/download/files/scripts/restore.php`.        
* В битриксе на сервере зайти в список резервных копий, вызвать контекстное меню и выбрать
"Получить ссылку для переноса". 
* Перейти по адресу *ВАШ_URL/restore.php*
* Выбрать пункт меню *Скачать с удаленного сервера* и поместить скопированный адрес
* Проследовать указаниям мастера        
        
##### *Важно: необходимо, чтобы файлы и папки GIT пренадлежали вашему пользователю, иначе коммит нельзя будет выполнить*