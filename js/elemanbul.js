function showMsg()
{
	$("#aramaMsj").css("padding", "10px");
	$("#aramaMsj").css("visibility", "visible");	
}

function hideMsg()
{
	$("#aramaMsj").css("padding", "0px");
	$("#aramaMsj").css("visibility", "collapse");	
}

function posted(urls, tur, pos){

	var file_data;
	var form_data = new FormData();

	if(tur == "islem")
	{
		switch(pos)
		{
			case "elemanara":		

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
				var pozisyonlar = "";
				for (var i=0; i < pozisyonDizi.length;i++) 
				{
				    if (pozisyonDizi[i].checked) 
				    {
				        pozisyonlar += pozisyonDizi[i].value + ",";
				    }
				}

				var calismaSekliDizi = document.getElementsByName('calismasekli_list[]');
				var calismaSekilleri = "";
				for (var i=0; i < calismaSekliDizi.length;i++) 
				{
				    if (calismaSekliDizi[i].checked) 
				    {
				        calismaSekilleri += calismaSekliDizi[i].value + ",";
				    }
				}

				//var yas = $('input[name="yas"]:checked').val();

				var yasBas = document.getElementById("yasBas");
				var yasBasSelect = yasBas.options[yasBas.selectedIndex].value;

				var yasBit = document.getElementById("yasBit");
				var yasBitSelect = yasBas.options[yasBit.selectedIndex].value;

				if(yasBasSelect == "Hepsi" && yasBitSelect != "Hepsi" || yasBasSelect != "Hepsi" && yasBitSelect == "Hepsi")
				{
					$('#aramaMsj').html('<b><font color="red">[*]Lütfen diğer yaşıda seçiniz.</font></b>');
					showMsg();
					return;
				}
				else if(yasBasSelect != "Hepsi" && yasBitSelect != "Hepsi" ) // yaşlar seçildi.
				{
					if(yasBasSelect > yasBitSelect) 
					{
						$('#aramaMsj').html('<b><font color="red">[*]Küçük Yaş Büyük Yaş\'tan Büyük Olamaz!</font></b>');
						showMsg();
						return;
					}
				}// else direk olarak ikiside hepsi seçilmiş demektir direk olarak bilgi gönderilecek.


				var medenidurumu = $('input[name="medenidurumu"]:checked').val();

				var cinsiyet = $('input[name="cinsiyet"]:checked').val();

				var surucubelgesi = $('input[name="surucubelgesi"]:checked').val();

				var askerlikDizi = document.getElementsByName('askerlik_durumu[]');
				var askerlikDurumu = "";
				for (var i=0; i < askerlikDizi.length;i++) 
				{
				    if (askerlikDizi[i].checked) 
				    {
				        askerlikDurumu += askerlikDizi[i].value + ",";
				    }
				}

				/*if(lokasyonlar == "" || sektorler == "")
				{
					$('#aramaMsj').html('<b><font color="red">[*]Lütfen Lokasyon Ve Sektör/Bölümü Seçiniz.</font></b>');
					showMsg();
					return;
				}*/


				/*if(cinsiyet == "Bayan")
				{
					askerlikDurumu = ""; // eğer cinsiyet bayan ise askerlik durumu olamaz. 
				}
				else // else ise askerlik durumu seçilmişmi kontrol edilecek.
				{
					if(askerlikDurumu == "")
					{
						$('#aramaMsj').html('<b><font color="red">[*]Lütfen Askerlik Durumunu Belirtin.</font></b>');						
						showMsg();
						return;
					}
				}*/

				//Kontroller okey mesaj panosunu gizle.
				hideMsg();
				
				form_data.append('lokasyonlar', lokasyonlar);
				form_data.append('sektorler', sektorler);
				form_data.append('pozisyonlar', pozisyonlar);
				form_data.append('calismaSekilleri', calismaSekilleri);
				form_data.append('yasBas', yasBasSelect);
				form_data.append('yasBit', yasBitSelect);
				form_data.append('medenidurumu', medenidurumu);
				form_data.append('cinsiyet', cinsiyet);
				form_data.append('surucubelgesi', surucubelgesi);
				form_data.append('askerlikDurumu', askerlikDurumu);	

				break;

			case "elemanbasitara":
				var aranan = document.getElementById("basitarama");	
				var araval = aranan.value;
				var lok = document.getElementById("lokkolay");
				var lokval = lok.options[lok.selectedIndex].value;
				form_data.append('aranan', araval);
				form_data.append('lok', lokval);
				break;
		}
	}	
	
	$('#preloader').delay(350).css({'display':'block'});
	$.ajax({
		type:'POST',
		url:urls,
		dataType: 'text',
		cache: false,
		contentType: false,
		processData: false,		
		data: form_data,  
		success: function (msg) {
			//Dönen sonucu ekranda gösterme
			switch(pos)
			{
				case "elemanara":
					$('#aramaSonuclari').html(msg);		
					break;
				case "elemanbasitara":
					$('#aramaSonuclari').html(msg);		
					break;
				default:
					
					break;
			}
				
			$('#preloader').delay(350).css({'display':'none'});						
			document.getElementById('bulduklarimiz').scrollIntoView()
		}
	});
}