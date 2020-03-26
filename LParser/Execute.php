<?php
namespace LParser;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Execute
{
    public $result = array();

    public function initParser($shop)
    {
        if ($shop == 'pvd'){
            $init = new PVD();
            $this->result = $init->result;
        }

        if ($shop == 'progreem'){
            $init = new PROGREEM();
            $this->result = $init->result;
        }

        if ($shop == 'ledeme-shop'){
            $init = new LEDEMESHOP();
            $this->result = $init->result;
        }
    }

    public static function createFile($items, $name)
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Название')
            ->setCellValue('B1', 'Внешний ID')
            ->setCellValue('C1', 'Цена')
            ->setCellValue('D1', 'Наличие');

        $row = 2;

        foreach ($items as $key => $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $items[$key]['name'])
                ->setCellValue('B' . $row, $items[$key]['external_id'])
                ->setCellValue('C' . $row, $items[$key]['price'])
                ->setCellValue('D' . $row, $items[$key]['stock']);

            $row++;
        }


        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(80);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);

        $writer = new Xlsx($spreadsheet);
        $date = new \DateTime();
        $formatDate = $date->format('d-m-Y');

        $filelink = $_SERVER['DOCUMENT_ROOT'] . '/tmp/' .  $name . $formatDate . '.xlsx';

        $writer->save($filelink);

        self::downloadFile($filelink);

    }

    public static function downloadFile($filelink){
        // заставляем браузер показать окно сохранения файла
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filelink));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        // читаем файл и отправляем его пользователю
        readfile($filelink);
    }

    public static function dump($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    public static function cleanStr($string)
    {
        return str_replace(array('  ', PHP_EOL), array('', ' '), $string);
    }

    public static function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}