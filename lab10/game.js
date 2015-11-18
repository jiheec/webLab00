"use strict";

var interval = 3000;
var numberOfBlocks = 9;
var numberOfTarget = 3;
var targetBlocks = [];
var selectedBlocks = [];
var timer;

document.observe('dom:loaded', function(){
	var blocknormal = $$(".block");

	$("start").observe("click", stopToStart);
	$("stop").observe("click", stopGame);
});

function stopToStart(){
    stopGame();
    startToSetTarget();
}

function stopGame(){

	$("state").innerHTML = "Stop";
	$("answer").innerHTML = "0/0";

	targetBlocks = [];
	selectedBlocks = [];
	timer = 0;

}

function startToSetTarget(){
	$("state").innerHTML = "Ready!";
	targetBlocks = [];
	selectedBlocks = [];
	timer = 0;

	for (var i = 1; i <= 3; i++){
  		//targetBlocks[i-1] = randomRange(1, 9);
  		targetBlocks[i-1] = Math.floor( (Math.random() * (9)) );
  		//alert(targetBlocks);
	}

	if(targetBlocks[0]===targetBlocks[1]||targetBlocks[0]===targetBlocks[2]||targetBlocks[1]===targetBlocks[2]){
		
		startToSetTarget();
	}

	setTimeout(setTargetToShow, 3000);
	//alert(targetBlocks);
}

function setTargetToShow(){
	var blocknormal = $$(".block");
	$("state").innerHTML = "Memorize!";

	for(var i=0 ; i<targetBlocks.length ; i++){
		var tb = targetBlocks[i];
		blocknormal[tb].addClassName("target");
	}
	/*
	for (var i = 0; i < blocknormal.length; i++) {
			blocknormal[i].addClassName("target");
		}*/
	//alert(tb);
	setTimeout(showToSelect, 3000);
}

function showToSelect(){
	var blocknormal = $$(".block");
	$("state").innerHTML = "Select!";
	for(var i=0 ; i<targetBlocks.length ; i++){
		var tb = targetBlocks[i];
		blocknormal[tb].removeClassName("target");
	}

	for(var i=0 ; i < numberOfBlocks ; i++){

		blocknormal[i].observe("click", function(){
			//blocknormal[i].addClassName("clicked");
			console.log(this);
			$(this).addClassName("clicked");
		});
	}

	
	//setTimeout(selectToResult, 3000);
}

function selectToResult(){
	var blocknormal = $$(".block");
	$("state").innerHTML = "Checking!";
	for(var i=0 ; i<targetBlocks.length ; i++){
		var tb = targetBlocks[i];
		blocknormal[tb].removeClassName("target");
	}


}









