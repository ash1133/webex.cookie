<?php
global $APPLICATION;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

$module_id = 'webex.cookie';
$ashBasketShareRight = $APPLICATION->GetGroupRight($module_id);
Loc::loadMessages(__FILE__);
Loader::includeModule($module_id);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$tabControl = new CAdminTabControl('tabControl', [
    [
        'DIV' => 'edit1',
        'TAB' => Loc::getMessage('BASKETSHARE_OPTIONS_TAB_NAME'),
        'TITLE' => Loc::getMessage('BASKETSHARE_OPTIONS_TAB_TITLE'),
    ],
    [
        'DIV' => 'edit2',
        'TAB' => Loc::getMessage('BASKETSHARE_OPTIONS_TAB_RIGHTS'),
        'TITLE' => Loc::getMessage('BASKETSHARE_OPTIONS_TAB_RIGHTS_TITLE'),
    ],
]);

if ($request->isPost() && $request['Update'] && check_bitrix_sessid()) {
    Option::set($module_id, 'cookiePage', $request['cookiePage']);
    Option::set($module_id, 'acceptCookie', $request['acceptCookie'] ? 'Y' : 'N');
    Option::set($module_id, 'loadMetrics', $request['loadMetrics'] ? "Y" : "N");
    Option::set($module_id, 'metrics', $request['metrics']);
    $obModule = CModule::CreateModuleObject($module_id);
}

$cookiePage = Option::get($module_id, 'cookiePage', "");
$acceptCookie = Option::get($module_id, 'acceptCookie', "N");
$loadMetrics = Option::get($module_id, 'loadMetrics', "N");
$metrics = Option::get($module_id, 'metrics', '');

$tabControl->Begin();
?>

<form method="post" action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($module_id) ?>&lang=<?= LANGUAGE_ID ?>">
    <?= bitrix_sessid_post() ?>
    <?php $tabControl->BeginNextTab(); ?>

    <tr>
        <td width="40%">
            <label for="metrics">Ссылка на страницу с политикой использования cookie:</label>
        </td>
        <td width="60%">
            <input type="text" name="cookiePage" value="<?= $cookiePage ?>">
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="metrics">Сохранять cookie до принятия cookie:</label>
        </td>
        <td width="60%">
            <input type="checkbox" name="acceptCookie" value="Y" <?= $acceptCookie == 'Y' ? 'checked' : '' ?>>
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="metrics">Не загружать JS метрики до принятия cookie:</label>
        </td>
        <td width="60%">
            <input type="checkbox" name="loadMetrics" value="Y" <?= $loadMetrics && $loadMetrics == 'Y' ? 'checked' : '' ?>>
        </td>
    </tr>

    <tr>
        <td width="40%">
            <label for="metrics">JS метрики:</label>
        </td>
        <td width="60%">
            <textarea name="metrics" id="metrics" cols="100" rows="10"><?= htmlspecialcharsbx($metrics) ?></textarea>
        </td>
    </tr>


    <?php $tabControl->BeginNextTab(); ?>

    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/admin/group_rights.php');
    ?>

    <?php $tabControl->Buttons(); ?>

    <input type="submit" name="Update" value="<?= Loc::getMessage('MAIN_SAVE') ?>" title="<?= Loc::getMessage('MAIN_OPT_SAVE_TITLE') ?>" class="adm-btn-save">
    <input type="reset" name="reset" value="<?= Loc::getMessage('MAIN_RESET') ?>">

    <?php $tabControl->End(); ?>
</form>