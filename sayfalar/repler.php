<?php session_start(); ob_start(); ?>
<?php include 'database.php'; ?>
<?php
$sube = $_GET['sube'];
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
  $sil = $conn -> prepare("DELETE FROM reprezant where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=repler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Reprezant Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
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
  <li class="breadcrumb-item active">Reprezantlar</li>
</ol>
<div class="row">
  <div class="col-xl-12 col-sm-6 mb-3">
    <div class="message"></div>
    <?php if(!empty($mesaj)): ?>
      <p><?= $mesaj ?></p>
    <?php endif; ?>
    <div class="alert alert-info">
      <?php
      $sorgu = $conn->prepare("SELECT COUNT(*) FROM reprezant");
      $sorgu->execute();
      $say = $sorgu->fetchColumn();
      echo 'Sistemde <b>'.$say.'</b> reprezant bulunmaktadır.';
      ?>
      <a class="btn-success btn-sm float-right mb-3" href="?sayfa=repekle">Reprezant Ekle</a>
    </div>
  </div>

<div class="col-xl-12 col-sm-6 mb-3">
	
	<?php       
        try
        {
                 $sql = "SELECT subeler.id, subeler.subeisim, subeler.sehir_id, sehirler.sehirisim from subeler,sehirler where sehirler.id = subeler.sehir_id ORDER BY sehirler.sehirisim, subeler.subeisim ASC";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="subeidbu"  class="form-control" onchange="location = this.value;">';
				 echo '<option value="/index.php?sayfa=repler&sube=">Şube seçiniz</option>';
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="/index.php?sayfa=repler&sube='.$row['id'].'">'.$row['sehirisim'].' - '.$row['subeisim'].'</option>'; 
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
  $verial1 = $conn -> prepare("SELECT * FROM reprezant where sube_id = '$sube' ");
  $verial1-> execute();
  while ($repgoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '
    <div class="col-xl-4 col-sm-12 mb-3">
    <article class="pKart">    
    <h5 class="pKonuBaslik card-title"><a href="?sayfa=repduzenle&id='.$repgoster['id'].'" title="'.$repgoster['repad'].'">'.$repgoster['repad'].' '.$repgoster['repsoyad'].'</a></h3>
	<h5 class="pKonuAciklama">Prim Oranı : % '.$repgoster['primorani'].'</h5>	  
    <div class="pKonuBilgi">
    <div class="pDetay">
    <ul class="pBilgi">
    <li><a href="?sayfa=repler&id='.$repgoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Sil</a></li>
    <li><a href="?sayfa=repduzenle&id='.$repgoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Düzenle</a></li>
    </ul>
    </div>
    </div>
    </article>
    </div>
    ';
  }
  ?>
</div>
