<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('search');

$query = $_GET['q'];

$obSearch = new CSearch;
$obSearch->Search(array(
    'QUERY' => $query,
    'SITE_ID' => SITE_ID,
    'MODULE_ID' => 'iblock',
));

while ($ar = $obSearch->GetNext()) {
    echo '<p><a href="'.$ar['URL'].'">'.$ar['TITLE'].'</a></p>';
}
?>
