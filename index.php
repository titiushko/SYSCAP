<!doctype html>
<?php
if(@$_GET["action"]=="getTime"){
	$time = Time();
	$date = date("H:i:s",$time);
	echo $date; // time output for ajax request
	die();
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>SYSCAP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="Pagina de inicio del servidor SYSCAP">
		<meta name="author" content="Titiushko">
		<link href="sources/css/bootstrap.css" rel="stylesheet">
		<link href="sources/css/main.css" rel="stylesheet">
		<link rel="shortcut icon" href="sources/img/icono.ico" type="image/ico">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript">
			window.onload = startInterval;
			function startInterval(){
				setInterval("startTime();",1000);
			}
			function startTime(){
				AX = new ajaxObject("?action=getTime", showTime)
				AX.update(); // start ajax request
			}
			// callback
			function showTime(data){
				//document.getElementById('digiclock').innerHTML = data;
				document.querySelector('digitalclock').innerHTML = data;
			}
		</script>
		<script type="text/javascript">
			// ajax object - constructor
			function ajaxObject(url, callbackFunction){
				var that=this;
				this.updating = false;
				this.abort = function(){
					if(that.updating){
						that.updating=false;
						that.AJAX.abort();
						that.AJAX=null;
					}
				};
				this.update = function(passData,postMethod){
					if(that.updating){
						return false;
					}
					that.AJAX = null;
					if(window.XMLHttpRequest){
						that.AJAX=new XMLHttpRequest();
					}
					else{
						that.AJAX=new ActiveXObject("Microsoft.XMLHTTP");
					}
					if(that.AJAX==null){
						return false;
					}
					else{
						that.AJAX.onreadystatechange = function(){
							if(that.AJAX.readyState==4){
								that.updating=false;
								that.callback(that.AJAX.responseText, that.AJAX.status, that.AJAX.responseXML, that.AJAX.getAllResponseHeaders());
								that.AJAX=null;
							}
						};
						that.updating = new Date();
						if(/post/i.test(postMethod)){
							var uri=urlCall+(/\?/i.test(urlCall)?'&':'?')+'timestamp='+that.updating.getTime();
							that.AJAX.open("POST", uri, true);
							that.AJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							that.AJAX.setRequestHeader("Content-Length", passData.length);
							that.AJAX.send(passData);
						}
						else{
							var uri=urlCall+(/\?/i.test(urlCall)?'&':'?')+passData+'&timestamp='+(that.updating.getTime());
							that.AJAX.open("GET", uri, true);
							that.AJAX.send(null);
						}
						return true;
					}
				};
				var urlCall = url;
				this.callback = callbackFunction || function (){};
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12 text-center">
					<img src="sources/img/after_defense.gif" class="img">
				</div>
			</div>
			<div class="row"><div class="col-sm-12 col-lg-12">&nbsp;</div></div>
			<div class="row"><div class="col-sm-12 col-lg-12">&nbsp;</div></div>
			<div class="row">
				<a target="_blank" href="http://178.62.28.189/syscap">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Sistema</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/syscap-icono.png" class="img">
							</div>
							<h1>SYSCAP</h1>
							<h3>Sistema en Funcionamiento</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="https://bitbucket.org/titiushko/syscap/commits/all">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Control de Cambios</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/bitbucket.png" class="img">
							</div>
							<h1>Bitbucket</h1>
							<h3>Repositorio Git de SYSCAP</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://178.62.28.189/phpmyadmin">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Administracion</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/phpmyadmin.png" class="img">
							</div>
							<h1>PhpMyAdmin</h1>
							<h3>Base de Datos de SYSCAP</h3>
						</div>
					</div>
				</a>
				<div class="col-sm-3 col-lg-3">
					<div class="half-unit">
						<dtitle>Hora Local</dtitle>
						<hr>
						<div class="clockcenter">
							<digiclock>12:45:25</digiclock>
						</div>
					</div>
					<div class="half-unit">
						<dtitle>Hora Servidor</dtitle>
						<hr>
						<div class="clockcenter">
							<digitalclock><?= date("H:i:s"); ?></digitalclock>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<a target="_blank" href="http://formal.gradodigital.edu.sv/">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Moodle</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/grad0digital.png" class="img">
							</div>
							<h1>Educación Continua en TICs</h1>
							<h3>Campus Virtual de Cusros Tutorizados</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="https://docs.moodle.org/all/es/P%C3%A1gina_Principal">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/moodle-docs.png" class="img">
							</div>
							<h1>MoodleDocs</h1>
							<h3>Documentación Oficla en Español</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://178.62.28.189/moodle">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Moodle</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/moodle.png" class="img">
							</div>
							<h1>Moodle Local</h1>
							<h3>Moodle de Prueba SYSCAP</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="https://drive.google.com/folderview?id=0BweQez5dZbMDZzQ3WXNNNldSYm8&usp=sharing">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Carpeta Compartida</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/google-drive.png" class="img">
							</div>
							<h1>Google Drive</h1>
							<h3>BackUp Documentación del TG</h3>
						</div>
					</div>
				</a>
			</div>
			<div class="row">
				<a target="_blank" href="https://bitbucket.org/titiushko/syscap/wiki/Home">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Wiki</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/bitbucket-wiki.png" class="img">
							</div>
							<h1>SYSCAP Wiki</h1>
							<h3>Documentación de Desarrollo</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://librosweb.es/bootstrap_3">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/bootstrap.png" class="img">
							</div>
							<h1>Bootstrap</h1>
							<h3>Framework CSS</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://escodeigniter.com/guia_usuario">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/codeigniter.png" class="img">
							</div>
							<h1>CodeIgniter</h1>
							<h3>Framework PHP</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://virtualtec.cl/manual-de-html5-y-css3">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Sintaxis</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/html5.png" class="img">
							</div>
							<h1>HTML5</h1>
						</div>
					</div>
				</a>
			</div>
			<div class="row">
				<a target="_blank" href="http://php.net/manual/es/langref.php">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Sintaxis</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/php.png" class="img">
							</div>
							<h1>PHP</h1>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://dev.mysql.com/doc/refman/5.0/es/tutorial.html">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Sintaxis</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/mysql.png" class="img">
							</div>
							<h1>MySql</h1>
						</div>
					</div>
				</a>
				<a target="_blank" href="https://www.atlassian.com/es/git/tutorial">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Sintaxis</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/git.png" class="img">
							</div>
							<h1>Git</h1>
							<h3>Sistema Control de Versiones</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://178.62.28.189/codiad">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>IDE Online</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/codiad.png" class="img">
							</div>
							<h1>Codiad</h1>
						</div>
					</div>
				</a>
			</div>
			<div class="row">
				<a target="_blank" href="https://tg2013-mlst.hipchat.com/chat?focus_jid=157919_tg2013-mlst@conf.hipchat.com">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Servicio de Chat</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/hipchat.png" class="img">
							</div>
							<h1>HipChat</h1>
							<h3>Chat de TG2014-MLST</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="https://cloud.digitalocean.com">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Alojamiento en la Nube</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/digitalocean.png" class="img">
							</div>
							<h1>DigitalOcean</h1>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://178.62.28.189:8080">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Integración Continua</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/jenkins.png" class="img">
							</div>
							<h1>Jenkins</h1>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://www.datatables.net/">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/datatables.png" class="img">
							</div>
							<h1>DataTables</h1>
							<h3>Plugin jQuery para Tablas</h3>
						</div>
					</div>
				</a>
			</div>
			<div class="row">
				<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/reference?hl=es">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/googlemaps.png" class="img">
							</div>
							<h1>Google Maps</h1>
							<h3>Google Maps JavaScript API V3</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/fortawesome.png" class="img">
							</div>
							<h1>Font Awesome</h1>
							<h3>Bootstrap Iconos Tipográficos</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://morrisjs.github.io/morris.js/">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/morrisjs.png" class="img">
							</div>
							<h1>Morris JS</h1>
							<h3>Plugin jQuery para Gráficas</h3>
						</div>
					</div>
				</a>
				<a target="_blank" href="http://www.tcpdf.org/doc/code/classTCPDF.html">
					<div class="col-sm-3 col-lg-3">
						<div class="dash-unit">
							<dtitle>Referencia</dtitle>
							<hr>
							<div class="thumbnail">
								<img src="sources/img/tcpdf.png" class="img">
							</div>
							<h1>TCPDF</h1>
							<h3>Plugin PHP para Generar PDF</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<script type="text/javascript">
			(function(){
				var clock = document.querySelector('digiclock');
				var pad = function(x) {
					return x < 10 ? '0'+x : x;
				};
				var ticktock = function() {
					var d = new Date();
					var h = pad(d.getHours());
					var m = pad(d.getMinutes());
					var s = pad(d.getSeconds());
					var current_time = [h,m,s].join(':');
					clock.innerHTML = current_time;
				};
				ticktock();
				setInterval(ticktock, 1000);
			}());
		</script>
	</body>
</html>