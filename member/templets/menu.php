    <?php
        $add_channel_menu = array();
        //���Ϊ�οͷ��ʣ����������˵�
        if(!empty($cfg_ml->M_ID))
        {
            $channelInfos = array();
            $dsql->Execute('addmod',"SELECT id,nid,typename,useraddcon,usermancon,issend,issystem,usertype,isshow FROM `#@__channeltype` ");	
            while($menurow = $dsql->GetArray('addmod'))
            {
                $channelInfos[$menurow['nid']] = $menurow;
                //���õ�ģ��
                if($menurow['isshow']==0)
                {
                    continue;
                }
                //�������
                if($menurow['issend']!=1 || $menurow['issystem']==1 
                || ( !preg_match("#".$cfg_ml->M_MbType."#", $menurow['usertype']) && trim($menurow['usertype'])!='' ) )
                {
                    continue;
                }
                $menurow['ddcon'] = empty($menurow['useraddcon']) ? 'archives_add.php' : $menurow['useraddcon'];
                $menurow['list'] = empty($menurow['usermancon']) ? 'content_list.php' : $menurow['usermancon'];
                $add_channel_menu[] = $menurow;
            }
            unset($menurow);
		?>
 
      	<!-- �������Ĳ˵�-->
      	<?php
		      	if($menutype == 'mydede')

      	{
      	?>
   
        <?php
        //�Ƿ���������Ͷ��
        if($channelInfos['article']['issend']==1 && $channelInfos['article']['isshow']==1)
        {
        ?>
                  <dd><a href="content_list.php?channelid=1" title="�ѷ���������">���¹���</a><span><a href="article_add.php" title="���·���">����</a></span></dd>
        <?php
      	}
        //�Ƿ�����ͼ��Ͷ��
        if($channelInfos['image']['issend']==1 && $cfg_mb_album=='Y'  && $channelInfos['image']['isshow']==1 
        && ($channelInfos['image']['usertype']=='' || preg_match("#".$cfg_ml->fields['mtype']."#", $channelInfos['image']['usertype'])) )
        {
        ?>
          
          
          <dd><a href="content_list.php?channelid=2" title="����ͼ��">ͼ������</a><span><a href="album_add.php" title="ͼ���ϴ�">����</a></span></dd>
	        <?php
	      	}
	      	//�Ƿ��������Ͷ��
	        if($channelInfos['soft']['issend']==1 && $channelInfos['soft']['isshow']==1
	        && ($channelInfos['image']['usertype']=='' || preg_match("#".$cfg_ml->fields['mtype']."#", $channelInfos['image']['usertype']))
	        )
	        {
	        ?>
          <dd><a href="content_list.php?channelid=3" title="�ѷ��������">�������</a><span><a href="soft_add.php" title="����ϴ�">�ϴ�</a></span></dd>
          <?php
           }
           ?>
       
				<?php
				//�Ƿ�������Զ���ģ��Ͷ��
				if($cfg_mb_sendall=='Y')
				{
				?>
 
  					<?php
					foreach($add_channel_menu as $nnarr) {
					?>
					<dd><a href="<?php echo $nnarr['list'];?>?channelid=<?php echo $nnarr['id'];?>" title="�ѷ�����<?php echo $nnarr['typename'];?>"><?php echo $nnarr['typename'];?>����</a><span><a href='archives_do.php?dopost=addArc&channelid=<?php echo $nnarr['id'];?>' title="����<?php echo $nnarr['typename'];?>">����</a></span></dd>
					<?php
					} 
					}
					?>  
    <dd><a href="mystow.php"><b></b>�ҵ��ղؼ�</a></dd>
         <?php
      }
      ?>
      	<!-- �ҵ�֯�β˵�-->
      	<?php
      	if($menutype == 'content')
      	{
      	?>
                  <dd><a href="content_list.php?channelid=1" title="�ѷ���������">���¹���</a><span><a href="article_add.php" title="��������">����</a></span></dd>
          <dd><a href="content_list.php?channelid=2" title="����ͼ��">ͼ������</a><span><a href="album_add.php" title="ͼ���ϴ�">����</a></span></dd>
           <dd><a href="content_list.php?channelid=3" title="�ѷ��������">�������</a><span><a href="soft_add.php" title="����ϴ�">�ϴ�</a></span></dd>
    <dd><a href="mystow.php"><b></b>�ҵ��ղؼ�</a></dd>

<?php
        if($cfg_feedback_forbid=='N')
        {
          //<dd class="icon feedback"><a href='../member/myfeedback.php'>�ҵ�����</a></dd>
        }
        $dsql->Execute('nn','Select indexname,indexurl From `#@__sys_module` where ismember=1 ');
        while($nnarr = $dsql->GetArray('nn'))
        {
        	@preg_match("/\/(.+?)\//is", $nnarr['indexurl'],$matches);
        	$nnarr['class'] = isset($matches[1]) ? $matches[1] : 'channel';
        	$nnarr['indexurl'] = str_replace("**","=",$nnarr['indexurl']);
        ?>
        <dd class="<?php echo $nnarr['class'];?>"><a href="<?php echo $nnarr['indexurl']; ?>"><b></b><?php echo $nnarr['indexname']; ?>ģ��</a></dd>
        <?php
        }
        ?>
         <?php
      }
      ?>
      	<!-- ϵͳ���ò˵�-->
      	<?php
      	if($menutype == 'config')
      	{
      	?>
         	<dd ><a href="zh.php"><b></b>��������</a></dd>
	        <!--<dd ><a href="zl.php"><b></b><?php echo $cfg_ml->M_MbType; ?>����</a></dd>-->
	        <dd><a href="tx.php"><b></b>ͷ������</a></dd>
          	<!--<dd><a href="fl.php"><b></b>�������</a></dd>
         	<dd><a href="kj.php"><b></b>�ռ�����</a></dd>
        	<dd><a href="fg.php"><b></b>���ѡ��</a></dd>-->
         
        <?php
      }
      ?>
       <?php
    }
    ?>
   
