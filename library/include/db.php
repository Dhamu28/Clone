<?php
ini_set('display_errors', 1);
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
error_reporting(E_ALL);

class db
{
    public $file;
    public $res;
    public $query;
    public $statement;

     public function __construct($file) {
        // exit('sss here');
        $this->file = $file;

        if (!file_exists($this->file)) {
            // Attempt to create the database file
            $created = touch($this->file);
             if (!$created) {
                $errorMessage = 'DB connect error. Unable to create database file.';
                $errorMessage .= 'Run the following commands to create the file and set permissions: ' . PHP_EOL;
                $errorMessage .= '<pre>touch ' . $this->file.' && chmod 660 ' . $this->file.' && chown www-data:www-data '.$this->file.'</pre>';
                $errorMessage.='<pre>chown www-data:www-data "folderin which db is"</pre>';
                throw new Exception($errorMessage);
            }
        }

         $this->connect();
    }


    public function connect() {
        $this->res = new SQLite3($this->file);

        if (! $this->res) {
            throw new Exception('DB connect error, check file location and permissions');
        }
    }

    public function Q($query, $params = []) {
        $this->query = $query;
        $this->statement = $this->res->prepare($query) or die($this->res->lastErrorMsg());

        if ($this->statement) {
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $this->statement->bindValue($key + 1, $value);
                }
            }

            $result = $this->statement->execute();

            $type = strtolower(explode(' ', trim($query))[0]);
            if ($type=='select') {
                $data = [];
                while ($record = $result->fetchArray()) {
                    $data[] = $record;
                }
                return $data;
            }
            elseif ($type=='insert') {
                return $this->res->lastInsertRowID();
            } else {
                return $result;    
            }
        }
        return false;
    }

}

?>