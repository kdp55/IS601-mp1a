
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

class record
{
    public function __construct(Array $fields = null, Array $values = null)
    {

        $record = array_combine($fields,$values);

        foreach ($record as $property => $value)
        {
            $this->createProperty($property, $value);
        }

    }

    public function ReturnArray()
    {
        $array = (array)$this;
        return $array;
    }

    public function createProperty($property,$value)
    {
        $this->{$property} = $value;
        $property = '<th>' .$property.'</th>' ;
        $value = '<td>' .$value.'</td>';
    }

}
class RecordFactory
{
    public static function create(Array $fields = null,Array $values = null)
    {
        $record = new record($fields,$values);

        return $record;
    }

}

//class utilities{
//  public static function csvxyz($array)
//{
//  foreach
//}
//}

class html
{
    public static function createTable($array)
    {
        /**
         * @param $array
         * @return string
         */
        echo "<html lang=\"en\">
<head>
  <title>Bootstrap Example</title>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
</head>
</html>";
        //table row
        $html = '<table class="table table-striped">';
        // header row
        $html .= '<tr>';
        foreach($array[0] as $key=>$value){
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        // data rows
        foreach( $array as $key=>$value){
            $html .= '<tr>';
            foreach($value as $key2=>$value2){
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }

        // finish table and return it

        $html .= '</table>';
        return $html;



    }


}

class system{
    static public function Printpage($page)
    {
        echo $page;
    }

}
