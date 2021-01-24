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




<div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Yıllara Göre Toplam Satış Tutarı
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>                                    
                                </div>
                            </div>

<?php
$baglanti = mysqli_connect("localhost","kds_odev","_Oo09y0jd99!5trS","kds_odev");
$satis_sorgu = mysqli_query($baglanti,"SELECT sum(satislar.satistutari) as toplamsatis FROM satislar GROUP BY satislar.yil");
$yil_sorgu = mysqli_query($baglanti,"SELECT yil FROM satislar GROUP BY yil");
?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
                   	var miktar=[<?php while ($sonuc2=mysqli_fetch_assoc($satis_sorgu)) { echo '"' . $sonuc2['toplamsatis'] . '",';}?>];	
					var adlar=[<?php while ($sonuc=mysqli_fetch_assoc($yil_sorgu)) { echo '"' . $sonuc['yil'] . '",';}?>];
		
					var kanvas = document.getElementById('myBarChart').getContext('2d');
					var chart = new Chart(kanvas, {
						type: "bar",
						data: { 
							labels: adlar,
							datasets: [{
								label: 'Toplam Satış Tutarı (TL)',
								backgroundColor: "rgba(2,117,216,1)",		
								borderColor: "rgba(2,117,216,1)",
								data: miktar,
							
				}]
			},
			options: {
				legend:{
					labels: {						
					}
				},
				scales: {
					yAxes: [{
						ticks:{							
							beginAtZero: true,
							min: 0,
         					max: 400000,
          					maxTicksLimit: 10
						}
					}],
					xAxes:[{
						ticks:{							
						}
					}]
				}
			}
		});
</script>