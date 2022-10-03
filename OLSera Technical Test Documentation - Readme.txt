1. Create DB with the name is olsera
2. I have been create Tax Seeder, if you want to use it, you can call by this query in terminal :
php artisan db:seed --class=TaxTableSeeder
3. Link api Tax to call by postman :
POST : http://localhost:8000/api/taxes/store
UPDATE : http://localhost:8000/api/taxes/update
DELETE : http://localhost:8000/api/taxes/1
GET : http://localhost:8000/api/taxes
GET (id) : http://localhost:8000/api/taxes/1
4. Link api Item to call by postman :
GET : http://localhost:8000/api/items
POST : http://localhost:8000/api/items/store
UPDATE : http://localhost:8000/api/items/update
DELETE : http://localhost:8000/api/items/1
