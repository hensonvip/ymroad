    <?php
        $add_channel_menu = array();
        //如果为游客访问，不启用左侧菜单
        if(!empty($cfg_ml->M_ID))
        {
            $channelInfos = array();
            $dsql->Execute('addmod',"SELECT id,nid,typename,useraddcon,usermancon,issend,issystem,usertype,isshow FROM `#@__channeltype` ");	
            while($menurow = $dsql->GetArray('addmod'))
            {
                $channelInfos[$menurow['nid']] = $menurow;
                //禁用的模型
                if($menurow['isshow']==0)
                {
                    continue;
                }
                //其它情况
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
 
      	<!-- 内容中心菜单-->
      	<?php
		      	if($menutype == 'mydede')

      	{
      	?>
   
        <?php
        //是否启用文章投稿
        if($channelInfos['article']['issend']==1 && $channelInfos['article']['isshow']==1)
        {
        ?>
                  <dd><a href="content_list.php?channelid=1" title="已发布的文章">文章管理</a><span><a href="article_add.php" title="文章发布">发布</a></span></dd>
        <?php
      	}
        //是否启用图集投稿
        if($channelInfos['image']['issend']==1 && $cfg_mb_album=='Y'  && $channelInfos['image']['isshow']==1 
        && ($channelInfos['image']['usertype']=='' || preg_match("#".$cfg_ml->fields['mtype']."#", $channelInfos['image']['usertype'])) )
        {
        ?>
          
          
          <dd><a href="content_list.php?channelid=2" title="管理图集">图集管理</a><span><a href="album_add.php" title="图集上传">发布</a></span></dd>
	        <?php
	      	}
	      	//是否启用软件投稿
	        if($channelInfos['soft']['issend']==1 && $channelInfos['soft']['isshow']==1
	        && ($channelInfos['image']['usertype']=='' || preg_match("#".$cfg_ml->fields['mtype']."#", $channelInfos['image']['usertype']))
	        )
	        {
	        ?>
          <dd><a href="content_list.php?channelid=3" title="已发布的软件">软件管理</a><span><a href="soft_add.php" title="软件上传">上传</a></span></dd>
          <?php
           }
           ?>
       
				<?php
				//是否允许对自定义模型投稿
				if($cfg_mb_sendall=='Y')
				{
				?>
 
  					<?php
					foreach($add_channel_menu as $nnarr) {
					?>
					<dd><a href="<?php echo $nnarr['list'];?>?channelid=<?php echo $nnarr['id'];?>" title="已发布的<?php echo $nnarr['typename'];?>"><?php echo $nnarr['typename'];?>管理</a><span><a href='archives_do.php?dopost=addArc&channelid=<?php echo $nnarr['id'];?>' title="发表<?php echo $nnarr['typename'];?>">发表</a></span></dd>
					<?php
					} 
					}
					?>  
    <dd><a href="mystow.php"><b></b>我的收藏夹</a></dd>
         <?php
      }
      ?>
      	<!-- 我的织梦菜单-->
      	<?php
      	if($menutype == 'content')
      	{
      	?>
                  <dd><a href="content_list.php?channelid=1" title="已发布的文章">文章管理</a><span><a href="article_add.php" title="发布文章">发布</a></span></dd>
          <dd><a href="content_list.php?channelid=2" title="管理图集">图集管理</a><span><a href="album_add.php" title="图集上传">发布</a></span></dd>
           <dd><a href="content_list.php?channelid=3" title="已发布的软件">软件管理</a><span><a href="soft_add.php" title="软件上传">上传</a></span></dd>
    <dd><a href="mystow.php"><b></b>我的收藏夹</a></dd>

<?php
        if($cfg_feedback_forbid=='N')
        {
          //<dd class="icon feedback"><a href='../member/myfeedback.php'>我的评论</a></dd>
        }
        $dsql->Execute('nn','Select indexname,indexurl From `#@__sys_module` where ismember=1 ');
        while($nnarr = $dsql->GetArray('nn'))
        {
        	@preg_match("/\/(.+?)\//is", $nnarr['indexurl'],$matches);
        	$nnarr['class'] = isset($matches[1]) ? $matches[1] : 'channel';
        	$nnarr['indexurl'] = str_replace("**","=",$nnarr['indexurl']);
        ?>
        <dd class="<?php echo $nnarr['class'];?>"><a href="<?php echo $nnarr['indexurl']; ?>"><b></b><?php echo $nnarr['indexname']; ?>模块</a></dd>
        <?php
        }
        ?>
         <?php
      }
      ?>
      	<!-- 系统设置菜单-->
      	<?php
      	if($menutype == 'config')
      	{
      	?>
         	<dd ><a href="zh.php"><b></b>基本资料</a></dd>
	        <!--<dd ><a href="zl.php"><b></b><?php echo $cfg_ml->M_MbType; ?>资料</a></dd>-->
	        <dd><a href="tx.php"><b></b>头像设置</a></dd>
          	<!--<dd><a href="fl.php"><b></b>分类管理</a></dd>
         	<dd><a href="kj.php"><b></b>空间设置</a></dd>
        	<dd><a href="fg.php"><b></b>风格选择</a></dd>-->
         
        <?php
      }
      ?>
       <?php
    }
    ?>
   
