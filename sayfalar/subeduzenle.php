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
$vericek = $conn -> prepare("SELECT * FROM subeler where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_GET['id'];
  $subeisim = $_POST['subeisim'];
  $sehir_id = $_POST['sehiridbu'];	
  $guncelle = $conn -> prepare("UPDATE subeler SET subeisim=:subeisim, sehir_id=:sehir_id WHERE id=:id");
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':subeisim', $subeisim);
  $guncelle->bindParam(':sehir_id', $sehir_id);
  $guncelle-> execute(); 
  if($guncelle){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=subeler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarı İle Düzenlendi. 2 Saniye İçinde Yönlendiriliyorsunuz...</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }
}
?>

<?php
if (isset($_GET['numaram'])) {
  $numaras = $_GET['numaram'];  
  $subesil = $conn -> prepare("DELETE FROM subeler where id = :id");
  $subesil->bindParam(':id', $_GET['numaram']);
  $subesil-> execute();
  if($subesil){
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
    <li class="breadcrumb-item"><a href="?sayfa=subeler">Şube Düzenle</a></li>
    <li class="breadcrumb-item active"><?php echo $veriyigoster['subeisim']; ?></li>
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
          <div class="input-group-prepend"><span class="input-group-text">Şube İsmi</span></div>
          <input type="text" name="subeisim" class="form-control" value="<?php echo $veriyigoster['subeisim']; ?>">
          <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>">
        </div>
		  <div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Şehir</span></div>
		  <?php			  
        try
        {
                 $sql = "SELECT id,sehirisim from sehirler";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="sehiridbu"  class="form-control" onchange="">';				 
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['id'].'" '.(($row['id']==$veriyigoster['sehir_id'])?'selected="selected"':"").'>'.$row['sehirisim'].'</option>'; 
             }
             echo '</select>';
            }
            catch (PDOException $e)
            {   
                die("Database bağlantı hatası" . $e->getMessage());
            }
    ?>
			  </div>
      </div>
      <div class="col-xl-12 col-sm-12 mb-3">
        <hr>
        <a href="?sayfa=subeler" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Kaydet</button>
      </div>
    </div>
  </form>
</div>
