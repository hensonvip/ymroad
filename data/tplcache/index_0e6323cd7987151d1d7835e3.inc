<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<title>��Ա����-<?php echo $cfg_webname; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>" />
<script language="JavaScript" src="templets/images/jquery.js"></script>
<script language="JavaScript" src="templets/images/jquery.lazyload.js"></script>
<script language="JavaScript" src="templets/images/common.js"></script>
<script type="text/javascript" src="templets/js/feed.js"></script>
<style>
.newlist{ width:100%; clear:both}
.newlist ul{ padding-left:20px; padding-top:10px;}
.newlist li{ float:left; margin:0 20px 15px 0; width:190px; overflow:hidden;}
.newlist li .pic{ width:190px; height:190px; overflow:hidden; margin-bottom:10px;display:block}
.newlist li .pic img{ width:190px; }
.newlist li .tit{overflow: hidden;white-space: nowrap;display: block;}
.newlist li p{ height:22px; line-height:22px;}
</style>
</head>
<body>
<?php include(DEDEMEMBER."/templets/head.htm"); ?>
<div class="main">
  <div class="navbar"> <span class="notice"><a href="/member">λ��</a></span>
    <ul class="position">
      <li><a href="/">��ҳ</a></li>
      <li style="background-image: none; background-position: initial initial; background-repeat: initial initial;">��Ա����</li>
    </ul>
  </div>
  <!--navbar end-->
  <div class="ucbox">
<?php include(DEDEMEMBER."/templets/left.htm"); ?>
    <!--ucleft end-->
    <div class="ucright">
      <div class="ucuser"> <span class="faceimg"><a href="<?php echo $cfg_cmsurl;?>/member/index.php?uid=<?php echo $cfg_ml->M_LoginID; ?>"><img src="<?php echo $cfg_ml->fields['face']; ?>" width="64" height="64" alt="��������" original="templets/images/dfboy.png"></a></span>
        <div class="usermore">
          <h3 class="uname"><?php echo $cfg_ml->M_UserName?><cite> <?php echo $cfg_ml->dengji($dsql); ?> </cite></h3>
          <!--<span class="ucinfo"><a href="<?php echo $cfg_cmsurl;?>/member/index.php?uid=<?php echo $cfg_ml->M_LoginID; ?>" target="_blank">������ҳ</a> <a href="zl.php">�޸�����</a> <a href="tx.php">�ҵ�ͷ��</a></span>-->
          <ul class="uinfo">
            <?php
       $pms = $dsql->GetOne("SELECT COUNT(*) AS nums FROM #@__member_pms WHERE toid='{$cfg_ml->M_ID}' AND `hasview`=0 AND folder = 'inbox'");
		if($pms['nums'] > 0)
		{
			echo " <li><span><img src='templets/images/u4.gif' alt='����Ϣ' original='templets/images/u4.gif'></span><a href='pm.php?TB_iframe=true&height=600&width=700' title='�ҵĶ���Ϣ' target='_blank'><b style='color:#F00'>{$pms['nums']}</b></a></li><EMBED src='templets/images/music.wav' autostart='true' loop='2' width=1 height=1>";
		}
		elseif($pms['nums']==0)
		{
			echo "<li><span><img src='templets/images/u4.gif' alt='����Ϣ' original='templets/images/u4.gif'></span><a href='pm.php?TB_iframe=true&height=600&width=700' title='�ҵĶ���Ϣ' target='_blank'>0</a></li>";
		}
       ?>
            <li><?php echo $cfg_ml->money($dsql); ?></li>
            <li><code><a href="/work/vip.html" title="����VIP" id="qd" target="_blank">����VIP</a></code></li>
          </ul>
        </div>
        <!--<ul class="otherinfo">
          <li><cite id="citecolor"><a href="myfriend.php"><?php echo $minfos['friend']; ?></a></cite><br>
            <a href="myfriend.php">��˿</a></li>
          <li><cite><?php echo $minfos['homecount']; ?></cite><br>
            ����</li>
          <li id="lastinfo"><cite><a href="mystow.php"><?php echo $minfos['stow']; ?></a></cite><br>
            <a href="mystow.php">�ղ�</a></li>
        </ul>-->
      </div>
      <!--ucuser end-->
      
      <div class="utool"> <span class="titlefont">���ù���</span>
        <ul class="usertool">
	<li><a href="/work/vip.html" class="tool6" target="_blank"></a>
            <p><a href="/work/vip.html" style="color:#f30">��ͨVIP</a></p>
          </li>
          <li><a href="zh.php" class="tool1"></a>
            <p><a href="zh.php">��������</a></p>
          </li>
          <li><a href="tx.php" class="tool2"></a>
            <p><a href="tx.php">ͷ������</a></p>
          </li>
        <!--  <li><a href="soft_add.php" class="tool3"></a>
            <p><a href="soft_add.php">�ϴ�����</a></p>
          </li>
          <li><a href="/member/fxtg.php" class="tool4"></a>
            <p><a href="/member/fxtg.php">�����ƹ�</a></p>
          </li>
          <li><a href="fg.php" class="tool5"></a>
            <p><a href="fg.php">�ռ任��</a></p>
          </li>
          <li><a href="buy.php" class="tool6"></a>
            <p><a href="buy.php">��ֵ���</a></p>
          </li>-->
          <li><a href="pm.php" class="tool7"></a>
            <p><a href="pm.php">����Ϣ</a></p>
          </li>
        </ul>
      </div>
      <div class="utitile"> <span class="titlefont2" style="line-height:48px;">ģ�嶯̬</span>

<div class="newlist">
      	<ul>
        
        	<?php 
                $db->SetQuery("SELECT * FROM #@__archives where typeid=27 order BY click desc limit 0,12"); 
                $db->Execute(); 
                $i=0; 
                while($rs = $db->GetArray()){ 
                $i++; 
                ?> 
               <li><a href="../plus/view.php?aid=<?php echo $rs['id'];?>"  class="pic" target="_blank"><img src="<?php echo $rs['litpic'];?>" width="190" height="190"><?php echo $rs['title'];?></a></li>   
                <?php 
                }?> 
                
        </ul>
      </div>


</div>
      <dl class="ucmsg" id="ucmsg">
        <span>
        <div class="ucmsg" id="FeedText"></div>
        </span>
      </dl>
      <a class="loadingmore" href="javascript:void(0)" onclick="gdt()"><cite id="stxt">���ظ����������</cite></a> </div>
    <!--urright end--> 
    
  </div>
  <!--ucbox end--> 
  
</div>
<!--main end-->
<?php include(DEDEMEMBER."/templets/foot.htm"); ?>
</body>
</html>