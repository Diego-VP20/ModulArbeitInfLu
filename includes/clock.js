let d,h,m,s,day,month,year,animate;

// Quelle: https://dyclassroom.com/web-project/html5-how-to-create-a-simple-clock-using-javascript

// Ich habe noch die Tagesanzeige hinzugefügt. War nicht übelst schwer. Alles andere ist aus der Quelle rauskopiert.

function init(){
    d=new Date();
    h=d.getHours();
    m=d.getMinutes();
    s=d.getSeconds();
    // Added {
    day=d.getDay();
    month=d.getMonth();
    year=d.getFullYear()
    // }
    clock();
}

function changeValue(id,valueToPut){
    if(valueToPut<10){
        valueToPut='0'+valueToPut;
    }
    document.getElementById(id).innerHTML=valueToPut;
}

function clock(){
    s++;
    if(s===60){
        s=0;
        m++;
        if(m===60){
            m=0;
            h++;
            if(h===24){
                h=0;
            }
        }
    }

    changeValue('sec',s);
    changeValue('min',m);
    changeValue('hr',h);
    // Added {
    changeValue('day',day);
    changeValue('month',month);
    changeValue('year',year);
    // }
    animate=setTimeout(clock,1000);
}

window.onload=init;