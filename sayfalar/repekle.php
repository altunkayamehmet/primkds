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
  $repad = $_POST['repad'];
  $repsoyad = $_POST['repsoyad'];
  $primorani= $_POST['primorani'];
  $sube_id = $_POST['subeidbu'];
  $ekleyen = $veriyigoster['adiniz'];  
  $stmt = $conn->prepare('INSERT INTO reprezant(repad, repsoyad, primorani, sube_id, ekleyen) VALUES (:repad, :repsoyad, :primorani, :sube_id, :ekleyen)');
  $stmt->bindParam(':repad',$repad);
  $stmt->bindParam(':repsoyad',$repsoyad);
  $stmt->bindParam(':primorani',$primorani);
  $stmt->bindParam(':sube_id',$sube_id);  
  $stmt->bindParam(':ekleyen',$ekleyen);
  $stmt->execute();
  if($stmt){
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Reprezant Eklendi !</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Reprezant Ekleme Başarısız !</strong>
    </div>';
  }
}

?>


<div class="container-fluid">

  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item active">Reprezant Ekle</li>
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
          <input type="text" name="repad" class="form-control" placeholder="Reprezant Adı">
        </div> 
		  <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Reprezant Soyadı</span></div>
          <input type="text" name="repsoyad" class="form-control" placeholder="Reprezant Soyadı">
        </div>
		  <div class="input-group mb-3">
		  <div class="input-group-prepend"><span class="input-group-text">Prim Oranı</span></div>
		  <select name="primorani" class="form-control">  			
			<option value="10">10</option>
  			<option value="11">11</option>
  			<option value="12">12</option>
  			<option value="13">13</option>
			<option value="14">14</option>
  			<option value="15">15</option>
  			<option value="16">16</option>
  			<option value="17">17</option>
			<option value="18">18</option>
  			<option value="19">19</option>
  			<option value="20">20</option>	
			</select>
			  </div>
        <div class="input-group mb-3">
		<div class="input-group-prepend"><span class="input-group-text">Şube</span></div>	
	<?php       
        try
        {
                 $sql = "SELECT subeler.id, subeler.subeisim, subeler.sehir_id, sehirler.sehirisim from subeler,sehirler where sehirler.id = subeler.sehir_id";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="subeidbu"  class="form-control" onchange="">';				 
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="'.$row['id'].'">'.$row['sehirisim'].' - '.$row['subeisim'].'</option>'; 
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
        <button type="submit" name="Gonder" class="btn btn-success float-right">Ekle</button>
      </div>
    </div>
  </form>
</div>
