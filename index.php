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



// Получение записей для первой страницы
$sth = $dbh->prepare("SELECT * FROM `image` LIMIT 3");
$sth->execute();
$items = $sth->fetchAll(PDO::FETCH_ASSOC);

// Кол-во страниц
$sth = $dbh->prepare("SELECT COUNT(`id`) FROM `image`");
$sth->execute();
$total = $sth->fetch(PDO::FETCH_COLUMN);

$amt = ceil($total / 3);
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="showmore-list">
    <div class="prod-list">
        <?php foreach ($items as $row): ?>
            <div class="prod-item">
                <div class="prod-item-img">
                    <img src="/images/<?php echo $row['img']; ?>" alt="">
                </div>
                <div class="prod-item-name">
                    <?php echo $row['name']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="showmore-bottom">
    <a data-page="1" data-max="<?php echo $amt; ?>" id="showmore-button" href="#">Показать еще</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script>
    $(function(){
        $('#showmore-button').click(function (){
            var $target = $(this);
            var page = $target.attr('data-page');
            page++;

            $.ajax({
                url: '/ajax.php?page=' + page,
                dataType: 'html',
                success: function(data){
                    $('#showmore-list .prod-list').append(data);
                }
            });

            $target.attr('data-page', page);
            if (page ==  $target.attr('data-max')) {
                $target.hide();
            }

            return false;
        });
    });
</script>