<html>
    <meta content="">
    <meta name="viewport" content="initial-scale=1%">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        @include('nasabah.css')  
    </head>
    
    <body>
        @include('nasabah.header-mobile')
        <div class="header header_text">
            <span style="color:#FF8E05">Selamat Datang di </span><br>
            <span style="color:#005264">BANK ARTHA GRAHA International</span><br>
            <span style="color:#005264">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.82 10.1733L11.1267 9.97993C10.9276 9.95654 10.7258 9.97858 10.5364 10.0444C10.347 10.1102 10.175 10.2181 10.0334 10.3599L8.80669 11.5866C6.91415 10.6241 5.37588 9.0858 4.41336 7.19326L5.64669 5.95993C5.93336 5.67326 6.07336 5.27326 6.02669 4.86659L5.83336 3.18659C5.79556 2.86138 5.63949 2.56142 5.39485 2.34382C5.15021 2.12623 4.8341 2.0062 4.50669 2.00659H3.35336C2.60003 2.00659 1.97336 2.63326 2.02003 3.38659C2.37336 9.07993 6.92669 13.6266 12.6134 13.9799C13.3667 14.0266 13.9934 13.3999 13.9934 12.6466V11.4933C14 10.8199 13.4934 10.2533 12.82 10.1733Z" fill="#005264"/>
                </svg>
                0-800-191-8880
            </span>
        </div>
        <div class="header header_text">
            <b>Service Quality Bank Artha Graha International</b>
            <p>Range :</p>
            <ul class="a">
                <li>1  : Sangat Tidak Puas</li>
                <li>10 : Sangat Puas</li>
            </ul>
        </div>
        <form method="POST" action={{route('nasabah.store')}} id="form-nasabah-submit" >
            @csrf
            <input type="hidden" name="code" value={{$pengguna->generate}}>
            <div class="question">
                <div class="question-text">
                    Nama Nasabah<br>
                    <div class="pagination">
                        <input type="text"  name="nama_nasabah">
                    </div>
                </div>
            </div>
            @foreach($question as $key => $die)
                @if($die->type == 'radio')
                <div class="question">
                    <div class="question-text">
                        {{$key + 1}}  {{$die->question}}
                        <input type="hidden" name="question[{{$die->id}}]" value="{{$die->question}}" class="quess{{$die->id}}" required>
                        <input type="hidden" name="ques[{{$die->id}}]" class="ques{{$die->id}}" required>
                        <div class="pagination">
                            <a href="javascript:;" class="click_active{{$die->id}}" value="1">1</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="2">2</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="3">3</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="4">4</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="5">5</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="6">6</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="7">7</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="8">8</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="9">9</a>
                            <a href="javascript:;" class="click_active{{$die->id}}" value="10">10</a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            <br>
            <div class="question">
                <div class="question-text">
                     Kritik Dan Saran <br>
                    <textarea placeholder="Masukkan kritik dan saran anda" style="height:130px;width:300px;" name="kritik_saran" id="kritik_saran"></textarea>
                </div>
            </div>
        </form>
        <div class="question">
            <div class="question-text">
                <button type="submit" form="form-nasabah-submit" class="button btn-submit">submit</button>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/client/client.js"></script>
        <script src="/client/sweatAlert.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
              $(function(){
                runNavigation();
                function runNavigation(){
                    $.ajax({
                        type: 'GET', 
                        url: '{{route("admin.question.getQuesionId")}}',
                        success: function (data){
                            $.each(data.question, function( key, value ){
                                $(document).on('click','.click_active'+value.id,function(){
                                    $('.click_active'+value.id).removeClass('active')
                                    $(this).addClass('active');
                                    $('.ques'+value.id).val($(this).attr('value'));
                                });
                                $(document).on('click','.btn-submit',function(e){
                                    if($('.ques'+value.id).val() == ''){
                                        e.preventDefault();
                                        var alertSuccess = $('.alert-text-success').html();
                                        Swal.fire(
                                            'Peringatan',
                                            'jawaban point wajib di isi',
                                            'danger'
                                        )
                                    }
                                });
                            }); 
                        }
                    });
                    
                }
              });
        </script>
        	@if(\Session::has('success'))
			<div class="alert-text-success">{{\Session::get('success')}}</div>
			<script>
				var alertSuccess = $('.alert-text-success').html();
                Swal.fire(
                'Terimakasih',
                'Atas Kesempatan Waktunya',
                'success'
                )
			</script>
		@endif
    </body>
</html>