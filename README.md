Intro
=====

Just another PHP class to cope with MySQL via PDO.

### Installation

Use composer:

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
composer require qrzysio/mysql-pdo-class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

### Usage

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
require 'vendor/autoload.php';

$db = new Db();

$db->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
$db->bind(':fname', 'John');
$db->bind(':lname', 'Smith');
$db->bind(':age', '24');
$db->bind(':gender', 'male');
$db->exec();

echo $db->lastId();

*** Transactions ***

$db->beginTrans();

$db->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
$db->bind(':fname', 'Jenny');
$db->bind(':lname', 'Smith');
$db->bind(':age', '23');
$db->bind(':gender', 'female');
$db->exec();


$db->bind(':fname', 'Jilly');
$db->bind(':lname', 'Smith');
$db->bind(':age', '25');
$db->bind(':gender', 'female');
$db->exec();

echo $db->lastId();

$db->endTrans();

*** Select a single row ***

$db->query('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');
$db->bind(':fname', 'Jenny');
$row = $db->single();

*** Select multiple rows ***

$db->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');
$db->bind(':lname', 'Smith');
$rows = $db->fetch();

echo $db->numrows();
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

### Try { } catch { } usage

It's very convenient to use `try` and `catch` blocks.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
try {
  $db->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
  $db->bind(':fname', 'Jenny');
  $db->bind(':lname', 'Smith');
  $db->bind(':age', '23');
  $db->bind(':gender', 'female');
  $db->exec();
} catch (PDOException $e) {
  echo '<p>Something went wrong!</p>';
  echo '<p><strong>Details:</strong></p>';
  echo '<p>'.$e->getMessage().'</p>';  
}
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Or more useful method.

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
try {

  // doing some operations
  ValidateFirst();

  // adding to database
  try {
    $db->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
    $db->bind(':fname', 'Jenny');
    $db->bind(':lname', 'Smith');
    $db->bind(':age', '23');
    $db->bind(':gender', 'female');
    $db->exec();    
  } catch (PDOException $e) {
    throw new Exception('We have an issue with this code!');    
  }

  // additional operations
  DoSomehing();

} catch (Exception $e) {
  echo '<p>Something went wrong!</p>';
  echo '<p><strong>Details:</strong></p>';
  echo '<p>'.$e->getMessage().'</p>';  
}
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

### All methods

`exec()` - execute SQL query

`fetch()` - fetch all rows and returns an array

`single()` - fetch only one row as an array

`numrows()` - returns number of rows affected or counted

`lastId()` - last inserted ID

`cancel()` - rollback the operation

`debug()` - returns `debugDumpParams()` method from PDO

`beginTrans()` - begins a transaction

`endTrans()` - ends a transaction
 

### License

This script was made by a bloger and published here:
http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/

There is no info about license, so I believe it's MIT. I did some small changes
in the code and perhaps will do more in the future. According to the former
author, license of this script is MIT.
