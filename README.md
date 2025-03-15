- Laravel framework 8.x  -- 
--- 

- Install Laravel Project some command 

        => composer global require laravel/installer
        => composer install
        =>  composer dump-autoload
        => mv .env.example .env  
        => php artisan cache:clear 
        =>  composer dump-autoload
        =>  php artisan key:generate
        =>   php artisan config:cache
        => php artisan migrate

-- Some Basic Command 

- command list 

        => php artisan list
 - Run
    
        => php artisan serve

- Clear Application Cache

        => php artisan cache:clear
        => php artisan route:clear
        => php artisan config:clear
        => php artisan view:clear

- Database

        => php artisan migrate
        => php artisan migrate:rollback
        => php artisan migrate:refresh   
          Be carefull about refresh

        => php artisan make:migration migration_name
        
        => php artisan make:migration add_columns_to_customers_table
        
- Controllers and Models

        => php artisan make:controller ControllerName

        => php artisan make:model ModelName
        
        =>php artisan make:model ModelName -m
     

- 


- Steps for run Laravel application downloading from github

        > git clone github repository
        > change directory to the folder
        > composer install or composer update
        > change file name .env.example to .env
        > Set up .env file
        > php artisan key:generate
        > php artisan storage:link
        > php artisan migrate
        > php artisan serve 

        tutorial: https://www.youtube.com/watch?v=9qaiY3ycpwY
     

- 

- Role back one step 

        =>  php artisan migrate:rollback --step=1

 
