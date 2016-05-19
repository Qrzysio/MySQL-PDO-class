# Intro

Just another php class to coper with MySQL via PDO.

### Version
1.0

### Installation

Use composer:
```
composer require 
```

### Usage

```
$database = new Database();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
$database->bind(':fname', 'John');
$database->bind(':lname', 'Smith');
$database->bind(':age', '24');
$database->bind(':gender', 'male');
$database->execute();


echo $database->lastInsertId();


*** Transactions ***

$database->beginTransaction();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
$database->bind(':fname', 'Jenny');
$database->bind(':lname', 'Smith');
$database->bind(':age', '23');
$database->bind(':gender', 'female');
$database->execute();


$database->bind(':fname', 'Jilly');
$database->bind(':lname', 'Smith');
$database->bind(':age', '25');
$database->bind(':gender', 'female');
$database->execute();

echo $database->lastInsertId();

$database->endTransaction();

*** Select a single row ***

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');
$database->bind(':fname', 'Jenny');
$row = $database->single();


*** Select multiple rows ***

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');
$database->bind(':lname', 'Smith');
$rows = $database->resultset();


echo $database->rowCount();
```

### GIT commands

```
git tag -a 1.2 -m "1.2"
git commit -a -m "2016.05.05"

git push origin master
git push origin --tags
```

### License
This script was made by a bloger and published here:
http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/

There is no info about license, so I believe it's MIT. I did some small changes in the code and perhaps will do more in the future. According to the former author, license of this script is MIT.