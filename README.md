# actualiza-datos-generales-simulacion-client-php

Actualizacion de datos generales simulacion. <br/><img src='https://www.circulodecredito.com.mx/assets/img/logocirculo.png' height='37' width='100'/><br/>

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales
- Se debe contar con las siguientes dependencias de PHP:
    - ext-curl
    - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```

- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir los siguientes pasos:

 1. Dar clic en la sección "**Mis aplicaciones**".
 2. Seleccionar la aplicación.
 3. Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
 4. Al abrirse la ventana emergente, seleccionar el producto.
 5. Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en **test/Api/ADGPorCuentaApiTest.php**

Es importante contar con el setUp() que se encargará de inicializar la petición. Por tanto, se debe modificar la URL (**the_url**) y la API KEY (**your_x_api_key**), como se muestra en el siguiente fragmento de código:

```php
  public function setUp()
    {
        $config = new Configuration();
        $config->setHost('https://services.circulodecredito.com.mx/sandbox/v1/adg');
        $client = new Client();
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "x_api_key";
  
    }
```

Para la petición se deberá modificar el siguiente fragmento de código con los datos correspondientes:

> **NOTA:** Para más ejemplos de simulación, consulte la colección de Postman.

```php
/**
* Este método será ejecutado en la prueba ubicado en path/to/repository/test/Api/ApiTest.php
*/
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
```

## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

---
[CONDICIONES DE USO, REPRODUCCIÓN Y DISTRIBUCIÓN](https://github.com/APIHub-CdC/licencias-cdc)

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
