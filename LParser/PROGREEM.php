<?php


namespace LParser;

use DiDom\Document;

class PROGREEM
{


    public $result = array();

    public function __construct()
    {
        $url = self::links();

        for ($i = 0;$i < count($url); $i++){
            $this->getData($url[$i]);
        }
    }

    public function getData($url)
    {
        $document = new Document($url, true);

        $blocks = $document->find('.item_block');

        for ($i = 0; $i < $document->count('.item_block'); $i++){

            $external_id = $blocks[$i]->find('.button_block')[0]->first('span')->attr('data-item');

            if (!$external_id){
                $external_id = $blocks[$i]->find('.button_block')[0]->first('span')->attr('data-autoload-product_id');
            }

            $name = trim($blocks[$i]->find('.item-title')[0]->text());

            if ($blocks[$i]->has('.price_value')) {
                $price = trim($blocks[$i]->find('.price_value')[0]->text());
            }else{
                $price = 'нету цены';
            }

            $stock = $blocks[$i]->find('.item-stock')[0]->text();

            $this->result[$external_id] = compact('external_id','name', 'price', 'stock');
        }
    }

    public static function links(){
        return array(
            'https://progreem.by/catalog/otoplenie/sistemy-bystrogo-montazha/gidrostrelki/?display=block&SHOWALL_1=1',
            'https://progreem.by/catalog/otoplenie/sistemy-bystrogo-montazha/kollektory/?display=block&SHOWALL_1=1',
            'https://progreem.by/catalog/otoplenie/sistemy-bystrogo-montazha/komplektuyushchie/?display=block&SHOWALL_1=1',
            'https://progreem.by/catalog/otoplenie/sistemy-bystrogo-montazha/nasosnye-gruppy/?display=block&SHOWALL_1=1',
            'https://progreem.by/catalog/otoplenie/sistemy-bystrogo-montazha/osnovaniya-pod-nasosnuyu-gruppu/?display=block&SHOWALL_1=1'
        );
    }


}