<?php
/**
 * @version        $Id: ajax_loginsta.php 1 8:38 2010��7��9��Z tianya $
 * @package        DedeCMS.Member
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
AjaxHead();
if($myurl == '') exit('');

$uid  = $cfg_ml->M_LoginID;

!$cfg_ml->fields['face'] && $face = ($cfg_ml->fields['sex'] == 'Ů')? 'dfgirl' : 'dfboy';
$facepic = empty($face)? $cfg_ml->fields['face'] : $GLOBALS['cfg_memberurl'].'/templets/images/'.$face.'.png';
?>
<div class="userinfo">
    <div class="welcome">��ã�<a href="/member/" target="_blank"><strong><?php echo $cfg_ml->M_UserName; ?></strong></a>����ӭ��¼ | <a href="<?php echo $cfg_memberurl; ?>/index_do.php?fmdo=login&dopost=exit">�˳���¼</a> </div>
    
    
    
</div><!-- /userinfo -->
