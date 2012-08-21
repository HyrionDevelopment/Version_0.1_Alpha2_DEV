<!DOCTYPE HTML>
<html>
<head>
<link href="http://demo.cmswire.nl/v3-alpha1/styles/default/css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://demo.cmswire.nl/admin_shortcuts/js/jquery.json-2.3.js"></script>
<title>{WEBSITE-NAME}</title>
<style>

div#users-contain { width: auto; font-size: 10px; }
div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }

div#cart { width: auto; font-size: 11px; font-family:Verdana, Geneva, sans-serif; color: #000000; }
div#cart table { margin: 0 0; border-collapse: collapse; width: 600px; color: #000000;}
div#cart table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; color: #000000;}

div#item_search { width: auto; font-size: 11px; font-family:Verdana, Geneva, sans-serif; color: #000000; }
div#item_search table { margin: 0 0; border-collapse: collapse; width: 600px; color: #000000;}
div#item_search table td{ padding: 10px; border-bottom: 1px solid #eee;}

#content .box .content #item_search a
{
	color: #000;
}

.cart_amount { width: 20px; }
body
{
	margin: 0px auto;
	background: #efe6c0;
	font-family: Tahoma,Geneva,Kalimati,sans-serif;
	color: #FFF;
	height: 100%;
}

#container
{
	width: 1000px;
	margin: 0px auto;
}

#container2
{
	background: #95283b;
	padding-top: 13px;
	height: 100%;
}

#header
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/header1.png);
	width: 1000px;
	height: 134px;
}
#header2
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/header2.png);
	width: 1000px;
	height: 216px;
}

#logo
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/logo.png);
	width: 347px;
	height: 100px;
	float:left;
}


#content
{
	float:right;
	background: #95283b;
	padding-left: 0px;
	padding-right: 15px;
	padding-bottom: 15px;
}

#content .box
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/content_mid.png);
	width: 665px;
	font-size: 10pt;
	float: right;
}

#content .box .content
{
	padding-left: 25px;
	padding-right: 25px;
}

#content .box .content a
{
	color: #FFF;
}

#content .box .content #cart a
{
	color: #000;
}

#content .box .top a
{
	color: #FFF;
}

#content .box .top
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/content_top.png);
	width: 615px;
	height: 28px;
	padding-top: 15px;
	padding-left: 50px;
	font-weight: bold;
}

#content .box .bottom
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/content_bot.png);
	width: 665px;
	height: 15px;
}

#footer
{
	background: #696862;
	height: 75px;
	clear: both;
}

#footer .bar
{
	background: #352020;
	height: 2px;
}

#footer .content
{
	text-align:center;
	margin: 0px auto;
	color: #c3c3c0;
	font-size: 9pt;
}

#menu1-2
{
	float:right;
	font-size: 10pt;
	padding-right: 5px;
	color: #FFF;
}

#menu1-2 a
{
	color: #FFF;
}

#menu1
{
	float:right;
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu1/grey_mid.png);
	width: auto;
	height: 52px;
	font-size: 10pt;
	margin-top: 66px;
	position:relative;
}

#menu1 a
{
	color: #FFF;
}

#menu1 ul
{
	list-style: none;
	padding: 0;
	margin: 0;
}

#menu1 ul li
{
	float: left;
	margin-right: 20px;	
	border-left: #241212 1px solid;
	list-style-type: none;
	margin-top: 18px;
}

#menu1 ul .first_item
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu1/or_mid.png) repeat-x;
	height: 52px;
	padding-bottom: 18px;
	border-left: none;
	margin-top: 0px;
}

#menu1 ul .first_item .left
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu1/or_left.png) no-repeat;
	height: 52px;
	width: 5px;
	float: left;
}

#menu1 ul .first_item .right
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu1/or_right.png) no-repeat;
	height: 52px;
	width: 12px;
	float: right;
}

#menu1 ul .first_item .content
{
	padding-top: 18px;
	float: left;
	padding-left: 10px;
	padding-right: 10px;
}

#menu1 ul .first_item .content a
{
	color: #7c2203;
}

#menu2
{
	float: left;
	height: auto !important;
	height: 100%;
	min-height: 100%;
	background: #95283b;
	width: 300px;
	position:relative;
	overflow:hidden;
}

#menu2 .box
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu2/mid.png) repeat-y;
	width: 271px;
	float: right;
	margin-bottom: 10px;
}

#menu2 .box .content
{
	padding-left: 21px;
	padding-top: 10px;
	padding-bottom: 10px;
}

#menu2 .box .content ul
{
	list-style: none;
	padding: 0;
	margin: 0; 
}

#menu2 .box .content ul li
{
	list-style: none;
	padding: 0;
	margin: 0; 
}

#menu2 .box .content a
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}

#menu2 .box .content a:link, a:visited
{
	color: #FFF;
}

#menu2 .box .content a:hover
{
	color: #fb9428;
}

#menu2 .box .top
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu2/top.png) repeat-y;
	width: 271px;
	height: 35px;
	padding-top: 27px;
}

#menu2 .box .bottom
{
	background: url(http://demo.cmswire.nl/v3-alpha1/images/menu2/bot.png) repeat-y;
	width: 271px;
	height: 15px;
}

#menu3 ul
{
	padding: 0;
	margin: 0;
}

</style>
</head>

<body>
<div id="container">
	<div id="header">
		<div id="logo"></div>
		<div id="menu1-2">
		<a href="#">Mijn account</a> | <a href="#">Bestelstatus</a> | <a href="#">Klantenservice</a> | <a href="#">Verlanglijstjes</a>
		</div>
		<div id="menu1">
		<ul>
			<li class="first_item">
				<div class="left"></div>
				<div class="content">
					<a href="http://demo.cmswire.nl/v3-alpha1/">Home</a>
				</div>
				<div class="right"></div>
			</li>
			<li><a href="#">Over Ons</a></li>
			<li><a href="#">Locatie</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Gastenboek</a></li>
		</div>
	</div>
	<div id="header2"></div>
	<div id="container2">
	<div id="content">
	<div id="menu2">
	<!-- <div class="box">
		<div class="top">Menu</div>
		
		<div class="content">
		{menu}
		</div>
		
		<div class="bottom"></div>
	</div> -->
	
	<div class="box">
		<div class="top">Assortiment</div>
		
		<div class="content">
		{webshop_category}
		</div>
		
		<div class="bottom"></div>
	</div>	
	
	<div class="box">
		<div class="top">Winkelmandje</div>
		
		<div class="content">
		Er zitten momenteel <b>{webshop_cart_count}</b> {webshop_cart_countitems} in uw winkelmandje.<br /><br />
		<a href="http://demo.cmswire.nl/v3-alpha1/webshop/winkelmandje/bekijken/">Winkelmandje bekijken</a>
		</div>
		
		<div class="bottom"></div>
	</div>
	
		<div class="box">
		<div class="top"><a href="http://demo.cmswire.nl/v3-alpha1/ucp/login/">Login</a></div>
		<div class="content">
		 <form>
			Email:<br />
			<input name="email" id="email" value="" type="text"/><br />
			Wachtwoord:
			<br />
			<input name="email" id="email" value="" type="password" />
			<br /><br />
			<input type="submit" value="Inloggen" />
		 </form>
		</div>
		
		<div class="bottom"></div>
		</div>	
	</div>
		<div class="box">
			<div class="top">Inhoud</div>
			<div class="content">