<?php
    class Imgur
    {
        protected string $client_id = '4d33f1dff19b2ab';
        protected string $url = 'https://api.imgur.com/3/image.json';
        protected ?array $headers;

        public function __construct(?string $client_id=null)
        {
            if ($client_id != null)
                $this->client_id = $client_id;
            $this->headers = array("Authorization: Client-ID $this->client_id");
        }

        public function upload_image($file)
        {
            //nhận vào đường dẫn tới file ảnh (url online hoặc path trên máy), upload ảnh lên imgur và trả về link ảnh
            //Todo: trả về json thay cho link
            $img = file_get_contents($file);
            $pvars  = array('image' => base64_encode($img));

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL=> $this->url,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => $this->headers,
                CURLOPT_POSTFIELDS => $pvars
            ));

            $result = json_decode(curl_exec($curl), true);
            if($result['success'])
                return $result['data']['link'];
            else
                return "ERROR: ".$result['status'];
        }
    }
?>