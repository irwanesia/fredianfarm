<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig
{
    public $key = 'float@321'; // Ganti dengan kunci rahasia Anda
    public $issuer = 'codeir'; // Ganti dengan penerbit Anda
    public $audience = 'andi'; // Ganti dengan audiens Anda
    public $issuedAt = null;
    public $notBefore = null;
    public $expiration = null;

    public function __construct()
    {
        $this->issuedAt = time();
        $this->notBefore = $this->issuedAt;
        $this->expiration = $this->issuedAt + 3600; // Token valid selama 1 jam
    }
}
