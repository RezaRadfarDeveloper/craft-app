<?php
namespace modules;

use Craft;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class Module extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@modules', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\controllers';
        }

        parent::init();
        $url = "https://developers.zomato.com/api/v2.1/search?entity_id=259&entity_type=city&q=Melbourne&count=20";
// user-key is based on the key registered in zomato API page ...
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'user-key: 419a4c531b337d0e0d082a84065726e2'
  ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

//
$array = json_decode($output, true);
    $restaurantName = "<ul class='list-group' style='float:left;margin:40px;'>";
for ($i=0 ; $i<count($array['restaurants']) ; $i++){
  $restaurantName .= "<li class='list-group-item list-group-item-action'>";
  $restaurantName .= ($array['restaurants'][$i]['restaurant']['name']."<br>");
$restaurantName .= "</li>";
}
  $restaurantName .= "</ul>";
  echo $restaurantName;
  // in the case of error related to returned value...
print_r($curl_error);
        // Custom initialization code goes here...
    }
}
