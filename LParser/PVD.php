<?php

namespace LParser;

use DiDom\Document;
use \Curl\Curl;

class PVD
{
    public $result= array();


    public function __construct()
    {
        foreach (self::pvdLinks() as $link){
            self::getDataPWD($link);
        }
    }

    public function getDataPWD($link)
    {
        $document = new Document($link, true);

        $product = $document->find('.product-shop-inner')[0];

        $name = $document->find('h1')[0]->text();
        $external_id = $product->find('.addtofavor')[0]->attr('rel');
        $price = $product->find('.price')[0]->attr('content');
        $stock = Execute::cleanStr($product->find('.favour')[0]->find('.col-xs-7')[0]->find('p')[0]->find('span')[0]->text());

        $this->result[$external_id] = compact('name', 'external_id', 'price', 'stock');

    }

    public static function pvdLinks()
    {
        return array(
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-uglovoj-ustanovochnyij-schell-comfor-12x-12.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-uglovoj-ustanovochnyij-12x-12-346.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-uglovoj-ustanovochnyij-schell-comfort-12x-34.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-3-x-proxodnoj-itap-12x34x12-vnn-255.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-uglovoj-ustanovochnyij-schell-comfor-12x-38.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-uglovoj-ustanovochnyij-s-czangovyim-zazhimom-itap-12x-38-348.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-uglovoj-ustanovochnyij-12x-12-391.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-uglovoj-ustanovochnyij-12x-12-391.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-40-pn-16-mpaa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-40-pn-16-mpaa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh40-ideal-ruchka-091.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh40-ideal-ruchka-099.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-32-pn-16-mpaa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg32-ideal-babochka-092.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-32-pn-16-mpaa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh32-ideal-babochka-093.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-s-amerikankoj-itap-gsh32-ideal-babochka-098.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-25-pn-16-mpaa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg25-ideal-babochka-092.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg25-ideal-ruchka-090.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-25-pn-16-mpaa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh25-ideal-babochka-093.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh25-ideal-ruchka-091.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-shardn-25-pn-16-mpa-so-sgon-11b27n9-vod.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh25-ideal-babochka-098.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-uglovoj-nik-itap-gsh25-ideal-babochka-s-nakgajkoj-krasn-298.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-arizona-12-gg-ruchka-babochka-bugatti-602.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-15-pn-16-mpa-11b27n5-vod-g-g-ruchka-babochka-czvetlit.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-15-pn-16-mpa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg15-ideal-babochka-092.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg15-ideal-ruchka-090.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-arizona-12-gsh-ruchka-ryichag-bugatti.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-15-pn-16-mpa-11b27n5-vod-m-cz-ruchka-babochka.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-15-pn-16-mpa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-new-jersey-12-gsh-ruchka-babochka-bugatti-917.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-oregon-12-gsh-ruchka-ryichag-bugatti-305.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-mini-12-126.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh15-ideal-babochka-093.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh15-ideal-ruchka-091.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-s-amerikankoj-arizona-12-gsh-ruchka-babochka-bugatti-626.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-shardn-15-pn-16-mpa-so-sgon-11b27n9-vod.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh15-ideal-babochka-098.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-uglovoj-nik-itap-gsh15-ideal-babochka-s-nakgajkoj-krasn-298.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-15-pn-16-mpa-11b27p7-vod-nr-nr-ruchka-babochka-czvetlit.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-uglovoj-sharovyij-dn15-pn-16-mpa-11b27n17-cz12-x-34.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-50-pn-16-mpaa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-50-pn-16-mpaa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-20-pn-16-mpa-11b27n5-vod-g-g-ruchka-babochka.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-20-pn-16-mpaa-11b27n5-vod-g-g.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg20-ideal-babochka-092.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gg20-ideal-ruchka-090.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-20-pn-16-mpa-11b27n5-vod-m-cz-ruchka-babochka.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-dn-20-pn-16-mpaa-11b27n5-vod-m-cz.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh20-ideal-babochka-093.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh20-ideal-ruchka-091.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-shardn-20-pn-16-mpa-so-sgon-11b27n9-vod.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-polnoproxodnoj-nik-itap-gsh20-ideal-babochka-098.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-uglovoj-nik-itap-gsh20-ideal-babochka-s-nakgajkoj-krasn-298.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-ventilnyij-vodorazbornyij-krn-15-12-czrb0053-czvetlit.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-vodorazbornyij-pod-shlang-s-latunnyim-shtuczerom-itap-ideal-du15-132.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-vodorazbornyij-pod-shlang-s-nejlonovyim-shtuczerom-ideal-du15-174.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-vodorazbornyij-s-latunnyim-shtuczerom-12-ledeme.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-vodorazbornyij-pod-shlang-s-latunnyim-shtuczerom-itap-ideal-du20-132.html',
            'https://pvd.by/catalog/vodosnabzhenie/kranyi-sharovyie-ventili/kran-sharovyij-vodorazbornyij-pod-shlang-s-nejlonovyim-shtuczerom-ideal-du20-174.html',
            'https://pvd.by/catalog/otoplenie/avtomatika-upravlenie-i-bezopasnost-dlya-sistem-otopleniya/reduktoryi-davleniya-vodyi/regulyator-davleniya-12-itap-361.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/termostaticheskij-klapan-afriso-atm-561.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/termostaticheskij-klapan-afriso-atm-361.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/atm-341-termostaticheskij-klapan-34-kvs-16-afriso.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/trehhodovoy-klapan-herz-calis-ts-rd-dn20-1.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/trexxodovoj-termosmesitelnyij-reguliruyushhij-klapan-teplomix-dn-25-1-herz.html',
            'https://pvd.by/catalog/otoplenie/klapanyi-termostaticheskie-elektroprivodyi/trexxodovoj-termosmesitelnyij-reguliruyushhij-klapan-teplomix-dn-32-114-herz.html'
        );
    }
}