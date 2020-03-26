<?php

namespace LParser;

use DiDom\Document;

class LEDEMESHOP
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
        $document = new Document($url, true, 'windows-1251');

        $blocks = $document->find('.ok-product');

        for ($i = 0; $i < $document->count('.ok-product'); $i++){

            $external_id = $blocks[$i]->attr('data-cart-id');


            $name = trim($blocks[$i]->find('.ok-product__title')[0]->text());

            $price = $blocks[$i]->find('.ok-product__price-new')[0]->text();

            $price = str_replace('руб.', '', $price);

            if ($blocks[$i]->has('.ok-product__status')){
                $stock = $blocks[$i]->find('.ok-product__status')[0]->text();
            }else{
                $stock = 'Y';
            }

            $this->result[$external_id] = compact('external_id','name', 'price', 'stock');
        }

        if ($document->find('.l-child-col-indent')[0]->nextSibling('div.-mb-article')->find('a.-state-active')[0]->nextSibling('a')){
            $next = $document->find('.l-child-col-indent')[0]->nextSibling('div.-mb-article')->find('a.-state-active')[0]->nextSibling('a')->attr('data-url');
            $next = strstr($url, '?', true) . $next;

            if ( !empty($next) ){
                $this->getData($next);
            }
        }
    }

    public static function links(){
        return array(
            'https://ledeme.shop.by/smesiteli/?page_size=60',
            'https://ledeme.shop.by/moyki_kuhonnye/ledeme/?page_size=60',
            'https://ledeme.shop.by/moyki_dlya_kuhni_iz_iskusstvennogo_kamnya/gerhans/?page_size=60',
            'https://ledeme.shop.by/smesiteli/komplektuyuschie_k_smesitelyam/?page_size=60',
            'https://ledeme.shop.by/dushevye_sistemy/?page_size=60'
        );
    }
}