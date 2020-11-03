<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>  
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Nouvelles acquisitions</title>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--link rel="stylesheet" href="awesomplete.css" />
<script src="awesomplete.js" async></script -->
	
	
	
<style>
body {
color: #32322f;
background-color: #fff;
font-size: 14px;
font-family: Arial,verdana;
}

a,a:link, a:hover, a:visited {
color: #642667;
text-decoration: none;
}
a.ged {
background-color: #642667;
color: #fff;
font-weight: bold;
padding: 1px;
margin-left: 10px;
margin-right: 10px;
}

h1
{
color: #004C7E;
margin-top: 70px;
margin-left: 30px;
}

#item {
margin-left: 30px;
}

.sort {
  padding:8px 10px;
  border-radius: 6px;
  border:none;
  display:inline-block;
  color:#fff;
  text-decoration: none;
  background-color: #A0011A;
  height:30px;
}
.sort:hover {
  text-decoration: none;
  background-color:#C50C1D;
}
.sort:focus {
  outline:none;
}
.sort:after {
  display:inline-block;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid transparent;
  content:"";
  position: relative;
  top:-10px;
  right:-5px;
}
.sort.asc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #fff;
  content:"";
  position: relative;
  top:4px;
  right:-5px;
}
.sort.desc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #fff;
  content:"";
  position: relative;
  top:-4px;
  right:-5px;
}

.pagination_top li, .pagination_bot li {
  display:inline-block;
  padding:5px;
 
}
.pagination_top li a, .pagination_bot li a {
 background-color: #004C7E;
 padding: 5px;
 color: #fff;
 border-radius: 5px;
}

.pagination_top li.active a, .pagination_bot li.active a {
 background-color: #006FB9!important;
 padding: 5px;
 color: #fff;
 border-radius: 5px;
}

input {
  border:solid 1px #ccc;
  border-radius: 5px;
  padding:6px 10px;
  margin-bottom:10px
}
input:focus {
  outline:none;
  border-color:#aaa;
}


.list > li {
  display:block;
  /*background-color: #eee;*/
  padding:10px;
  box-shadow: inset 0 1px 0 #eee;
}

h3.title{
font-size: 18px;
color: #642667;
}

.biblio {
color: #642667;
}

.biblio-info {
color: #642667;
font-weight: bold;
}

.info {
color: #642667;
font-weight: bold;
}


#topLink {
margin: 0;
padding: 0;
list-style-type: none;
height: 94px;
background: #642667 no-repeat scroll 100% 0;
position: absolute;
top: 0;
left: 0;
width: 100%;
}

#topLink a.unifi {
    left: 0;
    top: 0;
    height: 94px;
    width: 172px;
    background: url('https://campus-condorcet.primo.exlibrisgroup.com/discovery/custom/thumbnails/thumbnail_33CCP_INST-CCP.png') 0 0 no-repeat scroll;
}
#topLink li a {
    position: absolute;
    top: 0;
}
#topLink a.sba {
    left: 173px;
    top: 0;
    height: 94px;
    width: 126px;
    background: 0 0 no-repeat scroll;
}

#topLink a span {
    position: absolute;
    left: -999em;
}
</style>		
</head>

<body>
  <ul id="topLink">
    <li><a title="Campus Condorcet - Grand équipement documentaire" href="https://campus-condorcet.fr/le-ged" class="unifi"><span>Campus Condorcet - Grand équipement documentaire</span></a></li>
  </ul>
  <br>
  
  <h1>Nouvelles acquisitions du Grand équipement documentaire (GED)</h1>
  <?php 
    $dfin = new DateTime('-1 day');
    $ddeb = new DateTime('-61 day');
    echo "<p class='info'>Ouvrages réceptionnés entre le " . $ddeb->format('d/m/Y') . " et le " . $dfin->format('d/m/Y');
  ?>
  <?php
    require 'lib/cachena.php';
  ?>
</body>
<script language="javascript" src="js/new_acq.js"></script>
</html>
