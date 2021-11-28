<?php 
$databaseConfig = include '../db.config.php';

$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4;port=3306', $databaseConfig['DB_HOST'], $databaseConfig['DB_NAME']);
try {
     $pdo = new \PDO($dsn, $databaseConfig['DB_USER'], $databaseConfig['DB_PASS'], []);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->query("SELECT * FROM news");
$result = $stmt->fetchAll();

echo '<h1>News count: '.count($result).'</h1>';
foreach($result as $news) {
    echo sprintf('<div style="padding: 0 0 0 20px;"><small><h3><small>Tytuł:</small> %s</h3><p><small>Treść:</small> %s</p><small>Data:</small> <date>%s</date></div><hr />', $news['title'], $news['content'], $news['created']);
}