
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A simple jQuery image cropping plugin.">
  <meta name="keywords" content="HTML, CSS, JS, JavaScript, jQuery plugin, image cropping, front-end, frontend, web development">
  <meta name="author" content="Fengyuan Chen">
  <title>Cropper</title>
  <link href="/Cropper/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Cropper/css/cropper.min.css" rel="stylesheet">
  <link href="/Cropper/css/main.css" rel="stylesheet">
  <link href="/Cropper/css/style.css" rel="stylesheet">

  
</head>
<body>

<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			
				<div class="main-crl">
				  
				</div>
			
			</div>
		</div>
	</div>

</header>

   <!-- Overview -->
  <div class="container docs-overview">
    <div class="row">
      <div class="col-md-9">
        <div class="img-container"><img src="/img/{{$Image}}"></div>

      </div>
        <div class="col-md-3">
			<div class="button-group showing">
				<button class="btn btn-warning" id="reset" data-method="reset" data-toggle="tooltip" type="button" title="$().cropper(&quot;reset&quot;)">Reset</button>
				
				<button class="btn btn-info" id="freeRatio" data-method="setAspectRatio" data-option="auto" data-toggle="tooltip" type="button" title="$().cropper(&quot;setAspectRatio&quot;, &quot;auto&quot;)">Free Ratio</button>
			   
			</div>
			<h3>Preview:</h3>
			<div class="row">
			  <div class="col-md-8">
				<div class="img-preview img-preview-sm"></div>
			  </div>
			  <div class="col-md-4">
				<div class="img-preview img-preview-xs"></div>
			  </div>
			</div>
			<hr>
			<h3>Data:</h3>
			<div class="docs-data">

			  <div class="input-group">
				<label class="input-group-addon" for="dataX">Station:</label>
				<input class="form-control" id="Station" type="text" placeholder="Station" list="Stations">
				<datalist id="Stations">
					@foreach($Stations as $row)
					<option value="{{$row->Code}}"></option>
					@endforeach
				</datalist>
			  </div>

			  <div class="input-group">
				<label class="input-group-addon" for="dataX">X</label>
				<input class="form-control" id="dataX" type="text" placeholder="x">
				<span class="input-group-addon">px</span>
			  </div>
			  <div class="input-group">
				<label class="input-group-addon" for="dataY">Y</label>
				<input class="form-control" id="dataY" type="text" placeholder="y">
				<span class="input-group-addon">px</span>
			  </div>
			  <div class="input-group">
				<label class="input-group-addon" for="dataWidth">Width</label>
				<input class="form-control" id="dataWidth" type="text" placeholder="width">
				<span class="input-group-addon">px</span>
			  </div>
			  <div class="input-group">
				<label class="input-group-addon" for="dataHeight">Height</label>
				<input class="form-control" id="dataHeight" type="text" placeholder="height">
				<span class="input-group-addon">px</span>
			  </div>
			  <!-- <div class="input-group">
				<label class="input-group-addon" for="dataRotate">Rotate</label>
				<input class="form-control" id="dataRotate" type="text" placeholder="rotate">
				<span class="input-group-addon">deg</span>
			  </div> -->
			  <div class="button-group">
					<button class="btn btn-info" onclick="Save();">Save</button>
			  </div>
		</div>
		</div>
		<div class="clearfix"></div><br>
		<div class="col-md-12 tabs">
		
			<table>
				<thead>
					<tr>
						<th>Station Name</th>
						<th>Station Code</th>
						<th>X-Axis</th>
						<th>Y-Axis</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($Stations as $row)
					<tr>
						<td>{{$row->Name}}</td>
						<td>{{$row->Code}}</td>
						<td>{{$row->XAxis}}</td>
						<td>{{$row->YAxis}}</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		   
		 	
		  
		 
		</div>
        
      </div>
    </div>
   
  </div>

  <script src="/Cropper/js/jquery-1.12.4.min.js"></script>
  <script src="/Cropper/js/bootstrap.min.js"></script>
  <script src="/Cropper/js/run_prettify.js"></script>
  <script src="/Cropper/js/common.js"></script>
  <script src="/Cropper/js/cropper.min.js"></script>
  <script src="/Cropper/js/main.js"></script>
  <script>
  function Save()
  {
	var url="/Division/SaveStationMark";
	var Station=document.getElementById("Station").value;
	var dataX=document.getElementById("dataX").value;
    var dataY=document.getElementById("dataY").value;
	var data={"Station":Station,"XAxis":dataX,"YAxis":dataY};
	$.ajax({
		url: url,
		type:'get',
		data: data,
		success:function()
		{
			alert("Saved");
			 location.reload();
		},
		error: function()
		{
			alert('failed');
		}
	});
  }
  </script>
</body>
</html>
