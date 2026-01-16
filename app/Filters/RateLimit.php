<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RateLimit implements FilterInterface
{
    // misal max 10 request per menit
    private $maxRequests = 2;
    private $period = 20; // detik

    public function before(RequestInterface $request, $arguments = null)
    {
        $ip = $request->getIPAddress();
        $cache = \Config\Services::cache();

        $key = 'rate_' . $ip;
        $data = $cache->get($key);

        if (!$data) {
            $data = ['count' => 1, 'time' => time()];
            $cache->save($key, $data, $this->period);
        } else {
            if ($data['count'] >= $this->maxRequests) {
                throw new \App\Libraries\MyException('opss !! banyak permintaan !!',429);
            }
            $data['count']++;
            $cache->save($key, $data, $this->period - (time() - $data['time']));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak perlu implementasi
    }
}
