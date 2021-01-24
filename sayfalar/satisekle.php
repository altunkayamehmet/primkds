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
  $satistutari = $_POST['satistutari'];
  $rep_id = $_POST['repidbu'];
  $urun_id = $_POST['urunidbu'];
  $yil = $_POST['yilbu'];	
  $ekleyen = $veriyigoster['adiniz'];
  $stmt = $conn->prepare('INSERT INTO satislar(satistutari, rep_id, urun_id, yil, ekleyen) VALUES (:satistutari, :rep_id, :urun_id, :yil, :ekleyen)');
  $stmt->bindParam(':satistutari',$satistutari);
  $stmt->bindParam(':rep_id',$rep_id);
  $stmt->bindParam(':urun_id',$urun_id);
  $stmt->bindParam(':yil',$yil);	
  $stmt->bindParam(':ekleyen',$ekleyen);
  $stmt->execute();
  if($stmt){
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Satış Eklendi !</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Satış Ekleme Başarısız !</strong>
    </div>';
  }
}

?>


<div class="container-fluid">

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item active">Satış Ekle</li>
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
          <input type="text" name="satistutari" class="form-control" placeholder="Satış Tutarı">
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
                echo '<option value="'.$row['id'].'">'.$row['repad'].' '.$row['repsoyad'].'</option>'; 
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
                echo '<option value="'.$row['id'].'">'.$row['urunbaslik'].'</option>'; 
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
			<option value="2018">2018</option>
  			<option value="2019">2019</option>
  			<option value="2020">2020</option>  			
			</select>
			  </div>
      </div>
      <div class="col-xl-12 col-sm-12 mb-3">
        <hr>
        <a href="?sayfa=satislar" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Ekle</button>
      </div>
    </div>
  </form>
</div>
