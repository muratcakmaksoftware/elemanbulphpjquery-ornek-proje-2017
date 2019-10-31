<?php
	require_once "../inc/ayarlar.php";				
							
	$aranan = $_POST["aranan"];
	$lok = $_POST["lok"];	
	
	$arananDizi = explode(",", trim($aranan, ",")); // buradaki trim amacı başta ve sonda olan virgülleri silmek için.	


	$sorgu = "SELECT * FROM uyelerara WHERE";

	$sorgu .= " aktif=1 AND cvAktif=1 AND resim != ''"; // hiçbiri seçilmesede bu varsayılan olduğu için sorguda sıkıntı çıkmayacak.
	
	if($lok != "Hepsi")
	{
		$sorgu .= " AND lokasyon LIKE '%".trim($lok, " ")."%'"; // buradaki trim amacı başta ve sondaki boşlukları silmek için
	}

	$ilkgirissek = true;
	foreach ($arananDizi as $sek) {		
		if($ilkgirissek)
		{
			$sorgu .= " AND sektor LIKE '%".trim($sek, " ") ."%'";
			$ilkgirissek = false;
		}
		else
		{
			$sorgu .= " OR sektor LIKE '%".trim($sek, " ") ."%'";
		}
		
	}
	$ilkgirispoz = true;
	foreach ($arananDizi as $poz) {	
		if($ilkgirispoz)
		{
			$sorgu .= " AND pozisyon LIKE '%".trim($poz, " ") ."%'";
			$ilkgirispoz = false;
		}
		else
		{
			$sorgu .= " OR pozisyon LIKE '%".trim($poz, " ") ."%'";
		}
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