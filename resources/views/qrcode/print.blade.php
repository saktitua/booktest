<html>
    <meta name="viewport" content="initial-scale=1%">
    <style>
        .header-header{
            margin: auto;
            font-size: 1.1em;
            font-weight: bold;
            color:cornflowerblue;
            margin-top:70px;
        }
        .content-barcode{
            margin-top:40px;
        }
        .center {
            margin: auto;
            width: 50%;
            padding: 0px;
        }
    </style>
    <body>
     <div class="center">
        <div class="header-header">
            {{$pengguna->name}} - {{$pengguna->role}}  - {{$cabang->nama_cabang}}
        </div>
        <div class="content-barcode">
            @if($pengguna->generate !== null)
            {!! QrCode::size(350)->generate(env('BARCODE_URL').$pengguna->generate) !!}
            @else 
                {{"Tidak ada barcode"}}
            @endif
        </div>
    </div>
    <script src="/client/client.js"></script>
    <script>
        window.print()
    </script>
    </body>
</html>

