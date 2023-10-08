<html>
    <meta content="">
    <head>
        @include('nasabah.css')  
    </head>
    
    <body>
        @include('nasabah.header-mobile')
        <div class="header header_text">
            <span style="color:#FF8E05">Selamat Datang di </span><br>
            <span style="color:#005264">BANK ARTHA GRAHA International</span><br>
            <span style="color:#005264">
                <svg width="26" height="26" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        <div class="question">
            <input type="hidden" name="code" value={{$pengguna->generate}}>
            <div class="question-text">
                1. Nama Anda ?
                <input type="text" placeholder="Masukkan nama anda" class="form-control" name="nama" id="nama" required>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                2. Bagaimana penampilan petugas yang melayani ?
                <input type="hidden" name="ques1" class="ques1">
            </div>
            <div class="pagination">
                <a href="#" class="click_active1" value="1">1</a>
                <a href="#" class="click_active1" value="2">2</a>
                <a href="#" class="click_active1" value="3">3</a>
                <a href="#" class="click_active1" value="4">4</a>
                <a href="#" class="click_active1" value="5">5</a>
                <a href="#" class="click_active1" value="6">6</a>
                <a href="#" class="click_active1" value="7">7</a>
                <a href="#" class="click_active1" value="8">8</a>
                <a href="#" class="click_active1" value="9">9</a>
                <a href="#" class="click_active1" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                3. Bagaimana kecepatan petugas yang melayani ?
                <input type="hidden" name="ques2" class="ques2">
            </div>
            <div class="pagination">
                <a href="#" class="click_active2" value="1">1</a>
                <a href="#" class="click_active2" value="2">2</a>
                <a href="#" class="click_active2" value="3">3</a>
                <a href="#" class="click_active2" value="4">4</a>
                <a href="#" class="click_active2" value="5">5</a>
                <a href="#" class="click_active2" value="6">6</a>
                <a href="#" class="click_active2" value="7">7</a>
                <a href="#" class="click_active2" value="8">8</a>
                <a href="#" class="click_active2" value="9">9</a>
                <a href="#" class="click_active2" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                4. Bagaimana kepuasan nasabah terhadap pelayanan kami ?
                <input type="hidden" name="ques3" class="ques3">
            </div>
            <div class="pagination">
                <a href="#" class="click_active3" value="1">1</a>
                <a href="#" class="click_active3" value="2">2</a>
                <a href="#" class="click_active3" value="3">3</a>
                <a href="#" class="click_active3" value="4">4</a>
                <a href="#" class="click_active3" value="5">5</a>
                <a href="#" class="click_active3" value="6">6</a>
                <a href="#" class="click_active3" value="7">7</a>
                <a href="#" class="click_active3" value="8">8</a>
                <a href="#" class="click_active3" value="9">9</a>
                <a href="#" class="click_active3" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                5. Bagaimana kualitas penyambutan oleh security cabang kami ?
                <input type="hidden" name="ques4" class="ques4">
            </div>
            <div class="pagination">
                <a href="#" class="click_active4" value="1">1</a>
                <a href="#" class="click_active4" value="2">2</a>
                <a href="#" class="click_active4" value="3">3</a>
                <a href="#" class="click_active4" value="4">4</a>
                <a href="#" class="click_active4" value="5">5</a>
                <a href="#" class="click_active4" value="6">6</a>
                <a href="#" class="click_active4" value="7">7</a>
                <a href="#" class="click_active4" value="8">8</a>
                <a href="#" class="click_active4" value="9">9</a>
                <a href="#" class="click_active4" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                6. Bagaimana keramahan petugas yang melayani ?
                <input type="hidden" name="ques5" class="ques5">
            </div>
            <div class="pagination">
                <a href="#" class="click_active5" value="1">1</a>
                <a href="#" class="click_active5" value="2">2</a>
                <a href="#" class="click_active5" value="3">3</a>
                <a href="#" class="click_active5" value="4">4</a>
                <a href="#" class="click_active5" value="5">5</a>
                <a href="#" class="click_active5" value="6">6</a>
                <a href="#" class="click_active5" value="7">7</a>
                <a href="#" class="click_active5" value="8">8</a>
                <a href="#" class="click_active5" value="9">9</a>
                <a href="#" class="click_active5" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                7. Bagaimana pengetahuan petugas yang melayani ?
                <input type="hidden" name="ques6" class="ques6">
            </div>
            <div class="pagination">
                <a href="#" class="click_active6" value="1">1</a>
                <a href="#" class="click_active6" value="2">2</a>
                <a href="#" class="click_active6" value="3">3</a>
                <a href="#" class="click_active6" value="4">4</a>
                <a href="#" class="click_active6" value="5">5</a>
                <a href="#" class="click_active6" value="6">6</a>
                <a href="#" class="click_active6" value="7">7</a>
                <a href="#" class="click_active6" value="8">8</a>
                <a href="#" class="click_active6" value="9">9</a>
                <a href="#" class="click_active6" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                8. Bagaimana ruang banking hall ?
                <input type="hidden" name="ques7" class="ques7">
            </div>
            <div class="pagination">
                <a href="#" class="click_active7" value="1">1</a>
                <a href="#" class="click_active7" value="2">2</a>
                <a href="#" class="click_active7" value="3">3</a>
                <a href="#" class="click_active7" value="4">4</a>
                <a href="#" class="click_active7" value="5">5</a>
                <a href="#" class="click_active7" value="6">6</a>
                <a href="#" class="click_active7" value="7">7</a>
                <a href="#" class="click_active7" value="8">8</a>
                <a href="#" class="click_active7" value="9">9</a>
                <a href="#" class="click_active7" value="10">10</a>
            </div>
        </div>
        <div class="question">
            <div class="question-text">
                9. Kritik dan Saran
                <textarea placeholder="Masukkan kritik dan saran  anda" class="form-control" style="height:200px" name="reason" id="reason" required></textarea>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/client/client.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function(){
                $(document).on('click','.click_active1',function(){
                    $('.click_active1').removeClass('active')
                    $(this).addClass('active');
                    $('.ques1').val($(this).attr('value'));
                });
                $(document).on('click','.click_active2',function(){
                    $('.click_active2').removeClass('active')
                    $(this).addClass('active');
                    $('.ques2').val($(this).attr('value'));
                });
                $(document).on('click','.click_active3',function(){
                    $('.click_active3').removeClass('active')
                    $(this).addClass('active');
                    $('.ques3').val($(this).attr('value'));
                });
                $(document).on('click','.click_active4',function(){
                    $('.click_active4').removeClass('active')
                    $(this).addClass('active');
                    $('.ques4').val($(this).attr('value'));
                });
                $(document).on('click','.click_active5',function(){
                    $('.click_active5').removeClass('active')
                    $(this).addClass('active');
                    $('.ques5').val($(this).attr('value'));
                });
                $(document).on('click','.click_active6',function(){
                    $('.click_active6').removeClass('active')
                    $(this).addClass('active');
                    $('.ques6').val($(this).attr('value'));
                });
                $(document).on('click','.click_active7',function(){
                    $('.click_active7').removeClass('active')
                    $(this).addClass('active');
                    $('.ques7').val($(this).attr('value'));
                });
            });
        </script>
    </body>
</html>