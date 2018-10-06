
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

class csv
{
    static public function getRecords($filename)
    {
        $file = fopen($filename,"r");
        $fields = array();
        $count = 0;

        while(! feof($file))
        {
            $record = fgetcsv($file);
            if ($count == 0) {
                $fields = $record;
            }
            else
            {
                $records[] = RecordFactory::create($fields, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;


    }
}