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
$vericek = $conn -> prepare("SELECT * FROM satislar where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_GET['id'];
  $satistutari = $_POST['satistutari'];
  $rep_id = $_POST['repidbu'];
  $urun_id = $_POST['urunidbu'];
  $yil = $_POST['yilbu'];
  $guncelle = $conn -> prepare("UPDATE satislar SET satistutari=:satistutari, rep_id=:rep_id, urun_id=:urun_id, yil=:yil WHERE id=:id");
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':satistutari', $satistutari);	
  $guncelle->bindParam(':rep_id', $rep_id);
  $guncelle->bindParam(':urun_id', $urun_id);
  $guncelle->bindParam(':yil', $yil);  	
  $guncelle-> execute(); 
  if($guncelle){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=repler">
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
  $repsil = $conn -> prepare("DELETE FROM reprezant where id = :id");
  $repsil->bindParam(':id', $_GET['numaram']);
  $repsil-> execute();
  if($repsil){
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
    <li class="breadcrumb-item"><a href="?sayfa=satislar">Satış Düzenle</a></li>    
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
          <div class="input-group-prepend"><span class="input-group-text">Satış Tutarı</span></div>
          <input type="text" name="satistutari" class="form-control" value="<?php echo $veriyigoster['satistutari']; ?>">          
		  <div class="input-group-append"><span class="input-group-text">TL</span></div>
        </div>
		  <div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Reprezant</span></div>		  			
			<?php       
        try
        {
                 $sql = "SELECT id,repad,repsoyad,sube_id from reprezant";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="repidbu"  class="form-control" onchange="">';				 
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['id'].'" '.(($row['id']==$veriyigoster['rep_id'])?'selected="selected"':"").'>'.$row['repad'].' '.$row['repsoyad'].'</option>'; 
             }
             echo '</select>';
            }
            catch (PDOException $e)
            {   
                die("Database bağlantı hatası" . $e->getMessage());
            }
    ?>
			  </div>
		  <div class="input-group mb-3">
		<div class="input-group-prepend"><span class="input-group-text">Ürün</span></div>	
	<?php       
        try
        {
                 $sql = "SELECT id,urunbaslik from urunler";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="urunidbu"  class="form-control" onchange="">';				 
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['id'].'" '.(($row['id']==$veriyigoster['urun_id'])?'selected="selected"':"").'>'.$row['urunbaslik'].'</option>'; 
             }
             echo '</select>';
            }
            catch (PDOException $e)
            {   
                die("Database bağlantı hatası" . $e->getMessage());
            }
    ?>
</div>
		  	<div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Yıl</span></div>
		  <select name="yilbu" class="form-control">  			
			<option value="2018" <?php if($veriyigoster['yil']=="2018") echo 'selected="selected"'; ?>>2018</option>
  			<option value="2019" <?php if($veriyigoster['yil']=="2019") echo 'selected="selected"'; ?>>2019</option>
  			<option value="2020" <?php if($veriyigoster['yil']=="2020") echo 'selected="selected"'; ?>>2020</option>  			
			</select>
			  </div>	  
      </div>
      <div class="col-xl-12 col-sm-12 mb-3">
        <hr>
        <a href="?sayfa=repler" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Kaydet</button>
      </div>
    </div>
  </form>
</div>
