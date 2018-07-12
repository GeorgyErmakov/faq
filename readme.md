<h1>Инструкция по развертыванию FAQ</h1>

Требования: MySQL: 5.0.67 и выше,  PHP 7.1.16 и выше, Composer 
<ul>
<li>composer install</li>
<li>копировать и переименовать .env.example в .env</li>
<li>php artisan key:generate</li>
<li>Создать базу данных из дампа diplom.sql</li>
<li>Доступ к клиентской части http://localhost, к административной http://localhost/dashboard</li>
<li>Администратор: admin\admin</li>
</ul>