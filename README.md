packages qrcode :
https://techvblogs.com/blog/generate-qr-code-laravel-8


#running ketika sudah di dev server
    php artisan migrate:fresh --seed    (Untuk Migrate Database dan record data default seperti user default, role default, akses role default)
    php artisan config:cache
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear

#ganti atau tambah di env BARCODE_URL. contoh : BARCODE_URL=Http://microsite.com/

#login 
    Superadmin 
        Username : superadmin@microsite.com
        password : microsite123
    Admin
        Username : admin@microsite.com
        password : microsite123
    Customer Service
        Username : customer@microsite.com
        password : microsite123