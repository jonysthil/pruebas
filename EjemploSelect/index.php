<html>
<head>
<script>
function obtenerEstados(pais)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{	
    	if (this.readyState == 4 && this.status == 200)
	    {
    	    if (pais.selectedIndex > 0)
    	    {
   	    	    eliminarEstados();
   	    	    
   	    	    var obj = JSON.parse(this.responseText);
   	    	    
   	    	    for(i=0;i<obj.length;i++)
   	    	    {
	   				var estados = document.getElementById("estados");
					var option = document.createElement("option");
					option.text = obj[i].stdNombre;
					estados.add(option);
   	    	    }

    	    }
    	    else
    	    {	    	    
	    	    eliminarEstados();
    	    }
    	}
	};
	xmlhttp.open("GET", "estados.php?pais="+pais.value, true);
	xmlhttp.send();
}
function eliminarEstados()
{
    //document.getElementById("estados").options.length = 0;

	var select = document.getElementById('estados');
	while (select.firstChild) {
		select.removeChild(select.firstChild);
	}
}
</script>
</head>
<body>

<form>

País
<select id="pais" name="pais" onchange="obtenerEstados(this)">
<option value="0">-Selecciona-</option>
<option value="1" selected>México</option>
<option value="2">USA</option>
</select>

<select id="estados" name="estados">
</select>

</form>

</body>
</html>