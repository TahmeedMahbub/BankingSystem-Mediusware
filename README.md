<h1>Installation:</h1>
The project should be clonned first. <br/>
> git clone -b dev.0.0.1 https://github.com/TahmeedMahbub/BankingSystem-Mediusware  <br/> <br/>

Go to project directory.
> ## cd BankingSystem-Mediusware

create .env file and set a relevent database name

Install the dependencies.
> composer install
> ## composer dump-autoload
> ## php artisan key:generate

Migrate the database.
> ## php artisan migrate
You may need to write "yes" to create database

Now you're ready to play!
> ## php artisan serve


<h1>Usage:</h1>
Go to the base URL 127.0.0.1:<port> <br/>
Create a user. <br/>
After creating automatically shifted to home page. <br/>
Choose "Deposit" to deposit some money. <br/>
Then choose "Withdraw" if you want to withdraw money. <br/>
