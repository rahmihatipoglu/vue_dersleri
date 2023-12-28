<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'db.php';

if (!isset($_GET['method'])) {
  die("HATA: API doğru biçimde çağrılmadı!");
}


switch ($_GET['method']) {
  case 'get.iller':
    $SQL = "SELECT * FROM iller ORDER BY il_adi";
    $SORGU = $DB->prepare($SQL);
    break;

  case 'get.ilceler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM ilceler WHERE il_id = :id ORDER BY ilce_adi";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':id', $ID);
    break;

  case 'get.semtler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM semtler WHERE ilce_id = :id ORDER BY semt_adi";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':id', $ID);
    break;

  case 'get.mahalleler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM mahalleler WHERE semt_id = :id ORDER BY mahalle_adi";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':id', $ID);
    break;

  default:
    die("HATA: `method` adlı değişken için doğru verilerler çağırınız");
}

$SORGU->execute();
$rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
