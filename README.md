# CurCon
## _The Coolest Real-Time Currency Converter, Ever_

[![N|Yii2](https://s3-ap-southeast-1.amazonaws.com/cdn.ezeelive.com/wp-content/uploads/2017/12/10184002/yii_framework_developer_india_ezeelive.jpg)](https://www.yiiframework.com/)

> An example of using the yii2 framework 
> to create a currency conversion site 
> at the current exchange rate 
>of the Central Bank of the Russian Federation.*

*currently only available for Ubuntu.
 
## Requirements

- The LAMP stack: php v7.4, MySQL v8.0, apache2.
([Example](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04) of installation LAMP)

- [Composer](https://getcomposer.org/download/)
([Example](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04) installation guide)

## Installation

Go to **/var/www** folder:

```sh
$ cd /var/www/
```

Clone the repository:

```sh
$ sudo git clone https://github.com/Viktor4444/Currency-Converter
```

Change permissions on the repository:

```sh
$ sudo chmod -R 777 /var/www/Currency-Converter
```

To get the latest dependencies and update the *composer.lock* file:

```sh
$ cd Currency-Converter/
$ composer update
```

##### Configuring a DB

You need to import the dump into your mysql server:

```sh
$ sudo mysqldump -u root -p CurrencyConverter < CurCon.sql
```

You also need to create a new user and give him access rights to the required table:

```sql
CREATE USER 'ConverterUser'@'%' IDENTIFIED BY 'currency';
GRANT ALL PRIVILEGES ON `CurrencyConverter`.* TO 'ConverterUser'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

##### Configuring apache2

Finally, you need to make changes to the server configuration. Create file **/etc/apache2/sites-enabled/Currency-Converter.conf**:**

```sh
$ sudo nano /etc/apache2/sites-enabled/Currency-Converter.conf
```

and paste the following text there:

```
<VirtualHost *:80>
    ServerName Currency-Converter
    ServerAlias www.Currency-Converter
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/Currency-Converter
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

(**if you have other configurations you will need to disable them)

And, don't forget to be sure to restart the Apache server!:)

```sh
$ sudo systemctl reload apache2
```

## Usage

**CurCon** is very easy to use!
Just go to http://localhost/web

You will be immediately redirected to the login page, but don't worry! Just go to the registration page by clicking the button in the header of the site and enter your preferred login and password(then you will be automatically log in), and count the currency as much as you want!


## License

**Free Software, Hell Yeah!**

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [dill]: <https://github.com/joemccann/dillinger>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>
