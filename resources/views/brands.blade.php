<!DOCTYPE html>
<html>

    <head>
        <title>Sales</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href='http://fonts.googleapis.com/css?family=Exo+2:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.js"></script>

                <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>

    <body>
        
        <div class="warrper">


                @include('nav')

            <div class="headingSection paper"> 
                <h1>Brands</h1>
                <h2>Wellcome to the brands page</h2>
            </div>

            <div class="sales paper">

                <div class="row">

                    @for ($i=0; $i<count($newBrands); $i++)
                        <div class="col-xs-6 col-md-3">
                            <a href="/allBrands/{{$name[$i]}}" class="thumbnail" data-name="{{$name[$i]}}">
                                <div class="saleBrande" style="background-image: url({{$newBrands[$i] }});">
                                </div>
                            </a>
                        </div>
                    @endfor






              </div>
            
            </div>
        
        <footer>&copy; Sellnco <?php echo date("Y"); ?></footer>
        
    </body>

</html>
