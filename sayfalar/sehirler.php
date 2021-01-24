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
if (isset($_GET['id'])) {
  $numaras = $_GET['id']; 
  $sil = $conn -> prepare("DELETE FROM sehirler where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=sehirler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Şehir Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }  
}

?> 

<div class="container-fluid">
 <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
  <li class="breadcrumb-item active">Şehirler</li>
</ol>
<div class="row">
  <div class="col-xl-12 col-sm-6 mb-3">
    <div class="message"></div>
    <?php if(!empty($mesaj)): ?>
      <p><?= $mesaj ?></p>
    <?php endif; ?>
    <div class="alert alert-info">
      <?php
      $sorgu = $conn->prepare("SELECT COUNT(*) FROM sehirler");
      $sorgu->execute();
      $say = $sorgu->fetchColumn();
      echo 'Sistemde <b>'.$say.'</b> şehir bulunmaktadır.';
      ?>
      <a class="btn-success btn-sm float-right mb-3" href="?sayfa=sehirekle">Şehir Ekle</a>
    </div>
  </div>



  <?php
  $verial1 = $conn -> prepare("SELECT * FROM sehirler");
  $verial1-> execute();
  while ($sehirgoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="col-xl-4 col-sm-12 mb-3">
    <article class="pKart">    
    <h5 class="pKonuBaslik card-title"><a href="?sayfa=sehirduzenle&id='.$sehirgoster['id'].'" title="'.$sehirgoster['sehirisim'].'">'.$sehirgoster['sehirisim'].'</a></h3>
    <p class="pTarih"><i class="fas fa-car"></i><b>'.$sehirgoster['sehirplaka'].'</b></p>    
    <div class="pKonuBilgi">
    <div class="pDetay">
    <ul class="pBilgi">
    <li><a href="?sayfa=sehirler&id='.$sehirgoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Sil</a></li>
    <li><a href="?sayfa=sehirduzenle&id='.$sehirgoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Düzenle</a></li>
    </ul>
    </div>
    </div>
    </article>
    </div>
    ';
  }
  ?>
</div>
