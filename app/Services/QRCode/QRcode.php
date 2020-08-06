<?php


namespace App\Services\QRCode;


class QRcode
{
    const LVL_FRAME_LOW = "L";
    const LVL_FRAME_MIDDLE = "M";
    const LVL_FRAME_HIGH = "Q";
    const LVL_FRAME_HUGE = "H";

    private $api = "https://chart.googleapis.com/chart?";
    private $qr = null;

    public $type = "href";
    public $logo = null;
    public $color = "#ffffff";
    public $frame = "";
    public $size = "200";
    public $target = null;
    public $margin = 1;

    public $output = null;

    public function __construct()
    {
        $this->frame = self::LVL_FRAME_LOW;
    }

    private function getqr(){

        if(is_null($this->target)){
            trigger_error("Merci de selectionner une cible grace à la variable target", E_USER_ERROR);
        }

        if(!is_null($this->logo)){  //on augmente les frames au maximum
            $this->frame = self::LVL_FRAME_HUGE;
        }

        $query = [
            "cht=qr",
            "chs=".$this->size."x".$this->size,
            "chl=".urlencode($this->target()),
            "chld=".$this->frame."|".$this->margin,
            "chco=".$this->color
        ];

        $this->qr = imagecreatefrompng($this->api . implode("&", $query));
    }

    private function target(){
        switch ($this->type){
            case "mail" : $target = "mailto:".$this->target;
                break;
            case "sms" : $target = "sms:".$this->target;
                break;
            case "phone" : $target = "tel:".$this->target;
                break;
            case "skype" : $target = "skype:".$this->target."?call";
                break;
            default : $target = $this->target;
        }

        return $target;
    }

    private function insertlogo(){
        if(!is_null($this->logo) and !is_null($this->qr)){

            if(file_exists($this->logo)){
                trigger_error("La source de l'image [<b>".$this->logo."</b>] n'existe pas", E_USER_ERROR);
            }

            $logo = imagecreatefromstring(file_get_contents($this->logo));
            $QR_width = imagesx($this->qr);
            $QR_height = imagesy($this->qr);

            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);

            $logo_qr_width = $QR_width/3;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;

            imagecopyresampled($this->qr, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        }
    }

    public function output(){

        $this->getqr();
        $this->insertlogo();


        if(is_null($this->output)) // on envoi l'image au navigateur
        {
            ob_start();
            imagepng($this->qr);
//            imagedestroy($this->qr);
            $imagedata = ob_get_clean();

            return $imagedata;
        }
        else{
            imagepng($this->qr, $this->output);
            imagedestroy($this->qr);
        }

    }
}
