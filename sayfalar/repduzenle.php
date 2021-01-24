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
$vericek = $conn -> prepare("SELECT * FROM reprezant where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_GET['id'];
  $repad = $_POST['repad'];
  $repsoyad = $_POST['repsoyad'];
  $primorani = $_POST['primorani'];
  $sube_id = $_POST['subeidbu'];
  $guncelle = $conn -> prepare("UPDATE reprezant SET repad=:repad, repsoyad=:repsoyad, primorani=:primorani, sube_id=:sube_id WHERE id=:id");
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':repad', $repad);
  $guncelle->bindParam(':repsoyad', $repsoyad);
  $guncelle->bindParam(':primorani', $primorani);
  $guncelle->bindParam(':sube_id', $sube_id);  	
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
    <li class="breadcrumb-item"><a href="?sayfa=repler">Reprezant Düzenle</a></li>
    <li class="breadcrumb-item active"><?php echo $veriyigoster['repad']; ?> <?php echo $veriyigoster['repsoyad']; ?></li>
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
          <div class="input-group-prepend"><span class="input-group-text">Reprezant Adı</span></div>
          <input type="text" name="repad" class="form-control" value="<?php echo $veriyigoster['repad']; ?>">
          <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>">
        </div>
		  <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Reprezant Soyadı</span></div>
          <input type="text" name="repsoyad" class="form-control" value="<?php echo $veriyigoster['repsoyad']; ?>">
          <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>">
        </div>
		  <div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Prim Oranı</span></div>
		  <select name="primorani" class="form-control">  			
			<option value="10" <?php if($veriyigoster['primorani']=="10") echo 'selected="selected"'; ?>>10</option>
  			<option value="11" <?php if($veriyigoster['primorani']=="11") echo 'selected="selected"'; ?>>11</option>
  			<option value="12" <?php if($veriyigoster['primorani']=="12") echo 'selected="selected"'; ?>>12</option>
  			<option value="13" <?php if($veriyigoster['primorani']=="13") echo 'selected="selected"'; ?>>13</option>
			<option value="14" <?php if($veriyigoster['primorani']=="14") echo 'selected="selected"'; ?>>14</option>
  			<option value="15" <?php if($veriyigoster['primorani']=="15") echo 'selected="selected"'; ?>>15</option>
  			<option value="16" <?php if($veriyigoster['primorani']=="16") echo 'selected="selected"'; ?>>16</option>
  			<option value="17" <?php if($veriyigoster['primorani']=="17") echo 'selected="selected"'; ?>>17</option>
			<option value="18" <?php if($veriyigoster['primorani']=="18") echo 'selected="selected"'; ?>>18</option>
  			<option value="19" <?php if($veriyigoster['primorani']=="19") echo 'selected="selected"'; ?>>19</option>
  			<option value="20" <?php if($veriyigoster['primorani']=="20") echo 'selected="selected"'; ?>>20</option>	
			</select>
			  </div>
		  <div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Şube</span></div>	
	<?php       
        try
        {
                 $sql = "SELECT subeler.id, subeler.subeisim, subeler.sehir_id, sehirler.sehirisim from subeler,sehirler where sehirler.id = subeler.sehir_id ORDER BY sehirler.sehirisim, subeler.subeisim ASC";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="subeidbu"  class="form-control" onchange="">';				 
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['id'].'" '.(($row['id']==$veriyigoster['sube_id'])?'selected="selected"':"").'>'.$row['sehirisim'].' - '.$row['subeisim'].'</option>'; 
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
        <a href="?sayfa=repler" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Kaydet</button>
      </div>
    </div>
  </form>
</div>
