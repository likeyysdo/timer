<?php
/**
* 
*/


   class MyDB 
   {
      protected static $_instance = null;
      private static $stmt = "";
      private static $db ;
      protected function __construct()
      {
         static::$db = new SQLite3('test.db');
         
         //$db->open('test.db');
      }
      protected function __clone(){

      }
      public function getInstance(){
         if (static::$_instance === null) {
            static::$_instance = new static;
         }
         return static::$_instance;
      }
      public function getTotalCount(){
         static::$stmt = static::$db->prepare('select Count from TotalCount where Num = 1;');
         $stmtResult = static::$stmt->execute();
         while($arr=$stmtResult->fetchArray())
         {
            if ($result = $arr['Count']) {
               
               return $result;
            }
          
         }
         //return $result->fetchArray();
      }
      public function setTotalCount($count){
         static::$stmt = static::$db->prepare('update TotalCount set Count = ? where Num = 1;');
         static::$stmt->bindValue(1,$count,SQLITE3_FLOAT);
         $stmtResult = static::$stmt->execute();
            if(!$stmtResult){
            echo static::$db->lastErrorMsg();
            } else {
            //echo "success";
            }
      }
      public function startRecord($date){
         static::$stmt = static::$db->prepare('insert into DateRecord (date,type) values (?,1);');
         static::$stmt->bindValue(1,$date,SQLITE3_TEXT);
         $stmtResult = static::$stmt->execute();
            if(!$stmtResult){
            echo static::$db->lastErrorMsg();
            } else {
            //echo "success";
            }

      }
      public function endRecord($date){
         static::$stmt = static::$db->prepare('insert into DateRecord (date,type) values (?,0);');
         static::$stmt->bindValue(1,$date,SQLITE3_TEXT);
         $stmtResult = static::$stmt->execute();
            if(!$stmtResult){
            echo static::$db->lastErrorMsg();
            } else {
            //echo "success";
            }

      }

      public function getRecords(){
         static::$stmt = static::$db->prepare('select * from DateRecord;');
         $stmtResult = static::$stmt->execute();
            if(!$stmtResult){
            echo static::$db->lastErrorMsg();
            return 0;
            } else {
               $row = array();
            for ($i=0; $res = $stmtResult->fetchArray() ; $i++) { 
               $row[$i]['num'] = $res['Num'];
               $row[$i]['date'] = $res['Date'];
               $row[$i]['type'] = $res['Type'];
            }
            return $row;
            }

      }
      public function getLastRecord(){
         static::$stmt = static::$db->prepare('select * from DateRecord ordeR by num desc limIT 0,1;');
         $stmtResult = static::$stmt->execute();
            if(!$stmtResult){
            echo static::$db->lastErrorMsg();
            return 0;
            } else {
            $row = array();
            $res = $stmtResult->fetchArray();
               $row['num'] = $res['Num'];
               $row['date'] = $res['Date'];
               $row['type'] = $res['Type'];
            
            return $row;
            }

      }
   }
   function test(){
   $db1 = MyDB::getInstance();
   if(!$db1){
      echo $db1->lastErrorMsg();
   } else {
      echo "Opened database successfully\n <br />";
   }
   echo $db1->getTotalCount(),123;
   //$db1->setTotalCount(1273.44444);
   echo $db1->getTotalCount();
   //$db1->startRecord("asda123sd");
   print_r($db1->getLastRecord());
   
   }
// test();


