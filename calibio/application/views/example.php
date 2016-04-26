<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}

@import url(http://fonts.googleapis.com/css?family=Open+Sans:700);
#cssmenu {
  background: #f96e5b;
  width: auto;
}
#cssmenu ul {
  list-style: none;
  margin: 0;
  padding: 0;
  line-height: 1;
  display: block;
  zoom: 1;
}
#cssmenu ul:after {
  content: " ";
  display: block;
  font-size: 0;
  height: 0;
  clear: both;
  visibility: hidden;
}
#cssmenu ul li {
  display: inline-block;
  padding: 0;
  margin: 0;
}
#cssmenu.align-right ul li {
  float: right;
}
#cssmenu.align-center ul {
  text-align: center;
}
#cssmenu ul li a {
  color: #ffffff;
  text-decoration: none;
  display: block;
  padding: 15px 25px;
  font-family: 'Open Sans', sans-serif;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 14px;
  position: relative;
  -webkit-transition: color .25s;
  -moz-transition: color .25s;
  -ms-transition: color .25s;
  -o-transition: color .25s;
  transition: color .25s;
}
#cssmenu ul li a:hover {
  color: #333333;
}
#cssmenu ul li a:hover:before {
  width: 100%;
}
#cssmenu ul li a:after {
  content: "";
  display: block;
  position: absolute;
  right: -3px;
  top: 19px;
  height: 6px;
  width: 6px;
  background: #ffffff;
  opacity: .5;
}
#cssmenu ul li a:before {
  content: "";
  display: block;
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 0;
  background: #333333;
  -webkit-transition: width .25s;
  -moz-transition: width .25s;
  -ms-transition: width .25s;
  -o-transition: width .25s;
  transition: width .25s;
}
#cssmenu ul li.last > a:after,
#cssmenu ul li:last-child > a:after {
  display: none;
}
#cssmenu ul li.active a {
  color: #333333;
}
#cssmenu ul li.active a:before {
  width: 100%;
}
#cssmenu.align-right li.last > a:after,
#cssmenu.align-right li:last-child > a:after {
  display: block;
}
#cssmenu.align-right li:first-child a:after {
  display: none;
}
@media screen and (max-width: 768px) {
  #cssmenu ul li {
    float: none;
    display: block;
  }
  #cssmenu ul li a {
    width: 100%;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-bottom: 1px solid #fb998c;
  }
  #cssmenu ul li.last > a,
  #cssmenu ul li:last-child > a {
    border: 0;
  }
  #cssmenu ul li a:after {
    display: none;
  }
  #cssmenu ul li a:before {
    display: none;
  }
}


</style>

</head>
<body>

<div id='cssmenu'>

</div>	
  </div>		
	</div>
	<div style='height:20px;'></div>  
    <div>
    <div class="row">
	  <div class="col-md-12 col-md-push-0">
	  	<?php echo $output; ?>
	  </div>
	</div>
		
    </div>
</body>
</html>
