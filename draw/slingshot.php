<!DOCTYPE html> 
<html> 
<head> 
	<title>My Page</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.2.0.min.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile-1.2.0.min.js"></script>
	<script src="js/sketch.js"></script>
	
	<style type="text/css" media="screen">
		#paintBox
		{
		  border:1px solid #9a9a9a;
		  width:100%;
		  height: 200px;
		}
	</style>
	
	<script type="text/javascript">
	  
	
	
	
	</script>
	
</head> 
<body onload="init()"> 



<!-- Start of IFTTT IDEA -->
<div data-role="page" id="page4">

	<div data-role="header">
		<a href="#" data-rel="back" data-icon="arrow-l">Back</a>
		<h1>Preview your instrument:</h1>
		<a href="#page1" data-transition="pop">Done</a>
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
					<script type="text/javascript" charset="utf-8">
						// alert(document.getElementById("canvasimg").src);
					</script>
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
					
					// PImage b;
					// String uri = jsString;
					// im = loadImage(uri);
					// String s = uri;
				    // PImage img;
				
					PImage b;
					b = loadImage("images/test.png");
					//preloading the image here before it's updated


									
					void setup(){
					
						size(290,300);
						background(255);
						smooth();
						fill(50);
						//text(s, 10, 10, 70, 280);
						
						// make this dynamic this from the Javascript to update here, otherwise just grabs pre-existing one:
						//img = loadImage(uri);
						
						//String url = "http://mt0.google.com/mt?n=404&v=w2.61&x=9913&y=12119&zoom=2";

						//online = loadImage(url, "png");

						//noLoop();
						
						/////////
						
						// http://processingjs.org/articles/p5QuickStart.html
						// http://processingjs.nihongoresources.com/interfacing/
						// http://processingjs.org/articles/PomaxGuide.html
						// http://forum.processing.org/topic/how-to-load-an-image-in-base64-with-processing-js
						// https://wiki.mozilla.org/Processing.js_for_JavaScript_Devs
						
												
						//create initial slingshot
						line(leftRodTopX,leftRodTopY,rightRodTopX,rightRodTopY); //string
						
						// fill(0,0,255);
						// ellipse(150, 100, 40, 40);
						image(b, 50, 40, 300, 416);
						
					}

					void draw(){
						
						
						image(b, 50, 40, 300, 416);
						
						
						if(mousePressed){
						  background(255);
						  bezier(900,400,880,375,880,325,912,320);
						  fill(255,0,0);
						  
						  image(b, 50, mouseY-240, 300, 416);
						  
						  //ellipse(150, mouseY, 40, 40);
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
						  //image(b, 80, 100, 200, 200);
						  // fill(0,0,255);
						  // ellipse(150, 100, 40, 40);
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

						   if(release.y>=330&&release.y<=380&&release.x>=900&&release.x<=1000){
						     winner = true;
						   }
						 }

						 if(winner){
						   x = random(0,1200);
						   y = random(0,500);
						   r = random(0,255);
						   g = random(0,255);;
						   b = random(0,255);
						   fill(r,g,b);
						   ellipse(x,y,50,50);
						   println(winner);
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