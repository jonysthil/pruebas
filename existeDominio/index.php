<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de dominio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        $(document).on('ready',function(){

            $('#btn-validar').click(function(){
                var url = "validando.php";
                $.ajax({                        
                    type: "POST",                 
                    url: url,                     
                    data: $("#validaDominio").serialize(), 
                    success: function(data) {
                        $('#resp').html(data);               
                    }
                });
            });

            $("#validaDominio").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
    </script>
</head>
<body>

        <br>
        <br>
        <br>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="text-center">
                    <img src="logotipo.png" width="50%" class="img-fluid img-responsive" alt="Custom Coding">
                </p>
                <div class="card">
                    <div class="card-header">
                        Comprueba la disponibilidad de su nombre de dominio.
                    </div>
                    <div class="card-body">
                        <form id="validaDominio">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">www.</div>
                                    </div>
                                    <input name="dominio" id="dominio" type="text" class="form-control" placeholder="Dominio" required>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="dom" id="dom">
                                        <option value="com">.com</option>
                                        <option value="mx">.mx</option>
                                        <option value="com.mx">.com.mx</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" id="btn-validar" class="btn btn-primary">Comprobar</button>
                                </div>
                            </div>
                        </form>
                        <div id="resp"></div>
                    </div>
                </div>
                <p class="text-center">Por: Jonathan Jimenez.</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>

