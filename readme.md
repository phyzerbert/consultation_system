## Installation Instructions

- Run git clone https://github.com/phyzerbert/consultation_system.git
- Create a MySQL database for the project
    - mysql -u root -p
    - create database consult;
    - \q
- Copy .env.example to .env
- Configure your .env file
    - APP_NAME=ConsultantSystem
    - DB_DATABASE=consult
    - DB_USERNAME=root
    - DB_PASSWORD=null
- Run 'composer update' from the projects root folder.
- From the projects root folder run 'php artisan key:generate'
- From the projects root folder run 'php artisan migrate'
- From the projects root folder run 'php artisan db:seed'
- Run 'php artisan serve'
- Start server at http://localhost:8000
