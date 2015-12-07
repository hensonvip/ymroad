<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/channelunit.func.php");
$rili = rili($date,'',true);
$db = new dedesql();
$curtime = time();
//获得时间戳
if(empty($date)){
    $timestamp = $curtime;
	$date =date('Y-n-d',$timestamp);
}else{
    $timestamp = strtotime($date);
}

    $selectedyear = date('Y',$timestamp);
    $selectedmonth = date('n',$timestamp);
    $selectedday = date('d',$timestamp);
    
    $starttime = mktime(0,0,0,$selectedmonth,$selectedday,$selectedyear);
    $endtime = $starttime+86400;

$where = '';
$tid = intval($tid);
if($tid > 0){
    $where = " and typeid=$tid";
}
$pagesize = 30;//默认一页30条数据
$maxpages=9;//
$pagepre=4;//分页用
$pageno = isset($_GET["pageno"]) ? intval($_GET["pageno"]) : 1;
$csql = "select count(*) as c from #@__archives,#@__arctype where pubdate>$starttime and pubdate <$endtime $where AND #@__archives.arcrank=0 AND #@__arctype.id = #@__archives.typeid";
$crow = $db->GetOne($csql);
$datacount = $crow['c'];//总条数
$startrow =($pageno-1) * $pagesize;//开始数
	if($datacount>0)//获取页码
	{
	$maxpage = $datacount%$pagesize;//
    	if($maxpage>0)
    	{
    	$maxpage= ceil($datacount/$pagesize);
    	}else{
		$maxpage= $datacount/$pagesize;//获取总页数
		}

	}else{
	$maxpage=0;
	}
if($pageno>$maxpage&&$maxpage!=0){	
	echo "<script>alert('好像没有这么多页数据！');history.go(-1);</script>";
	exit();
}
$query = "select #@__archives.id,#@__archives.pubdate,#@__archives.title,#@__archives.senddate,#@__archives.ismake,#@__archives.arcrank,#@__archives.money,#@__arctype.namerule,#@__arctype.typedir,#@__archives.typeid from #@__archives,#@__arctype where pubdate>$starttime and pubdate <$endtime $where AND #@__archives.arcrank=0 and #@__arctype.id = #@__archives.typeid LIMIT $startrow,$pagesize";


$db->setquery($query);
$db->execute();
$list = array();
while($row = $db->getarray())
{
   $row['time'] = date('20y-m-d H:i',$row['pubdate']);
    $row['pubdate'] = date('20ymd',$row['pubdate']);
    $list[] = $row;
}

require_once(dirname(__FILE__)."/../update/date.htm");

function GetArcUrl($aid,$typeid,$timetag,$title,$ismake=0,$rank=0,$namerule="",$artdir="",$money=0){
  	return GetFileUrl($aid,$typeid,$timetag,$title,$ismake,$rank,$namerule,$artdir,$money);
  }
function rili($date, $file = '/update/index.php', $nomax = false)
{
    $curtime = time();
    //获得时间戳
    if(empty($date)){
        $timestamp = $curtime;
    }else{
        $timestamp = strtotime($date);
    }
    
    $selectedyear = date('Y',$timestamp);
    $selectedmonth = date('n',$timestamp);
    $selectedday = date('d',$timestamp);
    //给定月份第一天星期几
    $firstday = date('w',mktime(0,0,0,$selectedmonth,1,$selectedyear));
    ////给定月份所应有的天数
    $lastday = date('t',$timestamp);//给定月份所应有的天数
    
    $preyear = date('Y',mktime(0,0,0,$selectedmonth,0,$selectedyear));
    $nextyear = date('Y',mktime(0,0,0,$selectedmonth,$lastday+1,$selectedyear));
    $premonth = date('n',mktime(0,0,0,$selectedmonth,0,$selectedyear));
    $nextmonth = date('n',mktime(0,0,0,$selectedmonth,$lastday+1,$selectedyear));
    $premonthdays = date('t',mktime(0,0,0,$selectedmonth,0,$selectedyear));
    $nextmonthdays = date('t',mktime(0,0,0,$selectedmonth,$lastday+1,$selectedyear));
    $preday = min($selectedday,$premonthdays);
    $nextday = min($selectedday,$nextmonthdays);
    
    
    //显示日历头
    $days = array("日","一","二","三","四","五","六");
    $months = array("一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月");
    $monthName = $months[$selectedmonth-1];
    
    $str = "<table bgcolor=\"#F0F9EE\">";
    $str .= "<caption valign=\"center\"><a href=\"$file?date=$preyear-$premonth-$preday\"><<</a> <b> $selectedyear  $monthName</b> ";
    if($nomax && mktime(0,0,0,$nextmonth,1,$nextyear) > $curtime){
        $str .= ">></caption>";
    }else{
        $str .= "<a href=\"$file?date=$nextyear-$nextmonth-$nextday\">>></a></caption>";
    }
    $str .= "<tr>";
    for($i=0;$i<7;$i++){
    $str .= "<td width=10%>$days[$i]</td>";
    }
    $str .= "</tr>";
    //空出当月第一天的位置
    $i = 0;
    while($i < $firstday){
        $str .= "<td></td>";
        $i++;
    }
    $day = 0;
    while($day < $lastday){
        if(($i % 7) == 0){
            $str .= "</tr><tr>";
        }
        $day++;
        $i++;
        //当天用红色表示
        if($day == $selectedday){
            $str .= "<td class=calendarToday align=center><font color=#ffffff>$day</font></td>";
        }else {
            if($nomax && mktime(0,0,0,$selectedmonth,$day,$selectedyear) > $curtime){
                $str .= "<td>$day</td>";
            }else{
                $str .= "<td><a href=\"$file?date=$selectedyear-$selectedmonth-$day\">$day</a></td>";
            }
        }
        
    }
    $str .= "</tr></table>";
    return $str;
}

?>