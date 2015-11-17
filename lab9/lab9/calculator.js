"use strict"
window.onload = function () {
    //alert("Calculator calculates only the first factorial among the continuous factorials");
    var stack = [];
    var displayVal = "0";
    var flag=0;
    var allstack = []
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;

            if(/^[0-9]$/.test(value)){
                if(displayVal=="0"){//startsWith("0")
                    displayVal = value;
                    document.getElementById('result').innerHTML = displayVal;
                } 
                else {
                    displayVal += value;
                    document.getElementById('result').innerHTML = displayVal;
                }
                //stack.push(value);

            } else if(value=="AC") {
                displayVal="0";
                stack = [];
                allstack = [];
                document.getElementById('expression').innerHTML = "0";
                document.getElementById('result').innerHTML = "0";
                
            } else if(value=='.'){
                //displayVal += value;
                var cnt = displayVal.split(".").length;
                if(cnt==1){
                    displayVal += value;
                    document.getElementById('result').innerHTML = displayVal;
                }

            } else {
            	
            	if(document.getElementById('expression').innerHTML == "0"){
            		document.getElementById('expression').innerHTML = displayVal + value;
                    
            	} else if(allstack[allstack.length-1]=="!"){
                    
                    if(value != "!") document.getElementById('expression').innerHTML += value;
                    else if(value == "!") ;
                    else document.getElementById('expression').innerHTML += (displayVal + value);
            		
            	} else {
                    
            		document.getElementById('expression').innerHTML += (displayVal + value);
            	}
            	
            	
            	
            	if(stack[stack.length-1]=="*"||stack[stack.length-1]=="/"||stack[stack.length-1]=="^"){
            		
            		highPriorityCalculator(stack, displayVal);
            		
            	} else if(stack[stack.length-1]=="!") {
            		
            		displayVal = factorial(stack[stack.length-2]);
            		
            		stack.pop();
            		stack.pop();
            		stack.push(displayVal);
                    //allstack.push(displayVal);
            	} else {
            		stack.push(parseFloat(displayVal));
                    allstack.push(parseFloat(displayVal));
            	}
            	
            	if(allstack[allstack.length-1] =="!"){
                    if(value =="+" || value == "-"){
                        stack.push(value);
                        allstack.push(value);
                    }
                                        
                } else {
                    stack.push(value);
                    allstack.push(value);
                }
                
                displayVal="0";
                document.getElementById('result').innerHTML = displayVal;
            	
            }
            
            if(value == "=") {
            		
                displayVal = calculator(stack);
                document.getElementById('result').innerHTML = displayVal;
                stack = [];
                allstack = [];
                displayVal="0";
            		
            }
            
           // alert(stack);
           // alert(allstack);
        };
       
    }

    
};


function factorial (x) {
    if(x==1 || x==0){
        return 1;
    } else {
        return x*factorial(x-1);
    }
}

function highPriorityCalculator(s, val) {
	var operator = s.pop();
	var prenum = s.pop();
	
	if(operator == "*"){
		//s.push("1111111111");
		s.push(prenum * val);
	} else if(operator=="/"){
		s.push(prenum/val);
	} else if(operator=="^"){
		s.push(Math.pow(prenum, val))
	}	
}

function calculator(s) {
    var result = s[0];
    var operator = "+";
    
    if(s.length == 1){
    	
    } else {
    	for (var i=1; i< s.length; i+=2) {
	        if(s[i]==operator) result += s[i+1];
	        else if(s[i]=="-") result -= s[i+1];
        }
    	
    }
    return result;
}
