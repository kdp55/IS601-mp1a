
<?php
/**
 * Created by PhpStorm.
 * User: kaksha96
 * Date: 10/6/18
 * Time: 12:14 AM
 */


main:: start("democsv.csv");
class main
{
    static public function start($filename)
    {
        $records = csv::getRecords($filename);
        $table = html::createTable($records);
        system:: Printpage($table);
    }

}
