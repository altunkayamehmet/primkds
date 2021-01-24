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
function SayfaGetir(){
	if(isset($_GET['sayfa'])){
		switch ($_GET['sayfa']) {
			case 'anasayfa': include('sayfalar/anasayfa.php'); break;
			case 'hesabim': include('sayfalar/hesabim.php'); break;			
			case 'urunler': include('sayfalar/urunler.php'); break;
			case 'urunekle': include('sayfalar/urunekle.php'); break;
			case 'urunduzenle': include('sayfalar/urunduzenle.php'); break;
			case 'sehirler': include('sayfalar/sehirler.php'); break;
			case 'sehirekle': include('sayfalar/sehirekle.php'); break;
			case 'sehirduzenle': include('sayfalar/sehirduzenle.php'); break;
			case 'subeler': include('sayfalar/subeler.php'); break;
			case 'subeekle': include('sayfalar/subeekle.php'); break;
			case 'subeduzenle': include('sayfalar/subeduzenle.php'); break;
			case 'repduzenle': include('sayfalar/repduzenle.php'); break;	
			case 'repekle': include('sayfalar/repekle.php'); break;
			case 'repler': include('sayfalar/repler.php'); break;
			case 'satisduzenle': include('sayfalar/satisduzenle.php'); break;	
			case 'satisekle': include('sayfalar/satisekle.php'); break;
			case 'satislar': include('sayfalar/satislar.php'); break;
			case 'repgrafik': include('sayfalar/repgrafik.php'); break;
			case 'repgrafik2': include('sayfalar/repgrafik2.php'); break;	
			case 'yilgrafik': include('sayfalar/yilgrafik.php'); break;
			case 'urungrafik': include('sayfalar/urungrafik.php'); break;
			default: include('sayfalar/404.php'); break;
		}
	}else{
		include('sayfalar/anasayfa.php');
	}
}
?>
<?php 
$vericek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
$vericek->bindParam(1, $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $veriyigoster['site_title']; ?> | Yönetim Paneli</title>
	<link rel="shortcut icon" type="image/png" href="assets/resim/favicon/<?php echo $veriyigoster['site_favicon']; ?>"/>
	<meta name="description" content="<?php echo $veriyigoster['site_description']; ?>">
	<meta name="keywords" content="<?php echo $veriyigoster['site_keywords']; ?>">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<link href="assets/css/sb-admin.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">

</head>

<body id="page-top" class="sidebar-toggled">
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top ">
		<a class="navbar-brand mr-1" href="?sayfa=anasayfa">Yönetim Paneli</a>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<div class="input-group-append">
				</div>
			</div>
		</form>
		<ul class="navbar-nav ml-auto ml-md-0 float-right">		

			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="?sayfa=hesabim">Hesabım</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cikisModal">Çıkış Yap</a>
				</div>
			</li>
		</ul>
	</nav>
	<div id="wrapper">
		<ul class="sidebar navbar-nav toggled">
			<li class="nav-item active">
				<a class="nav-link" href="?sayfa=anasayfa">
					<i class="fas fa-fw fa-home"></i>
					<span>Ana Sayfa</span>
				</a>
			</li>			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-box-open"></i>
					<span>Ürünler</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=urunler">Ürün Listesi</a>
					<a class="dropdown-item" href="?sayfa=urunekle">Ürün Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-city"></i>
					<span>Şehirler</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=sehirler">Şehir Listesi</a>
					<a class="dropdown-item" href="?sayfa=sehirekle">Şehir Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-code-branch"></i>
					<span>Şubeler</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=subeler">Şube Listesi</a>
					<a class="dropdown-item" href="?sayfa=subeekle">Şube Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-users"></i>
					<span>Reprezantlar</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=repler">Reprezant Listesi</a>
					<a class="dropdown-item" href="?sayfa=repekle">Reprezant Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-money-bill-alt"></i>
					<span>Satışlar</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=satislar">Satış Listesi</a>
					<a class="dropdown-item" href="?sayfa=satisekle">Satış Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-chart-bar"></i>
					<span>Raporlama</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=repgrafik">Reprezant Grafiği (TL)</a>
					<a class="dropdown-item" href="?sayfa=repgrafik2">Reprezant Grafiği (Adet)</a>
					<a class="dropdown-item" href="?sayfa=yilgrafik">Yıl Grafiği</a>
					<a class="dropdown-item" href="?sayfa=urungrafik">Ürün Grafiği</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?sayfa=hesabim">
					<i class="fas fa-fw fa-user"></i>
					<span>Yönetici</span>
				</a>
			</li>		
		</ul>
		<div id="content-wrapper">
			<?php SayfaGetir(); ?>
			<footer class="sticky-footer">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright © 2021 <a target="_blank" title="Mehmet Altunkaya" href="https://www.mehmetaltunkaya.com/">Mehmet Altunkaya</a> tarafından kodlanmıştır.</span>
					</div>					
				</div>
			</footer>
		</div>
	</div>
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<div class="modal fade" id="cikisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Çıkış Yap ?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Mevcut oturumunuzu sonlandırmaya hazırsanız, aşağıdaki "Oturumu Kapat" ı seçin.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">İptal Et</button>
					<a class="btn btn-primary" href="cikis.php">Oturumu Kapat</a>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<script src="assets/js/sb-admin.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/vendor/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/demo/datatables-demo.js"></script>
	<script>
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {

				var input = $(this).parents('.input-group').find(':text'),
				log = label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#img-upload').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});   
		});


	</script>
</body>
</html>
