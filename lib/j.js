function formatQuarterlyHrs(t){
    var n = t.val(), x=0;
    n = parseFloat(n); if(isNaN(n)){ n=0; }  
    n = Math.abs(n);
    //x = Math.floor(n*4)*0.25;
    //x = n*4; x = Math.round(x); x = x/4; x = Math.round(x*100)/100; 
    x = Math.round( Math.round(n*4) *25 ) /100;
    t.val(x);
}

function notify(obj){
    
    var logMessageTimerOut = 7000, //7 seconds
        logMessageMaxTimerOut = 20000; //20 seconds    
    
    if(obj.type==='log'){
        alertify.log(obj.msg);
    } else if(obj.type==='error'){
        alertify.log(obj.msg,'error',logMessageMaxTimerOut);
    } else if(obj.type==='success'){
        alertify.log(obj.msg,'success',logMessageTimerOut);
    } else if(obj.type==='alert'){
        alertify.alert(obj.msg);
    }
    
    
    
}
