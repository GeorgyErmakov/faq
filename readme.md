<h1>Инструкция по развертыванию FAQ</h1>

Требования: MySQL: 5.0.67 и выше,  PHP 7.1.16 и выше, Composer 
<ul>
<li>git clone https://github.com/GeorgyErmakov/Neto faq</li>
<li>cd faq</li>
<li>composer install</li>
<li>копировать и переименовать .env.example в .env</li>
<li>php artisan key:generate</li>
<li>Настроить добашнюю папку веб-сервера на ./faq/public</li>
<li>Создать базу данных из дампа diplom.sql</li>
<li>В файле config/database.php изменить данные для соединения к базе diplom_a</li>
<li>Доступ к клиентской части http://localhost, к административной http://localhost/admin</li>
<li>Администратор: admin\admin</li>
</ul>
<p>В разработке валидация, обработка ошибок и логирование.</p>