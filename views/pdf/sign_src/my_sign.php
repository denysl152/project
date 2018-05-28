<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=yes" />
		<meta http-equiv="refresh" content="10 ; url=../bouton_packs.php">
		<title>Signature</title>
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		
		<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}
			#btnSaveSign {
				color: #fff;
				background: #34A853;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			
			#btnEffacer{
				color: #fff;
				background: #f99a0b;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#signArea{
				width:304px;
				margin: 50px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #CFCFCF;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		</style>
		
	</head>
	<body>

		<h2>Veillez signer pour finaliser le formulaire</h2>
		
		<div id="signArea" >
			<h2 class="tag-ingo">Signez ci-dessous</h2>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		<button id="btnSaveSign">J'ai signé</button>
		<a href='my_sign.php'><button id="btnEffacer">Effacer</button></a>

		
		<?php
			//recuppération des variable du formulaire pour la session
			session_start();		
			
			header("refresh:10;url=bouton_packs.php");
			
		?>
		
		<script>
			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});
			
			$("#btnSaveSign").click(function(e){
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
						//ajax call to save image inside folder
						$.ajax({
							url: 'save_sign.php',
							data: { img_data:img_data },
							type: 'post',
							dataType: 'json',
							success: function (response) {
								window.location.replace("../fichepdf.php");//chrome ie et firefox
								//window.location.reload('../fichepdf.php'); //POUR IE ET FIREFOX MAIS PAS CHROME
							}
						});
					}
				});				
			});
			
		</script>

	</body>
</html>
