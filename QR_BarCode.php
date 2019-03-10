<?php

class QR_BarCode{
    // Google Chart API URL
    private $googleChartAPI = 'http://chart.apis.google.com/chart';
    // Code data
    private $codeData;

    /**
     * URL QR code
     * @param string $url
     */

    public function content($firstname = null, $lastname = null, $email = null,$jobtitle = null, $company = null,$job_desc = null, $telephone = null,$linkedin = null, $twitter = null,$instagram = null, $facebook= null) {
        $this->codeData = "Firstname:{$firstname};Lastname:{$lastname};Email:{$email};Jobtitle: {$jobtitle};Company:{$company};Job Description: {$job_desc};Telephone:{$telephone};Linkedin: {$linkedin};Twitter:{$twitter};Instagram: {$instagram};Facebook:{$facebook}";
    }

    /**
     * Generate QR code image
     *
     * @param int $size
     * @param string $filename
     * @return bool
     */
    public function qrCode($size = 200, $filename = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->googleChartAPI);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->codeData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $img = curl_exec($ch);
        curl_close($ch);

        if($img) {
            if($filename) {
                if(!preg_match("#\.png$#i", $filename)) {
                    $filename .= ".png";
                }

                return file_put_contents($filename, $img);
            } else {
                header("Content-type: image/png");
                print $img;
                return true;
            }
        }
        return false;
    }
}
?>