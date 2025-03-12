//// run composer install command
  composer install
//// run migration command 
  php artisan migrate

//// add key in env

JOB_API_ID=your_api_id
JOB_API_KEY=your_api_key
JOB_API_URL=https://api.adzuna.com/v1/api/jobs/us/search/1

///run this command 
php artisan jwt:secret

JWT_SECRET=
