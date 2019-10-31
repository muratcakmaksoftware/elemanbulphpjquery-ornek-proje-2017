<?php
	require_once "header.php";


	require "inc/ayarlar.php";
	
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];

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
		$uyelikTarihi = "";
		$calismaSekli = "";
		$calismaDrm = -1;
		$cvguncel = "";
		$knt = false;
		$query = $db->prepare("SELECT * FROM uyeler WHERE id=? AND cvAktif=1 AND aktif=1");
		if ($query->execute(array($id))) {
			while ($satir = $query->fetch()) {
				$isim = $satir["isim"];
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
				$uyelikTarihi = $satir["kayitTarihi"];
				$knt = true;
				break;
			}
		}

		if(!$knt)
		{
			header("Location:index.php");
		}
	}
	else
		header("Location:index.php");
	
?>

	<div class="container-full">

		<div class="row">
			<div class="col-md-12 text-center">
			 	<div class="container">

			 		<?php 
		  				if($resim == "")
		  					echo "<img class=\"img-circle\" src=\"images/profile.png\" width=\"200\" height=\"200\" />";
		  				else
		  					echo "<img class=\"img-circle\" src=\"data:image/jpeg;base64, ".$resim."\" width=\"200\" height=\"200\" />";
		  			?>
					
		  			<h2 class="kalin"><?php echo $isim ?></h2>
		  			<hr/>
		  			<span class="yazibaslik">Bilgilerim</span><br/>
		  			<span class="yazitema1"><?php echo "CV Güncelleme Tarihi: ".date("d/m/Y", strtotime($cvguncel)); ?></span><br/>
		  			<span class="yazitema1"><?php echo "Üyelik Tarihi: ". date("d/m/Y", strtotime($uyelikTarihi));?></span><br/>		  				  			
		  			<span class="yazitema1"><?php echo "Cinsiyet: ".$cinsiyet; ?></span><br/>
		  			<span class="yazitema1"><?php echo "Sürücü Belgesi: ".$surucuBelgesi; ?></span><br/>
		  			<span class="yazitema1"><?php echo "Medeni Durumu: ".$medeniDurumu; ?></span><br/>
	  				<?php
		  				if($cinsiyet == "Bay")
		  				{
		  					echo '<span class="yazitema1">Askerlik Durumu:'.$askerlikDurumu.'</span><br/>';
		  				}
		  			?>
		  					  			
		  			<span class="yazitema1"><?php if($calismaDrm == 1) echo "Çalışma Durumu: Çalışıyor"; else echo "Çalışma Durumu: Çalışmıyor"; ?></span><br/>
		  			<span class="yazitema1"><?php echo "Doğum Tarihi: ".date("d/m/Y", strtotime($dogumTarihi)); ?> Yaşı: <?php echo date("Y") - date("Y", strtotime($dogumTarihi)) ?></span><br/>
		  			<span class="yazitema1"><?php echo "Telefon Numarası: ".$tel; ?></span><br/>
		  			<span class="yazitema1"><?php echo "E-Mail Adresi: ".$email; ?></span><br/>	  			
					<hr/>

		  			<span class="yazibaslik">Çalışmak İstediği Konumlar(Lokasyon)</span><br/>
		  			<span class="yazitema1"><?php echo trim($lokasyon, ",") ?></span>					
					<hr/>		  			

		  			<span class="yazibaslik">İlgilendiği Sektörler (Sektör)</span><br/>
		  			<span class="yazitema1"><?php echo trim($sektor, ",") ?></span>
					<hr style="width:100%;height:1px;" />

					<span class="yazibaslik">İlgilendiği Pozisyonlar</span><br/>
		  			<span class="yazitema1"><?php echo trim($pozisyon, ",") ?></span>
					<hr/>
					
					<span class="yazibaslik">Ön Bilgi</span><br/>
		  			<span class="yazitema1"><?php echo $onBilgi ?></span>
					<hr/>

					<span class="yazibaslik">Yetenekleri/Kendisi Hakkında</span><br/>					
		  			<span class="yazitema1"><?php echo $cv ?></span>
					<hr/>

					<span class="yazibaslik">Göz Atmanızı İstediği Web Siteleri</span><br/>
					<?php
						$siteLinker = "";
						$siteDizi = explode(" ", $siteler);
						foreach ($siteDizi as $site) {
							$siteLinker .= "<a href='http://".$site."' target='_blank'>".$site."</a> ";
						}
					?>
		  			<span class="yazitema1"><?php echo $siteLinker ?></span>
					<hr/>

					<span class="yazibaslik">Üniversite Bilgileri</span><br/>					
		  			<span class="yazitema1"><?php echo $uniBilgileri ?></span>
					<hr/>

					<span class="yazibaslik">Lise Bilgileri</span><br/>					
	  				<span class="yazitema1"><?php echo $liseBilgileri ?></span>
					<hr/>

					<span class="yazibaslik">Dil Bilgileri</span><br/>										
	  				<span class="yazitema1"><?php echo $dilBilgisi ?></span>	  			
		  			

			 	</div>
			</div>
		</div>

	</div>

	

	
	
<?php
	include "footer.php";	
?>