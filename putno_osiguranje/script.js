function dodajDugme(vrednost) {
    
    var osiguranik = '<div class="osiguranik" data-broj-osiguranika=1>'+
                        '<p>Ime i prezime</p> <input  type="text" name="ime_prezime_os1" required>'+
                        '<p>Datum rođenja</p> <input  type="date" name="datum_rodjenja_os1" required>'+
                    '</div>';
    if (vrednost=="" || vrednost=="individualno") {
      document.getElementById("dugme").innerHTML="";
      document.getElementById("osiguranici").innerHTML="";
      ukupanBrOsiguranika();
      return;
    }

    var dugme = '<button id="dodaj_os" type="button" onclick="callCallbacks()" >Dodaj osiguranika</button>';

    document.getElementById("dugme").innerHTML=dugme;
    document.getElementById("osiguranici").innerHTML=osiguranik;
    ukupanBrOsiguranika();
}

var i=1;
function dodajOsiguranika(){
    i++;
    var osiguranik = '<div class="osiguranik" data-broj-osiguranika='+i+'>'+
                        '<p>Ime i prezime</p> <input  type="text" name="ime_prezime_os'+i+'" required>'+
                        '<p>Datum rođenja</p> <input  type="date" name="datum_rodjenja_os'+i+'" required>'+
                        '<button id="izbrisi_os" type="button" onclick="izbrisiOsiguranika('+i+')" >Izbriši Osiguranika</button>'+
                    '</div>';
    $("#osiguranici").append(osiguranik);
}

function ukupanBrOsiguranika(){
    var brOsiguranika = [];
    $('.osiguranik').each(function () {
        brOsiguranika.push($(this).attr('data-broj-osiguranika')); 
    });

    $('#broj_osiguranika').val(brOsiguranika);

   console.log(brOsiguranika.toString());
}

function izbrisiOsiguranika(i){
    $('[data-broj-osiguranika='+i+']').remove();
    ukupanBrOsiguranika();
}

var callbacks = $.Callbacks();
    callbacks.add( dodajOsiguranika );
    callbacks.add( ukupanBrOsiguranika );
function callCallbacks(){
    callbacks.fire();
}


Date.prototype.toInputFormat = function() {
    var yyyy = this.getFullYear().toString();
    var mm = (this.getMonth()+1).toString(); 
    var dd  = this.getDate().toString();
    return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); 
 }

function pretpostavkaDatuma(vrednost){
    
        var date = new Date(vrednost),
            days = 7;
         
         if(!isNaN(date.getTime())){
             date.setDate(date.getDate() + days);
             
             $("#datum_do").val(date.toInputFormat());
         } else {
             alert("Invalid Date");  
         }
}

