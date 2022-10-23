<?php
require_once('config/config.php');

// Подключение к БД
try {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $dbh = new PDO($connect_str,DB_USER,DB_PASS);;
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Кол-во элементов
$limit = 3;

// Получение записей для текущей страницы
$page = intval(@$_GET['page']);
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;
$sth = $dbh->prepare("SELECT * FROM `image` LIMIT {$start}, {$limit}");
$sth->execute();
$items = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($items as $row) {
    ?>
    <link rel="stylesheet" type="text/css" href="style.css">
    <div class="prod-item">
        <div class="prod-item-img">
            <img src="/images/<?php echo $row['img']; ?>" alt="">
        </div>
        <div class="prod-item-name">
            <?php echo $row['name']; ?>
        </div>
    </div>
    <?php
}