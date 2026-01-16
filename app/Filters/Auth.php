<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Libraries\MyException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
  public function before(RequestInterface $request, $arguments = null)
  {
    //get header token
    $authHeader = $request->getHeaderLine('Authorization');
    //  $authHeader = $request->getServer('HTTP_AUTHORIZATION');
   
    if($authHeader == null || $authHeader == '') {
      throw new MyException('Unauthorized token invalid !',401);
    }
    
    //harus diawali bearer
    if (!str_starts_with($authHeader, 'Bearer ')) {
      throw new MyException('Unauthorized token invalid !!',401);
    }

    //ambil token
    $token = str_replace('Bearer ', '', $authHeader);
    
    try {
      $decoded = JWT::decode($token, new Key('passwordRahasiaSangatRahasiaDanSuperRahasia', 'HS256'));
      //simpan payload di request
      $request->user = $decoded;
    } catch (\Exception $e) {
      throw new MyException('Unauthorized token invalid !!!',401);
    }
    
    // PERBAIKI LOGIN, KETIKA LOGOUT MASIH DIBACA LOGIN, KASU JWT
    // SESSION LOGOUT OK
    
  }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
