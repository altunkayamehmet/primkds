<?php session_start(); ob_start(); ?>
<?php include 'database.php'; ?>
<?php
if( isset($_SESSION['yonetici']) && !empty($_SESSION['yonetici']) ){
  $records = $conn->prepare('SELECT * FROM yoneticiler WHERE id = :id');
  $records->bindParam(':id', $_SESSION['yonetici']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = NULL;
  if( count($results) > 0){ $user = $results; }
}
else { header("Location: giris.php"); die(); }
?>

<?php 
$vericek = $conn -> prepare("SELECT * FROM yoneticiler where id = :id");
$vericek->bindParam(':id', $_SESSION['yonetici']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if(isset($_POST['Gonder']))
{
  $urunbaslik = $_POST['urunbaslik']; 
  $urunfiyat = $_POST['urunfiyat'];
  $ekleyen = $veriyigoster['adiniz'];  
  $stmt = $conn->prepare('INSERT INTO urunler(urunbaslik, urunfiyat, ekleyen) VALUES (:urunbaslik, :urunfiyat, :ekleyen)');
  $stmt->bindParam(':urunbaslik',$urunbaslik); 
  $stmt->bindParam(':urunfiyat',$urunfiyat);  
  $stmt->bindParam(':ekleyen',$ekleyen);
  $stmt->execute();
  if($stmt){
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ürün Eklendi !</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ürün Ekleme Başarısız !</strong>
    </div>';
  }
}

?>


<div class="container-fluid">

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item active">Ürün Ekle</li>
  </ol>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-3">
        <div class="message"></div>
        <?php if(!empty($mesaj)): ?>
          <p><?= $mesaj ?></p>
        <?php endif; ?>
      </div>      
      <div class="col-xl-8 col-sm-12 mb-3">        
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün Başlığı</span></div>
          <input type="text" name="urunbaslik" class="form-control" placeholder="Ürün Başlığı">
        </div>        
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün Fiyatı</span></div>
          <input type="text" name="urunfiyat" class="form-control" placeholder="Ürün Fiyatı">
          <div class="input-group-append"><span class="input-group-text">TL</span></div>
        </div>
      </div>
      <div class="col-xl-12 col-sm-12 mb-3">
        <hr>
        <a href="?sayfa=urunler" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Ekle</button>
      </div>
    </div>
  </form>
</div>
