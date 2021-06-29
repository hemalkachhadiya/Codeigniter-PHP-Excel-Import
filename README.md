# CodeIgniter Excel Import
excel import demo

## versions
```base
php = "^7.3||^8.0",
CodeIgniter = "^4",
```
## Clone Demo

Use below CMD to clone demo
```bash
git clone git@github.com:hemalkachhadiya/Codeigniter-PHP-Excel-Import.git
```

## Composer install
```base
composer install
```

## Setup .env file
copy the ```env``` file to ```.env``` file and uncomment ```app.baseURL``` and set your app url.

```python
app.baseURL = ''
```
## Setup database
create database and  import ``` \document\demo_codeigniter4_excel_import.sql ``` sql file 
and set below database credentials in ```.env``` file
```php
database.default.hostname = ''
database.default.database = ''
database.default.username = ''
database.default.password =
database.default.DBDriver = MySQLi
```
at last run the project in browser

## Spreadsheet package import usign cmd
```base
composer require phpoffice/phpspreadsheet
```

## Controller file
```php 
<?php
// add this lines top of controller
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Reader\Csv;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class{
    // import function
    public function import() {
        $arr_file = explode('.', $_FILES['excel']['name']);
        $extension = end($arr_file);
        if('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        if (!empty($sheetData)) {
            for ($i=1; $i<count($sheetData); $i++) {
                $store = [
                    'name' => $sheetData[$i][0],
                    'email' => $sheetData[$i][1],
                    'phone' => $sheetData[$i][2],
                    'address' => $sheetData[$i][3],
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d")
                ];
                $users = new UserModel();
                $users->insert($store);
            }
        }
        return redirect()->to('/');
    }
}
```