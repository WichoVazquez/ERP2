
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Alta de Perfil</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
  <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 400px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
	.text-label {
    color: #cdcdcd;
    font-weight: bold;
	}
  </style>
  <script src="../Clases/javascript/perfil_pantalla.js"></script>
  
</head>
<body>

<div style="width:300;">
<?
$perfil=$_POST['perfil'];
?>
<fieldset>
<form >
<label for="perfil">ID Perfil</label>
<input type="text" name="perfil" id="perfil" class="text ui-widget-content ui-corner-all" onKeyUp="showResultPerfil(this.value)" title="Palabras Clave" <?php if(!empty($perfil)) echo "value='".$perfil."' disabled='disabled'"; ?> />
<DIV id="liveperfil" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
</form>
</fieldset>    
</div>
<div id="dialog-form" title="Ingresar Pantalla">
  <form>
  <fieldset>
    <label for="pantalla">ID Pantalla</label>
    <input type="text" name="pantalla" id="pantalla" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" title="Palabras Clave" width="200" maxlength="20"/>
    <DIV id="livesearch" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" disabled="disabled" />
    <label for="desc">Descripcion</label>
    <input type="text" name="desc" id="desc" class="text ui-widget-content ui-corner-all" disabled="disabled" />
    <label for="area">Area</label>
    <input type="text" name="area" id="area" class="text ui-widget-content ui-corner-all" disabled="disabled" />
    <label for="url">URL</label>
    <input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" disabled="disabled" />
  </fieldset>
  </form>
</div>
<div id="users-contain" class="ui-widget">
  <h1>Pantallas de Perfil:</h1>
  <table id="pantallas" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>&nbsp;</th>
        <th>No.</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Area</th>
        <th>URL</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<button id="crear-pantalla">Agregar Pantalla</button>
<button id="borrar-pantalla">Borrar Pantalla</button>
<button id="continuar-pantalla">Añadir</button>
<div id="status_regis" class="ui-widget">
</div>
</body>
</html>
