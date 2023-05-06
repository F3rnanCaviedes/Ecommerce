<!DOCTYPE html PUBLIC "-//W3C//DTD xhtml 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xtml1-transitional.dtd">
<html xmlns="http://www.w3c.org/1999/xhmtl" lang="es">
<head>
<meta http-equiv="content-type" type="text/html"; charset="utf-8">
<title>Cavedi Rossi</title>
  <link type="text/css" rel="Stylesheet" href="vista/modules/css/products.css" media="all"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="vista/modules/css/adminlte.min.css">
  <style type="text/css">
     * {box-sizing: border-box;}

.img-zoom-container {
  position: relative;
}

.img-zoom-lens {
  position: absolute;
  border: 1px solid #d4d4d4;
  /*set the size of the lens:*/
  width: 40px;
  height: 40px;
}

.img-zoom-result {
  border: 1px solid #d4d4d4;
  /*set the size of the result div:*/
  width: 300px;
  height: 300px;
}
  </style>
</head>
  <body>
   <h1>Image Zoom</h1>

<p>Mouse over the image:</p>

<div class="img-zoom-container">
  <img id="myimage" src="img_girl.jpg" width="300" height="240">
  <div id="myresult" class="img-zoom-result"></div>
</div>

<p>The image must be placed inside a container with relative positioning.</p>
<p>The result can be put anywhere on the page, but must have the class name "img-zoom-result".</p>
<p>Make sure both the image and the result have IDs. These IDs are used when a javaScript initiates the zoom effect.</p>

<script>
// Initiate zoom effect:
imageZoom("myimage", "myresult");
</script>

  </body>
<footer>
</footer>
</html>