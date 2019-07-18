<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="/Main/sites/upload_files/npi/files/favicon_0.ico" type="image/vnd.microsoft.icon" />
    <title>North East Frontier Railway</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="title" content="National Portal of India" />
    <meta name="lang" content="en" />
    <meta name="MobileOptimized" content="width" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--main style css-->
    <link rel="stylesheet" href="/Main/css/mainstyle.css">
    <link rel="stylesheet" href="/Main/font-style.css">
    <!--main style css ends-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/Main/css/global.custom.responsive69ff.css">
    <link rel="stylesheet" href="/Main/sites/all/themes/adaptivetheme/npi_adaptive/css/global.base69ff.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="/Main/js/jquery.mina532.js"></script>
    <script src="/Main/js/jquery.once7839.js"></script>
    <script src="/Main/js/drupal69ff.js"></script>
    <script src="/Main/js/views_slideshowc619.js"></script>
    <script src="/Main/js/ajaxa86a.js"></script>
    <script src="/Main/js/script69ff.js"></script>
    <script src="/Main/js/progress69ff.js"></script>
    <script>
        var base_url ="/"; var themePath = ""; var modulePath = "";
    </script>
    <script src="/Main/js/ajax_view69ff.js"></script>
    <script src="/Main/js/jquery.flexslider-min69ff.js"></script>
    <script src="/Main/js/flexslider_views_slideshow69ff.js"></script>
    <script src="/Main/js/jquery.min69ff.js"></script>
    <script src="/Main/js/custom69ff.js"></script>
    <script src="/Main/js/mainslider.js">
        <script type="text/javascript">  
                    if(_getCookie("fontSize") != null){
                        fontSize = _getCookie("fontSize");
                    }else{
                        fontSize = 100;
                    }
                    var base_url ="/";
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	@yield('Top')
</head>

<body class="html front not-logged-in no-sidebars page-home home i18n-en site-name-hidden atr-7.x-3.x atv-7.x-3.2 page-panels">
    <!-- !Leaderboard Region -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    @include('Main.inc.navbar')
    @yield('content')

    <!-- /end #columns -->
    <!-- !Tertiary Content Region -->
    <!-- !Footer -->
    @include('Main.inc.footer')
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#dataTable').DataTable();
          } );
    </script>
	@yield('Bottom')
</body>
</html>