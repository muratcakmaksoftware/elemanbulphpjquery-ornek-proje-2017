<?php
	require "inc/ayarlar.php";	
	session_start();

	if(isset($_SESSION["kadi"]) || isset($_SESSION["pw"]))
	{
		header("Location:uye/index.php");
	}


	if(isset($_POST["girisyap"]))
	{

		if(isset($_POST["kadi"]) && isset($_POST["kpw"]))
		{
			$kadi = $_POST["kadi"];
			$pw = $_POST["kpw"];
			$isim = "";
			$id = -1;
			$knt = false;
			$query = $db->prepare("SELECT * FROM uyeler WHERE kadi = ? AND pw = ? AND aktif=1");
			if ($query->execute(array($kadi, $pw))) {
				while ($satir = $query->fetch()) {
					$id = $satir["id"];
					$isim = $satir["isim"];							
					$knt = true;
					break;																				
				}
			}

			if($knt)
			{
				$_SESSION["kadi"] = $kadi;
				$_SESSION["pw"] = $pw;
				$_SESSION["isim"] = $isim;
				$_SESSION["id"] = $id;
				header("Location:uye/index.php");
			}
			else
			{
				echo "
				<center>
					<div class=\"alert alert-warning\" role=\"alert\"> 
				   		<strong>Dikkat!</strong> Kullanıcı Adı Veya Şifre Yanlış
					</div>
				</center>";
			}
		}
		else
			echo "
				<center>
					<div class=\"alert alert-warning\" role=\"alert\"> 
				   		<strong>Dikkat!</strong> Kullanıcı Adı Veya Şifre Boş Geçilemez.
					</div>
				</center>";	
		
	}

	if(isset($_POST["kayitol"]))
	{

		if(isset($_POST["risim"]) && isset($_POST["rkadi"]) && isset($_POST["remail"]) && isset($_POST["rpw"]) && isset($_POST["rpw2"]))
		{
			
			$isim = $_POST["risim"];
			$id = -1;

			$kadi = $_POST["rkadi"];
			$pw = $_POST["rpw"];
			$email = $_POST["remail"];
			
			$knt = false;
			$query = $db->prepare("SELECT * FROM uyeler WHERE kadi = ?");
			if ($query->execute(array($kadi))) {
				while ($satir = $query->fetch()) {						
					$knt = true;
					break;																				
				}
			}

			if($knt)
			{
				echo "
				<center>
					<div class=\"alert alert-warning\" role=\"alert\"> 
				   		<strong>Dikkat!</strong> Aynı kullanıcı adı kullanımda.<br/> Lütfen Farklı Bir Kullanıcı Adı Giriniz.
					</div>
				</center>";

				
			}
			else
			{
				$kayitTarihi = date("Y"). "-".date("m")."-".date("d");

				$query = $db->prepare("INSERT INTO uyeler SET
				isim = ?, kadi = ?, pw = ?, email = ?, kayitTarihi = ?");
				$insert = $query->execute(array(
					$isim, $kadi,$pw, $email, $kayitTarihi
				));
				if ( $insert ){
					// Id bilgisi alınması için kullanıcı adı ve şifre tekrar kontrol ediliyor.
					$knt = false;
					$query = $db->prepare("SELECT * FROM uyeler WHERE kadi = ? AND pw = ? AND aktif=1");
					if ($query->execute(array($kadi, $pw))) {
						while ($satir = $query->fetch()) {						
							$knt = true;
							$id = $satir["id"];
							$isim = $satir["isim"];	
							break;																				
						}
					}

					if($knt)
					{
						$_SESSION["kadi"] = $kadi;
						$_SESSION["pw"] = $pw;
						$_SESSION["isim"] = $isim;
						$_SESSION["id"] = $id;
						header("Location:uye/index.php");
					}
					else
					{
						echo "
						<center>
							<div class=\"alert alert-warning\" role=\"alert\"> 
						   		<strong>Dikkat!</strong> Kullanıcı Adı Veya Şifre Yanlış
							</div>
						</center>";
					}

					
				}
				else
					echo "
				<center>
					<div class=\"alert alert-warning\" role=\"alert\"> 
				   		<strong>Dikkat!</strong> Kayıt Ederken Sorun Oluştu Lütfen Tekrar Deneyin.
					</div>
				</center>";

				
				
			}
		}
		else
			echo "
				<center>
					<div class=\"alert alert-warning\" role=\"alert\"> 
				   		<strong>Dikkat!</strong> Gerekli Yerleri Doldurunuz.
					</div>
				</center>";			
		
	}


?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Elemanı Bul Giriş/Üye Ol</title>
	    <meta name="description" content="Bize katılın ve daha hızlı iş bulun.">
		<meta name="keywords" content="eleman bul,eleman bul giriş yap,eleman bul üye ol,işçi bul,ücretsiz eleman ara">
		<meta name="author" content="Murat Çakmak">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="css/elemanbul.css" type="text/css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<link rel="stylesheet" href="css/login.css" type="text/css">
		<script src="js/login.js"></script>

		<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
		<link rel="manifest" href="favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
	</head>

<body>
	
	<div id="preloader">
	    <div id="status">&nbsp;</div>
	</div>	
	<script type="text/javascript">$('#preloader').delay(350).css({'display':'block'});</script>

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<center><a href="index.php"><img src="images/logoblack.png" class="logo" style="margin-left:10px;margin-top:10px;" /></a></center>
			</div>


		</div>

    	<div class="row" style="margin-top:30px;">
    		<div id="bildiri">
	    		
			</div>

			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Giriş Yap</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Kayıt Ol</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="kadi" id="kuser" tabindex="1" class="form-control" placeholder="Kullanıcı Adı" value="">
									</div>
									<div class="form-group">
										<input type="password" name="kpw" id="kpw" tabindex="2" class="form-control" placeholder="Şifre">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="girisyap" onclick="return loginKontrol()" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Giriş Yap">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Şifremi unuttum?</a>
												</div>
											</div>
										</div>
									</div>
								</form>

								<form id="register-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="risim" id="risim" tabindex="1" class="form-control" placeholder="İsminiz" value="">
									</div>
									<div class="form-group">
										<input type="text" name="rkadi" id="ruser" tabindex="1" class="form-control" placeholder="Kullanıcı Adı" value="">
									</div>
									<div class="form-group">
										<input type="email" name="remail" id="remail" tabindex="1" class="form-control" placeholder="Email Adresi" value="">
									</div>
									<div class="form-group">
										<input type="password" name="rpw" id="rpw" tabindex="2" class="form-control" placeholder="Şifre">
									</div>
									<div class="form-group">
										<input type="password" name="rpw2" id="rpw2" tabindex="2" class="form-control" placeholder="Şifre Tekrarı">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="kayitol" onclick="return kayitKontrol()" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Kayıt Ol">
											</div>
										</div>
									</div>
								</form>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function loginKontrol()
		{
			if($('#kuser').val().trim() != "" && $('#kpw').val().trim() != "" && $('#kuser').val().trim().length >= 5)
			{
				return true;
			}
			else
			{
				$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
				  '<strong>Dikkat!</strong> Kullanıcı Adı Veya Şifreyi Boş Geçemezsiniz.'+
				'</div>');
				return false;
			}
		}

		function kayitKontrol()
		{
			if($('#risim').val().trim() != "" && $('#ruser').val().trim() != "" && $('#remail').val().trim() != "" && $('#rpw').val().trim() != "" && $('#rpw2').val().trim() != "")
			{
				if($('#ruser').val().trim().length >= 5 && $('#rpw').val().trim().length >= 5)
				{
					if($('#rpw').val().trim() == $('#rpw2').val().trim())
					{
						if(isEmail($('#remail').val().trim()))
						{
							if(isKullanici($('#ruser').val().trim()) && isKullanici($('#rpw').val().trim()))
							{
								return true;
							}
							else
							{
								$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
						  '<strong>Dikkat!</strong> Kullanıcı Adını Veya Şifrenizi Doğru Giriniz.<br/>Sadece Harf Ve Sayı girebilirsiniz.'+
						'</div>');
								return false;	
							}
						}
						else
						{
							$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
					  '<strong>Dikkat!</strong> Email adresinizi doğru girdiğinizden emin olun.'+
					'</div>');
							return false;	
						}
						
					}
					else
					{
						$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
					  '<strong>Dikkat!</strong> Şifreler Uyuşmadı Lütfen Kontrol Edin.'+
					'</div>');
						return false;
					}
				}
				else
				{
					$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
					  '<strong>Dikkat!</strong> Kullanıcı Adı Ve Şifre En Az 5 Karakterli Olmalıdır.'+
					'</div>');
					return false;
				}
				
				
			}
			else
			{

				$('#bildiri').html('<div class="alert alert-warning" role="alert">'+
				  '<strong>Dikkat!</strong> Gerekli Yerleri Doldurunuz.'+
				'</div>');
				return false;
			}
		}

		function isEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
		}

		function isKullanici(kadi){
			var regex = /^[a-zA-Z0-9]+$/;
			return regex.test(kadi);
		}
		
		$('#preloader').delay(350).css({'display':'none'});

	</script>

</body>
</html>