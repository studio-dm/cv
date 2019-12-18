var animeSpeed = 80;
var dmChar;
function typingText(type){
	document.getElementById(type).style.display="none";
	var theDiv=document.getElementById(type);
	var dmDiv=document.createElement('div');
	dmDiv.setAttribute("id","newText");
	theDiv.parentNode.insertBefore(dmDiv,theDiv.nextSibling);
	var thetext=document.getElementById(type).innerHTML;
	
		animeText(type,thetext);
}	
function animeText(type,thetext){
	var i = -1;
	var id = setInterval(function() {
		i++;
		if(i === thetext.length)
			{
			clearInterval(id);
			}
		dmChar=thetext.charAt(i);
		var newElement=document.createElement('span');
		newElement.className="intro-type animated zoomIn";
		newElement.innerHTML=dmChar;
		document.getElementById("newText").appendChild(newElement);
		document.getElementById("newText").style.marginBottom="50px";
		//getStarted();
		
	}, animeSpeed);
		   
	
}
function getStarted(){
	var j = 0;
var _gs = setInterval(function(){
	j++
	if(j===1){clearInterval(_gs);}
	document.getElementById("getStarted").click();
	console.log(j);
},30000);
	
}
//typingText("type-text");
