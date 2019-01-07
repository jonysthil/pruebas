
var ns4 = (document.layers) ? true : false
var ie4 = (document.all) ? true : false
var ns6 = (document.getElementById && !document.all) ? true : false;
var coorX, coorY, iniX, iniY;

if (ns6) document.addEventListener("mousemove", mouseMove, true)
if (ns4) { document.captureEvents(Event.MOUSEMOVE); document.mousemove = mouseMove; }

function mouseMove(e) {
    if (ns4 || ns6) { coorX = e.pageX; coorY = e.pageY; }
    if (ie4) { coorX = event.x; coorY = event.y; }
    return true;
}

function ini() {
    if (ie4) document.body.onmousemove = mouseMove;
    iniX = document.getElementById("recuadro").offsetLeft;
    iniY = document.getElementById("recuadro").offsetTop;
}

function coordenadas(idImagen) {
    $('#exampleModalCenter').modal('show');
    $('#tagPositionX').val(coorX);
    $('#tagPositionY').val(coorY);
    $('#idImagen').val(idImagen);

    //alert ("Pinchó las siguientes coordenadas:\nx:" + coorX + "\ny: " + coorY + "\niniX = " + iniX + "\niniY = " + iniY);
}

function mostrar() {
    document.getElementById("ayuda").style.top = coorY + 10;
    document.getElementById("ayuda").style.left = coorX + 10;
    document.getElementById("ayuda").style.visibility = "visible";
    document.getElementById("ayuda").innerHTML = "x = " + coorX + "<br>y = " + coorY;
}

function ocultar() {
    document.getElementById("ayuda").style.visibility = "hidden";
}
function mover() {
    document.getElementById("ayuda").style.top = coorY + 10;
    document.getElementById("ayuda").style.left = coorX + 10;
    document.getElementById("ayuda").style.visibility = "visible";
    document.getElementById("ayuda").innerHTML = "x = " + coorX + "<br>y = " + coorY;
}

function ubicar() {
    document.getElementById("ubicacion").style.top = coorY + 10;
    document.getElementById("ubicacion").style.left = coorX + 10;
}