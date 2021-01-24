<?php session_start(); ob_start(); ?>
<?php include 'database.php'; ?>
<?php
if( isset($_SESSION['yonetici']) && !empty($_SESSION['yonetici']) ){
  $records = $conn->prepare('SELECT * FROM yoneticiler WHERE id = :id');
  $records->bindParam(':id', $_SESSION['yonetici']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = NULL;
  if( count($results) > 0){
    $user = $results;
  }
}
else
{
  header("Location: giris.php");
  die();
}
?>

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
  </ol>
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM reprezant");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo 'Toplam Reprezant Sayısı : <b>'.$say.'</b>';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=repler">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-money-bill-alt"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM satislar");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo ' Toplam Satış Sayısı : <b>'.$say.'</b>';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=satislar">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-box-open"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM urunler");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo ' Toplam Ürün Sayısı : <b>'.$say.'</b>';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=urunler">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-code-branch"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM subeler");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo ' Toplam Şube Sayısı : <b>'.$say.'</b>';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=subeler">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-money-bill-alt"></i> Satışlar</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Reprezant Adı Soyadı</th>
            	<th>Ürün</th>            
            	<th>Satış Tutarı</th>
				<th>Yıl</th>  
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php  
  $verial1 = $conn -> prepare("SELECT reprezant.repad, reprezant.repsoyad, urunler.urunbaslik, satislar.id, satislar.satistutari, satislar.rep_id, satislar.urun_id, satislar.yil, satislar.ekleyen FROM satislar,reprezant,urunler where reprezant.id = satislar.rep_id AND urunler.id = satislar.urun_id order by ID desc limit 5");
  $verial1-> execute();  
  while ($satisgoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '    
                <td>'.$satisgoster['repad'].' '.$satisgoster['repsoyad'].'</td>
                <td>'.$satisgoster['urunbaslik'].'</td>                
                <td class="bg-secondary text-white">'.$satisgoster['satistutari'].' TL</td>
				<td>'.$satisgoster['yil'].'</td>
				<td><a href="?sayfa=satisduzenle&id='.$satisgoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
				<a href="?sayfa=satislar&id='.$satisgoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
    ';
  }
  ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">Son Eklenen 5 Satış Listelenir.</div>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-users"></i> Reprezantlar</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Reprezant Adı Soyadı</th>
				<th>Prim Orani</th>    
                <th>Şube</th>
				<th>Şehir</th>	  
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php  
  $verial1 = $conn -> prepare("SELECT reprezant.id, reprezant.repad, reprezant.repsoyad, reprezant.sube_id, reprezant.primorani, subeler.subeisim, sehirler.sehirisim FROM reprezant,subeler,sehirler where subeler.id = reprezant.sube_id AND sehirler.id = subeler.sehir_id order by ID desc limit 5");
  $verial1-> execute();  
  while ($satisgoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
    echo '    
                <td>'.$satisgoster['repad'].' '.$satisgoster['repsoyad'].'</td>
                <td class="bg-secondary text-white">% '.$satisgoster['primorani'].'</td>                
                <td>'.$satisgoster['subeisim'].'</td>
				<td>'.$satisgoster['sehirisim'].'</td>
				<td><a href="?sayfa=repduzenle&id='.$satisgoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
				<a href="?sayfa=repler&id='.$satisgoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
    ';
  }
  ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">Son Eklenen 5 Reprezant Listelenir.</div>
      </div>
    </div>
  </div>
</div>