function Funkcija()
{
	document.getElementById("tree-menu1").style.display="none";
	document.getElementById("tree-menu2").style.display="none";
	document.getElementById("tree-menu3").style.display="none";
	document.getElementById("tree-menu4").style.display="none";
	document.getElementById("tree-menu5").style.display="none";
	document.getElementById("tree-menu51").style.display="none";
	document.getElementById("tree-menu52").style.display="none";
	document.getElementById("tree-menu53").style.display="none";
}

function Funkcija1()
{
	if(document.getElementById("tree-menu1").style.display=="block"){
		document.getElementById("tree-menu1").style.display="none";
		document.getElementById("OrgVrijednosti").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
		
	else {
		document.getElementById("tree-menu1").style.display="block";
		document.getElementById("OrgVrijednosti").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}

function Funkcija2()
{
	if(document.getElementById("tree-menu2").style.display=="block"){
		document.getElementById("tree-menu2").style.display="none";
		document.getElementById("Antikorupcija").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
		
	else {
		document.getElementById("tree-menu2").style.display="block";
		document.getElementById("Antikorupcija").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}

function Funkcija3()
{
	if(document.getElementById("tree-menu3").style.display=="block"){
		document.getElementById("tree-menu3").style.display="none";
		document.getElementById("JavnaNabava").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu3").style.display="block";
		document.getElementById("JavnaNabava").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}

function Funkcija4()
{
	if(document.getElementById("tree-menu4").style.display=="block"){
		document.getElementById("tree-menu4").style.display="none";
		document.getElementById("PolitikaKvaliteta").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu4").style.display="block";
		document.getElementById("PolitikaKvaliteta").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}


function Funkcija5()
{
	if(document.getElementById("tree-menu5").style.display=="block"){
		document.getElementById("tree-menu5").style.display="none";
		document.getElementById("PonudeUsluge").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu5").style.display="block";
		document.getElementById("PonudeUsluge").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}


function Funkcija51()
{
	if(document.getElementById("tree-menu51").style.display=="block"){
		document.getElementById("tree-menu51").style.display="none";
		document.getElementById("AkcijskePonude").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu51").style.display="block";
		document.getElementById("AkcijskePonude").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}

function Funkcija52()
{
	if(document.getElementById("tree-menu52").style.display=="block"){
		document.getElementById("tree-menu52").style.display="none";
		document.getElementById("Pogodnosti").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu52").style.display="block";
		document.getElementById("Pogodnosti").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}

function Funkcija53()
{
	if(document.getElementById("tree-menu53").style.display=="block"){
		document.getElementById("tree-menu53").style.display="none";
		document.getElementById("Usluge").style.listStyleImage = "url(slike/list-style-triangle.png)";
	}
	else{
		document.getElementById("tree-menu53").style.display="block";
		document.getElementById("Usluge").style.listStyleImage = "url('https://cdn1.iconfinder.com/data/icons/material-core/20/check-circle-outline-blank-16.png')";
	}
}


function validirajEmail(email) {
	var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	if(email.value.match(emailformat))  
	{  
 		return true;  
	}  
	else  
	{  
		return false;  
	}  
}


function validiraj() {
	var validno = true;
	var poruka = 'Ispravite sljedeće greške:\r\n';


	// validacija imena i prezimena
	var imee = document.formica.firstname;

	if (imee.value.length == 0)
	{
		poruka = poruka + '  - Upišite ime i prezime\r\n';
		var slika = document.getElementById("eror_name");
		slika.style.display="inline";
		document.formica.firstname.focus();
		validno = false;
	}

	// validacija emaila
	if (document.formica.email.value.length == 0) {
		poruka = poruka + '  - Unesite email\r\n';
		var slika = document.getElementById("eror_email");
		slika.style.display="inline";
		document.formica.email.focus();
		validno = false;
	}
	else if (validirajEmail(document.formica.email) == false) {
		poruka = poruka + '  - Unijeli ste pogrešan email\r\n';
		var slika = document.getElementById("eror_email");
		slika.style.display="inline";
		document.formica.email.focus();
		validno = false;
	}

	// potvrda emaila- cross validacija
	if (document.formica.email.value != document.formica.emailpotvrda.value) {
		
		poruka = poruka + '  - Niste unijeli ispravan potvrdni email\r\n';
		var slika = document.getElementById("eror_email_potvrda");
		slika.style.display="inline";
		document.formica.emailpotvrda.focus();
		validno = false;
	}


	// validacija poruke
	var tekst = document.formica.myname;
	if (tekst.value.length == 0) {
		poruka = poruka + '  - Unesite tekst poruke\r\n';
		var slika = document.getElementById("eror_poruka");
		slika.style.display = "inline";
		validno = false;
		document.formica.myname.focus();
	}


	// validacija poštanskog broja i mjesta putem Ajaxa
	var mj = document.formica.mjesto.value;
	var ptbr = document.formica.ptbroj.value;
	var xmlhttp = new XMLHttpRequest();

	// polja grad iptbroj nisu obavezna, ali ako se unese jedno(grad/ptbroj) mora se unijeti i drugo(ptbroj/grad)

	if(mj.length == 0 && ptbr.length != 0) 
	{
		poruka = poruka + '  - Unesite mjesto za uneseni poštanski broj\r\n';
		var slika = document.getElementById("eror_city");
		slika.style.display = "inline";
		validno = false;

		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				var obj = JSON.parse(xmlhttp.responseText);

				// ako je unesen nepostojeći ptbroj
				if(obj.hasOwnProperty("greska") && obj.greska == "Nepostojeći poštanski broj")
				{
					alert(poruka + '  - ' + objj.greska + '\r\n');
					return false;
				}
				// kada se ne unese mjesto javlja se greška da je mjesto nepostojeće
				else if(obj.hasOwnProperty("greska") && obj.greska == "Nepostojeće mjesto")
				{
					alert(poruka + '  - ' + obj.greska + '\r\n');
					return false;				
				}

				
				if(xmlhttp.readyState == 4 && xmlhttp.status == 404)
    		    {
       	       		console.log("Pogrešan URL!");
       	     	}
			}
		}
		
	}

	else if(ptbr.length == 0 && mj.length != 0)
	{
		poruka = poruka + '  - Unesite poštanski broj za uneseno mjesto\r\n';
		var slika = document.getElementById("eror_cityno");
		slika.style.display = "inline";
		validno = false;

		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				var obj = JSON.parse(xmlhttp.responseText);

				// ako je unesen nepostojeći grad
				if(obj.hasOwnProperty("greska") && obj.greska == "Nepostojeće mjesto")
				{
					alert(poruka + '  - ' + obj.greska + '\r\n');
					return false;
				}
				// kada se ne unese ptbroj javlja se greška da je ptbroj nepostojeći
				else if(obj.hasOwnProperty("greska") && obj.greska == "Nepostojeći poštanski broj")
				{
					alert(poruka + '  - ' + obj.greska + '\r\n');
					return false;
				}
				
				
				if(xmlhttp.readyState == 4 && xmlhttp.status == 404)
    		    {
       	       		console.log("Pogrešan URL!");
       	     	}
			}
		}
	}
	
	else if(mj.length != 0 && ptbr.length != 0)
	{
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				var obj = JSON.parse(xmlhttp.responseText);
				if(obj.hasOwnProperty("greska") && obj.greska == "Poštanski broj ne odgovara mjestu")
				{
					alert(poruka + '  - ' + obj.greska + '\r\n');
					return false;
				}
				else if(obj.hasOwnProperty("ok") && obj.ok == "Poštanski broj odgovara mjestu")
				{
					alert(obj.ok);
				}
				if(xmlhttp.readyState == 4 && xmlhttp.status == 404)
    		    {
       	       		console.log("Pogrešan URL!");
       	     	}
			}
		}
	}

	mj = encodeURIComponent(mj);
	ptbr = encodeURIComponent(ptbr);
	var url = 'http://zamger.etf.unsa.ba/wt/postanskiBroj.php?mjesto='+mj+'&postanskiBroj='+ptbr;
	xmlhttp.open("GET", url, true);
    xmlhttp.send();

	
	if (validno==false) {
		alert(poruka);
	}
	else {
		var slika1 = document.getElementById("eror_name");
		var slika2 = document.getElementById("eror_email");
		var slika3 = document.getElementById("eror_poruka");
		var slika4 = document.getElementById("eror_cityno");
		var slika4 = document.getElementById("eror_city");
		slika1.style.display = "none";
		slika2.style.display = "none";
		slika3.style.display = "none";
		slika4.style.display = "none";
		slika5.style.display = "none";
	}

}


function funkcijaHome() {
	var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "index.php", true);
    ajax.send();
}

/*
function funkcijaNews() {
	var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "news.html", true);
    ajax.send();
}
*/

function funkcijaRoutes() {
	var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "routes.html", true);
    ajax.send();
}

function funkcijaContact() {
	var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "contact.html", true);
    ajax.send();
}

function funkcijaAbout() {
		var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "about.html", true);
    ajax.send();
}

function funkcijaAdminPanel() {
		var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {// Anonimna funkcija
                if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("tijelo").innerHTML = ajax.responseText;
                if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
        }
    ajax.open("GET", "admin_panel.php", true);
    ajax.send();
}

var now;

function loadNews()
{
	// get news
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {

      if (ajax.readyState == 4 && ajax.status == 200)
      {
      	var slika = "";
      	var detaljno = "";
        var news = JSON.parse(ajax.responseText);

        news = news['vijesti'];
        var string = "<div class='article'";
        for(var i=0; i<news.length; i++)
        {
        	/*
        	if(news[i].slika == null)
            	slika = "";
            else
            	slika = "<img class = 'article-pic' src='getImage.php?id="+news[i].slika+" alt='neka slika'>";*/
            //  ako novost ima/nema detaljno
            if(news[i].detaljno == "")
                detaljno = "";
            else
                detaljno = "<a id='detaljnoTekst"+news[i].id+"' class='read-more' href='javascript:void(0)' onclick='showMore("+news[i].id+")>DETALJNIJE...</a>";

            if(news[i].broj_komentara == 0)
            {
                string += "<div class='article'><h1>"+news[i].naslov+"</h1>"
                          +"<h2><strong>autor : </strong>"+news[i].autor+", <strong>Objavljeno : </strong>"+news[i].datum+"</h2>"
                          +slika+"<p>"+news[i].tekst+"<br><br>";
                string += "<div id='detaljnaVijest"+news[i].id+"></div>";
                string += detaljno;
                string += " Nema komentara<br><br></p></div>";
            }
            else
            {
                string += "<div class='article'><h1>"+news[i].naslov+"</h1>"
                          +"<h2><strong>autor : </strong>"+news[i].autor+", <strong>Objavljeno : </strong>"+news[i].datum+"</h2>"
                          +slika+"<p>"+news[i].tekst+"<br><br>";
                string += "<div id='detaljnaVijest"+news[i].id+"></div>";
                string += detaljno;
                string += "<a href = 'javascript:void(0);' onclick='showDiv("+news[i].id+")'>Ima "+news[i].broj_komentara+" komentara</a>";
                string += "<br><br></p></div>";
                string += "<div id='vijestBr"+news[i].autor+"'></div>";    
            }

                             
            string += "<form action='' method='post' onsubmit='return false'>"
	                      +"<input type='hidden' id='pk' value='"+news[i].id+"'>"
	                      
	                      +"<br><textarea rows='5' cols='50' id='komm' placeholder='Komentar'></textarea><br>"
	                      +"<input type='button' name='addcomm' value='Komentariši' onClick='sendComment(this.form)'>"
                       +"</form>"; 
        }
         string += "</div>";

        document.getElementById("loadNews").innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("loadNews").innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_vijesti.php", true);
    ajax.send();
}

function showDiv(vijestId)
{
	
    // get comments
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200)
      {

        var comms = JSON.parse(ajax.responseText);

        comms = comms['komentari'];
        var string = "";
        for(var i=0; i<comms.length; i++)
          string += "<div class='comments'><p id='kom'><strong>"+comms[i].autor+"</strong><br><small>"+comms[i].datum+"<br><br>"+comms[i].tekst+"</small></p></div>";

        document.getElementById("vijestBr"+(vijestId.toString())).innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("vijestBr"+(vijestId.toString())).innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_komentari.php?vijest="+(vijestId.toString()), true);
    ajax.send();

     // show/hide comments
    if(document.getElementById("vijestBr"+(vijestId.toString())).style.display == 'block')
      	document.getElementById("vijestBr"+(vijestId.toString())).style.display = 'none';
    else
      	document.getElementById("vijestBr"+(vijestId.toString())).style.display = 'block';
}

function updateTime() {
	now = new Date();
}

var autorr;
function sendComment(f)
{
	var ajax = new XMLHttpRequest();

	var vijest = f.pk.value;
	var auth = f.author.value;
	var txt = f.komm.value;
	autorr = auth;

	ajax.open("POST", "web_servis_komentari.php");
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("autor=" + auth + "&tekst=" + txt + "&vijest=" + vijest);

}


function showMore(vijestId)
{
	// get details
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200)
      {

        var comms = JSON.parse(ajax.responseText);

        comms = comms['detalji'];
        var string = "<div class='article'><p>" + comms[0].detaljno + "</p></div>";
        
        document.getElementById("detaljnaVijest"+(vijestId.toString())).innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("detaljnaVijest"+(vijestId.toString())).innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_detaljno.php?vijest="+(vijestId.toString()), true);
    ajax.send();

     // show/hide details
    if(document.getElementById("detaljnaVijest"+(vijestId.toString())).style.display == 'block')
    {
    	var element = document.getElementById("detaljnoTekst"+(vijestId.toString()));
    	element.innerHTML = "DETALJNIJE...";
    	document.getElementById("detaljnaVijest"+(vijestId.toString())).style.display = 'none';
  	}
    else
    {
    	var element = document.getElementById("detaljnoTekst"+(vijestId.toString()));
    	element.innerHTML = "SAKRIJ DETALJNO";
    	document.getElementById("detaljnaVijest"+(vijestId.toString())).style.display = 'block';
  	}
}

function showAdminComments() 
{
	// get comments
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200)
      {

        var comms = JSON.parse(ajax.responseText);

        comms = comms['komentari'];
        var string = "<fieldset id='komentar_fs'><legend>Komentari</legend>";
        for(var i=0; i<comms.length; i++)
      	  string += "<div id='kom'><strong>"+comms[i].autor+"</strong><br><small id='kom_datum'>"
      	+comms[i].datum+"</small><br><br><small>"
      	+comms[i].tekst+"</small><br><br></div><br>"
      	+"<form action='' method='post'>"
      	+"<button id='batnObrisi' type='submit' name='buttonObrisiKom' onClick='obrisiKomentarAdmin("+comms[i].id+")'>Obriši</button>"
      	+"</form><br><br>"

      	string += "</fieldset><br><br>";
        document.getElementById("svi_komentari").innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("svi_komentari").innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_komentari_admin.php", true);
    ajax.send();
}

function showAdminNews()
{
	// get news
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200)
      {

        var news = JSON.parse(ajax.responseText);

        news = news['vijesti']; 
      
        var string = "<fieldset id='novosti_fs'><legend>Novosti</legend>";
        for(var i=0; i<news.length; i++)
      	  string += "<div id='kom'>"
	                    +"<strong>"+news[i].naslov+"</strong><br>"
	                    +"<small id='kom_datum'>"+news[i].datum+"</small><br>"
	                    +"<small id='kom_datum'>"+news[i].autor+"</small><br><br>"
	                    +"<img class = 'article-pic' src='getImage.php?id="+news[i].id+" alt='nema slike'><br>"
	                    +"<small>"+news[i].tekst+"</small><br> "
	                    +"<small>"+news[i].detaljno+"</small><br><br>"  
	                    +"<form id='formica' action='admin_panel.php' method='post'>"
	                        +"<input type='hidden' name='pk' value="+news[i].id+">"
	                        +"<button id='batnObrisi' type='submit' name='buttonObrisiVijest'>Obriši</button><br><br>"
	                        +"<input type='text' name='aut' placeholder='Autor'>"
	                        +"<input type='text' name='nasl' placeholder='Naslov'><br><br>"
	                        +"<textarea rows='5' cols='50' name='txt' placeholder='Vijest'></textarea><br>"
	                        +"<textarea rows='5' cols='50' name='det' placeholder='Detaljno'></textarea><br>"
	                        +"<button id='batnDodajIzmijeni' type='submit' name='buttonIzmijeniVijest'>Izmijeni</button><br><br>"
	                    +"</form>"
                    +"</div><br>";
        string += "<div id='kom'>"
      				+"<strong>Dodaj novu vijest</strong><br><br>"
      				+"<form id='formica' action='admin_panel.php' method='post'>"
	                        +"<input type='text' name='aut' placeholder='Autor'>"
	                        +"<input type='text' name='nasl' placeholder='Naslov'><br><br>"
	                        +"<textarea rows='5' cols='50' name='txt' placeholder='Vijest'></textarea><br>"
	                        +"<textarea rows='5' cols='50' name='det' placeholder='Detaljno'></textarea><br>"
	                        +"<button id='batnDodajIzmijeni' type='submit' name='buttonDodajVijest'>Dodaj</button><br><br>"
	                    +"</form>"
                    +"</div><br>";
      	string += "</fieldset><br><br>";
      	

        document.getElementById("sve_vijesti").innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("sve_vijesti").innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_vijesti_admin.php", true);
    ajax.send();
}

var usrmail;
function showAdminUsers()
{
	// get users
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200)
      {

        var users = JSON.parse(ajax.responseText);

        users = users['korisnici'];
        var string = "<fieldset id='korisnici_fs'><legend>Korisnici</legend>";
        for(var i=0; i<users.length; i++)
      	  string += "<div id='kom'>"
	                    +"<strong> Username: "+users[i].username+"</strong><br>"
                        +"<strong>Password: "+users[i].password+"</strong><br><br>"
                        +"<small>Email: "+users[i].email+"</small><br><br>"
                        +"<small>Pristup: "+users[i].pristup+"</small><br><br>"
                        +"<form action='' method='post'>"
				      		+"<button id='batnObrisi' type='submit' name='buttonObrisiKor' onClick='obrisiKomentarAdmin("+users[i].id+")'>Obriši</button><br><br>"
				      		+"<input type='text' name='usr' placeholder='Username'><br><br>"
	                        +"<input type='text' name='eml' placeholder='Email'><br><br>"
	                        +"<input type='text' name='pas' placeholder='Password'><br><br>"
	                        +"<input type='text' name='pr' placeholder='Pristup'><br><br>"
	                        +"<button id='batnDodajIzmijeni' type='submit' name='buttonIzmijeniKor'>Izmijeni</button>"
				      	+"</form><br><br>"
                    +"</div><br>";
        string += "<div id='kom'>"
      				+"<strong>Dodaj novog korisnika</strong><br><br>"
      				+"<form id='formica' action='admin_panel.php' method='post'>"
				      		+"<input type='text' name='usr' placeholder='Username'><br><br>"
	                        +"<input type='text' name='eml' placeholder='Email'><br><br>"
	                        +"<input type='text' name='pas' placeholder='Password'><br><br>"
	                        +"<input type='text' name='pr' placeholder='Pristup'><br><br>"
	                        +"<button id='batnDodajIzmijeni' type='submit' name='buttonDodajKor'>Dodaj</button><br><br>"
	                    +"</form>"
                    +"</div><br>";           
      	string += "</fieldset><br><br>";
        document.getElementById("svi_korisnici").innerHTML = string;
      }
        
      if (ajax.readyState == 4 && ajax.status == 404)
        document.getElementById("svi_korisnici").innerHTML = "Greška!";
    }
    ajax.open("GET", "web_servis_korisnici_admin.php", true);
    ajax.send();
}


function obrisiKomentarAdmin(pk_kom)
{
	var ajax = new XMLHttpRequest();

	var pk_komentar = pk_kom;
	ajax.open("DELETE", "web_servis_komentari.php");
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("komentarid=" + pk_komentar);
}



function LoginUser(f) 
{
	if (document.getElementById("login").style.display == 'block') 
	{
		document.getElementById("login").style.display = 'none';
		document.getElementById("loggedin").innerHTML = "ULOGOVANI STE!";
	}
}




function insertPassInDatabase()
{

}

/*
function checkDatabaseUpdatesComments() 
{
	console.log(now);
	var ajax = new XMLHttpRequest();
	    ajax.onreadystatechange = function() {
	      if (ajax.readyState == 4 && ajax.status == 200)
	      {

	        var comms = JSON.parse(ajax.responseText);

	        comms = comms['komentari'];
	        console.log(comms[0]);
	        
	      }
	        
	      if (ajax.readyState == 4 && ajax.status == 404)
	        console.log = "Greška!";
	    }
	    ajax.open("GET", "web_servis_komentari_novi.php?vrijeme="+now, true);
	    ajax.send();
}
*/