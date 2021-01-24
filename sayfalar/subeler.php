<?php session_start(); ob_start(); ?>
<?php include 'database.php'; ?>
<?php
$sehir = $_GET['sehir'];
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
  $sil = $conn -> prepare("DELETE FROM subeler where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=subeler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Şube Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
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
  <li class="breadcrumb-item active">Şubeler</li>
</ol>
<div class="row">
  <div class="col-xl-12 col-sm-6 mb-3">
    <div class="message"></div>
    <?php if(!empty($mesaj)): ?>
      <p><?= $mesaj ?></p>
    <?php endif; ?>
    <div class="alert alert-info">
      <?php
      $sorgu = $conn->prepare("SELECT COUNT(*) FROM subeler");
      $sorgu->execute();
      $say = $sorgu->fetchColumn();
      echo 'Sistemde <b>'.$say.'</b> şube bulunmaktadır.';
      ?>
      <a class="btn-success btn-sm float-right mb-3" href="?sayfa=subeekle">Şube Ekle</a>
    </div>
  </div>

<div class="col-xl-12 col-sm-6 mb-3">

	<?php       
        try
        {
                 $sql = "SELECT id,sehirisim from sehirler";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="sehiridbu"  class="form-control" onchange="location = this.value;">';
				 echo '<option value="/index.php?sayfa=subeler&sehir=">Şehir seçiniz</option>';
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="/index.php?sayfa=subeler&sehir='.$row['id'].'">'.$row['sehirisim'].'</option>'; 
             }
             echo '</select>';
            }
            catch (PDOException $e)
            {   
                die("Database bağlantı hatası" . $e->getMessage());
            }
    ?>
</div>	
	

  <?php  
  $verial1 = $conn -> prepare("SELECT * FROM subeler where sehir_id = '$sehir' ");
  $verial1-> execute();
  while ($subegoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="col-xl-4 col-sm-12 mb-3">
    <article class="pKart">    
    <h5 class="pKonuBaslik card-title"><a href="?sayfa=subeduzenle&id='.$subegoster['id'].'" title="'.$subegoster['subeisim'].'">'.$subegoster['subeisim'].'</a></h3>     
    <div class="pKonuBilgi">
    <div class="pDetay">
    <ul class="pBilgi">
    <li><a href="?sayfa=subeler&id='.$subegoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Sil</a></li>
    <li><a href="?sayfa=subeduzenle&id='.$subegoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Düzenle</a></li>
    </ul>
    </div>
    </div>
    </article>
    </div>
    ';
  }
  ?>
</div>
