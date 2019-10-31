<?php
	require_once "../inc/ayarlar.php";	
							
	$lokasyonlar = $_POST["lokasyonlar"];
	$sektorler = $_POST["sektorler"];
	$pozisyonlar = $_POST["pozisyonlar"];
	$calismaSekilleri = $_POST["calismaSekilleri"];
	$yasBas = $_POST["yasBas"];
	$yasBit = $_POST["yasBit"];
	$medenidurumu = $_POST["medenidurumu"];
	$cinsiyet = $_POST["cinsiyet"];
	$surucubelgesi = $_POST["surucubelgesi"];
	$askerlikDurumu = $_POST["askerlikDurumu"];	

	
	$loksDizi = explode(",", trim($lokasyonlar, ",")); // buradaki trim amacı başta ve sonda olan virgülleri silmek için.
	$sekDizi = explode(",", trim($sektorler, ","));
	$pozDizi = explode(",", trim($pozisyonlar, ","));
	$csDizi = explode(",", trim($calismaSekilleri, ","));	
	$askDizi = explode(",", trim($askerlikDurumu, ","));

	$sorgu = "SELECT * FROM uyelerara WHERE";

	$sorgu .= " aktif=1 AND cvAktif=1 AND resim != ''"; // hiçbiri seçilmesede bu varsayılan olduğu için sorguda sıkıntı çıkmayacak.

	switch ($medenidurumu) { // hepsi ise kısıtlanmayacak.

		case 'Bekar':
			$sorgu .= " AND medeniDurum='Bekar'";
			break;

		case 'Evli':
			$sorgu .= " AND medeniDurum='Evli'";
			break;
		
	}

	switch ($cinsiyet) { // hepsi ise kısıtlanmayacak.

		case 'Bay':
			$sorgu .= " AND cinsiyet='Bay'";
			break;

		case 'Bayan':
			$sorgu .= " AND cinsiyet='Bayan'";
			break;
		
	}

	switch ($surucubelgesi) { // hepsi ise kısıtlanmayacak.

		case 'Var':
			$sorgu .= " AND surucuBelgesi='Var'";
			break;

		case 'Yok':
			$sorgu .= " AND surucuBelgesi='Yok'";
			break;				

	}

	if($yasBas != "Hepsi" && $yasBit != "Hepsi")
	{
		$sorgu .= " AND yasi BETWEEN ".$yasBas." AND ".$yasBit."";
	}	

	$lokilkgiris = true;
	foreach ($loksDizi as $lok) { 
		if($lokilkgiris) // ilk giriş
		{
			$sorgu .= " AND lokasyon LIKE '%".trim($lok, " ")."%'"; // buradaki trim amacı başta ve sondaki boşlukları silmek için
			$lokilkgiris = false;
		}
		else
			$sorgu .= " OR lokasyon LIKE '%".trim($lok, " ")."%'"; 


	}

	$sekilkgiris = true;
	foreach ($sekDizi as $sek) { 
		if($sekilkgiris)
		{
			$sorgu .= " AND sektor LIKE '%".trim($sek, " ") ."%'";
			$sekilkgiris = false;
		}
		else
			$sorgu .= " OR sektor LIKE '%".trim($sek, " ") ."%'";
	}

	$pozilkgiris = true;
	foreach ($pozDizi as $poz) { 
		if($pozilkgiris)
		{
			$sorgu .= " AND pozisyon LIKE '%".trim($poz, " ") ."%'";
			$pozilkgiris = false;
		}
		else
			$sorgu .= " OR pozisyon LIKE '%".trim($poz, " ") ."%'";
	}

	$csilkgiris = true;
	foreach ($csDizi as $cs) { 
		if($csilkgiris)
		{
			$sorgu .= " AND calismaSekli LIKE '%".trim($cs, " ") ."%'";
			$csilkgiris = false;
		}
		else
			$sorgu .= " OR calismaSekli LIKE '%".trim($cs, " ") ."%'";
	}

	$askdrmilkgiris = true;
	foreach ($askDizi as $askdrm) { 
		if($askdrmilkgiris)
		{
			$sorgu .= " AND askerlikDurumu LIKE '%".trim($askdrm, " ") ."%'";
			$askdrmilkgiris = false;
		}
		else
			$sorgu .= " OR askerlikDurumu LIKE '%".trim($askdrm, " ") ."%'";
	}

	$query = $db->prepare($sorgu);
	if ($query->execute()) 
	{
		while ($satir = $query->fetch()) 
		{				

			echo '<div class="kisi">';
				echo '<div class="kresim">';
					
				if($satir["resim"] == "")
				{
					echo'<img class="img-circle resimg" src="images/profile.png"/>';
				}
				else
				{
					echo'<img class="img-circle resimg" src="data:image/jpeg;base64, '.$satir["resim"].'" />';													
				}
				echo '</div>';
				echo '<div class="kbilgiler">';
					echo '<span class="kyazistil">İsmi: '.$satir["isim"].'</span><br/>';
					echo '<span class="kyazistil">Yaşı: '.$satir["yasi"].'</span><br/>';
					echo '<span class="kyazistil">CV G.Tarihi: '.date("d/m/Y", strtotime($satir["cvguncel"])).'</span><br/>';
					$loks=explode(",",$satir["lokasyon"]);
					if(count($loks) > 0)
						echo '<span class="kyazistil">Yer: '.$loks[0].'</span>';
					else
						echo '<span class="kyazistil">Yer: Seçilmemiş.</span>';
				echo '</div>';
				echo '<div class="konbilgi kyazistil">';
					echo '<span class="kyazistil">Ön Bilgi:</span><br/>';
					echo $satir["onBilgi"];		  							
				echo '</div>';
				echo '<div class="kdetay">';
				echo "<a href='elemanincele.php?id=".$satir["id"]."' target='_blank'><img src='images/cvdetail.png' class='cvdetay' /></a>";
				echo '</div>';
			echo '</div>';
			echo '<hr style="border-color:#26BDD0"/>';

		}
	}	
?>