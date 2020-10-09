# gatheringPrize #

#### How to Install : ####
* Download XAMPP dengan PHP versi 7.3.10
* Clone git repository
* Install composer
* composer install project 'gatheringPrize'
* command 'mv .env.example .env'
* buat database nama terserah. contoh 'gathering'
* command 'php artisan key:generate'
* configure .env 
    * DB_DATABASE=gathering ( nama database )
    * DB_USERNAME= root
    * DB_PASSWORD= (kosongi jika tidak ada)
* command 'php artisan migrate **path=/database/migrations/2019_10_11_132236_create_prizes_table.php'
* command 'php artisan migrate'
* command 'php artisan db:seed **class=UsersTableSeeder'
* login email: admin@admin.com, password: superadmin
* Enjoy