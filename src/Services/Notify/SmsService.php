<?php

namespace Kraify\Fastdev\Services\Notify;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class SmsService
{

    const URl = 'https://sms.ru/';
    private string $api_key;
    private string $url;


    public function __construct ( string $api_key, string $url = null ) {
        $this->api_key = $api_key;
        $this->url = $url ? : 'https://sms.ru/';
    }


    private function request ( $uri, array $fields = [] ) {
        $client = new Client( [
            'base_uri' => $this->url,
        ] );

        $fields[ 'api_id' ] = $this->api_key;
        $fields[ 'json' ]   = 1;

        $response = $client->get( $uri, [
            'query' => $fields,
        ] );

        return json_decode( $response->getBody()->getContents(), true );
    }


    public function send ( $numbers, string $text ): array {
        return $this->request( 'sms/send', [
            'to'  => implode( ',', Arr::wrap( $numbers ) ),
            'msg' => $text,
        ] );
    }


    public function status ( int $id ): array {
        return $this->request( 'sms/status', [ 'id' => $id ] );
    }


}
