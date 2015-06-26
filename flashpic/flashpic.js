  numOfPics=parseInt(numOfPics);
  timeDelay=parseInt(timeDelay);
  var picArray=Array();
  for(var x=0; x<numOfPics; x++){
	  picArray[x]="flashPic"+(x+1);
  }
  
  function flashPic_init(){
  setInterval(function(){displayPic()},timeDelay);
  }
  
  //hide all, display next in array, repeat
  var i=0;
  function displayPic(){
    if(i==0){
      document.getElementById(picArray[picArray.length-1]).style.display="none";
    }
    else{
      document.getElementById(picArray[i-1]).style.display="none";
    }
    document.getElementById(picArray[i]).style.display=displayType;
		  if(i==numOfPics-1){
			  i=0;
		  }
		  else{
			  i=i+1;
		  }
	  }
