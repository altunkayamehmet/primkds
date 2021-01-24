<?php session_start(); ob_start(); ?>
<?php include 'database.php'; ?>
<?php
$yil = $_GET['yil'];
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
  $sil = $conn -> prepare("DELETE FROM satislar where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=satislar">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Satış Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
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
  <li class="breadcrumb-item active">Satışlar</li>
</ol>
<div class="row">
  <div class="col-xl-12 col-sm-6 mb-3">
    <div class="message"></div>
    <?php if(!empty($mesaj)): ?>
      <p><?= $mesaj ?></p>
    <?php endif; ?>    
  </div>

<div class="col-xl-12 col-sm-12 mb-3">	
	
	<?php       
        try
        {
                 $sql = "SELECT id,yil from satislar GROUP BY yil";
                 $sonuckod = $conn->query($sql); 
                 $sonuckod->setFetchMode(PDO::FETCH_ASSOC);
                 echo '<select name="yilidbu"  class="form-control" onchange="location = this.value;">';
				 echo '<option value="/index.php?sayfa=satislar&yil=">Yıl seçiniz</option>';
             while ( $row = $sonuckod->fetch() )
             {
                echo '<option value="/index.php?sayfa=satislar&yil='.$row['yil'].'">'.$row['yil'].'</option>'; 
             }
             echo '</select>';
            }
            catch (PDOException $e)
            {   
                die("Database bağlantı hatası" . $e->getMessage());
            }
    ?>
</div>	
	 

	
	<div class="col-xl-12 col-sm-12 mb-3">
      <div class="alert alert-info">
        <?php
        $sorgu = $conn->prepare("SELECT COUNT(*) FROM satislar WHERE yil='$yil'");
        $sorgu->execute();
        $say = $sorgu->fetchColumn();
        echo ''.$yil.' Yılında <b>'.$say.'</b> satış bulunmaktadır. ';
        ?>   
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
          <thead>
            <th>Reprezant Adı Soyadı</th>
            <th>Ürün</th>            
            <th>Satış Tutarı</th>
			<th>#</th>  
          </thead>
          <tbody>
            <?php  
  $verial1 = $conn -> prepare("SELECT reprezant.repad, reprezant.repsoyad, urunler.urunbaslik, satislar.id, satislar.satistutari, satislar.rep_id, satislar.urun_id, satislar.yil, satislar.ekleyen FROM satislar,reprezant,urunler where reprezant.id = satislar.rep_id AND urunler.id = satislar.urun_id AND yil = '$yil' ");
  $verial1-> execute();  
  while ($satisgoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '    
                <td>'.$satisgoster['repad'].' '.$satisgoster['repsoyad'].'</td>
                <td>'.$satisgoster['urunbaslik'].'</td>                
                <td class="bg-secondary text-white">'.$satisgoster['satistutari'].' TL</td>
				<td><a href="?sayfa=satisduzenle&id='.$satisgoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Düzenle</a>
				<a href="?sayfa=satislar&id='.$satisgoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Sil</a></td>
                </tr>
    ';
  }
  ?>
</div>
          </tbody>
          <tfoot>

          </tfoot>
        </table>
      </div>
    </div>
