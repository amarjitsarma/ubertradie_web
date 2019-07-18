@extends('Main.layouts.app')
@section("Top")
<script>
// stores the device context of the canvas we use to draw the outlines
// initialized in myInit, used in myHover and myLeave
var hdc;
// shorthand func
function byId(e){return document.getElementById(e);}
// takes a string that contains coords eg - "227,307,261,309, 339,354, 328,371, 240,331"
// draws a line from each co-ord pair to the next - assumes starting point needs to be repeated as ending point.
function drawRect(coOrdStr)
{
    var mCoords = coOrdStr.split(',');
    var top, left, bot, right;
    left = mCoords[0];
    top = mCoords[1];
    right = mCoords[2];
    bot = mCoords[3];
    hdc.strokeRect(left,top,right-left,bot-top); 
}
function myHover(element)
{
    var hoveredElement = element;
    var coordStr = element.getAttribute('coords');
    var areaType = element.getAttribute('shape');
	drawRect(coordStr);
}
function myLeave()
{
    var canvas = byId('myCanvas');
    hdc.clearRect(0, 0, canvas.width, canvas.height);
}
function myInit()
{
    // get the target image
    var img = byId('img-imgmap201293016112');
    var x,y, w,h;
    // get it's position and width+height
    x = img.offsetLeft;
    y = img.offsetTop;
    w = img.clientWidth;
    h = img.clientHeight;
    // move the canvas, so it's contained by the same parent as the image
    var imgParent = img.parentNode;
    var can = byId('myCanvas');
    imgParent.appendChild(can);
    // place the canvas in front of the image
    can.style.zIndex = 1;
    // position it over the image
    can.style.left = x+'px';
    can.style.top = y+'px';
    // make same size as the image
    can.setAttribute('width', w+'px');
    can.setAttribute('height', h+'px');
    // get it's context
    hdc = can.getContext('2d');
    // set the 'default' values for the colour/width of fill/stroke operations
    hdc.fillStyle = 'red';
    hdc.strokeStyle = 'red';
    hdc.lineWidth = 2;
}
</script>
@endsection
@section("content")
<div id="main" class="columns clearfix">
        <main id="content-column" class="content-column" role="main">
            <!-- !Breadcrumbs -->
            <div class="bread_crumbs">
                <div class='wrapper'><a href="/">About</a>Rangia</div>
            </div>
            <div class="content-inner wrapper">
                <!-- !Messages and Help -->
                <div class="full_width_secction">
					<img src="/img/Rangia.jpg" usemap="#planetmap" id="img-imgmap201293016112" style="width:1000px;height:665px;">
					<map name="planetmap" id='imgmap201293016112' style="border:#f00 1px solid">
					@foreach($Stations as $Station)
					<area shape="rect" coords="{{$Station->XAxis*$size[0]}},{{$Station->YAxis*$size[1]}},{{$Station->XAxis*$size[0]+30*$size[0]}},{{$Station->YAxis*$size[1]+30*$size[1]}}" alt="{{$Station->Name}}" onclick="window.location = '/StationDetail?Code={{$Station->Code}}';" title="{{$Station->Name}}">
					@endforeach
					</map>
					<h3>Rangiya railway division is one of the five railway divisions under Northeast Frontier Railway zone of Indian Railways. This railway division was formed on 1 April 2003 from Alipurduar railway division and its headquarter is located at Rangiya in the state of Assam of India.</h3>

					<h3>Katihar railway division, Lumding railway division, Tinsukia railway division and Alipurduar railway division are the other four railway divisions under NFR Zone headquartered at Maligaon, Guwahati.</h3>
					<div class="log-main">
						<h2>Station List:</h2>
						@foreach($Stations as $Station)
    					<div class="user" onclick="window.location = '/StationDetail?Code={{$Station->Code}}';" style="cursor: pointer;">
       						<strong>{{$Station->Name}}({{$Station->Code}})</strong> 
        					<span>{{$Station->State}}</span>
    					</div>
    					@endforeach
					</div>
				</div>
			</div>
		</main>
	</div>
@endsection
@section('Bottom')
<script>
	$(document.body).attr('onload',myInit());
</script>
@endsection