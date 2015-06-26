FLASHPIC README 
contact: zacdavidm@gmail.com

flashpic is an open source javascript resource written by zacdavid nov'12.

flashpic is implemented in 4 parts. 
1. script in the head of the page
2. a javscript file that the head links to
3. html and a script tag to start flashpic

1. Head Script- what you are going to do is, copy the script as is into the head of your page. you will have to 



  <script type="text/javascript">
  //Are you setting up flashPic? If so, this is what you want. Also, make sure the src of the next script tag is correct
  
  var numOfPics=5; //number of pictures you have
  var timeDelay=1000; //time in miliseconds (1000ms = 1s)
  var displayType="inline-block"; /display type of divs
 </script>
 
 <script src="flashpic.js"></script>
 
 <style type="text/css">
  .flashPic{
    display:none;
  }
 </style>




2. JS file - you need to upload flashpic.js to your server. you should put this file in the same folder as the page that is using it. Advanced users: you can move the file, but you have to update the src of the script tag in the head

3. HTML and Script - you will copy this code into the body of your page where you want flashPic to show up. You can add or remove divs, just make sure they follow the format below (class="flashPic" id="flashPic1,2,3..."). Flashpic will work out of the box with a shortened sample picture set. You can put whatever you want inside of flashPic divs. 

	<div class="flashPic" id="flashPic1" >
		<img src="http://zacdavid.com/labs/flashpic/squid/pic1.gif">
	</div>
	
	<div class="flashPic" id="flashPic2" >
		<img src="http://zacdavid.com/labs/flashpic/squid/pic2.gif">
	</div>
	
	<div class="flashPic" id="flashPic3" >
		<img src="http://zacdavid.com/labs/flashpic/squid/pic3.gif">
	</div>
	
	<div class="flashPic" id="flashPic4" >
		<img src="http://zacdavid.com/labs/flashpic/squid/pic4.gif">
	</div>
	
	<div class="flashPic" id="flashPic5" >
		<img src="http://zacdavid.com/labs/flashpic/squid/pic5.gif">
	</div>

	<script>
    flashPic_init();
	</script>
	
	
	
	
END OF FLASHPIC README/ STARTER CODE. source = zacdavid.com/labs/flashpic
