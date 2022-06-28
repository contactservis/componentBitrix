<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//формирование массива параметров
$arComponentParameters = array(
    "PARAMETERS" => array(
        "AR_TRACKED_UTM"    =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  "Введите отслеживаемые utm метки через запятую",
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  ""
        ),
        "DAY_COOKIES"    =>  array(
            "PARENT"    =>  "BASE",
            "NAME"      =>  "Количество дней хранения меток в coocies",
            "TYPE"      =>  "STRING",
            "DEFAULT"   =>  "30"
        )
    ),
);