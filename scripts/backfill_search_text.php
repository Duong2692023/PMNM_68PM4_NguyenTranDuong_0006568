<?php
// Script backfill search_text for students table.
// Run: php scripts/backfill_search_text.php

require_once __DIR__ . '/../app/Core/DB.php';

$dbh = ConnectDB::Connect();

$normalize = function($str) {
    $str = mb_strtolower($str, 'UTF-8');
    $map = array(
        'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
        'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
        'i' => 'ì|í|ị|ỉ|ĩ',
        'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
        'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
        'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
        'd' => 'đ',
    );
    foreach ($map as $latin => $unicode) {
        $str = preg_replace('/(' . $unicode . ')/u', $latin, $str);
    }
    $str = preg_replace('/\p{M}/u', '', $str);
    $str = preg_replace('/\s+/u', ' ', trim($str));
    return $str;
};

try {
    $stmt = $dbh->prepare("SELECT id, mssv, hoten FROM students");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $update = $dbh->prepare("UPDATE students SET search_text = :search WHERE id = :id");

    foreach ($rows as $r) {
        $src = trim(($r['mssv'] ?? '') . ' ' . ($r['hoten'] ?? ''));
        $norm = $normalize($src);
        $update->execute([':search' => $norm, ':id' => $r['id']]);
    }

    echo "Backfill completed: " . count($rows) . " rows updated.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
