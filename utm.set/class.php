<?php 
/* 
* Отслеживание и запись в coocies utm меток
*/
class utm_set extends CBitrixComponent {
  
  /**
   * onPrepareComponentParams
   *  $arParams["AR_TRACKED_UTM"] - строка utm меток разделенных запятой
   *  $arParams["DAY_COOKIES"] - количество дней хранения меток в coocies
   *
   * @param  mixed $arParams
   * @return void
   */
  public function onPrepareComponentParams($arParams){
      $result = array(
      "CACHE_TYPE"      => $arParams["CACHE_TYPE"],
      "AR_TRACKED_UTM"  => $arParams["AR_TRACKED_UTM"],
      "DAY_COOKIES"     => (int) $arParams["DAY_COOKIES"],
      );
      return $result;
  }
  
  /**
   * getParamsUTM - параметры
   *
   * @return void
   */
  private function getParamsUTM(){
    $arParamsUTM = [];
    
    // массив отслеживаемых utm меток
    $arTrackedUTMs = explode( ",", $this->arParams["AR_TRACKED_UTM"] );
    foreach ($arTrackedUTMs as &$item){
      $item = trim($item);
    }
    $arParamsUTM["AR_TRACKED_UTM"] = $arTrackedUTMs;
    
    // срок хранения cookies
    $keepDay = time()+60*60*24*$this->arParams["DAY_COOKIES"];
    $arParamsUTM["DAY_COOKIES"] = $keepDay;
    
    // массив GET 
    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    $arGet   = $request->getQueryList()->toArray();
    $arParamsUTM["GET"] = $arGet;

    return $arParamsUTM;
  }
  
  /**
   * setCookies - установка cookies
   *
   * @param  mixed $ParamsUTM
   * @return void
   */
  private function setCookies( $arParamsUTM ){
    foreach ($arParamsUTM["GET"] as $utm => $value){
      if( in_array($utm, $arParamsUTM["AR_TRACKED_UTM"] ) ){
        // устанавливаем куки
        setcookie($utm, $value, $arParamsUTM["DAY_COOKIES"]);
      }
    }

  }

  public function executeComponent(){  
    // Получим массивв данных
    $arParamsUTM = $this->getParamsUTM();    
    // установка cokies
    $this->setCookies( $arParamsUTM );
  }
}
