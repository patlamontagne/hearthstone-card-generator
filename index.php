<?php
	session_start();

	// login
	@$action = $_REQUEST['action'];
	@$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
	@$username = $_REQUEST['username'];
	@$userpass = $_REQUEST['userpass'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Hearthstone Card Generator</title>
	<link rel="stylesheet" href="fonts/stylesheet.css">
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="jscolor/jscolor.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!-- Google analytics -->   
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-69581148-1', 'auto');
	  ga('send', 'pageview');

	</script>
	<script>
	$(document).ready(function(){
		//
		//
		//
		//	CANVAS
		//
		//
		//

		function buildcanvas() {
		    var canvas = document.getElementById('canvas');
		    var ctx = canvas.getContext('2d');

		    make_pic(ctx);
		}


		// prepare image to fit canvas;

		var MoveX = 0;
		var MoveY = 0;
		var lastMoveX = 0;
		var lastMoveY= 0;
		var isDragging = false;
		var isSetting = false;
		var yOffset = -10;

		var cover_image = new Image();
		cover_image.src ='img/minion_base.png';
		var pic_image = new Image();
		$('#inputArtwork').val('07 - aWzLnTH.jpg');
		$('#type').val('minion');
		var mask_image = new Image();
		mask_image.src ='img/minion_mask.png';

		pic_image.onload = function(){
			buildcanvas();
		}

		function make_pic(ctx) {
			
			mask_image.src ="img/" + $('#type').val() + "_mask.png";
			cover_image.src = "img/" + $('#type').val() + "_" + $('#rarity').val() + ".png";
			pic_image.src = "img/artwork/" + $('#inputArtwork').val();
		    var im_width = parseInt(pic_image.width/3 * $('#resize').slider('value'));
		    var im_height = parseInt(pic_image.height/3 * $('#resize').slider('value'));

		    // texte
		    var nom = $("#cardName").val();
		    var desc = $("#description").val();
		    var mana = $("#inputMana").val(); 
		    if($('#type').val() == 'spell'){
			    var attack = 1;
			    var health = 1;
		    } else {
			    var attack = $('#inputAtt').val();
			    var health = $('#inputHealth').val();
		    }

		    ctx.clearRect(0, 0, canvas.width, canvas.height);

		    // masque
		    ctx.drawImage(mask_image, 0, yOffset, mask_image.width, mask_image.height);
		    ctx.save();

		    // point au centre
		    ctx.translate(canvas.width/2, canvas.height/2);
	    	ctx.globalCompositeOperation = "source-in";
		    ctx.drawImage(pic_image, -canvas.width/2 + MoveX, -canvas.height/2 + MoveY + yOffset, im_width, im_height);
		    ctx.restore();

		    // couverture
		    ctx.save();
		    if(isSetting) ctx.globalAlpha = 0.5;
		    ctx.drawImage(cover_image, 0, yOffset, cover_image.width, cover_image.height);
		    ctx.restore();

		    

		    // nom
	    	ctx.textAlign = 'center';
			ctx.textBaseline = 'middle'; 
		    ctx.fillStyle = 'white';
		    ctx.font = "18px belwe";
	      	ctx.lineWidth = 4;
	      	var height = $('#type').val() == 'spell' ? 200 : 204;
			ctx.strokeText(nom,canvas.width/2 + 4, height + yOffset)
			ctx.fillText(nom,canvas.width/2 + 4, height + yOffset);

			// mana
		    ctx.font = "52px belwe";
	      	ctx.lineWidth = 5;
			ctx.strokeText(mana, 45,56 + yOffset)
			ctx.fillText(mana, 45,56 + yOffset);

			if($('#type').val() == 'minion'){
				// att
			    ctx.font = "48px belwe";
		      	ctx.lineWidth = 5;
				ctx.strokeText(attack, 50, 327 + yOffset)
				ctx.fillText(attack, 50, 327 + yOffset);

				// hp
			    ctx.font = "48px belwe";
		      	ctx.lineWidth = 5;
				ctx.strokeText(health, 227, 327 + yOffset)
				ctx.fillText(health, 227, 327 + yOffset);
			}
			

			// desc
		    ctx.font = "17px Trebuchet MS";
		    ctx.fillStyle = 'black'; 
		    var lineHeight = 19;
		    var maxWidth = $('#type').val() == 'spell' ? 160 : 176;
		    var x = canvas.width/2 + 4;
		    var y = 274;

			formatterTexte(ctx, desc, x, y + yOffset, maxWidth, lineHeight);
		}

		// format paragraphe
		function formatterTexte(context, text, x, y, maxWidth, lineHeight) {
	        var words = text.split(' ');
	        var line = '';
	        var nbLine = 0;
	        for(var n = 0; n < words.length; n++) {
	          var testLine = line + words[n] + ' ';
	          var metrics = context.measureText(testLine);
	          var testWidth = metrics.width;
	          if (testWidth > maxWidth && n > 0) {
	            context.fillText(line, x, y);
	            line = words[n] + ' ';
	            y += lineHeight;
	          }
	          else {
	            line = testLine;
	          }
	        }
	        context.fillText(line, x, y);
	      }

		$("#canvas").mousedown(function(event){
		    
		    switch (event.which) {
		        case 1:
		            isDragging = true;
		            break;
		        case 3:
		            isSetting = isSetting ? false : true;
		   			buildcanvas();
		            break;
		    }
		});

		$(window).mouseup(function(event){
		    
		    switch (event.which) {
		        case 1:
		            isDragging = false;
				    lastMoveX = MoveX;
				    lastMoveY = MoveY+8;
				    buildcanvas();
		            break;
		    }
		});

		$(window).mousemove(function(event) {
		    if( isDragging == true )
		    {
		        var cWidth = canvas.width/2;    
		        MoveX = (event.pageX / $(window).width())*cWidth + lastMoveX;    
		        MoveX = MoveX - (cWidth/2);
		        var cHeight = canvas.height/2; 
		        MoveY = (event.pageY / $(window).height())*cHeight + lastMoveY +20;    
		        MoveY = MoveY - (cHeight/2);
		        buildcanvas();
		    }
		});

		$("#resize").slider({
		    value: 0.80,
		    min: 0.5,
		    max: 1.5,
		    step: 0.1,
		    slide: function (event, ui) {
		        $('#img_resize').val(ui.value);
		        buildcanvas();
		    }

		});


		//
		// FIN CANVAS
		//


		//
		//
		//
		//	JQUERY
		//
		//
		//


		// choix du type de carte
		$('.type_btn').click(function(){

			// stocker la valeur de la langue
			var type = $(this).attr('rel');
			$('#type').val(type);

			// cacher les options selon le type
			if(type == 'spell') {
				$('#rarity5').hide();
				$('#inputAtt').parent().hide();
				$('#inputHealth').parent().hide();
			}

			$(this).parent().hide();

			// cacher formulaires et les fermer
			$('form').css('opacity',0);
			$('form').hide();

			// fermer le header
			$('#header').slideToggle('fast');

			// masquer et fermer le contenu du header
			$('#logo, #header>div.btn_menu').animate({opacity: 0}, 'fast', function(){
				$('#logo, #header>div.btn_menu').hide();
			});
			
			// ouvrir le main
			$('#main:hidden').slideToggle('fast', function(){
				// rouvrir le premier formulaire
				$('#form1').show();
				$('#form1').animate({opacity: 1}, 'fast');
			});

		});

		// choix rareté
		$('#rarity').val('base');
		
		$('#choix_rarity li').each(function(index){
			var rar_value = $(this).attr('value');
			$(this).css('background', 'url(img/rarity_'+ rar_value +'.png) no-repeat center');
		});
		$(".rarity").click(function(){
			rarity = $(this).attr('value');
			$('#choix_rarity li').removeClass('rar_selected');
			$(this).addClass('rar_selected');
			$('#rarity').val(rarity);
		});

		// clic sur image
		$('div.thumbs').click(function(){
			$('div.thumbs').removeClass('selected');
			var image = $(this).attr('rel');
			$(this).addClass('selected');

			$('#inputArtwork').val(image);
		});

		// Infos carte
		$('#inputMana, #inputAtt, #inputHealth').on('keyup', function(){
			var rel = $(this).attr('rel');
			var val = parseInt($(this).val().replace(/(<([^>]+)>)/g,""));
			// var val = $(this).val().replace(/(<([^>]+)>)/g,"");
			if(isNaN(val) || val < 0) val = 0;
			else if (val > 10) val = 10;
		});
		$('#cardName').on('keyup', function(){
			var rel = $(this).attr('rel');
			var val = $(this).val().replace(/(<([^>]+)>)/g,"");
		});
		$('#description').on('keyup', function(){
			var rel = $(this).attr('rel');
			var val = $(this).val();
		});
		$('#yourName').on('keyup', function(){
			var val = $(this).val();
		});


		/* 
			FORMULAIRE 1
		*/
		$('#form1').on('submit', function(e){
			e.preventDefault();

		    // valeurs
		    var rarity = $('#rarity').val();
		    var artwork = $('#inputArtwork').val();

		  
		    $.ajax({
		        type: 'GET',
		        url: 'validation.php',
		        dataType: 'html',
		        data: {
		        	'rarity': rarity,
		        	'artwork': artwork,
		        	'step': 1
		        },
				error:function(msg){
					alert( "Error !: " + msg );
				},
		        success: function(data, statut){ 
		        	$('#error1').html(data);
		        	if(rarity !== '' && artwork !== ''){
		        		$('#form1:visible').animate({opacity: 0}, 'fast', function(){
		            		$('#form1').hide();
		        			$('#form2:hidden').show();
		        			$('#form2').animate({opacity: 1}, 'fast');
		        		});
		        		
		            	//$('#form1:visible').slideToggle('fast');
		            	//$('#form2:hidden').slideToggle('fast');
		        	}
		        }
			});
		});



		/* 
			FORMULAIRE 2
		*/
		$('#form2').on('submit', function(e){
			e.preventDefault();

		    // valeurs
		    var type = $('#type').val();
		    var rarity = $('#rarity').val();
		    var artwork = $('#inputArtwork').val();
		    var mana = $('#inputMana').val();
		    if(type == 'spell'){
			    var attack = 1;
			    var health = 1;
		    } else {
			    var attack = $('#inputAtt').val();
			    var health = $('#inputHealth').val();
		    }
		    var cardName = $('#cardName').val();
		    var description = $('#description').val();

		    $.ajax({
		        type: 'GET',
		        url: 'validation.php',
		        dataType: 'json',
		        data: {
			        'mana': mana,
			        'attack': attack,
			        'health': health,
			        'cardName': cardName,
			        'description': description,
		        	'step': 2
		        },
				error:function(msg){
					alert( "Error !: " + msg );
				},
		        success: function(data){
		        	$('.error').html('&nbsp;');

		        	if(data.mana.valid && data.attack.valid && data.health.valid && data.cardName.valid && data.desc.valid ){

		        		$('#cardName').val(data.cardName.value);
		        		$('#description').val(data.desc.value);

		            	$('#form2:visible').animate({opacity: 0}, 'fast', function(){
		            		$('#form2').hide();
		        			$('#form3:hidden').show();
		        			$('#form3').animate({opacity: 1}, 'fast');
		        		});
		        	} else {
						if(!data.mana.valid) $('#err_mana').html(data.mana.error);
						if(!data.attack.valid) $('#err_attack').html(data.attack.error);
						if(!data.health.valid) $('#err_health').html(data.health.error);
						if(!data.cardName.valid) $('#err_cardName').html(data.cardName.error);
						if(!data.desc.valid) $('#err_desc').html(data.desc.error);
		        	}
		        	
		        }
			});
		});



		/* 
			FORMULAIRE 3
		*/
		$('#form3').on('submit', function(e){
			e.preventDefault();

			isSetting = false;
		    buildcanvas();

			var canvas = $('#canvas');
			var imageData = canvas.get(0).toDataURL();

			// document.write('<img src="'+imageData+'"/>');

			$.ajax({
	            type: 'POST',
	            url: 'validation.php',
	            dataType: 'html',
  				contentType: "application/x-www-form-urlencoded;charset=UTF-8",
	            data: {
			        'imageData': imageData,
	            	'step': 3
	            },
				error:function(msg){
					alert( "Error !: " + msg );
				},
	            success: function(data){ 
	            	$('#imageName').val(data);
	            	$('#form3:visible').animate({opacity: 0}, 'fast', function(){
            			$('#form3').hide();
						if($('#sendByMail').is(':checked')){
		        			$('#form4:hidden').show();
		        			$('#form4').animate({opacity: 1}, 'fast');
						}
	    			    else {
	    			    	var section = $('<div/>', { id : 'section'});
	    			    	var image = $('<img/>', { src : 'img/cards/'+data} );
	    			    	var a = $("<a href='index.php' style='display: block; width: 100%; margin: 30px auto 10px;font: normal 2em \"Belwe\", Arial, sans-serif;color: #fff;text-shadow: 0px 0px 3px #000;-webkit-text-stroke-width: 1.5px;-webkit-text-stroke-color: black;'>Create another Card</a>");
	    			    	section.css('padding-top', '48px');
	    			    	section.append(image);
	    			    	section.append(a);
	    			    	$('#main').html(section);
	    			    }
	        		});
	            }
			});
		});



		/* 
			FORMULAIRE 4
		*/
		$('#form4').on('submit', function(e){
			e.preventDefault();

		    // valeurs
		    var type = $('#type').val();
		    var rarity = $('#rarity').val();
		    var artwork = $('#inputArtwork').val();
		    var mana = $('#inputMana').val();
		    if(type == 'spell'){
			    var attack = 1;
			    var health = 1;
		    } else {
			    var attack = $('#inputAtt').val();
			    var health = $('#inputHealth').val();
		    }
		    var cardName = $('#cardName').val();
		    var description = $('#description').val();
		    var yourName = $('#yourName').val();
		    var yourEmail = $('#yourEmail').val();
		    var email = $('#email').val();
		    var color = $('#couleur_police').val();
		    var imageName = $('#imageName').val();

			isSetting = true;
		    buildcanvas();
		    $('#error3, #error4, #error5').html('&nbsp;');

		    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		    var valid = true;

		    if(yourName.length < 3 ){
				valid = false;
	        	$('#error3').html("Your name is not valid or is too short");
			}
			if(!testEmail.test(yourEmail)){
				valid = false;
	        	$('#error4').html("Email not valid");
			}
			if(!testEmail.test(email)){
				valid = false;
	        	$('#error5').html("Email not valid");
			}


			if(valid){

				$("#form4 .btn_menu").animate({opacity: 0}, 'fast', function(){
			    	$('#form4 .btn_menu').hide();
			    });

		    	$.ajax({
		            type: 'GET',
		            url: 'validation.php',
		            dataType: 'html',
		            data: {
			        	'type': type,
			        	'rarity': rarity,
			        	'artwork': artwork,
				        'mana': mana,
				        'attack': attack,
				        'health': health,
				        'cardName': cardName,
				        'description': description,
				        'yourName': yourName,
				        'yourEmail': yourEmail,
				        'email': email,
					    'color': color,
					    'imageName': imageName,
		            	'step': 4
		            },
		            error:function(msg){
						alert( "Error !: " + msg );
					},
					success: function(data){
						var a = $("<a href='index.php' style='display: block; width: 100%; margin: 30px auto 10px;font: normal 2em \"Belwe\", Arial, sans-serif;color: #fff;text-shadow: 0px 0px 3px #000;-webkit-text-stroke-width: 1.5px;-webkit-text-stroke-color: black;'>Create another Card</a>");
	        			$("#form4").append(data);
    			    	$("#form4").append(a);
		            }
				});
		    }
	        
		});


		$('.back').click(function(){
			var nb = $(this).attr('rel');
			
		    $('#form'+(++nb)+':visible').animate({opacity: 0}, 'fast', function(){
		    	$('#form'+(nb)).hide();
		    	$('#form'+(--nb)+':hidden').show();
				$('#form'+nb).animate({opacity: 1}, 'fast');
			});
		});


		$('#adminToggle').click(function(e){
			e.preventDefault();
			$(this).siblings('form').slideToggle('fast');
		});

		//
		// FIN JQUERY
		//
	});
	</script>
</head>
<body>
<div id="header" >
	
	<div id="logo">
		<img src="img/logo.png" alt="Logo" title="HearthStone">
			<h1>Unofficial Card Creator</h1>
	</div>
	<div class="type_btn_menu">
		<a class='type_btn' rel="minion">Create a Minion card</a>
		<a class='type_btn' rel="spell">Create a Spell card</a>
		<p>Send creation by email ? <input type="checkbox" name="sendByMail" id="sendByMail"></p>
		<input type="hidden" id="type" value="" >
	</div>
</div>
<div id="main">
	<div id="options">
		<!-- Zone de choix des options de création -->
		<form id="form1" action="validation.php" method="get">
			<h1>
				<span class='en'>Type, Rarity &amp; Artwork</span>
			</h1><br><br>
			<h2>
				<span class='en'>Choose your rarity</span>
			</h2><br>
				<ul id="choix_rarity">
					<li class="rarity rar_selected" id="rarity1" value="base" title="base"></li>
					<li class="rarity" id="rarity2" value="uncommon" title="uncommon"></li>
					<li class="rarity" id="rarity3" value="rare" title="rare"></li>
					<li class="rarity" id="rarity4" value="epic" title="epic"></li>
					<li class="rarity" id="rarity5" value="legendary" title="legendary"></li>
				</ul><br><br>
			<h2>
				<span class='en'>Choose your artwork</span>
			</h2><br>
				<div id="choix_artwork">
					<?php

					include('connexion.php');

					$query = "SELECT * FROM artwork"; 
					$result = $mysqli->query($query) or die($mysqli->error);
					// var_dump($result);

					echo "<div id='galerie'>";

					while ( $val = $result->fetch_array()) {
						echo '<div class="thumbs" rel="'.str_replace(' ', '%20', $val['url']).'"style="background: url(img/artwork/thumbs/'.str_replace(' ', '%20', $val['url']).') no-repeat; background-size: cover"></div>';
					}
						

					echo "<br style='clear: both;'></div>";

					?>
					
					<input type="hidden" id="rarity" value="" >
					<input type="hidden" id="inputArtwork" value="">
					<span id="error1">&nbsp;</span>
					<div class="btn_menu">
						<input type="submit" class='hs_btn en' value="Next" name="action">
					</div>
				</div>
		</form>
		<form id="form2" action="validation.php" method="get">
			<h1>
				<span class='en'>Values, Name &amp; Description</span>
			</h1><br><br>
			<h2>
				<span class='en'>Choose your values and text</span>
			</h2><br>
			<div id="choix_values">
				<div>
					<input type="text" name="inputMana" id="inputMana" rel="mana" maxlength="2" placeholder="Mana Cost">
					<div class='error' id="err_mana">&nbsp;</div>
				</div>
				<div>
					<input type="text" name="inputAtt" id="inputAtt" rel="att" maxlength="2" placeholder="Attack Points">
					<div class='error' id="err_attack">&nbsp;</div>
				</div>
				<div>
					<input type="text" name="inputHealth" id="inputHealth" rel="def" maxlength="2" placeholder="Health Points">
					<div class='error' id="err_health">&nbsp;</div>
				</div>

				<div>
					<input type="text" name="cardName" id="cardName" rel="nom" placeholder="Card's Name" maxlength="16">
					<div class='error' id="err_cardName">&nbsp;</div>
				</div>
		
				<div>
					<input type="text" name="description" rel="desc" id="description" placeholder="Card's Description" maxlength="48">
					<div class='error' id="err_desc">&nbsp;</div>
				</div>
			</div>
			<div class="btn_menu">
				<input type="button" class='back hs_btn en' value="Back" rel="1">
				<input type="submit" class='hs_btn en' value="Next" name="action">
			</div>
		</form>
		<form id="form3" action="validation.php" method="get" unselectable='on' >
			<h1>
				<span class='en'>Overview &amp; Adjustments</span>
			</h1>
			<h2>
				<span class='en'>Drag the artwork to fit the card</span>
				<br>
				<span class='en'>Right click the artwork to toggle opacity</span>
			</h2><br>
			<canvas id="canvas" width='270' height='380' oncontextmenu='return false;'>Your browser does not support canvas functions.</canvas>
			<br><h2>
				<span class='en'>Set Artwork Size</span>
			</h2><br>
			<div id="resize"></div>
			<input type="hidden" value="0" id="img_resize">
			<input type="hidden" value="" id="imageName">
			<div class="btn_menu">
				<input type="button" class='back hs_btn en' value="Back" rel="2">
				<input type="submit" class='hs_btn en' value="Next" name="action">
			</div>
		</form>
		<form id="form4" action="validation.php" method="get">
			<h1>
				<span class='en'>Submission Form</span>
			</h1><br><br>
			<h2>
				<span class='en'>Enter your name, your Email, and the recipient's Email</span>
			</h2><br>
			<div id="choix_email">
				<div>
					<input type="text" name="yourName" id="yourName" maxlength="25" placeholder='Your Name' > 
					<div class='error' id="error3">&nbsp;</div>
				</div>
				<div>
					<input type="email" name="yourEmail" id="yourEmail" placeholder="Your Email" >
					<div class='error' id="error4">&nbsp;</div>
				</div>
				<div>
					<input type="email" name="email" id="email" placeholder="Recipient's Email" >
					<div class='error' id="error5">&nbsp;</div>
				</div><br><br>
				<h2>
					<span class='en'>Select the email's background color</span>
				</h2><br>
				<div>
					<input type="text" name="couleur_police" id="couleur_police" value="couleur" class="color" maxlength="6">
				</div>
			</div>
			<div class="btn_menu">
				<input type="button" class='back hs_btn en' value="Back" rel="3">
				<input type="submit" class='hs_btn en' value="Next" name="action">
			</div>
		</form>
	</div>
</div>
<div id="copy">
	This website is not produced, endorsed, supported, or affiliated with Blizzard Entertainment. 2015<br>
	<a href='admin.php'>Admin</a>
</div>
</body>
</html>