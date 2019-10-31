<?php
	require_once "header.php";	
	require "../inc/ayarlar.php";
		
	$kadi = "";
	$pw = "";
	$tel = "";
	$email = "";
	$lokasyon = "";
	$sektor = "";
	$pozisyon = "";
	$dogumTarihi = "";
	$medeniDurumu = "";
	$cinsiyet = "";
	$surucuBelgesi = "";
	$askerlikDurumu = "";
	$uniBilgileri = "";
	$liseBilgileri = "";
	$onBilgi = "";
	$cv = "";
	$siteler = "";
	$dilBilgisi = "";
	$resim = "";
	$calismaSekli = "";
	$calismaDrm = -1;
	$cvguncel = "";
	$cvAktif = -1;

	if(isset($_SESSION["kadi"]) && isset($_SESSION["pw"]) && isset($_SESSION["id"]))
	{

		//Session bilgi kontrolü
		$kadi = $_SESSION["kadi"];
		$pw = $_SESSION["pw"];
		$id = $_SESSION["id"];

		$knt = false;
		$query = $db->prepare("SELECT * FROM uyeler WHERE kadi = ? AND pw = ? AND id = ? AND aktif=1");
		if ($query->execute(array($kadi, $pw, $id))) {
			while ($satir = $query->fetch()) {	
				$isim = $satir["isim"];
				$kadi = $satir["kadi"];
				$pw = $satir["pw"];
				$tel = $satir["tel"];
				$lokasyon = $satir["lokasyon"];
				$sektor = $satir["sektor"];
				$pozisyon = $satir["pozisyon"];
				$email = $satir["email"];
				$dogumTarihi = $satir["dogumTarihi"];
				$medeniDurumu = $satir["medeniDurum"];
				$cinsiyet = $satir["cinsiyet"];
				$surucuBelgesi = $satir["surucuBelgesi"];
				$askerlikDurumu = $satir["askerlikDurumu"];
				$uniBilgileri = $satir["uniBilgileri"];
				$liseBilgileri = $satir["liseBilgileri"];
				$onBilgi = $satir["onBilgi"];
				$cv = $satir["cv"];
				$siteler = $satir["siteler"];
				$dilBilgisi = $satir["dilBilgisi"];
				$cvAktif = $satir["cvAktif"];
				$resim = $satir["resim"];
				$calismaSekli = $satir["calismaSekli"];
				$calismaDrm = $satir["calismaDurumu"];
				$cvguncel = $satir["cvguncel"];
				$knt = true;
				break;																				
			}
		}	

		if(!$knt) // eğer login bilgileri yanlış ise logout yaptır.
		{
			header("Location:logout.php");
		}
	}
	else
	{
		header("Location:logout.php");
	}
						

	if(isset($_POST["kaydet"]))
	{

		$mesaj = "";
		$sorgu = "";
		
		$pw = $_SESSION["pw"];

		$isim = "";
		$tel = "";
		$email = "";
		$lokasyon = "";
		$sektor = "";
		$pozisyon = "";
		$dogumTarihi = "";
		$medeniDurumu = "";
		$cinsiyet = "";
		$surucuBelgesi = "";
		$askerlikDurumu = "";
		$uniBilgileri = "";
		$liseBilgileri = "";
		$onBilgi = "";
		$cv = "";
		$siteler = "";
		$dilBilgisi = "";
		$calismaSekli = "";
		$calismaDrm = -1;
		$cvguncel = "";
		$cvAktif = -1;


		if(isset($_POST["isim"]) && isset($_POST["tel"]) && isset($_POST["email"]) && isset($_POST["cv"]) && isset($_POST["gun"]) && isset($_POST["ay"]) && isset($_POST["yil"]))
		{

			if(isset($_POST["isim"]))
				$isim = $_POST["isim"];

			if(isset($_POST["tel"]))
				$tel = $_POST["tel"];

			if(isset($_POST["email"]))
				$email = $_POST["email"];

			if(isset($_POST["eskipw"]) && isset($_POST["yenipw"]) && isset($_POST["yenipw2"]))
			{
				if($_POST["eskipw"] != "")
				{
					if($_POST["eskipw"] == $pw)
					{
						if($_POST["yenipw"] == $_POST["yenipw2"])
						{
							$pw = $_POST["yenipw"];
						}
						else
							$mesaj .= "<font color='red'>[*]Yeni Şifreler Uyuşmadığından Güncellenmedi.</font><br/>";										
					}
					else
						$mesaj .= "<font color='red'>[*]Mevcut Girdiğiniz Şifre Yanlış Olduğundan Yeni Şifre Güncellenmedi.</font><br/>";
				}

				
			}



			if(!empty($_POST['lokasyon_list']))
			{
				foreach($_POST['lokasyon_list'] as $loks) 
				{
					$lokasyon .= $loks.",";
			    }								    
			}
			else
			{
				$mesaj .= "[*]Lokasyon: Bilgilerinizi seçmenizi öneririz, seçmezseniz sizi bulmakta zorlanırlar.<br/>Eğer Lokasyon Bilginiz mevcut değil ise öneride bulununuz.<br/>";
			}


			if(!empty($_POST['sektor_list']))
			{
				foreach($_POST['sektor_list'] as $sek) 
				{
					$sektor .= $sek.",";
			    }
			}
			else
			{
				$mesaj .= "[*]Sektör: Bilgilerinizi seçmenizi öneririz, seçmezseniz sizi bulmakta zorlanırlar.<br/>Eğer Sektör Bilginiz mevcut değil öneride bulununuz.<br/>";
			}

			if(!empty($_POST['pozisyon_list']))
			{
				foreach($_POST['pozisyon_list'] as $poz) 
				{
					$pozisyon .= $poz.",";
			    }
			}
			else
			{
				$mesaj .= "[*]Pozisyon: Bilgilerinizi seçmenizi öneririz, seçmezseniz sizi bulmakta zorlanırlar.<br/>Eğer Pozisyon Bilginiz mevcut değil öneride bulununuz.<br/>";
			}

			

			if(!empty($_POST['calismasekli_list']))
			{
				foreach($_POST['calismasekli_list'] as $cs) 
				{
					$calismaSekli .= $cs.",";
			    }
			}
			else
			{
				$mesaj .= "[*]Çalışma Şekli: Bilgilerinizi seçmenizi öneririz, seçmezseniz sizi bulmakta zorlanırlar.<br/>";
			}



			

			if(isset($_POST["uniBilgileri"]))
				$uniBilgileri = $_POST["uniBilgileri"];

			if(isset($_POST["liseBilgileri"]))
				$liseBilgileri = $_POST["liseBilgileri"];

			if(isset($_POST["onBilgi"]))
				$onBilgi = $_POST["onBilgi"];

			if(isset($_POST["cv"]))
				$cv = $_POST["cv"];

			if(isset($_POST["siteler"]))
				$siteler = $_POST["siteler"];

			if(isset($_POST["dilBilgisi"]))
				$dilBilgisi = $_POST["dilBilgisi"];
			
			$dogumTarihi = $_POST["yil"]."-".$_POST["ay"]."-".$_POST["gun"];

			if(isset($_POST["medenidurumu"]))
				$medeniDurumu = $_POST["medenidurumu"];

			if(isset($_POST["cinsiyet"]))
			{
				$cinsiyet = $_POST["cinsiyet"];									
			}

			if(isset($_POST['askerlik_durumu']))
			{
				if($cinsiyet != "Bayan")
					$askerlikDurumu = $_POST["askerlik_durumu"];
				else
					$askerlikDurumu = "";
			}

			if(isset($_POST["surucuBelgesi"]))
				$surucuBelgesi = $_POST["surucuBelgesi"];

			if($_POST["calismaDrm"] == "Çalışmıyor")
				$calismaDrm = 0;
			else
				$calismaDrm = 1;
			

			if($_POST["cvdurum"] == "Aktif")
				$cvAktif = 1;
			else
				$cvAktif = 0;

			if(isset($_FILES["resim"]["type"]))
			{
				if($_FILES["resim"]["type"] == "image/jpg" || $_FILES["resim"]["type"] == "image/jpeg")
				{
					$resim = base64_encode(file_get_contents($_FILES["resim"]["tmp_name"]));
				}
			}

			if($resim == "")
			{
				$mesaj .= "[*]Profil resminizi koymanız gerekmektedir, koymazsanız aramalarda listelenmeyeceksiniz.<br/>";
			}

			$cvguncel = date("Y"). "-".date("m")."-".date("d");

			$query = $db->prepare("UPDATE uyeler SET
				isim = :pisim,
				pw = :ppw,
				lokasyon = :plokasyon,						
				sektor = :psektor,
				pozisyon = :ppozisyon,
				dogumTarihi = :pdogumTarihi,
				medeniDurum = :pmedeniDurum,
				cinsiyet = :pcinsiyet,
				surucuBelgesi = :psurucuBelgesi,
				askerlikDurumu = :paskerlikDurumu,
				uniBilgileri = :puniBilgileri,
				liseBilgileri = :pliseBilgileri,
				tel = :ptel,
				email = :pemail,
				cvAktif = :pcvAktif,
				cv = :pcv,
				onBilgi = :ponBilgi,
				siteler = :psiteler,
				dilBilgisi = :pdilBilgisi,
				calismaSekli = :pcalismaSekli,
				calismaDurumu = :pcalismaDurumu,
				cvguncel = :pcvguncel,
				resim = :presim 
				WHERE id = :kid");
				$update = $query->execute(array(
					 "pisim" => $isim,
					 "ppw" => $pw,
					 "plokasyon" => $lokasyon,
					 "psektor" => $sektor,
					 "ppozisyon" => $pozisyon,
					 "pdogumTarihi" => $dogumTarihi,
					 "pmedeniDurum" => $medeniDurumu,
					 "pcinsiyet" => $cinsiyet,
					 "psurucuBelgesi" => $surucuBelgesi,
					 "paskerlikDurumu" => $askerlikDurumu,
					 "puniBilgileri" => nl2br(strip_tags($uniBilgileri)),
					 "pliseBilgileri" => nl2br(strip_tags($liseBilgileri)),
					 "ptel" => $tel,
					 "pemail" => $email,
					 "pcvAktif" => $cvAktif,
					 "ponBilgi" => nl2br(strip_tags($onBilgi)),
					 "pcv" => nl2br(strip_tags($cv)),
					 "psiteler" => $siteler,
					 "pdilBilgisi" => nl2br(strip_tags($dilBilgisi)),
					 "pcalismaSekli" => $calismaSekli,
					 "pcalismaDurumu" => $calismaDrm,
					 "pcvguncel" => $cvguncel,
					 "presim" => $resim,
					 "kid" => $id
				));

				if ( $update )
				{
					$_SESSION["isim"] = $isim;
					$_SESSION["pw"] = $pw;					
			        $msj = '<div class="alert alert-success fade in">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
		    <strong>Başarılı!</strong> Değişiklikler Başarıyla Güncellendi.<br/>'.$mesaj.'
		  </div>';
				}

		}
		else
		{
			$mesaj .= "Lütfen gerekli bilgileri doldurunuz:İsim,Telefon,E-Mail,Kendinizi Tanıtınız,Doğum Tarihi";
			$msj = '<div class="alert alert-success fade in">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
		    <strong>Başarılı!</strong> Değişiklikler Başarıyla Güncellendi.<br/>'.$mesaj.'
		  </div>';
		}
	}
	

?>

	<script type="text/javascript">

		function cinsiyetKontrol(drm)
		{			
			if(drm)
			{				
				$("#askcnt").show();				
			}
			else
			{
				$("#askcnt").hide();
			}

		
}
		function kontroller()
		{
			var medenidrm = $('input[name="medenidurumu"]:checked').val();
			var cinsiyet = $('input[name="cinsiyet"]:checked').val();
			var surucuBelgesi =	$('input[name="surucuBelgesi"]:checked').val();
			if($("#isim").val() != "" && $("#tel").val() != "" && $("#email").val() != "" && $("#cv").val() != "" && $("#onBilgi").val() != "" && $("#gun").val() != "Gün" && $("#ay").val() != "Ay" && $("#yil").val() != "Yıl" && medenidrm != null && cinsiyet != null && surucuBelgesi != null)
			{			


				if($("#tel").val().length == 11 && isNumber($("#tel").val()))
				{
					if(isEmail($("#email").val()))
					{
						var lokasyonlarDizi = document.getElementsByName('lokasyon_list[]');
						var lokasyonlar = "";
						for (var i=0; i < lokasyonlarDizi.length;i++) 
						{
						    if (lokasyonlarDizi[i].checked) 
						    {
						        lokasyonlar += lokasyonlarDizi[i].value + ",";
						    }
						}

						var sektorDizi = document.getElementsByName('sektor_list[]');
						var sektorler = "";
						for (var i=0; i < sektorDizi.length;i++) 
						{
						    if (sektorDizi[i].checked) 
						    {
						        sektorler += sektorDizi[i].value + ",";
						    }
						}
						

						var pozisyonDizi = document.getElementsByName('pozisyon_list[]');
						var pozisyon = "";
						for (var i=0; i < pozisyonDizi.length;i++) 
						{
						    if (pozisyonDizi[i].checked) 
						    {
						        pozisyon += pozisyonDizi[i].value + ",";
						    }
						}

						if(lokasyonlar != "" && sektorler != "" && pozisyon != "")
						{
							
							if(cinsiyet == "Bay")
							{
								var askDrm = document.getElementById("askdurum");
								var askerlikDurumu = askDrm.options[askDrm.selectedIndex].value;
								if(askerlikDurumu != "")
								{
									return true;
								}
								else
								{
									$("#bildiri").html('<center>'+
									'<div class=\"alert alert-warning\" role=\"alert\">'+
							   		'<strong>Dikkat!</strong> Lütfen Askerlik Durumunu Seçiniz.'+
									'</div>'+
									'</center>');
									return false;
								}

							}
							else
							{
								//Bayan olduğu için askerlik durumunu kontrol etmeye gerek yok ve son kontrol olduğu için return true gönderiyoruz.
								return true;	
							}
							
						}
						else
						{
							$("#bildiri").html('<center>'+
							'<div class=\"alert alert-warning\" role=\"alert\">'+
					   		'<strong>Dikkat!</strong> Lokasyon, sektör ve pozisyondan en az bir tane seçmelisiniz.'+
							'</div>'+
							'</center>');
							return false;
						}

						
					}
					else
					{
						$("#bildiri").html('<center>'+
						'<div class=\"alert alert-warning\" role=\"alert\">'+
				   		'<strong>Dikkat!</strong> E-mail Formatını Yanlış Lütfen Geçerli Bir E-mail Adresi Giriniz.'+
						'</div>'+
						'</center>');
						return false;
					}
				}
				else
				{
					$("#bildiri").html('<center>'+
					'<div class=\"alert alert-warning\" role=\"alert\">'+
				   		'<strong>Dikkat!</strong> Telefon 11 Haneli Olmalıdır ve sadece sayı olmalıdır.'+
					'</div>'+
				'</center>');
					return false;

				}
			}
			else
			{
				$("#bildiri").html('<center>'+
					'<div class=\"alert alert-warning\" role=\"alert\">'+
				   		'<strong>Dikkat!</strong> Gerekli Bilgileri Doldurun.<br/>Gerekli Bilgiler:<br/>İsim,Telefon,E-Mail,Doğum Tarihi,Medeni Durum,Cinsiyet,Sürücü Belgesi, Baylar İçin Askerlik Durumu,Lokasyon,Sektör,Pozisyon,Ön Bilgi,Kendinizi Tanıtınız'+
					'</div>'+
				'</center>');
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

		function isNumber(nmbr){
			var regex = /^[0-9]+$/;
			return regex.test(nmbr);
		}

	</script>

	<!-- ÜYE PANELİ -->	
	<div class="container-firstpage">
		<div class="container-full gelismisArama">
			<div class="container">
				<br/>
				<center>
					<div>
						<?php 
							if(isset($msj))
								echo $msj; 
						?>
					</div>

					<span style="font-size:30px;">Hoşgeldin, <?php echo $_SESSION["isim"]; ?></span>					
					<hr/>
				</center>
				<div class="row">					
					<form name="elemaniGuncelle" action="" method="post" role="form" enctype="multipart/form-data">
						<center>
						<?php 
			  				if($resim == "")
			  					echo "<img id=\"resimGoster\" class=\"img-circle\" src=\"../images/profile.png\" width=\"200\" height=\"200\" />";
			  				else
			  					echo "<img id=\"resimGoster\" class=\"img-circle\" src=\"data:image/jpeg;base64, ".$resim."\" width=\"200\" height=\"200\" />";
			  			?>				  			
			  			<br/>
			  			<div class="fileUpload btn btn-primary">
						    <span>Resmi Seç</span>
						    <input id="file1" name="resim" type="file" onchange="readURL(this);" accept="image/*" class="upload" />
						</div>
						<div id="resBilgi">

						</div>
						<span style="font-size:23px;">CV Güncelleme Tarihiniz: <?php echo date("d/m/Y", strtotime($cvguncel)); ?></span>
						</center>

						<div class="col-md-4" style="margin-top:10px">
							<button type="button" class="secBaslik" onclick="$('#isimtelemail').toggle();" style="padding:10px;">
								<span style="font-size:20px !important;font-weight:bold;">İsim / Tel / E-Mail</span>
							</button>
							<div id="isimtelemail">
								<h4 style="font-weight:bold;">Kullanıcı Adınız / Değişmez</h4>
								<input type="text" class="form-control"  maxlength="80" placeholder="Kullanıcı Adı" value="<?php echo $kadi ?>" readonly>

								<h4 style="font-weight:bold;">İsminiz</h4>
								<input type="text" name="isim" id="isim" class="form-control" value="<?php echo $isim ?>" maxlength="80" placeholder="İsminiz">
								
								<h4 style="font-weight:bold;">Telefon Numaranız</h4>
								<input type="text" name="tel" id="tel" class="form-control" value="<?php echo $tel; ?>" maxlength="11" placeholder="Örneğin: 05345554411">

								<h4 style="font-weight:bold;">E-Mail Adresiniz</h4>
								<input type="text" name="email" id="email" class="form-control" value="<?php echo $email ?>" maxlength="50" placeholder="E-Mail Adresi">


							</div>
						</div>

						<div class="col-md-4" style="margin-top:10px">
							<button type="button" class="secBaslik" onclick="$('#dgmtarih').toggle();" style="padding:10px;">
								<span style="font-size:20px !important;font-weight:bold;">Doğum Tarihi</span>
							</button>
							<div id="dgmtarih">							
								
								<?php 
									$dizi = explode("-", $dogumTarihi);
								?>
								<center><span style="font-size:20px !important;">Gün</span></center>
								<div class="control-group">								
									<div class="select">
										<select name="gun" id="gun">
											<option value="Gün">Gün</option>
										    <?php

										    	for($i = 1; $i <= 31; $i++)
										    	{	
										    		if($dizi[2] == $i)
										    			echo "<option value='".$i."' selected> ".$i."</option>";
										    		else
										    			echo "<option value='".$i."'> ".$i."</option>";
										    	}
										    ?>
										</select>
										<div class="select__arrow"></div>
									</div>

									<center><span style="font-size:20px !important;">Ay</span></center>
									<div class="select">
										<select name="ay" id="ay">
											<option value="Ay">Ay</option>
										    <?php

										    	for($i = 1; $i <= 12; $i++)
										    	{	
										    		if($dizi[1] == $i)
										    			echo "<option value='".$i."' selected> ".$i."</option>";
										    		else								    			
										    			echo "<option value='".$i."'>".$i."</option>";
										    	}
										    ?>
										</select>
										<div class="select__arrow"></div>
									</div>

									<center><span style="font-size:20px !important;">Yıl</span></center>
									<div class="select">
										<select name="yil" id="yil">
											<option value="Yıl">Yıl</option>
										    <?php
										    	for($i = date('Y') - 100; $i <= date('Y'); $i++)
										    	{	
										    		if($dizi[0] == $i)
										    			echo "<option value='".$i."' selected> ".$i."</option>";
										    		else								    			
										    			echo "<option value='".$i."'>".$i."</option>";
										    	}
										    ?>
										</select>
										<div class="select__arrow"></div>
									</div>

								</div>
							</div>
						</div>	

						<div class="col-md-4" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#pwdegis').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Şifreyi Değiştirme</span></button>
							<div id="pwdegis">
								<h4 style="font-weight:bold;">Şifrenizi Girin</h4>
								<input type="password" name="eskipw" class="form-control"  maxlength="150" placeholder="Şu anki şifrenizi yazınız.">
								<h4 style="font-weight:bold;">Yeni Şifre</h4>
								<input type="password" name="yenipw" id="yenipw" class="form-control"  maxlength="150" placeholder="Yeni Şifre">
								<h4 style="font-weight:bold;">Yeni Şifre Tekrarı</h4>
								<input type="password" name="yenipw2" id="yenipw2" class="form-control"  maxlength="150" placeholder="Yeni Şifre Tekrarı">
							</div>
						</div>



						<div class="clear"></div>

						<div class="col-md-4" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#cinsiyet').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Cinsiyet</span></button>
							<div id="cinsiyet" style="padding:10px;">	
								<div class="control-group">									
									<label class="control control--radio">Bay<input type="radio" name="cinsiyet" <?php if($cinsiyet == "Bay") echo "checked='true'"; ?> value="Bay" onclick="cinsiyetKontrol(true)"/><div class="control__indicator"></div></label>
									<label class="control control--radio">Bayan<input type="radio" name="cinsiyet" <?php if($cinsiyet == "Bayan") echo "checked='true'"; ?> value="Bayan" onclick="cinsiyetKontrol(false)" /><div class="control__indicator"></div></label>
								</div>

								<div class="control-group" id="askcnt">
									<center><span style="font-size:20px !important;">Askerlik Durumu</span></center>
									<div class="select">
										<select name="askerlik_durumu" id="askdurum">
											<option value="Muaf" <?php if($askerlikDurumu == "Muaf") echo "selected"; ?> >Muaf</option>
											<option value="Yapıldı" <?php if($askerlikDurumu == "Yapıldı") echo "selected"; ?> >Yapıldı</option>
											<option value="Yapılmadı" <?php if($askerlikDurumu == "Yapılmadı") echo "selected"; ?> >Yapılmadı</option>
											<option value="Tecilli" <?php if($askerlikDurumu == "Tecilli") echo "selected"; ?> >Tecilli</option>
											<option value="Yapılıyor" <?php if($askerlikDurumu == "Yapılıyor") echo "selected"; ?> >Yapılıyor</option>
											<div class="select__arrow"></div>
										</select>
									</div>
								</div>
							</div>
						</div>		

						<div class="col-md-4" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#meddrmvesurucubelgesi').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Medeni Durumu / Sürücü Belgesi</span></button>
							<div id="meddrmvesurucubelgesi" style="padding:10px;">	
								<center><span style="font-size:20px !important;">Medeni Durumu</span></center>
								<div class="control-group">									
									<label class="control control--radio">Bekar<input type="radio" <?php if($medeniDurumu == "Bekar") echo "checked='true'"; ?> name="medenidurumu" value="Bekar" /><div class="control__indicator"></div></label>
									<label class="control control--radio">Evli<input type="radio" <?php if($medeniDurumu == "Evli") echo "checked='true'"; ?> name="medenidurumu" value="Evli" /><div class="control__indicator"></div></label>
								</div>
								<center><span style="font-size:20px !important;">Sürücü Belgesi</span></center>
								<div class="control-group">									
									<label class="control control--radio">Var<input type="radio" <?php if($surucuBelgesi == "Var") echo "checked='true'";  ?> name="surucuBelgesi" value="Var" /><div class="control__indicator"></div></label>
									<label class="control control--radio">Yok<input type="radio" <?php if($surucuBelgesi == "Yok") echo "checked='true'";  ?> name="surucuBelgesi" value="Yok" /><div class="control__indicator"></div></label>
								</div>
							</div>
						</div>															

						<div class="col-md-4" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#calismasekli').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Çalışma Şekli</span></button>
							<div id="calismasekli">						
								<div class="container-checkbox" style="height:230px;">
									<?php	
										$calismaSekilleri = array("Tam Zamanlı","Yarı Zamanlı","Freelance","Stajyer","Gönüllü","Fark etmez","Günlük","Saatlik","Dönemsel");
										$chkdizi = explode(",", $calismaSekli);
										$chkknt = false;							
										
										foreach ($calismaSekilleri as $calskl) {
											$chkknt = false;
											foreach ($chkdizi as $chk) {
												if(strtolower($calskl) == strtolower($chk))
												{
													$chkknt = true;
													break;
												}
											}
											if($chkknt)												
												echo "<label class='control control--checkbox'>".$calskl."<input type='checkbox' name='calismasekli_list[]' checked='true' value='".$calskl."'><div class='control__indicator'></div></label>";
											else
												echo "<label class='control control--checkbox'>".$calskl."<input type='checkbox' name='calismasekli_list[]' value='".$calskl."'><div class='control__indicator'></div></label>";
										}
										

									?>
								</div>
							</div>
						</div>

						<div class="clear"></div>						

						<div class="col-md-4" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#lokasyon').toggle();" style="padding:10px;">
								<span style="font-size:20px !important;font-weight:bold;">Lokasyon</span>
							</button>
							<div id="lokasyon">
								<div class="form-group has-feedback" style="margin:0;">						    
								    <input type="text" id="loksara" style="height:40px;font-size:20px;" class="form-control" placeholder="Örnek: İstanbul" />
								    <span class="glyphicon glyphicon-search form-control-feedback" style="font-size:20px;margin-top:3px;" ></span>
								</div>
								<div class="container-checkbox">
									<?php
										$query = $db->prepare("SELECT * FROM lokasyon WHERE onay=1 ORDER BY oncelik DESC");
										if ($query->execute()) {
											$chkdizi = explode(",", $lokasyon);
											$chkknt = false;
											$say = 0;
											while ($satir = $query->fetch()) {
												$chkknt = false;
												foreach ($chkdizi as $chk) {
													if(strtolower($chk) == strtolower($satir["isim"]))
													{
														$chkknt = true;
														break;
													}
												}

												if($chkknt)
												{
													echo "<label class='control control--checkbox' id='loks-$say'>".$satir["isim"]."<input type='checkbox' name='lokasyon_list[]' checked='true' value='".$satir["isim"]."'><div class='control__indicator'></div></label>";
												}
												else
												{
													echo "<label class='control control--checkbox' id='loks-$say'>".$satir["isim"]."<input type='checkbox' name='lokasyon_list[]' value='".$satir["isim"]."'><div class='control__indicator'></div></label>";
												}

												$say++;
											}
										}
								?>
								</div>
							</div>
						</div>

						<div class="col-md-4" style="margin-top:10px;">

							<button type="button" class="secBaslik" onclick="$('#sektor').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Sektör</span></button>
							<div id="sektor">
								<div class="form-group has-feedback" style="margin:0;">						    
								    <input type="text" id="sekara" style="height:40px;font-size:20px;" class="form-control" placeholder="Örnek: Bilişim" />
								    <span class="glyphicon glyphicon-search form-control-feedback" style="font-size:20px;margin-top:3px;" ></span>
								</div>						
								<div class="container-checkbox" >
									<?php										

										$query = $db->prepare("SELECT * FROM sektor WHERE onay=1 ORDER BY oncelik DESC"); 
										if ($query->execute()) {
											$chkdizi = explode(",", $sektor);
											$chkknt = false;
											$say = 0;
											while ($satir = $query->fetch()) {		
												$chkknt = false;
												foreach ($chkdizi as $chk) {
													if(strtolower($chk) == strtolower($satir["isim"]))
													{
														$chkknt = true;
														break;
													}
												}

												if($chkknt)
												{
													echo "<label class='control control--checkbox' id='sek-$say'>".$satir["isim"]."<input type='checkbox' name='sektor_list[]' checked='true' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
												}
												else
												{
													echo "<label class='control control--checkbox' id='sek-$say'>".$satir["isim"]."<input type='checkbox' name='sektor_list[]' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
												}

												$say++;
											}
										}

									?>
								</div>
							</div>

						</div>						
						<div class="col-md-4" style="margin-top:10px;">

							<button type="button" class="secBaslik" onclick="$('#pozisyon').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Pozisyon</span></button>
							<div id="pozisyon">
								<div class="form-group has-feedback" style="margin:0;">						    
								    <input type="text" id="pozara" style="height:40px;font-size:20px;" class="form-control" placeholder="Örnek: Bilgisayar Programcılığı" />
								    <span class="glyphicon glyphicon-search form-control-feedback" style="font-size:20px;margin-top:3px;" ></span>
								</div>						
								<div class="container-checkbox" >
									<?php
										$query = $db->prepare("SELECT * FROM pozisyon WHERE onay=1 ORDER BY oncelik DESC"); 
										if ($query->execute()) {
											$chkdizi = explode(",", $pozisyon);
											$chkknt = false;
											$say = 0;
											while ($satir = $query->fetch()) {		
												$chkknt = false;
												foreach ($chkdizi as $chk) {
													if(strtolower($chk) == strtolower($satir["isim"]))
													{
														$chkknt = true;
														break;
													}
												}

												if($chkknt)
												{
													echo "<label class='control control--checkbox' id='poz-$say'>".$satir["isim"]."<input type='checkbox' name='pozisyon_list[]' checked='true' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
												}
												else
												{
													echo "<label class='control control--checkbox' id='poz-$say'>".$satir["isim"]."<input type='checkbox' name='pozisyon_list[]' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
												}

												$say++;
											}
										}
									?>
								</div>
							</div>

						</div>
						<div class="clear"></div>

						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#uni').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Üniversite Bilgilerin</span></button>
							<div id="uni">
								<textarea class="form-control" name="uniBilgileri" rows="5"><?php echo strip_tags($uniBilgileri) ?></textarea>
							</div>
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#lise').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Lise Bilgilerin</span></button>
							<div id="lise">								
								<textarea class="form-control" name="liseBilgileri" rows="5"><?php echo strip_tags($liseBilgileri) ?></textarea>
							</div>
						</div>

						<div class="clear"></div>

						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#onbil').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Ön Bilginiz</span></button>
							<div id="onbil">															
								<textarea class="form-control" name="onBilgi" id="onBilgi" placeholder="[*]İlk 100 karakter aramada çıkacaktır." rows="8"><?php echo strip_tags($onBilgi) ?></textarea>
							</div>
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#tanit').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Kendinizi Tanıtın / Yapabildikleriniz</span></button>
							<div id="tanit">							
								<textarea class="form-control" name="cv" id="cv" rows="8"><?php echo strip_tags($cv) ?></textarea>
							</div>
						</div>

						<div class="clear"></div>

						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#sites').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Siteleriniz</span></button>
							<div id="sites">							
								<textarea class="form-control" name="siteler" rows="3" placeholder="[*]Boşluk bırakarak yazınız."><?php echo strip_tags($siteler) ?></textarea>
							</div>
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#dilbg').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Dil Bilginiz</span></button>
							<div id="dilbg">							
								<textarea class="form-control" name="dilBilgisi" rows="3"><?php echo strip_tags($dilBilgisi) ?></textarea>
							</div>
						</div>

						<div class="clear"></div>											

						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#caldrm').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Çalışma Durumun</span></button>
							<div id="caldrm" style="margin-top:10px;">															
								<div class="control-group">
									<div class="select">
										<select name="calismaDrm">
											<option value="Çalışmıyor" <?php if($calismaDrm == 0) echo "selected"; ?> >Çalışmıyor</option>
											<option value="Çalışıyor" <?php if($calismaDrm == 1) echo "selected"; ?> >Çalışıyor</option>
											<div class="select__arrow"></div>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6" style="margin-top:10px;">
							<button type="button" class="secBaslik" onclick="$('#cvyayin').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">CV Yayınlansın Mı ?</span></button>
							<div id="cvyayin" style="margin-top:10px;">															
								<div class="control-group" >
									<div class="select">
										<select name="cvdurum">
											<option value="Aktif" <?php if($cvAktif == 1) echo "selected"; ?> >Evet</option>
											<option value="Pasif" <?php if($cvAktif == 0) echo "selected"; ?> >Hayır</option>
											<div class="select__arrow"></div>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
						
						<button type="submit" name="kaydet" class="secBaslik" onclick="return kontroller();" style="width:100%; font-weight:bold;margin-top:5px;padding:10px; font-size:20px;">Kaydet</button>
						<br/><br/>
						<div id="bildiri">
						
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
		

	<?php // Cv kaydektikten sonra sayfa tekrar yüklemesinde cinsiyet kontrol edilip eğer bayan ise otomatik olarak kapalı olarak gelmesini sağlamak amacıyla bu script yazdım.
		if($cinsiyet == "Bayan")
		{
			echo "<script type='text/javascript'>cinsiyetKontrol(false);</script>";
		}
	?>

<script type="text/javascript">


	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
			if(input.files[0].size > 1050000)
			{				
				$('#resBilgi').html('<font color="red">[*]Resim 1 MB yüksek olamaz.</font>');				
				document.getElementById("file1").value = "";
			}
			else
			{
				if (!input.files[0].name.match(/.(jpg|jpeg)$/i))
				{
					$('#resBilgi').html('<font color="red">[*]Resim JPG Veya JPEG Formatında Olmalıdır.</font>');	
					document.getElementById("file1").value = "";
				}
				else
				{
					$('#resBilgi').html('');
		            reader.onload = function (e) {
		                $('#resimGoster')
		                    .attr('src', e.target.result)
		                    .width(200)
		                    .height(200);
		            };

		            reader.readAsDataURL(input.files[0]);
	        	}
            }

            	
        }
    }


    function lokscnt()
		{
			var aranan = document.getElementById("loksara");
			var lokasyonlarDizi = document.getElementsByName('lokasyon_list[]');
			var id;
			for (var i=0; i < lokasyonlarDizi.length;i++) 
			{
				id = document.getElementById("loks-"+i);
				id.style.display = 'block';
			}

			for (var i=0; i < lokasyonlarDizi.length;i++) 
			{
				if(lokasyonlarDizi[i].value.replace("İ", "i").toLowerCase().indexOf(aranan.value.replace("İ", "i").toLowerCase()) == -1)
				{
					id = document.getElementById("loks-"+i);
					id.style.display = 'none';
				}
			}			
			setTimeout(lokscnt, 1000);
		}

		function sekcnt()
		{
			var aranan = document.getElementById("sekara");
			var sekDizi = document.getElementsByName('sektor_list[]');
			var id;
			for (var i=0; i < sekDizi.length;i++) 
			{
				id = document.getElementById("sek-"+i);
				id.style.display = 'block';
			}

			for (var i=0; i < sekDizi.length;i++) 
			{
				if(sekDizi[i].value.replace("İ", "i").toLowerCase().indexOf(aranan.value.replace("İ", "i").toLowerCase()) == -1)
				{
					id = document.getElementById("sek-"+i);
					id.style.display = 'none';
				}
			}			
			setTimeout(sekcnt, 1000);
		}

		function pozcnt()
		{
			var aranan = document.getElementById("pozara");
			var pozDizi = document.getElementsByName('pozisyon_list[]');
			var id;
			for (var i=0; i < pozDizi.length;i++) 
			{
				id = document.getElementById("poz-"+i);
				id.style.display = 'block';
			}

			for (var i=0; i < pozDizi.length;i++) 
			{
				if(pozDizi[i].value.replace("İ", "i").toLowerCase().indexOf(aranan.value.replace("İ", "i").toLowerCase()) == -1)
				{
					id = document.getElementById("poz-"+i);
					id.style.display = 'none';
				}
			}			
			setTimeout(pozcnt, 1000);
		}

		setTimeout(lokscnt, 1000);
		setTimeout(sekcnt, 1000);
		setTimeout(pozcnt, 1000);

		$('#preloader').delay(350).css({'display':'none'});

</script>

<?php
	include "footer.php";	
?>