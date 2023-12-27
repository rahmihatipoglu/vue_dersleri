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
    $SQL = "SELECT IL_ID, PLAKA, IL_ADI FROM il ORDER BY IL_ADI";
    $SORGU = $DB->prepare($SQL);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    // DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;

  case 'get.ilceler':
    // $ILID = ($_GET['il_id']) ? $_GET['il_id'] : 0;
    $ILID = ($_GET['il_id']) ?? 0;
    $SQL = "SELECT ILCE_ID, IL_ID, ILCE_ADI FROM ilce WHERE IL_ID = :il_id ORDER BY ILCE_ADI";
    $SORGU = $DB->prepare($SQL);
    $SORGU->bindParam(':il_id', $ILID);
    $SORGU->execute();
    $rows = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    //DD($rows);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
    break;
  default:
    die("HATA: `method` adlı değişken için doğru verilerler çağırınız");
}
