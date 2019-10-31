	<div id="preloader">
	    <div id="status">&nbsp;</div>
	</div>
	<script type="text/javascript">$('#preloader').delay(350).css({'display':'block'});</script>
	
	<?php
		$uyeSayisi = 0;
		$query = $db->prepare("SELECT COUNT(*) AS uyeSayisi FROM uyeler");
		if ($query->execute()) {
			while ($satir = $query->fetch()) {				
				$uyeSayisi = $satir["uyeSayisi"];
				break;														
			}
		}	
	?>

	<div class="row" >
	  <div class="col-md-12">
		<a href="#">
			<a href='index.php'><img  src="images/logoblack.png" class="logo" style="margin-left:10px;margin-top:10px;" /></a>  	
			
			<div class="sagYasla">			


				<a href='hakkimizda.php'><button type='button' class='secBaslik' style='margin-right:10px; margin-top:20px;padding:10px; width:150px;'><span style='font-size:20px !important;font-weight:bold;'>Hakkımızda</span></button></a>
				<a href='blog/index.php'><button type='button' class='secBaslik' style='margin-right:10px; margin-top:20px;padding:10px; width:150px;'><span style='font-size:20px !important;font-weight:bold;'>BLOG</span></button></a>

				<?php
					if(isset($_SESSION["kadi"]) && isset($_SESSION["pw"]))																	
						echo "<a href='uye/index.php'><button type='button' class='secBaslik' style='margin-right:10px; margin-top:20px;padding:10px; width:150px;'><span style='font-size:20px !important;font-weight:bold;'>Profilim</span></button></a>";
					else							  				
		  				echo "<a href='login.php'><button type='button' class='secBaslik' style='margin-right:10px; margin-top:20px;padding:10px; width:150px;'><span style='font-size:20px !important;font-weight:bold;'>Giriş Yap</span></button></a>";
		  		?>

		  	</div>

		  	<div style="margin-top:25px; margin-right:10px; float:right;"><b>Sitemizde Şu an <?php echo $uyeSayisi ?> Eleman Bulunmakta. Sizde Üye Olun Bize Destek Olun!</b></div>

		</a>
		<div class="clear"></div>
	  </div>

	</div>

	<hr/>