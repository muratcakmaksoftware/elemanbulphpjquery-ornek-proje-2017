<?php include "header.php" ?>
	<script type="text/javascript">
		var acikKapali = false;
		function toggle()
		{
			acikKapali = !acikKapali;
			var element = document.getElementsByClassName('col-md-2 menu');
			if(acikKapali)
				element.className = "col-md-2 low-menu";
			else
				element.className = "col-md-2 menu";
			
		}
		
	</script>

	<div class="container-full">
		<div class="row">
		  	<div class="col-md-2 menu">
		  		<div class="ham">Admin Panel - L
		  			<div style="float:right;">
		  				<a href="" onclick="toggle(acikKapali)"><img class="hamimg" src="images/hamwhite.png" /></a>
	  				</div>
  				</div>
  				<hr style="border-color:white"/>
			</div>


		  <div class="col-md-10 sag">.col-md-4</div>
		</div>
	</div>

	

<?php include "footer.php" ?>
