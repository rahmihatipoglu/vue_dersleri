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
    $SQL = "SELECT * FROM il ORDER BY IL_ADI";
    $SORGU = $DB->prepare($SQL);
    break;

  case 'get.ilceler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM ilce WHERE IL_ID = :id ORDER BY ILCE_ADI";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':id', $ID);
    break;

  case 'get.semtler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM semt WHERE ILCE_ID = :id ORDER BY SEMT_ADI";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':id', $ID);
    break;

  case 'get.mahalleler':
    $ID = ($_GET['id']) ?? 0;
    $SQL = "SELECT * FROM mahalle_koy WHERE SEMT_ID = :id ORDER BY MAHALLE_ADI";
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
