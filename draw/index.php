<!DOCTYPE html> 
<html> 
<head> 
	<title>My Page</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.2.0.min.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script src="js/sketch.js"></script>
	
	<!-- ADD IN HEADER STUFF FROM CHAT -->
	
	<link rel="stylesheet" href="http://easywebsocket.org/contrib/chat/main.css" />
	<script src="../json2.js"></script>		
	<script src="../easyWebSocket.min.js"></script>
	<script src="../jquery.min.js"></script>
	<script src="../jquery.tmpl.min.js"></script>
	<script src="../jQuery.url.js"></script>
	<script src="../main.js"></script>
	
	<!-- //// -->
	
	
	<style type="text/css" media="screen">
		#paintBox
		{
		  border:1px solid #9a9a9a;
		  width:100%;
		  height: 200px;
		}
	</style>
	
	<script type="text/javascript">
	  var canvas = null; //canvas object
	  var context = null; //canvas's context object
	  var clearBtn = null; //clear button object
	  var saveBtn = null; //clear button object

	  /*boolean var to check if the touchstart event
	  is caused and then record the initial co-ordinate*/
	  var buttonDown = false;

	  //onLoad event register
	  window.addEventListener('load', initApp, false);

	  function initApp() {
	    setTimeout(function() { window.scrollTo(0, 1); }, 10); //hide the address bar of the browser.
	    canvas = document.getElementById('paintBox');
	    clearBtn = document.getElementById('clearBtn');
		saveBtn = document.getElementById('saveBtn');

	    setCanvasDmiension();
	    initializeEvents();

	    context = canvas.getContext('2d'); //get the 2D drawing context of the canvas
	}

	function setCanvasDmiension() {
	  //canvas.width = 300; //window.innerWidth;
	  canvas.height = window.innerHeight; //setting the height of the canvas
	}

	function initializeEvents() {
	  canvas.addEventListener('touchstart', startPaint, false);
	  canvas.addEventListener('touchmove', continuePaint, false);
	  canvas.addEventListener('touchend', stopPaint, false);

	  clearBtn.addEventListener('touchend', clearCanvas,false);
	  saveBtn.addEventListener('touchend', save,false);
	}

	function clearCanvas() {
	  context.clearRect(0,0,canvas.width,canvas.height);
	  alert("clear");
	}

	function startPaint(evt) {
	  if(!buttonDown)
	  {
	    context.beginPath();
	    context.moveTo(evt.touches[0].pageX, evt.touches[0].pageY);
	    buttonDown = true;
	  }
	  evt.preventDefault();
	}

	function continuePaint(evt) {
	  if(buttonDown)
	  {
	    context.lineTo(evt.touches[0].pageX,evt.touches[0].pageY);
	    context.stroke();
	  }
	}

	function stopPaint() {
	  buttonDown = false;
	}
	
	function save()
	{
	    document.getElementById("canvasimg").style.border="1px solid";
	    var dataURL = canvas.toDataURL();
	    localStorage.setItem('canvasImage', canvas.toDataURL('image/png'));
	    document.getElementById("canvasimg").src = dataURL;
	    document.getElementById("canvasimg").style.display="inline";
		
	}
	
	
	
	
	</script>
	
</head> 
<body onload="init()"> 

<!-- Start of INSTRUMENT IDEA -->
<div data-role="page" id="page2">

	<div data-role="header">
		<h1>Draw a picture</h1>
		<a href="#page4" data-transition="slide" data-icon="arrow-r"  rel="external" onclick="saveViaAJAX();">Next</a>
	</div><!-- /header -->

	<div data-role="content">	
		<p>Draw a picture:</p>	
		

	  	<canvas id="paintBox">
	    	Your browser does not support canvas
	  	</canvas>
		<input type="button" value="Save" id="saveBtn" />
    	<input type="button" value="Clear" id="clearBtn"/></p>

		<script type="text/javascript">
		function saveViaAJAX()
		{
				
			var testCanvas = document.getElementById("paintBox");
			var canvasData = testCanvas.toDataURL("image/png");
			var postData = "canvasData="+canvasData;

			var ajax = new XMLHttpRequest();
			ajax.open("POST",'testSave.php',true);
			ajax.setRequestHeader('Content-Type', 'canvas/upload');

			ajax.onreadystatechange=function()
		  	{
				if (ajax.readyState == 4)
				{
					//alert(ajax.responseText);
					// Write out the filename.
		    		document.getElementById("debugFilenameConsole").innerHTML="Saved as<br><a target='_blank' href='"+ajax.responseText+"'>"+ajax.responseText+"</a><br>Reload this page to generate new image or click the filename to open the image file.";
				}
		  	}

			ajax.send(postData);
			//alert(canvasData);
			
			//UPDATE PROCESSING IMAGE VARIABLE HERE OR FIRE OFF PROCESSING SKETCH SO IT RENDERS
			var pjs = Processing.getInstanceById('mycanvas');
			//alert(canvasData);
			var text = canvasData;
		    pjs.newImage(text);
			///
			
		}

		</script>
				
			
	</div><!-- /content -->

	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

<!-- Start of IFTTT IDEA -->
<div data-role="page" id="page4">

	<div data-role="header">
		<a href="#" data-rel="back" data-icon="arrow-l">Back</a>
		<h1>Preview your instrument:</h1>
	</div><!-- /header -->

	<div data-role="content">	
			
			<?php
				$instrumentSound = $_POST["instrumentSound"];
				$filepath = "files/instrument.html";
				$file =fopen($filepath, "w");
				$myHTML = 
					
					"<!DOCTYPE html> 
					<html> 
					<head> 
						<title>My instrument</title> 
						<meta name='viewport' content='width=device-width, initial-scale=1'> 
						<link rel='stylesheet' href='../css/themes/default/jquery.mobile-1.2.0.min.css' />
						<script src='../js/jquery.js'></script>
						<script src='../js/jquery.mobile-1.2.0.min.js'></script>
						<script src='http://code.jquery.com/jquery-latest.js'></script>
						<link rel='apple-touch-icon-precomposed' href='../img/icon-red-57.png'>
						<script>

							
							
						</script>
					</head> 
					<body> 

					<div data-role='page' id='bar'>

						<div data-role='header'>
							<h1>My Instrument</h1>
						</div><!-- /header -->

						<div data-role='content'>	
						      
								<a onclick='this.firstChild.play()'><audio src='../" . $_POST["instrumentSound"] . "'></audio><img src='../images/test.png' style='border:1px solid; width:100%; height:200px;'></a>
						</div><!-- /content -->

						<div data-role='footer'>
							<h4>Page Footer</h4>
						</div><!-- /footer -->

					</div><!-- /page -->

					</body>
					</html>";
				fwrite($file, $myHTML);
				fclose($file);
			?>	
				
				<script type="text/javascript" charset="utf-8">
				    document.getElementById("finalAppName").innerHTML = dataURL;
				</script>
				
				<p>
					
					<script type="text/javascript" charset="utf-8">

						$(document).ready(function() {
							// $("#audio-file").attr("src", "test");

							
						});

					</script>
				
				<div id="p1"></div>
				<div id="instrument-button">	
					<!-- <img id="canvasimg" style="display:none;"> -->
				</div>
				
				<canvas id="mycanvas"></canvas>
				
				<script src="http://cloud.github.com/downloads/processing-js/processing-js/processing-1.4.1.min.js"></script>
				
				<script type="application/javascript">
						    
					var jsString = localStorage.getItem('canvasImage');
					// alert(localStorage.getItem('canvasImage'));
					
				</script>
				
				<script type="text/processing" data-processing-target="mycanvas">
					//initialize variables
					int leftRodTopX = 120;
					int leftRodTopY = 60;
					int rightRodTopX = 185;
					int rightRodTopY = 60;
					int rectLeftX = 150;
					int rectMidX = 155;
					int rectTopY = 200;
					int rectWidth = 10;
					int rectHeight = 100;
					float slingMid = 152.5;
					float ellipseCenterX = pmouseX;
					float ellipseCenterY = pmouseY;
					float x;
					float y;
					float r;
					float g;
					float b;

					boolean hasBeenReleased = false;
					boolean winner = false;

					PVector press;
					PVector release;

					float gravity = 0;

					PImage b;

					void setup(){
					
						size(290,400);
						background(255);
						smooth();
						fill(50);
																		
						//create initial slingshot
						line(leftRodTopX,leftRodTopY,rightRodTopX,rightRodTopY); //string
						newImage();
						
					}
					
					void newImage(String imageFile) {
						//println("test");
						b = loadImage(imageFile);
					}

					void draw(){
						
						image(b, 50, 40, 300, 416);
						
						if(mousePressed){
						  background(255);
						  bezier(900,400,880,375,880,325,912,320);
						  fill(255,0,0);
						  
						  image(b, 50, mouseY-240, 300, 416);
						  noFill();
						  bezier(rightRodTopX,rightRodTopY,150,mouseY,150,mouseY,leftRodTopX,leftRodTopY);
						  fill(0,0,255);
						  noFill();
						  line(rectMidX,rectTopY,rightRodTopX,rightRodTopY);
						  line(rectMidX,rectTopY,leftRodTopX,leftRodTopY);
						  line(150,mouseY,slingMid,leftRodTopY);					  
						}

						if(mousePressed==false){
						  background(255);
						  noFill();
						  line(rectMidX,rectTopY,rightRodTopX,rightRodTopY);       //right rod
						  line(rectMidX,rectTopY,leftRodTopX,leftRodTopY);         //left rod
						  line(leftRodTopX,leftRodTopY,rightRodTopX,rightRodTopY); //string
						  stroke(0);
						 }

						 if(hasBeenReleased)
						 {
						   noFill();
						   bezier(900,400,880,375,880,325,912,320);
						   fill(255,0,0);
						   image(b, 50, release.y-240, 300, 416);
						   //ellipse(150, release.y, 40, 40);
						   release.add(press);
						   release.y+=gravity;
						   //gravity+=0.6;
						   //println(release.y); 
						   noFill();
						   bezier(925,400,945,375,945,325,912,320);
						   
						   
						   

						   if(release.y<=0){
						     winner = true;
						   }
						 }

						 if(winner){
						   //alert("test");
						 }
					}

					void mousePressed()
					{
					  press = new PVector(mouseX, mouseY);
					  winner = false;
					}

					void mouseReleased(){
					  float cSquared = sqrt(((mouseY-leftRodTopY)*(mouseY-leftRodTopY))+((slingMid-mouseX)*(slingMid-mouseX)))/5;
					  release = new PVector(mouseX, mouseY);
					  press.sub(release);
					  press.normalize();
					  press.mult(cSquared);
					  hasBeenReleased = true;
					  gravity = 0;
					}
				</script>
				
				<div id="finalSoundpath" style="display:none">image.png</div></p>
				
				<form action="<?php echo $PHP_SELF;?>" method="post" onsubmit="this.formSound.value = document.getElementById('finalSoundpath').innerHTML;" data-ajax="false">
				    <input type="hidden" name="instrumentSound" id="formSound" value="" />
				    <!-- <input type="submit" value="Publish" name="submit" /> -->
				</form>
			
				
				
				<div id="rightside">
					<?php
		
							if ($handle = opendir('files/')) {
								//echo "Directory handle: $handle\n";
								
					
							while (false !== ($file = readdir($handle))) {
																
								$pieces = explode(".", $file);
								
									if ($file == '.') {
									    // echo 'true';
									}

									else if ($file == '..') {
									    // echo 'true';
									}

									else if ($file == '.DS_Store') {
									    // echo 'true';
									}

									else if ($file == '.html') {
									    // echo 'true';
									}
									
									else if ($file == 'instrument.html') {
										// echo "<h3>Share the link to your app:</h3>";
										// echo "<a href='files/" . $file . "' target='_blank'>" . $pieces[0] . "</a><br />";
									}
								}
								closedir($handle);
							}
					?> 
				</div>

		
	</div><!-- /content -->

	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>