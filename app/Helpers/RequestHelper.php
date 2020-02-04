<?php
/**
 * Created by PhpStorm.
 * User: evtns
 * Date: 03/02/2020
 * Time: 22:38
 */
if (!function_exists('doRequest')) {
    function doRequest($type, $url, $data, $ssl)
    {
        try {
            $headers = [
                'Content-Type: application/json'
            ];
            $output = null;
            switch ($type) {
                case "POST":
                    $ch = curl_init();
                    $data = json_encode($data);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                    // SSL important
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $output = curl_exec($ch);
                    curl_close($ch);
                    break;
                case "GET":
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    // SSL important
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $output = curl_exec($ch);
                    curl_close($ch);
                    break;
            }
            return json_decode($output);
        } catch (\Exception $ex) {
            Log($ex);
        }
    }
}