
  var xpos=parseInt(400);
  var ypos=parseInt(300);
  var delay=75;
  var lineColor="#272f3a";

stopDef = function(e) {
if (e && e.preventDefault)
  e.preventDefault();
else if (window.event && window.event.returnValue)
  window.eventReturnValue = false;
};
 


function draw(){
  stopDef();
	if(xpos>800){
		xpos=800;}
	if(ypos>600){
		ypos=600;}
	if(xpos<0){
		xpos=0;}
	if(ypos<0){
		ypos=0;}

  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d"); 
  changeColor();
  ctx.fillStyle=lineColor;  
  ctx.fillRect(xpos,ypos,2,2);
}

function disableTouch(event){
touchMove(event);
gestureChange(event);
}

function touchMove(event) {
    event.preventDefault();
}

function gestureChange(event) {
    event.preventDefault();
}

function changeColor(){
lineColor=document.getElementById('lineColor').value;
}



//key 37, left arrow set  
var leftRun=false;

function leftStart() {
  document.getElementById('arrow-left').style.backgroundColor="#0000ff";
  leftRun=true;
  leftCont();
}

function leftCont(){
  if(leftRun==true){
    xpos=xpos-2;
    draw();

    setTimeout("leftCont()", delay);
  }
}


function leftEnd(){
  leftRun=false;
  document.getElementById('arrow-left').style.backgroundColor="#d8d8d8";
}




//key 38, up arrow set

function upStart(){
  upRun=true;
  document.getElementById('arrow-up').style.backgroundColor="#0000ff";
  upCont();
}

function upCont() {
  if(upRun==true){
    ypos=ypos-2;
    draw();
  
    setTimeout("upCont()", delay);
  }
}


function upEnd(){
  upRun=false;
  document.getElementById('arrow-up').style.backgroundColor="#d8d8d8";
}




//key 39, right arrow set

var rightRun=false;

function rightStart(){
  document.getElementById('arrow-right').style.backgroundColor="#0000ff";
  rightRun=true;
  rightCont();
}

function rightCont() {
  if(rightRun==true){  
    xpos=xpos+2;
    draw();

    setTimeout("rightCont()", delay);
  }
}

function rightEnd(){
  rightRun=false; 
  document.getElementById('arrow-right').style.backgroundColor="#d8d8d8";
} 




//key 40, down arrow set

var downRun=false;

function downStart(){
  document.getElementById('arrow-down').style.backgroundColor="#0000ff";
  downRun=true;
  downCont();
}

function downCont(){
  if(downRun==true){
    ypos=ypos+2;
    draw();
  
    setTimeout("downCont()", delay);
  }
}

function downEnd() {
  downRun=false;
  document.getElementById('arrow-down').style.backgroundColor="#d8d8d8";
}

// key 58, clear button

function canvasclear() {
  document.getElementById('clear').style.backgroundColor="blue";
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  ctx.clearRect(0, 0, c.width, c.height);
  
  draw();
}

function unclear() {
  document.getElementById('clear').style.backgroundColor="#d8d8d8";
}




document.onkeydown = function keydwn(evt) {

  evt = evt || window.event;
  switch (evt.keyCode) {
      case 37:
          if(!leftRun)leftStart();
          break;
      case 38:
          if(!upRun)upStart();
          break;
      case 39:
          if(!rightRun)rightStart();
          break;
      case 40:
          if(!downRun)downStart();
          break;
      case 88:
            canvasclear();
            break;
    }
}



document.onkeyup = function keyup(evt){
  evt = evt || window.event;
    switch (evt.keyCode) {
        case 37:
            leftEnd();
            break;
        case 38:
            upEnd();
            break;
        case 39:
            rightEnd();
            break;
        case 40:
            downEnd();
            break;
        case 88:
            unclear();
            break;
        
    }
}



function save(){
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d"); 
  
  var dataURL = c.toDataURL();
  document.getElementById('canvasImg').src = dataURL;

}
