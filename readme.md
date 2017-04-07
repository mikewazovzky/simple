### Package: mikewazovzky/simple

### Simple hand-made MVC library

### Description
set of classes implementing MVC pattern, includes 
- Model, 
- View, 
- Controller,
- Exceptions
- set of service classes and tools  

#### Version: 1.38

#### Documentation: see PHPDoc within a code

#### Installation

```composer require mikewazovzky/simple```

#### Testing

- copy from /vendor/mikewazovzky/simple/Mikewazovzky to project root  
/News  
.htaccess  
composer.json
environment.example  
index.php
- update autoload  
```composer dump-autoload```
- setup test database (table authors: id, name; table news: id, title, body)
- rename 'environment.example' file to 'environment.php'
- configure database and mail in 'environment.php'
- start application


