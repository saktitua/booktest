<html>
    <meta name="viewport" content="initial-scale=1%">
    <style>
        .header-header{
            text-align: center;
            font-size: 1.1em;
            font-weight: bold;
            color:cornflowerblue;
            margin-top:70px;
        }
        .content-barcode{
            position: absolute;
            left: 160px;
            top: 300px;
            bottom: 0px;
            right: 0px;
            border-radius: 110px;
        }
        .center {
            position: absolute;
            left: 25px;
            top: 100px;
            z-index: -1;
        }
    </style>
    <body>
     <div class="center">
        <img src="{{asset('logo/background-barcode.png')}}" height="774.80314961px" width="566.92913386px" alt="">
        
    </div>
    <div class="content-barcode">
        @if($pengguna->generate !== null)
        {!! QrCode::size(300)->generate(env('BARCODE_URL').$pengguna->generate) !!}
        @else 
            {{"Tidak ada barcode"}}
        @endif
    </div>
    <script src="/client/client.js"></script>
    <script>
        window.print()
    </script>
    </body>
</html>

