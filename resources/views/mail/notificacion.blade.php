<!DOCTYPE html>
<html>
<head>
<style>
  /* Agrega estilos CSS personalizados aquí */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  #header {
    text-align: center;
    background-color: #f0f0f0;
    padding: 20px;
  }
  #header img {
    max-width: 200px;
  }
  #contenido {
    margin: 20px;
  }

  /* Agrega un pequeño margen en tablets y escritorio */
  @media screen and (min-width: 768px) {
    #contenido {
      margin: 20px auto;
      max-width: 600px; /* Ancho máximo del contenido */
    }
  }
</style>
</head>
<body>
<div id="header">
  <img src="https://appgreenex.cl/image/logogreenex.png" alt="Logo de Greenex">
</div>
<div id="contenido">
  <p>Estimado Productor,</p>
  <p>Hemos procesado la siguiente fruta en nuestra planta:</p>
  <ul>
    <li>Especie: {{$proceso->especie}}</li>
    <li>Variedad: {{$proceso->variedad}}</li>
    <li>N° Proceso: {{$proceso->n_proceso}}</li>
    <li>Kilos:  {{number_format($proceso->kilos_netos)}}</li>
    <li>Fecha Proceso: {{date('d M Y g:i a', strtotime($proceso->fecha))}}</li>
  </ul>
  <p>Adjuntamos informe de proceso, para mayor información ingresar a nuestro portal de productores <a href="http://www.greenex.cl">www.greenex.cl</a>.</p>
  <p>Saludos,</p>
  <p>Equipo Greenex</p>
</div>
</body>
</html>
