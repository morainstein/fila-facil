<?php
namespace App\Helpers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Color\ColorInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Encoding\EncodingInterface;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;

class QrCodeFactory
{
  private QrCode $qrCode;
  private string $data;
  private int $size = 300;
  private int $margin = 10;
  private ColorInterface $foregroundColor;
  private ColorInterface $backgroundColor;

  function __construct()
  {
    $this->foregroundColor = new Color(255, 255, 255);
    $this->backgroundColor = new Color(16, 47, 67);
  }

  // public function setData($data) : void
  // {
  //   $this->data = $data;
  // }

  // public function setForegroundColor(int $r, int $g, int $b, int $a = 0) : void
  // {
  //   $this->foregroundColor = new Color($r, $g, $b, $a);
  // }

  // public function setBackgroundColor(int $r, int $g, int $b, int $a = 0) : void
  // {
  //   $this->backgroundColor = new Color($r, $g, $b, $a);
  // }

  // public function setQrcodeSize(int $size, int $margin) : void
  // {
  //   $this->size = $size;
  //   $this->margin = $margin;
  // }

  public function generate($clinicName)
  {
    $clinicName = str_replace(' ','_',$clinicName);
    $url = 'filafacil.com/'.$clinicName.'/';

    $qrcode = new QrCode(
      data: $url,
      encoding: new Encoding('UTF-8'),
      errorCorrectionLevel: ErrorCorrectionLevel::Low,
      size: $this->size,
      margin: $this->margin,
      roundBlockSizeMode: RoundBlockSizeMode::Margin,
      foregroundColor: $this->foregroundColor,
      backgroundColor: $this->backgroundColor
    );

    $writer = new \Endroid\QrCode\Writer\WebPWriter();

    $logo = new Logo(
      // path: __DIR__.'/assets/bender.png',
      path: __DIR__.'/logo1.png',
      resizeToWidth: 0,
      punchoutBackground: false
    );
    
    // Create generic label
    $label = new Label(
        text:  $url,
        margin: new Margin(10,10,10,10),
        textColor: new Color(255, 255, 255)
    );

    $result = $writer->write($qrcode,$logo,$label);
    $qrCodeName = "qrcode-". $clinicName .".png";
    $path = __DIR__."/../../resources/qrcodes/".$qrCodeName;
    $result->saveToFile($path);

    return $qrCodeName;

  }

}
