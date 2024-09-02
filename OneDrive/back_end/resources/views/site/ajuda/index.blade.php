@extends('layouts.app')

@section('Ajuda', 'Ajuda - Marca Aí')

@section('header', 'Ajuda')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	
	<div class="row">
	
	<!--team-1-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/00abff/fff?text=Diogo" class="img-fluid" />
	<h3>Diogo Cesar Silva Lima</h3>
	<p>BOT</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o BOT. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>
	<!--team-1-->
	
	<!--team-2-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/00abff/fff?text=Gustavo" class="img-fluid" />
	<h3>Gustavo Delpino Soratto</h3>
	<p>BOT</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o BOT. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>
	<!--team-2-->
	
	<!--team-3-->
    <div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/00abff/fff?text=Rafael" class="img-fluid" />
	<h3>Rafael Zangiacomi Navarro</h3>
	<p>BOT</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o BOT. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>

	<!--team-3-->
	
	<!--team-4-->
    <div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/3533cd/fff?text=Luiz" class="img-fluid" />
	<h3>Luiz Felipe Terra da Silva</h3>
	<p>Site</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o Site. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>
	<!--team-4-->
	
	<!--team-5-->
    <div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/3533cd/fff?text=Maria" class="img-fluid" />
	<h3>Maria Clara Cintra Batista</h3>
	<p>Site</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o Site. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>
	<!--team-5-->
	
	<!--team-6-->
	<div class="col-lg-4">
	<div class="our-team-main">
	
	<div class="team-front">
	<img src="http://placehold.it/110x110/3533cd/fff?text=Phablo" class="img-fluid" />
	<h3>Phablo Loureiro Alves</h3>
	<p>Site</p>
	</div>
	
	<div class="team-back">
	<span>
	Entre em contato se precisar de ajuda ou tiver alguma dúvida sobre o Site. <br><br>
    
    Email:
	</span>
	</div>
	
	</div>
	</div>
	<!--team-6-->
	

	</div>
<style>
	.our-team-main
{
	width:100%;
	height:auto;
	border-bottom:5px #323233 solid;
	background:#fff;
	text-align:center;
	border-radius:10px;
	overflow:hidden;
	position:relative;
	transition:0.5s;
	margin-bottom:28px;
}


.our-team-main img
{
	border-radius:50%;
	margin-bottom:20px;
	width: 90px;
}

.our-team-main h3
{
	font-size:20px;
	font-weight:700;
}

.our-team-main p
{
	margin-bottom:0;
}

.team-back
{
	width:100%;
	height:auto;
	position:absolute;
	top:0;
	left:0;
	padding:5px 15px 0 15px;
	text-align:left;
	background:#fff;
	
}

.team-front
{
	width:100%;
	height:auto;
	position:relative;
	z-index:10;
	background:#fff;
	padding:15px;
	bottom:0px;
	transition: all 0.5s ease;
}

.our-team-main:hover .team-front
{
	bottom:-200px;
	transition: all 0.5s ease;
}

.our-team-main:hover
{
	border-color:#777;
	transition:0.5s;
}
</style>
    
@endsection