<?php

include_once './CFDI.php';
//include_once './Clases/CFDI.php';

class Main
{
    private $xml;
    private $cfdi_xml;
    private $array_data = [
        "Comprobante" => [
            "LugarExpedicion" => "64000",
            "TipoDeComprobante" => "i",
            "Moneda" => "MXN",
            "SubTotal" => "100",
            "Total" => "116",
            "FormaPago" => "01",
            "NoCertificado" => "00000010101010101",
            "Fecha" => "2021-10-06 11:00:00"
        ],
        "Emisor" => [
            "Rfc" => "TME960709LR2",
            "Nombre" => "Tracto Camiones s.a de c.v",
            "RegimenFiscal" => "612"
        ]
    ];

    public function __construct()
    {
        $this->cfdi_xml = new CFDI;
        $this->xml = new XML;
    }

    final public function createXML()
    {
         //Obtener el XML por medio de la clase XML
        foreach ($this->array_data as $key => $value) :
            if ($key != (string) 'Comprobante') :
                //$this->xml->setSatFormat($key);
                foreach ($value as $attribute => $value) :
                //Setear attributos
                $this->xml->setAtribute($attribute,$value);
                endforeach;
            elseif($key != (string) 'Emisor'):
                foreach ($value as $attribute => $value) :
                    //Setear attributos
                $this->xml->setAtributeComprobante($attribute,$value);
                endforeach;
            endif;
        endforeach;

        var_dump($this->xml->getAtributes());
    }

    private function getCFDI(){

    }
}

try {
    $main = new Main;
    $main->createXML();
} catch (\Exception $error) {
    echo $error->getMessage();
}
