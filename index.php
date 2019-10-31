<?php
	require_once "header.php";	


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
	</script>

	<div class="cover">
		<div class="container aramaYap">			
			<input type="text" class="form-control aramainput" id="basitarama" placeholder="Bilgisayar, Sekreter, Eğitim" />
			<div class="control-group aragrup">					
				<div class="select">
					<select id="lokkolay" class="aramaselect">
						<option value="Hepsi" selected>Tüm Şehirler</option>
						<?php
							$query = $db->prepare("SELECT * FROM lokasyon WHERE onay=1 ORDER BY oncelik DESC");
							if ($query->execute()) {									
								while ($satir = $query->fetch()) {									
									echo "<option value='".$satir["isim"]."'>".$satir["isim"]."</option>";				
									
								}
							}
						?>
					</select>		
				</div>
			</div>			
			<a href="javascript:posted('php/elemanbasitara.php', 'islem', 'elemanbasitara')">
				<button type="button" class="btn btn-info aramabutton" >BUL</button>
			</a>			
		</div>
	</div>


	<div class="container-firstpage">	
		
		<div class="container-full gelismisArama">
			
			<div class="container" >
				<div class="row">
					<button type="button" class="secBaslik" id="detayliFiltre" onclick="$('#detayliFiltrele').toggle();" style="padding:10px;margin-top:10px;"><span style="font-size:20px !important;font-weight:bold;">Detaylı Filtrele</span></button>
					<div id="detayliFiltrele" style="margin-top:10px;">
						<form name="elemanAra" action="javascript:;" method="post" role="form">				
							<div class="col-md-4" style="margin-top:10px">
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
												$say = 0;
												while ($satir = $query->fetch()) {									
													echo "<label class='control control--checkbox' id='loks-$say'>".$satir["isim"]."<input type='checkbox' name='lokasyon_list[]' value='".$satir["isim"]."'><div class='control__indicator'></div></label>";				
													$say++;													
												}
											}
										?>
									</div>
								</div>
							</div>

							<div class="col-md-4" style="margin-top:10px">

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
												$say = 0;
												while ($satir = $query->fetch()) {									
													echo "<label class='control control--checkbox' id='sek-$say'>".$satir["isim"]."<input type='checkbox' name='sektor_list[]' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
													$say++;														
												}
											}
										?>
									</div>
								</div>

							</div>						
							<div class="col-md-4" style="margin-top:10px">

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
												$say = 0;
												while ($satir = $query->fetch()) {									
													echo "<label class='control control--checkbox' id='poz-$say'>".$satir["isim"]."<input type='checkbox' name='pozisyon_list[]' value='".$satir["isim"]."''><div class='control__indicator'></div></label>";			
													$say++;														
												}
											}
										?>
									</div>
								</div>

							</div>
							<div class="clear"></div>
							<div class="col-md-4" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#calismasekli').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Çalışma Şekli</span></button>
								<div id="calismasekli">						
									<div class="container-checkbox" style="height:200px;">
										<label class='control control--checkbox'>Tam Zamanlı<input type='checkbox' name='calismasekli_list[]' value='Tam Zamanlı'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Yarı Zamanlı<input type='checkbox' name='calismasekli_list[]' value='Yarı Zamanlı'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Freelance<input type='checkbox' name='calismasekli_list[]' value='Freelance'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Stajyer<input type='checkbox' name='calismasekli_list[]' value='Stajyer'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Gönüllü<input type='checkbox' name='calismasekli_list[]' value='Gönüllü'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Fark etmez<input type='checkbox' name='calismasekli_list[]' value='Fark etmez'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Günlük<input type='checkbox' name='calismasekli_list[]' value='Günlük'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Saatlik<input type='checkbox' name='calismasekli_list[]' value='Saatlik'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Dönemsel<input type='checkbox' name='calismasekli_list[]' value='Dönemsel'><div class='control__indicator'></div></label>
									</div>
								</div>
							</div>

							<div class="col-md-4" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#yas').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Yaş</span></button>
								<div id="yas" style="padding:10px;">	
									<div class="control-group">
										<center><span style="font-size:20px !important;">En Küçük Yaş</span></center>
										<div class="select">
											<select name="yasBas" id="yasBas">
												<option value="Hepsi" selected>Hepsi</option>
												<?php
													for ($i=16; $i <= 80; $i++) { 										
														echo "<option value='".$i."''>".$i."</option>";
													}								

												?>
											</select>
											<div class="select__arrow"></div>
										</div>																		
										<center><span style="font-size:20px !important;">En Büyük Yaş</span></center>
										<div class="select">
											<select class="select" name="yasBit" id="yasBit">
												<option value="Hepsi" selected>Hepsi</option>
												<?php
													for ($i=16; $i <= 80; $i++) { 										
														echo "<option value='".$i."''>".$i."</option>";
													}								

												?>
											</select>
											<div class="select__arrow"></div>
										</div>									
									</div>	
								</div>
							</div>

							<div class="col-md-4" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#cinsiyet').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Cinsiyet</span></button>
								<div id="cinsiyet" style="padding:10px;">	
									<div class="control-group">
										<label class="control control--radio">Hepsi<input type="radio" name="cinsiyet" checked="true" value="Hepsi" onclick="cinsiyetKontrol(true)" /><div class="control__indicator"></div></label>
										<label class="control control--radio">Bay<input type="radio" name="cinsiyet" value="Bay" onclick="cinsiyetKontrol(true)"/><div class="control__indicator"></div></label>
										<label class="control control--radio">Bayan<input type="radio" name="cinsiyet" value="Bayan" onclick="cinsiyetKontrol(false)" /><div class="control__indicator"></div></label>
									</div>
								</div>
							</div>

							<div class="clear"></div>
							<div class="col-md-4" id="askcnt" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#askdurum').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Askerlik Durumu</span></button>
								<div id="askdurum">						
									<div class="container-checkbox" style="height:141px;" >
										<label class='control control--checkbox'>Muaf<input type='checkbox' name='askerlik_durumu[]' value='Muaf'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Yapıldı<input type='checkbox' name='askerlik_durumu[]' value='Yapıldı'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Yapılmadı<input type='checkbox' name='askerlik_durumu[]' value='Yapılmadı'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Tecilli<input type='checkbox' name='askerlik_durumu[]' value='Tecilli'><div class='control__indicator'></div></label>
										<label class='control control--checkbox'>Yapılıyor<input type='checkbox' name='askerlik_durumu[]' value='Yapılıyor'><div class='control__indicator'></div></label>
									</div>
								</div>
							</div>

							<div class="col-md-4" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#meddrm').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Medeni Durumu</span></button>
								<div id="meddrm" style="padding:10px;">	
									<div class="control-group">
										<label class="control control--radio">Hepsi<input type="radio" name="medenidurumu" checked="true" value="Hepsi" /><div class="control__indicator"></div></label>
										<label class="control control--radio">Bekar<input type="radio" name="medenidurumu" value="Bekar" /><div class="control__indicator"></div></label>
										<label class="control control--radio">Evli<input type="radio" name="medenidurumu" value="Evli" /><div class="control__indicator"></div></label>
									</div>
								</div>
							</div>

							<div class="col-md-4" style="margin-top:20px;">
								<button type="button" class="secBaslik" onclick="$('#surbelge').toggle();" style="padding:10px;"><span style="font-size:20px !important;font-weight:bold;">Sürücü Belgesi</span></button>
								<div id="surbelge" style="padding:10px;">	
									<div class="control-group">
										<label class="control control--radio">Hepsi<input type="radio" name="surucubelgesi" checked="true" value="Hepsi" /><div class="control__indicator"></div></label>
										<label class="control control--radio">Var<input type="radio" name="surucubelgesi" value="Var" /><div class="control__indicator"></div></label>
										<label class="control control--radio">Yok<input type="radio" name="surucubelgesi" value="Yok" /><div class="control__indicator"></div></label>
									</div>
								</div>
							</div>

							<a href="javascript:posted('php/elemanara.php', 'islem', 'elemanara')">
								<button type="button" class="secBaslik" style="width:100%; font-weight:bold;margin-top:5px;padding:10px; font-size:20px;">Elemanı Bul</button>
							</a>

							<div id="aramaMsj" >

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="clear"></div>

	<div class="container-aralik" id="bulduklarimiz">
		BULDUKLARIMIZ
	</div>

	<div class="container-secondpage">		
		<div class="container-full aramaSonuclari">
			<div class="container">					  				
	  				<div id="aramaSonuclari">
							<?php				
								$query = $db->prepare("SELECT * FROM uyelerara WHERE aktif=1 AND cvAktif=1 AND resim != '' ORDER BY id DESC LIMIT 10");
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
								    
					</div>
				</div>
			</div>
		</div>

	</div>


	<script type="text/javascript">

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