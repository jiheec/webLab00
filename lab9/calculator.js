"use strict"
window.onload = function () {
    var stack = [];
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;

            if(/^[0-9]$/.test(value)){
                if(displayVal.charAt(0)=="0"){
                    displayVal="";
                    displayVal += value;
                } 
                else {
                    displayVal += value;
                }
            } else if(value=="AC") {
                document.getElementById('expression').innerHTML = "0";
                displayVal="0";
                while(stack.length > 0){
                    stack.pop();
                }
                
            } else if(value=='.'){
                //displayVal += value;
                var cnt = displayVal.split(".").length;
                if(cnt==1){
                    displayVal += value;
                }

            } else {
                displayVal+=value;
                if(document.getElementById('expression').innerHTML=="0"){
                    document.getElementById('expression').innerHTML = displayVal;
                }
                document.getElementById('expression').innerHTML = displayVal;
                displayVal="0";
                stack.push("displayVal");

            }
            document.getElementById('result').innerHTML = displayVal;
            //document.getElementById('expression').innerHTML = ;
        };
    }

    
};
function factorial (x) {
    if(x=1){
        return 1;
    } else {
        return x*factorial(x-1);
    }
}
function highPriorityCalculator(s, val) {


}
function calculator(s) {
    var result = 0;
    var operator = "+";
    for (var i=0; i< s.length; i++) {
        
    }
    return result;
}
