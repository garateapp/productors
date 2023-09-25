<!DOCTYPE html>
<html>
<head>
<style>
  /* Estilos generales */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
  }
  #contenido {
    width: 100%; /* Por defecto, ocupa el 100% del ancho */
    max-width: 50%; /* Máximo del 50% del ancho en tabletas y computadoras */
    text-align: left;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
  }
  #contenido ul {
    list-style: none;
    padding-left: 0;
  }
  #header img {
    max-width: 200px;
  }

  /* Estilos específicos para dispositivos móviles */
  @media screen and (max-width: 768px) {
    #contenido {
      max-width: 100%; /* Ocupa el 100% del ancho en dispositivos móviles */
    }
  }
</style>
</head>
<body>
<div id="contenido">
  <div id="header">
    <img src="https://appgreenex.cl/image/logogreenex.png" alt="Logo de Greenex">
  </div>
  <p>Estimado Productor,</p>
  <p>Hemos procesado la siguiente fruta en nuestra planta:</p>
  <ul>
    <li>Especie: Manzanas</li>
    <li>Variedad: Royal Gala</li>
    <li>N° Proceso: 1314</li>
    <li>Kilos: 4.415</li>
    <li>Fecha Proceso: 09/02 18:37</li>
  </ul>
  <p>Adjuntamos informe de proceso, para mayor información ingresar a nuestro portal de productores <a href="http://www.greenex.cl">www.greenex.cl</a>.</p>
  <p>Saludos,</p>
  <p>Equipo Greenex</p>
</div>
</body>
</html>
