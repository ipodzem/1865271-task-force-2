<?php

namespace Taskforce\datasets;

class Import
{
    const filename = '';
    const tablename = '';
    private $data;
    public $filename;
    public $tablename;

    public function getCsvColumns()
    {
        return ['name'];
    }

    public function getDbColumns()
    {
        return ['name' => 'name'];
    }

    private function convertCsvToArray()
    {
        $service = new Csvtosql($this->filename, $this->getCsvColumns());
        $service->import();
        return $service->getData();
    }

    public function sql()
    {
        $values = [];
        $add_default_values = false;
        $data = $this->convertCsvToArray();
        $db_columns = $this->getDbColumns();
        $csv_columns = $this->getCsvColumns();
        $columns = "`" . implode("`, `", array_keys($db_columns)) . "`";

        if (count($db_columns) > count($csv_columns)) {
            $add_default_values = true;
        }
        $db_columns_values = array_values($db_columns);

        foreach ($data as $k => $row) {
            if ($add_default_values) {
                for ($i = count($csv_columns); $i < count($db_columns); $i++) {
                    if ($db_columns_values[$i] == 'inc') {
                        $row[$i] = $k + 1;
                    } elseif (strpos($db_columns_values[$i], 'random') !== false) {
                        $limit = (int)str_replace('random', '', $db_columns_values[$i]);
                        $row[$i] = mt_rand(1, $limit);
                    } else {
                        $row[$i] = $db_columns_values[$i];
                    }
                }
            }
            //$values[] = "(" . implode(", ", array_map('mysqli_real_escape_string', $row)) . ")";
            if (count($row) == count($db_columns_values)) {
                $values[] = "('" . implode("', '", $row) . "')";
            }
        }

        $united_values = implode(", ", $values);

        $sql = "INSERT INTO `" . $this->tablename . "`($columns) VALUES $united_values;";

        return $sql;
    }
}
