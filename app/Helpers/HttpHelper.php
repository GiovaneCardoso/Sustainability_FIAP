<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class HttpHelper
{

    /**
     * @var bool Throw error if http request fails
     */
    protected bool $throwError;

    /**
     * @var string Url of service
     */
    protected string $url;

    /**
     * @var BearerToken
     */
    protected $token;

    /**
     * @var Service EndPoint
    */
    protected string $endpoint;


    /**
     * @var array Headers
     */
    protected array $headers = [];

    /**
     * @var string ContentType
     */
    protected string $contentType;

    /**
     * @var string Body
     */
    protected string $body="";


    /**
     * @param string $url  Sufix of endpoint
     * @param bool throwError Behaviour when http request fails
    */
    public function __construct( string $url, bool $throwError=true )  {

        $this->url = $url;
        $this->contentType = "";
        $this->throwError = $throwError;

    }

    /**
     * @param string $token
     *
     * @return [type]
     */
    public function setToken(string $token) {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function issetToken(): bool {
        return isset($this->token);
    }

    /**
     * @param string $url
     *
     * @return [type]
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }


    /**
     * @param string $endpoint
     *
     * @return [type]
     */
    public function setEndPoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return url
     */
    public function getService():string
    {
        return $this->url . "/" . $this->endpoint;
    }


    /**
     * @param array $headers
     *
     * @return [type]
     */
    protected function setHeaders(array $headers = [])
    {
       $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @param mixed $headers=[]
     *
     * @return [type]
     */
    public function setHeadersWithDefault($headers=[]) {

        $defaultHeaders =   [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $this->setHeaders (array_merge($defaultHeaders, $headers));
    }

    /**
     * @param null $headers
     *
     * @return array
     */
    protected function getHeaders():array
    {

        return($this->headers);
    }


    /**
     * @param string|object $body=null
     *
     * @return [type]
     */
    public function setBody(array $body=[], $contentType = "") {

        $this->body = json_encode($body);
        $this->contentType = $contentType;
    }


    /**
     * @param string $method
     * @param string|object $body
     *
     * @return [array]
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function call (  string $method,
                            array $parameters =[]
                         ): array
    {
        $response = Http::withHeaders($this->getHeaders())
                        ->withToken($this->token)
                        ->withBody($this->body, $this->contentType)
                        ->send($method, $this->getService(), $parameters);


        if ( $response->status() !== 200 && $this->throwError === true ) {
            $response->throw();
        }

        return [
                'status' => $response->status(),
                'data' => $response->json()
               ];

    }

}
