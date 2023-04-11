<?php

namespace ActualizaDatosGeneralesSimulacion\Client;

use \ActualizaDatosGeneralesSimulacion\Client\Configuration;
use \ActualizaDatosGeneralesSimulacion\Client\ApiException;
use \ActualizaDatosGeneralesSimulacion\Client\ObjectSerializer;

use \GuzzleHttp\Client;

use \ActualizaDatosGeneralesSimulacion\Client\Api\ADGPorCuentaApi as Instance;

use \ActualizaDatosGeneralesSimulacion\Client\Model\RequestADG;
use \ActualizaDatosGeneralesSimulacion\Client\Model\CatalogoEstados;

class ADGPorCuentaApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('https://services.circulodecredito.com.mx/sandbox/v1/adg');
        $client = new Client();
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "x_api_key";
  
    }
    

    public function testPorCuentaPost()
    {
        $estado = new CatalogoEstados();
        $requestBody = new RequestADG();

        $requestBody->setClaveEstado($estado::GRO);
        $requestBody->setNumOtorgante("111111");
        $requestBody->setCuenta("TO");
        $requestBody->setCp("86621");
        $requestBody->setFolioOtorgante("33333");
   
        try {
            $result = $this->apiInstance->porCuentaPost($this->x_api_key, $requestBody);
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);

            return $result->getFolioConsulta();
        } catch (Exception $e) {
            echo 'Exception when calling RCCFS\Simulacion\MXApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
}
