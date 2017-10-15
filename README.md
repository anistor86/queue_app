# Queue App

Simple app to manage the queue system at councils' receptions

## Getting Started

These instructions will get you a copy of the project up and running on your local machine. See Installation notes how to install the project on a live system.

### Prerequisites

What things you need

```
- Apache
- PHP >= 5.0
- MySQL DB
```

### Installing

Follow the instructions to set up the app

Step 1:
```
Download the app on your computer and upload it to your server.
Or setup a local server on your computer
```

Step 2:
```
Open your MySQL database (or create one), and import the file 'queue_app.sql' to create the table
needed by the app to run.
```

Step 3:
```
Open the file 'mysql.inc.php' and change the database settings with your settings
(Just replace 'your_server_name', 'your_database_name', 'your_username_here', 'your_password_here')
```

Step 4:
```
Once server, database, and 'mysql.inc.php' file are setup, head to your 'queue app'
root folder and if everything was setup correctly, the app will run automatically.
```

![Alt text](http://lucastorani.it/form_submit/screenshot.jpg "Queue app Screenshot")

You can see an up and running version [here](http://lucastorani.it/form_submit/)


## Built With

* [Bootstrap](http://getbootstrap.com/) - CSS framework
* [jQuery](https://jquery.com/) - Javascript Library
* [JSON](www.json.org/) - Data-interchange format
* [PHP](www.php.net/) - Server scripting language
* [MySQL](www.mysql.org/) - SQL Database

## Authors

* **Luca Storani** - *Web Developer* - [Queue_app](https://github.com/anistor86/queue_app)

## Misc

* I choose to develop this app without just using HTML/CSS, PHP and Javascript,
and MySQL as database to save any data.

* It's specific for the customer request, and simple enough to avoid the use of a CMS,
or any other platform.

* For further information send me an email lucastorani@gmail.com
