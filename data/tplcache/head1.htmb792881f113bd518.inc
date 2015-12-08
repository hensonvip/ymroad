<?php
$z[0]=Array("global","",1015,1043);
$z[0][4]['name']="cfg_memberurl";
$z[1]=Array("global","",1633,1661);
$z[1][4]['name']="cfg_memberurl";
$z[2]=Array("global","",1736,1764);
$z[2][4]['name']="cfg_memberurl";
$z[3]=Array("field","(@me==\"\")? @me=\" id='cur'\":@me=\"\";",2971,3055);
$z[3][4]['name']="typeid";
$z[3][4]['runphp']="yes";
$z[4]=Array("channelartlist","\r\n        <li><a href=\"{dede:field name='typeurl'/}\">{dede:field name='typename'/}</a>\r\n            <ul>\r\n                {dede:channel type='son' noself='yes'}\r\n                  <li><a href=\"[field:typelink/]\">[field:typename/]</a></li>\r\n                  {/dede:channel}\r\n            </ul>\r\n        </li>\r\n        ",3110,3490);
$z[4][4]['row']="10";
$z[4][4]['typeid']="top";
$z[5]=Array("type","\r\n      	<dl onmouseover=\"this.className='dl_on'\" onmouseout=\"this.className=''\">\r\n          <dt><i class=\"c9\"></i>\r\n            <h2><a class=\"dt_a1\" href=\"[field:typeurl/]\">[field:typename/]</a></h2>\r\n          </dt>\r\n        </dl>\r\n       ",4137,4412);
$z[5][4]['typeid']="3";
$z[6]=Array("channel","\r\n        <dl onmouseover=\"this.className='dl_on'\" onmouseout=\"this.className=''\">\r\n          <dt><i class=\"c[field:global name=autoindex runphp=\"yes\"]@me=@me+1;[/field:global]\"></i>\r\n            <h2><a class=\"dt_a1\" href=\"[field:typeurl/]\">[field:typename/]</a></h2>\r\n          </dt>\r\n        </dl>\r\n        ",4422,4782);
$z[6][4]['type']="son";
$z[6][4]['typeid']="3";

?>