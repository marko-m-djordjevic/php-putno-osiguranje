<!DOCTYPE html>
<html>
    <head>
        <title>Forma za online kupovinu putnog osiguranja</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script src="jquery-3.3.1.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body class="upitnik">
        
        <h2>Forma za online kupovinu putnog osiguranja</h2>
        <form id="form1" action="hvala.php" method="post" enctype="application/x-www-form-urlencoded">

            <p>Nosilac osiguranja (Ime i Prezime)</p>
            <input  type="text" name="ime_prezime" required><br>

            <p>Odaberite vrstu polise osiguranja</p>
            <select name="vrsta_polise" onchange="dodajDugme(this.value)" required>
                <option value=""></option>
                <option value="individualno">Individualno</option>
                <option value="grupno">Grupno</option>
            </select>

            <p>Broj telefona</p>
            <input  type="number" name="br_tel" required><br>

            <p>Datum putovanja</p>
            Od <input id="datum_od" type="date" name="datum_od" onchange="pretpostavkaDatuma(this.value)" required> Do <input id="datum_do" type="date" name="datum_do" required><br>
            
            <input id="broj_osiguranika" type="hidden" name="broj_osiguranika" >

            <div id="osiguranici">
            </div>

            <br>
            <div id="dugme">
            </div>

            <br>
            <br>
            <input type="submit" value="Pošalji"><br>
        </form>
        
    </body>
</html>