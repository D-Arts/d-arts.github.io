<?php
/*
=====================================================
 DataLife Engine Nulled by M.I.D-Team
-----------------------------------------------------
 http://www.mid-team.ws/
-----------------------------------------------------
 Copyright (c) 2004,2009 SoftNews Media Group
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Файл: static.php
-----------------------------------------------------
 Назначение: вывод статистических страниц
=====================================================
*/
if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

 $waves[1]='';
	 	 $waves[2]=' (2 канал)';
		 $waves[3]=' (Муз. канал)';	
		 
 function makeClickers($text) { 

 $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', 
   '<u><a target="_blank" href="\\1">\\1</a></u>', $text); 
 $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', 
   '\\1<u><a target="_blank" href="http://\\2">\\2</a></u>', $text); 
 $text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})', 
   '<u><a target="_blank" href="mailto:\\1">\\1</a></u>', $text); 
  
return $text; 

}
if($_GET['sname'])
{
	 $month = mktime(date("H"), date("i"), date("s"), date("m"), date("d"),   date("Y"));

	

$nexttime = time() + 30;


   $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";
	  
	$ip=$_SERVER['REMOTE_ADDR'].' '.getenv('HTTP_X_FORWARDED_FOR');
	if($_SESSION[sname]!=$_GET['sname']||$_SESSION[thumb1]!=$_GET['thumb'])
	{
		
		if($_SESSION[sname]!=$_GET['sname'])
		{
			echo("New Q");
			$_SESSION['thumb']=0;
		}
			$_SESSION[sname]=$_GET['sname'];


	$vowels = array("_");
 $wave=$_GET[wave];
			 if(!$wave)
			 $wave=1;
	$sname= ltrim(rtrim(str_replace ($vowels, " ",$_GET['sname'])));
	
	 $pot = $db->super_query("SELECT a.*, WEEKDAY(a.begin) as beg, a.end as minutes FROM radioadmin a where a.wave='".$wave."' AND ((WEEKDAY(a.begin)='".$wday."'  AND TIME(a.begin)<='".$hday."'  AND TIME(a.end)>='".$hday."') OR ( (WEEKDAY(a.begin)='".$wday."' AND WEEKDAY(a.end)='".$wdaynext."'  AND TIME(a.begin)<='".$hday."'  )) OR  (WEEKDAY(a.end)='".$wday."'  AND WEEKDAY(a.begin)='".$wdayprev."'  AND TIME(a.end)>='".$hday."'))  order by id desc LIMIT 0,1;");
	  $image = $db->super_query("SELECT * FROM radiotop WHERE wave='1' AND  songname = '".$pot[name]."' LIMIT 1;");
	  
$curmonth=date("n");
if($curmonth!=$image[month]&&$image[songname]!=""&&$image[songname])
{
	  $db->query( "UPDATE radiotop set lastmonth=(mvotes1-mvotes2), mvotes2=0, mvotes1=0,  month='".$curmonth."' " );
}
	  
	   if( $pot[dj]&&$member_id[user_id]&&( $member_id[lastvote]<($_TIME-3600)||$member_id[lastvote]==""))
		{
			 $db->query( "UPDATE " . USERPREFIX . "_users set  lastvote='".$_TIME."' where name='".$member_id[name]."'" );
			if($_GET['thumb']=="down")
			{
				  $db->query( "UPDATE " . USERPREFIX . "_users set  forum_reputation=forum_reputation-1 where name='".$pot[dj]."'" );
			}
			else if($_GET['thumb']=="up")
			{
				  $db->query( "UPDATE " . USERPREFIX . "_users set  forum_reputation=forum_reputation+1 where name='".$pot[dj]."'" );
				  		 
			}
		}
		
	 if((!$image[songname]||$image[songname]=="")&&$pot[name]!=""&&$pot[name]!="Музыка нон-стоп")
	 {
		 if($_GET['thumb']=="down")
		 {
			  $db->query("INSERT  INTO radiotop (`songname`, `votes`, `votes2`, `mvotes1`, `mvotes2`,`ip`,`name`,`month`) values ('" . $pot[name]. "', '0', '1', '0', '1','" . $ip . "','".$pot[dj]."','".$curmonth."')");
			  
		 }
		 else  if($_GET['thumb']=="up")
		 {
		 $db->query("INSERT  INTO radiotop (`songname`, `votes`,`votes2`, `mvotes1`, `mvotes2`, `ip`,`name`,`month`) values ('" . $pot[name] . "', '1', '0','1', '0','" . $ip . "','".$pot[dj]."','".$curmonth."')");
		 			

		 }
	 }
	 else
	 {
		
			 if($_GET['thumb']=="down"&&$_SESSION[thumb1]!='0'&&$_SESSION[thumb1]!='')
			 {
			 
			  $db->query( "UPDATE radiotop set votes2=votes2+1, votes=votes-1,mvotes2=mvotes2+1, mvotes1=mvotes1-1, ip='" . $ip . "' where songname = '".$pot[name]."'" );
			
			 }
			 else if($_GET['thumb']=="up"&&$_SESSION[thumb1]!='0'&&$_SESSION[thumb1]!='')
			 {
			 
			  $db->query( "UPDATE radiotop set votes=votes+1, votes2=votes2-1,mvotes2=mvotes2-1, mvotes1=mvotes1+1, ip='" . $ip . "' where songname = '".$pot[name]."'" );
			 
			 }
			  else if($_GET['thumb']=="up")
			 {
			 echo("Up");
			 echo($_SESSION[thumb1]);
			  $db->query( "UPDATE radiotop set votes=votes+1, mvotes1=mvotes1+1, ip='" . $ip . "' where songname = '".$pot[name]."'" );
			  
			 }
			   else if($_GET['thumb']=="down")
			 {
			 
			  $db->query( "UPDATE radiotop set votes2=votes2+1, mvotes2=mvotes2+1, ip='" . $ip . "' where songname = '".$pot[name]."'" );
			  
			 }
			 
	 }	 	

	 } 
	 else
	 {
		 echo("Без накрутки, сорь");
	 }
	 $_SESSION[thumb1]=$_GET['thumb'];
	 return;
}
if($_POST['addvote']&&$member_id[user_group]<=3)
{
	$votad=stripslashes($_POST['addvote']);
	$wave=$_POST[wave];
	if(!$wave) $wave=1;
		$db->query( "INSERT INTO radiovote  (name,wave) values ('$votad','$wave')" );
			echo("Добавлено!");
}

if($_GET['votename'])
{
	$ip=$_SERVER['REMOTE_ADDR'].' '.getenv('HTTP_X_FORWARDED_FOR');
	$vowels = array("_");

	$sname= ltrim(rtrim(str_replace ($vowels, " ",$_GET['sname'])));
	 $wave=$_GET[wave];
			 if(!$wave)
			 $wave=1;
	 $image = $db->super_query("SELECT * FROM radiovote WHERE wave='".$wave."' order by id desc  LIMIT 0,1;");
	 if($image&&$image[ip]!=$ip&&$_SESSION[voted]!=$image[name])
	 {

if($_GET['votename']=="1")
{
			  $db->query( "UPDATE radiovote set vote1=vote1+1, ip='" . $ip . "' where  id = '".$image[id]."'" );
}
else if($_GET['votename']=="2")
{
			  $db->query( "UPDATE radiovote  set vote2=vote2+1, ip='" . $ip . "' where id = '".$image[id]."'" );
}
else if($_GET['votename']=="3")
{
			  $db->query( "UPDATE radiovote set vote3=vote3+1, ip='" . $ip . "' where id = '".$image[id]."'" );
}
$_SESSION[voted]=$image[name];

	 }
	 else
	 {
	
	 }
	  $wave=$_GET[wave];
			 if(!$wave)
			 $wave=1;
	$im = $db->super_query("SELECT  `vote1`, `vote2`, `vote3`, `name`    FROM radiovote where name!='no' AND wave='".$wave."'  order by id desc  LIMIT 0,1 ");
	$cnt=$im[vote1]+$im[vote2]+$im[vote3];

			if($cnt!=0)
			{
			$count=round(100/$cnt,1);
		
			}
			else
			{
				$count=0;
			}
			$p1=round($count*$im[vote1]);
					$p2=round($count*$im[vote2]);
							$p3=100-$p2-$p1;
							if($p3<=1)
							{
								$p3=0;
							}
echo("v1=".$p1."&v2=".$p2."&v3=".$p3."");
}

	else if(($_POST['mes']&&$_POST['mes']!="")||$postmes==1)
{
	echo("Tytk");
	if($member_id['user_group']=='5')
	{
		$nam="Гость";
	}
	else
	{
		$nam=$member_id[name];
	}
	if($_POST['vklogin']!="0"&&$_POST['vklogin'])
	{
		$_POST['vklogin']=	mb_convert_encoding(strip_tags($_POST['vklogin']),"CP1251", "UTF8");
		$vknam=$_POST['vklogin'];
	}
	else
	{
			$vknam="0";
	}
		$_TIME = time()+($config['date_adjust']*60);

	$title="Радио-привет от ".$nam;

	$category_list="37";
$alt_name="";
$allow_comm=0;
$approve=1;
	$news_fixed=0;
$allow_rating=0;
$allow_br=0;
$vowels = array("&amp","&");
$type=$_POST['emo'];
$_POST['mes']=	makeClickers(mb_convert_encoding(strip_tags($_POST['mes']),"CP1251", "UTF8"));
if($type!='0')
$short_story="".str_replace ($vowels, "%26",$_POST['mes']).'';
else
$short_story=str_replace ($vowels, "%26",$_POST['mes']);
$short_story=str_replace ("!plus", "\+",$short_story);
$allow_main=0;
strpos($short_story, '[');
	
					$pos=strpos($short_story, '[');
					
					$n1=strpos($short_story, ']',$pos)+1;
					if(!$n1)
					{
						$n1=strlen($short_story)-$pos;
					}
						$rest =(substr($short_story, $pos, $n1)) ;
					
							$rest2 = substr($rest,1,strlen($rest)-2) ;
							$b1 = $db->super_query( "SELECT name FROM " . USERPREFIX . "_users where name='{$rest2}'" );
							if($b1)
							{
								$short_story=str_replace ($rest, '<b><a target="_blank" href="http://nocens.ru/index.php?user='.$rest2.'">'.$rest.'</a></b>',$short_story);
								$nickact=$rest2;
								      	$link=str_replace ($rest, "",$_POST['mes']);
							}
							else
							{
								      	$link=$_POST['mes'];
									$nickact='0';
							}
			
					
$added_time = time() + ($config['date_adjust'] * 60);
$thistime = date( "d-m-Y H:i:s", $added_time );
                $time = date( "Y-m-d H:i:s", $_TIME );

   	$db->query( "INSERT INTO  dle_chat (author,	userto,	userfrom,	author_group,	message,	color,	font_style,	time, autorvk, type) values ( '$nam', '0', '$member_id[user_id]', '$member_id[user_group]' ,'$short_story', '#2a2a2a' , '', '$added_time', '$vknam','$type')" );
                $short=$title;
                $db->query( "UPDATE " . USERPREFIX . "_users set cash=cash+20 where name='".$member_id[name]."'" );
          
					if(!$_SESSION['checked'])
					{
					 $check = $db->super_query("SELECT COUNT(*) as num FROM `".PREFIX."_actions` WHERE `ufrom` = '".$member_id[name]."' AND type='radio'");
               if($check[num]>50)
               {
        
             achievements(4,$member_id[user_id],$member_id[achieves]);

               }
			   $_SESSION['checked']=1;
					}


        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$nam', '$nickact', '$link', '$time', 'radio')" );
			
                $row['id'] = $db->insert_id();
            $link='<b><a href="http://nocens.ru/index.php?do=flopper&list&user='.$nam.'">'.$game.'</a></b>';        
	}
	

else if($_GET['delmes']&&$member_id[user_group]<=3)
{
   $db->query("DELETE FROM radiomes where id='".$_GET['delmes']."'");
   echo("Удалено!");
}


	else if($_GET['login'])
{
	

$_IP = $db->safesql( $_SERVER['REMOTE_ADDR'] );
$dle_login_hash = "";

if( isset( $_REQUEST['action'] ) and $_REQUEST['action'] == "logout" ) {
	
	$dle_user_id = "";
	$dle_password = "";
	set_cookie( "dle_user_id", "", 0 );
	set_cookie( "dle_name", "", 0 );
	set_cookie( "dle_password", "", 0 );
	set_cookie( "dle_skin", "", 0 );
	set_cookie( "dle_newpm", "", 0 );
	set_cookie( "dle_hash", "", 0 );
	set_cookie( session_name(), "", 0 );
	@session_destroy();
	@session_unset();
	$is_logged = 0;
	
	header( "Location: $PHP_SELF" );
	die();
}

$is_logged = 0;
$member_id = array ();
if( $_SESSION['dle_log'] > 5 ) die( "Hacking attempt!" );

if($_GET['login']==1) {
	$_POST['login_name'] = iconv('utf-8', 'windows-1251', $_POST['login_name']);
	$_POST['login_name'] = $db->safesql( $_POST['login_name'] );
	$_POST['login_password'] = md5( $_POST['login_password'] );
	
	if( ! preg_match( "/[\||\'|\<|\>|\"|\!|\?|\$|\@|\/|\\\|\&\~\*\+]/", $_POST['login_name'] ) ) {
		
		$member_id = $db->super_query( "SELECT * FROM " . USERPREFIX . "_users where name='{$_POST['login_name']}' and password='" . md5( $_POST['login_password'] ) . "'" );
		
		if( $member_id['user_id'] ) {
				echo($member_id['name']);
			set_cookie( "dle_user_id", $member_id['user_id'], 365 );
			set_cookie( "dle_password", $_POST['login_password'], 365 );
			
			@session_register( 'dle_user_id' );
			@session_register( 'dle_password' );
			@session_register( 'member_lasttime' );
			
			$_SESSION['dle_user_id'] = $member_id['user_id'];
			$_SESSION['dle_password'] = $_POST['login_password'];
			$_SESSION['member_lasttime'] = $member_id['lastdate'];
			$_SESSION['dle_log'] = 0;
			$dle_login_hash = md5( strtolower( $_SERVER['HTTP_HOST'] . $member_id['name'] . $_POST['login_password'] . $config['key'] . date( "Ymd" ) ) );
			
			if( $config['log_hash'] ) {
				
				$salt = "abchefghjkmnpqrstuvwxyz0123456789";
				$hash = '';
				srand( ( double ) microtime() * 1000000 );
				
				for($i = 0; $i < 9; $i ++) {
					$hash .= $salt{rand( 0, 33 )};
				}
				
				$hash = md5( $hash );
				
				$db->query( "UPDATE " . USERPREFIX . "_users set hash='" . $hash . "', lastdate='{$_TIME}', logged_ip='" . $_IP . "' WHERE user_id='$member_id[user_id]'" );
				
				set_cookie( "dle_hash", $hash, 365 );
				
				$_COOKIE['dle_hash'] = $hash;
				$member_id['hash'] = $hash;
			
			} else
				$db->query( "UPDATE LOW_PRIORITY " . USERPREFIX . "_users set lastdate='{$_TIME}', logged_ip='" . $_IP . "' WHERE user_id='$member_id[user_id]'" );
			
			$is_logged = TRUE;
		}
	}

} elseif( intval( $_SESSION['dle_user_id'] ) > 0 ) {
	
	$member_id = $db->super_query( "SELECT * FROM " . USERPREFIX . "_users WHERE user_id='" . intval( $_SESSION['dle_user_id'] ) . "'" );
	
	if( $member_id['password'] == md5( $_SESSION['dle_password'] ) ) {
		
		$is_logged = TRUE;
		$dle_login_hash = md5( strtolower( $_SERVER['HTTP_HOST'] . $member_id['name'] . $_SESSION['dle_password'] . $config['key'] . date( "Ymd" ) ) );
	
	} else {
		
		$member_id = array ();
		$is_logged = false;
	}

} elseif( intval( $_COOKIE['dle_user_id'] ) > 0 ) {
	
	$member_id = $db->super_query( "SELECT * FROM " . USERPREFIX . "_users WHERE user_id='" . intval( $_COOKIE['dle_user_id'] ) . "'" );
	
	if( $member_id['password'] == md5( $_COOKIE['dle_password'] ) ) {
		
		$is_logged = TRUE;
		$dle_login_hash = md5( strtolower( $_SERVER['HTTP_HOST'] . $member_id['name'] . $_COOKIE['dle_password'] . $config['key'] . date( "Ymd" ) ) );
		
		@session_register( 'dle_user_id' );
		@session_register( 'dle_password' );
		
		$_SESSION['dle_user_id'] = $member_id['user_id'];
		$_SESSION['dle_password'] = $_COOKIE['dle_password'];
	
	} else {
		
		$member_id = array ();
		$is_logged = false;
	echo("no");
	}

}

if( isset( $_POST['login'] ) and ! $is_logged ) {
	
	$_SESSION['dle_log'] = intval( $_SESSION['dle_log'] );
	$_SESSION['dle_log'] ++;
	
	msgbox( $lang['login_err'], $lang['login_err_1'] );
}

if( $is_logged ) {
	
	if( ! $_SESSION['member_lasttime'] ) {
		
		@session_register( 'member_lasttime' );
		$_SESSION['member_lasttime'] = $member_id['lastdate'];
		
		if( ($member_id['lastdate'] + (3600 * 4)) < $_TIME ) {
			
			$db->query( "UPDATE LOW_PRIORITY " . USERPREFIX . "_users SET lastdate='{$_TIME}' where user_id='$member_id[user_id]'" );
		
		}
	}
	
	if( ! allowed_ip( $member_id['allowed_ip'] ) ) {
		
		$is_logged = 0;
		
		msgbox( $lang['login_err'], $lang['ip_block_login'] );
	
	}
	
	if( $config['log_hash'] and (($_COOKIE['dle_hash'] != $member_id['hash']) or ($member_id['hash'] == "")) ) {
		
		$is_logged = 0;
	
	}
	
	if( $config['ip_control'] == '2' and ! check_netz( $member_id['logged_ip'], $_IP ) and ! isset( $_POST['login'] ) ) $is_logged = 0;
	elseif( $config['ip_control'] == '1' and $user_group[$member_id['user_group']]['allow_admin'] and ! check_netz( $member_id['logged_ip'], $_IP ) and ! isset( $_POST['login'] ) ) $is_logged = 0;

}

if( ! $is_logged ) {
	
	$member_id = array ();
	set_cookie( "dle_user_id", "", 0 );
	set_cookie( "dle_password", "", 0 );
	set_cookie( "dle_hash", "", 0 );
	$_SESSION['dle_user_id'] = 0;
	$_SESSION['dle_password'] = "";

}
		
}


	else if($_GET['zak'])
{
	
		if($member_id['user_group']=='5')
	{
		$nam="Гость";
	}
	else
	{
		$nam=$member_id[name];
	}
	
	echo("Tytk");

		
		$_TIME = time()+($config['date_adjust']*60);
	
	$topic_date = date ("Y-m-d H:i:s", $_TIME);
	$post_text=strip_tags($_GET['zak']);

	$topic_id=291;
		$_IP = $db->safesql($_SERVER['REMOTE_ADDR']);
		$topic_title="<<Заказывать трэки \ песни в этом топике>>";
		$db->query("INSERT INTO " . PREFIX . "_forum_posts (topic_id, post_date, post_author, post_text, post_ip, is_register, e_mail, wysiwyg, is_count) values ('291', '$topic_date', '$nam', '$post_text', '$_IP', '1', '', '0', '1')");
			$db->query("UPDATE " . PREFIX . "_forum_topics SET post = post+1, last_date = '$topic_date',  last_poster_name = '$nam' WHERE tid = '291'");
		
		$db->query("UPDATE " . PREFIX . "_forum_forums SET posts = posts+1, f_last_tid = '$topic_id', f_last_title = '$topic_title', f_last_date = '$topic_date', f_last_poster_name = '$nam' WHERE id = '20'");
		$db->query("UPDATE " . PREFIX . "_users SET forum_post = forum_post+1, cash=cash+20 WHERE name = '$nam'");
		$db->query("UPDATE " . PREFIX . "_forum_forums SET f_last_tid = '$topic_id', f_last_title = '$topic_title', f_last_date ='$topic_date', f_last_poster_name = '$nam' WHERE id ='19'");
	
	
	
}
else if($_GET['del'])
{
	if($member_id['user_group']=='1'||$member_id['user_group']=='3')
	{
		$db->query("DELETE FROM radiotop WHERE id='".intval($_GET['del'])."'");
echo("Удалено!");
	}
}

else if($_GET['z1'])
{
		  $f3 = $db->query("(SELECT name  FROM dle_users where name in (SELECT ufrom FROM dle_actions WHERE Month(time)=1) order by user_id desc  LIMIT 0,40) UNION (SELECT name  FROM dle_users where name in (SELECT ufrom FROM dle_actions WHERE Month(time)=2) order by user_id desc  LIMIT 0,40) ");
	 
	 $i1=1;
	    while ($im = $db->get_row($f3)){
			echo($im[name]."<br>");
			}
}

else if($_GET['vote'])
{
	
	include (ROOT_DIR . '/engine/api/api.class.php');
require_once ENGINE_DIR . '/classes/parse.class.php';

$parse = new ParseFilter( );
$parse->safe_mode = true;
$parse->allow_url = false;
$parse->allow_image = false;
$_TIME = time() + ($config['date_adjust'] * 60);
$name = @$db->safesql( $_GET['page'] );
if($name=="" || !$name)
{
	$name="blogs";
	
}
	 $tpl->load_template( 'Radio2.tpl' );
	 $i1=1;
	 if($_GET[delop]&&$member_id[user_group]>=1&&$member_id[user_group]<=3)
	 {


		$db->query("DELETE FROM radiovote WHERE id='".intval($_GET['delop'])."'");

	 }
	 if($_GET['system']=="1")
	 {
	  $f3 = $db->query("SELECT  `vote1`, `vote2`, `vote3`, `name`    FROM radiovote where name!='no'    order by id desc  LIMIT 0,1 ");
	 }
	 else
	 {
		 	  $f3 = $db->query("SELECT  `id`, `vote1`, `vote2`, `vote3`,  `name`   FROM radiovote   where name!='no'   order by id desc  LIMIT 0,100 ");
	 }
	 $i1=1;
	    while ($im = $db->get_row($images)){
			
			
			if($i1%2==0)
			{
				$clas="c1";
			}
			else
			{
					$clas="c2";
			}
			$cnt=$im[vote1]+$im[vote2]+$im[vote3];
			if($cnt!=0)
			{
			$count=round(100/$cnt,1);
			}
			else
			{
				$count=0;
			}
			$p1=round($count*$im[vote1]);
					$p2=round($count*$im[vote2]);
							$p3=100-$p1-$p2;
							if($p1==0)
							$p1s='display:none;';
							else
							$p1s="";
							
							if($p2==0)
							$p2s='display:none;';
							else
							$p2s="";
							
							if($p3==0)
							$p3s='display:none;';
							else
							$p3s="";
							
							if(strpos($im[name],"1.")!=false&&strpos($im[name],"2.")!=false&&strpos($im[name],"3.")!=false)
		{
			$pos1=strpos($im[name],"1.");
			$pos2=strpos($im[name],"2.");
			$pos3=strpos($im[name],"3.");
			$label1=substr($im[name],$pos1+2,$pos2-$pos1-2);
					$label2=substr($im[name],$pos2+2,$pos3-$pos2-2);
							$label3=substr($im[name],$pos3+2,strlen($im[name])-$pos3-2);
		}
			else
			{
				$label1='Согласен';
				$label2='Не согласен';
				$label3='Всё равно';
			}
			if($member_id[user_group]>=1&&$member_id[user_group]<=3)
			{
				$addlink='<a href="http://nocens.ru/index.php?do=radio2&vote=1&delop='.$im[id].'"><img src="http://nocens.ru/pics/editnews2.png"></a>';
			}
			 if($_GET['system']!="1")
 {
	 
		//	$shout.='<div class="'.$clas.'"><span style="font-size: 14px; color: blue; ">'.$i1.'. <b>'.strip_tags($im[name]).'</b></span><br> <span style="color: green;">['.$p1.'%]</span> <span style="color: red;">['.$p2.'%] </span>['.$p3.'%]  <span style="color: grey;">('.$cnt.' всего)</span></div>';
		if($i1==1)
		$shout.='<div class="news"><h1>Последний опрос</h1></div>';
		if($i1==2)
		$shout.='<div class="news"><h1>Архив опросов</h1></div>';
				$shout.='<div><span style="font-size: 14px; ">'.$i1.'. <b>'.strip_tags($im[name]).'</b> ('.$cnt.' голосов) '.$addlink.'</span><div style="clear: both; height: 4px;"></div><div  style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; background-color: rgb(125, 197, 125); color: #000; '.$p1s.' width: '.$p1.'%;  " title="'.$label1.' ('.$p1.'%)"><b>'.$label1.' ('.$p1.'%)</b></div><div style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; background-color: rgb(240, 153, 153); color: #000;    '.$p2s.' width: '.$p2.'%; " title="'.$label2.' ('.$p2.'%)"> <b>'.$label2.' ('.$p2.'%)</b></div><div style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; '.$p3s.' background-color: rgb(180, 180, 180); color: #000;  width: '.$p3.'%; " title="'.$label3.' ('.$p3.'%)"> <b>'.$label3.' ('.$p3.'%)</b></div></div><div style="clear: both; height: 8px;"></div>';
 }
 else
 {
				if(strlen( $im[songname]) > 30 ) 
				{
				$im[songname] = substr( $im[songname], 0, 30);
				}
 	$shout.='<div class="'.$clas.'"><span style="font-size: 14px; color: blue; ">'.$i1.'. <b>'.strip_tags($im[name]).'</b></span>  <span style="color: green;">['.$im[vote1].']</span> <span style="color: red;"> ['.$im[vote2].'] </span>['.$im[vote3].']['.$im[vote3].'] ( <span style="color: green;">'.$p1.'%</span>-<span style="color: red;"> '.$p2.'%-</span>'.$p3.'%)</div><br>';

			}
		
			
			
			
			$i1++;
		}
		
 
 if($_GET['system']=="1")
 {

$shout= mb_convert_encoding($shout,"UTF8", "CP1251");

	 echo($shout);
 }
 else
 {
	if($member_id[user_group]<4)
	{
		 $shout2='<form>
<label for="textfield"></label>
<input style="width: 500px;" type="text" name="addvote" id="addvote" placeholder="Как дела? 1. Хорошо 2. Плохо 3. Никак" /> <select name="wave" id="wave">
       <option value="1" selected="selected">Первый Субкультурный</option>
       <option value="2">Второй Субкультурный</option>
       <option value="3">Музыка нон-стоп</option>
     </select>
<input type="submit" name="button" id="button" value="Создать" />
</form>';
	}
		 $tpl->set( '{bank}', $shout2.$shout);

 $tpl->compile( 'content' );
  $shout="";
 }
}






else if($_GET['schedule'])
{if($_GET[prid])
{
 $days=array("ПОНЕДЕЛЬНИК","ВТОРНИК","СРЕДА","ЧЕТВЕРГ","ПЯТНИЦА","СУББОТА","ВОСКРЕСЕНЬЕ");

	$idp=$_GET[prid];
	  $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";

	$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where id='{$idp}' order by id desc LIMIT 0,1;");
	$rating = $db->super_query("SELECT DISTINCT a.id, a.songname, a.mvotes1, a.lastmonth, a.mvotes2, a.votes, a.votes2, (a.votes-a.votes2) as vote3,(a.mvotes1-a.mvotes2) as mvotes  FROM radiotop a WHERE a.songname='".$pot[name]."' GROUP by a.songname  LIMIT 0,1;");
	if($rating[mvotes]=="")
	$rating[mvotes]=0;
		if($rating[vote3]=="")
	$rating[vote3]=0;
	$rates=$db->query("SELECT a.name FROM radiotop a WHERE a.songname!='".$pot[name]."' AND (((a.mvotes1-a.mvotes2)>".$rating[mvotes].") OR (((a.mvotes1-a.mvotes2)=".$rating[mvotes].") AND ((a.votes-a.votes2)>".$rating[vote3].")))  GROUP by a.songname");
	
	$ratenum=$db->num_rows($rates)+1;
		
			for($i=0; $i<$pot[ygold]; $i++)
			{
				$medals.='<img title="Лучший эфир года" align="texttop" src="http://nocens.ru/pics2/clubs/starbigg.png">';
			}
			for($i=0; $i<$pot[ysilver]; $i++)
			{
				$medals.='<img   title="Выдающийся эфир года"  align="texttop" src="http://nocens.ru/pics2/clubs/starbigs.png">';
			}
			for($i=0; $i<$pot[ybronze]; $i++)
			{
				$medals.='<img   title="Примечательный эфир года"  align="texttop" src="http://nocens.ru/pics2/clubs/starbigb.png">';
			}
			
			for($i=0; $i<$pot[gold]; $i++)
			{
				$medals.='<img title="Лучший эфир месяца" align="texttop" src="http://nocens.ru/pics2/clubs/star2.png">';
			}
			for($i=0; $i<$pot[silver]; $i++)
			{
				$medals.='<img   title="Выдающийся эфир месяца"  align="texttop" src="http://nocens.ru/pics2/clubs/star2s.png">';
			}
			for($i=0; $i<$pot[bronze]; $i++)
			{
				$medals.='<img   title="Примечательный эфир месяца"  align="texttop" src="http://nocens.ru/pics2/clubs/star2b.png">';
			}
		
	if($rating[mvotes]>0)
	$col="green";
	else if($rating[mvotes]<0)
	$col="red";
	else
	$col="grey";
	$rate=''.$medals.'<b>'.$ratenum.' место в <a onclick="DlePage(\'do=radio2&amp;top=1\'); return false;" href="http://nocens.ru/index.php?do=radio2&amp;top=1">рейтинге эфиров</a></b>.'; 
			    $time1= strtotime($pot[begin]);
	 $when=date("H:i", $time1);
	 	$weekd=$pot[beg];
	  $whatef=' '.$days[$weekd].', '.$when.'';
	    $tpl->set( '{when}',   $whatef);
				$pot[dj] = str_replace(" и ",",",$pot[dj]);
		$djs=explode(',',$pot[dj]);
		
		foreach($djs as $d)
		{
			$djname='<a href="http://nocens.ru/'.$d.'">'.$d.'</a>,';
		}
		$djname=substr($djname,0,strlen($djname)-1);
		   $tpl->set( '{author}',   '<p class="whiter">'.$djname.'</p>');
	  $tpl->set( '{potok2}', stripslashes($pot[name]));
	  $nam_e =stripslashes($pot[name]);
	  if($pot[description2])
	   $tpl->set( '{potok6}', stripslashes($pot[description2]));
	  else
				   $tpl->set( '{potok6}', stripslashes($pot[description]));
				   if($pot[link1])
				   {
				 $link2.= '<a href="'.$pot[link1].'"><b>Архив выпусков</b></a> &nbsp;&nbsp;';
				   }
				    $tpl->set( '{potok7}', $link1);
				if($pot[link2])
				   {
				 $link2.= '<a href="'.$pot[link2].'"><b>Обсуждение передачи</b></a>&nbsp; &nbsp;';
				   }
				   if($pot[vk])
				   {
				 $link2.= '<a href="http://vk.com/'.$pot[vk].'"><img align="texttop" src="http://nocens.ru/pics3/interface/groupvk.png" class="hidebut"> <b>Группа Вконтакте</b></a>&nbsp; &nbsp;';
				   }
				   if($pot[link2])
				   {
				 $link2.= '<a href="http://twitter.com/'.$pot[twitter].'"><img align="texttop" src="http://nocens.ru/pics3/interface/grouptw.png" class="hidebut"> <b>Микроблог в Twitter</b></a>&nbsp; &nbsp;';
				   }
				   if($member_id[user_group]<4)
				   {
				 $linkbar.= '<a href="http://nocens.ru/index.php?do=radio2&djbar=1&prid='.$pot[id].'"><img align="top" title="Редактировать" src="/pics/editnews11.png" width="25" height="20" border="0"></a><br>';
				   }
				   $tpl->set( '{linkbar}', $linkbar);
				       $tpl->set( '{potok7}', $link1);
				if($pot[call]&&$pot['efir']=="1")
				   {
				 $link10= '<p style="font-size: 16px; color: #05CACA; font-style: italic;"><b>Прямой эфир, принимаются Skype-звонки!</b></p>';
				   }
				   else if ($pot['efir']=="1")
				   {
					   		 $link10= '<p style="font-size: 16px;  color: #F00; font-style: italic;"><b>Прямой эфир!</b></p>';
				   }
				   else
				   {
					   		 $link10= '<p style="font-size: 16px; color: #CCC; font-style: italic;">Эфир в записи.</p>';
				   }
			$link10.='<p>'.$rate.'</p>';
				    $tpl->set( '{potok7}', $link1);
					 $tpl->set( '{potok8}', $link2);
					 	 $tpl->set( '{potok10}', $link10);
						 if(!$pot[picture])
						 {
							 $pot[picture]='http://nocens.ru/pics/buts/que.png';
						 }
					  $tpl->set( '{potok9}', $pot[picture]);
	
	 		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, TIME(begin) as h1 FROM radioadmin where name like '%{$pot [name]}%'  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
		
		 
	 $weekd=22445;

	 $progs='<div><div style="position: relative;">';
	 $k1=0;
	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="";
				
				}	$k1++;
				$weekd=$im[beg];
			
			
			
				
					}
$wv=$waves[$im[wave]];
			$descr=strip_tags($im['description']);
			$descr = str_replace("\r","",$descr);
$descr = str_replace("\n","<br>",$descr);
		$add1="onmouseover=\"tooltip.show('".$descr."');\" onmouseout=\"tooltip.hide();\"";
		
		if($pot[id]==$im[id])
		{	$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainbl.tpl");
		}
		else if($im['efir']=="1")
		{
				$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainimp.tpl");
		}
		else
		{
			$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainall.tpl");
		}
	
	$TplThumb = str_replace("{author}", '<p style=""><span><b>'.substr($im[h1],0,strlen($im[h1])-3).' '.$wv.'</b></span></p>', $TplThumb);
		  $TplThumb = str_replace("{src}",'<p '.$add1.' class="blacker" style="font-weight: bold;"><a href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[id].'">'.$days[$weekd].'</a> '.$uto.'</p>', $TplThumb);
				$TplThumb = str_replace("[link-full-foto]", "", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "", $TplThumb);
		$progs .=	$TplThumb;
		
		
			
		
		
}
$progs.="</div></div>";

  $nam_e = "Расписание Первого Субкультурного радиопроекта";
 $tpl->load_template( 'djbarall.tpl' );
}


else
{
	  $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";
	
	$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where   (WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."') order by id desc LIMIT 0,1;");
	
	 		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, TIME(begin) as h1 FROM radioadmin  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
			 
		 $days=array("ПОНЕДЕЛЬНИК","ВТОРНИК","СРЕДА","ЧЕТВЕРГ","ПЯТНИЦА","СУББОТА","ВОСКРЕСЕНЬЕ");
		 
	 $weekd=22445;
	 $progs="<div>";
	 $k1=0;
	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="";
				
				}	$k1++;
				$weekd=$im[beg];
			
					if($pot[beg]==$im[beg])
					{$progs.='<a name="today"></a>';
					}
					$progs.= '<div  style="clear: both;"></div><div class="separator"><b>'.$days[$weekd].'</b></div>';
			
				
					}
		if($im[picture])
		{
			$imager='<img width="75" height="75" src="'.$im[picture].'">';
		}
		else
		{
			$imager="";
		}
			$descr=strip_tags($im['description']);
			$descr = str_replace("\r","",$descr);
$descr = str_replace("\n","<br>",$descr);
		$add1="onmouseover=\"tooltip.show('".$descr."');\" onmouseout=\"tooltip.hide();\"";
		
		if($pot[id]==$im[id])
		{	$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainbl.tpl");
		}
		else if($im['efir']=="1")
		{
				$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainimp.tpl");
		}
		else
		{
			$TplThumb = file_get_contents(ROOT_DIR."/templates/".$config['skin']."/gallery_thumbmainall.tpl");
		}
	$addwave="";
	if($im[wave]!='1')
	{
		$addwave=' ('.$im[wave].' волна)';
	}
	if($im[hidden]=='1')
	{
		$addwave.=' (отменен)';
	}
	$TplThumb = str_replace("{author}", '<p ><span><b>'.substr($im[h1],0,strlen($im[h1])-3).'</b>'.$addwave.'</span></p>', $TplThumb);
		$TplThumb = str_replace("{src}",'<p '.$add1.' class="blacker" style="font-weight: bold;"><a href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[id].'">'.$imager.'<br>'.$im[name].'</a> '.$uto.'</p>', $TplThumb);
				$TplThumb = str_replace("[link-full-foto]", "", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "", $TplThumb);
		$progs .=	$TplThumb;
		
		
			
		
		
}
$progs.="</div>";

  
 $tpl->load_template( 'schedule.tpl' );}
  $tpl->set( '{progs}', $progs);
     $tpl->compile( 'content' );
		$tpl->clear();

}
else if($_GET['todaytext'])
{
	 $wave=$_GET[wave];
			 if(!$wave)
			 $wave=1;
			 
   $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";
$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where wave='".$wave."' AND hidden!='1' AND  ((WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."')) order by type asc, id desc LIMIT 0,1;");
	
	  
		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, TIME(begin) as h1, TIME(end) as h2 FROM radioadmin where  hidden!='1'  AND   WEEKDAY(begin)='".$wday."'  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
		 
	 $weekd=22445;
	 $progs="";
	 $k1=0; $vowels = array("\"");

	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="";
				
				}
				
				$k1++;
				$weekd=$im[beg];
				$progs.= '';
			}
		
					
			
			$im[name] = str_replace ($vowels, "", $im[name]);
			$wv=$waves[$im[wave]];
			if($wave!=$im[wave]){
				if($wv=="")
				$wv=" (1 канал)";
			$wv='<a href="event:'.$im[wave].'"><b>'.$wv.'</b></a>';
			}
			else
			{
				$wv="";
			}
		if($im[name]==$pot[name])
			{	
	$progs.='<textformat leading="5">&nbsp;&nbsp;<font size="+2" color="#990000"> <a target="_blank" href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[id].'"><b>'.substr($im[h1],0,strlen($im[h1])-3).' &nbsp;&nbsp;'.$im[name].'</b></a>'.$wv.'</font></textformat><br>';
			$next1=1;		}
		else if($next1==1)
		{
			$progs.='<font size="+1"  color="#000000"> <a target="_blank" href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[id].'"><b>'.substr($im[h1],0,strlen($im[h1])-3).'</b> &nbsp;&nbsp;'.$im[name].' </a>'.$wv.'</font><br>';
			
		}
		
	else
	{
		$progs.='<font color="#666666"> <a target="_blank" href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[id].'"><b>'.substr($im[h1],0,strlen($im[h1])-3).'</b> &nbsp;&nbsp;'.$im[name].'</a>'.$wv.'</font><br>';		
			}
		
}
//$fh = file_get_contents('http://nocens.ru/radio/hello.txt');
$progs.='';


if($member_id[user_group]<=3&&$member_id[user_group]>=0)
{
	$progs.='<br><a target="_blank" href="http://nocens.ru/index.php?do=radio2&djbar=1"><b>Редактировать сетку »</b></a><br>';
}
$progs=mb_convert_encoding('' ."<u>".date("d.m.Y")."</u><br><br>".$progs.$fh,"UTF8", "CP1251");


 echo($progs);
}
else if($_GET['todayxml'])
{
	   $wday=date("w")-1;
	   if($wday=='-1')
	   $wday=6;
		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, begin as h1, end as h2 FROM radioadmin where   hidden!='1'  AND  WEEKDAY(begin)='".$wday."'  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
		 
	 $weekd=22445;
	 $progs="";
	 $k1=0; $vowels = array("\"");

	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="</day>";
				
				}
				
				$k1++;
				$weekd=$im[beg];
				$progs.= '<day num="'.$im[beg].'">';
			}
			$im[name] = str_replace ($vowels, "", $im[name]);
		$progs.='<program  id="'.$im[id].'" type="'.$im[type].'" description="" link1="'.$im[link1].'" link2="'.$im[link2].'" picture="'.$im[picture].'"  call="'.$im[skype].'" start="'.$im[h1].'"  end="'.$im[h2].'" name="'.$im[name].'"></program>';
		
}
if($progs!="")
$progs.="</day>";

 
 echo($progs);
}
else if(isset($_GET['dayxml']))
{
	
		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, begin as h1, end as h2 FROM radioadmin where hidden!='1'  AND   WEEKDAY(begin)='".$_GET['dayxml']."'  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
		 
	 $weekd=22445;
	 $progs="";
	 $k1=0; $vowels = array("\"");

	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="</day>";
				
				}
				
				$k1++;
				$weekd=$im[beg];
				$progs.= '<day num="'.$im[beg].'">';
			}
			$im[name] = str_replace ($vowels, "", $im[name]);
		$progs.='<program id="'.$im[id].'" type="'.$im[type].'" description="'.$im[description].'" link1="'.$im[link1].'" link2="'.$im[link2].'" picture="'.$im[picture].'"  call="'.$im[skype].'"  start="'.$im[h1].'"  end="'.$im[h2].'"  name="'.$im[name].'"></program>';
		
}
if($progs!="")
$progs.="</day>";

 
 echo($progs);
}
else if(isset($_GET['newstext']))
{
	
		 $fsch = $db->query("SELECT * FROM dle_banners WHERE banner_tag LIKE '%radiotag%' AND approve='1' ORDER BY id desc LIMIT 0,5;");;
		
	    while ($im = $db->get_row($fsch)){
		$output.='<div style="font-family: Myriad Pro,Times New Roman; font-size: 12pt;">'.stripslashes($im[code]).'</div>';
		
}

if($member_id[user_group]<4)
{
	$output.=' <a target="_parent" href="http://nocens.ru/admin.php?mod=banners&action=edit&id=13">(Редактировать информацию)</a>';
}


 echo('<!DOCTYPE html><html lang="ru"><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head><body>'. mb_convert_encoding($output,"UTF8", "CP1251").'</body></html>');
}
else if($_GET['weekxml'])
{

	 		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, begin as h1, end as h2 FROM radioadmin where hidden!='1'  AND  type='2' order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,200;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
		 
	 $weekd=22445;
	 $progs="";
	 $k1=0; $vowels = array("\"");

	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="</day>";
				
				}
				
				$k1++;
				$weekd=$im[beg];
				$progs.= '<day num="'.$im[beg].'">';
			}
			$im[name] = str_replace ($vowels, "", $im[name]);
		$progs.='<program  id="'.$im[id].'" type="'.$im[type].'" description="'.$im[description].'" link1="'.$im[link1].'"  link2="'.$im[link2].'" picture="'.$im[picture].'" call="'.$im[skype].'" start="'.$im[h1].'"  end="'.$im[h2].'" name="'.$im[name].'"></program>';
		
}
if($progs!="")
$progs.="</day>";

 
 echo($progs);
}


else if($_GET['djbar']&&$member_id[user_group]<=3)
{
	
	
	if($_GET['clear']=="1")
		{ $month = mktime(date("H"), date("i"), date("s"), date("m"), date("d"),   date("Y"));
			$db->query("DELETE FROM radioadmin WHERE type='1' && begin <= NOW()");
			header("Location: http://nocens.ru/index.php?do=radio2&djbar=1"); 
		}
		else if ($_GET[clear])
		{
			 $month = mktime(date("H"), date("i")+60, date("s"), date("m"), date("d"),   date("Y"));
			$db->query("DELETE FROM radioadmin WHERE id='".$_GET[clear]."'");
			header("Location: http://nocens.ru/index.php?do=radio2&djbar=1"); 
		}
		else if($_GET[overlay])
		{
			if($_GET[change])
		{$banner_code=strip_tags($_POST[mainoverlay]);
				$db->query( "UPDATE " . PREFIX . "_banners SET  code='$banner_code' WHERE banner_tag='overlay'" );
		}
		$row = $db->super_query( "SELECT * FROM " . PREFIX . "_banners WHERE banner_tag='overlay' LIMIT 0,1" );
		  $tpl->set( '{overlaynew}', $row[code]);
		   $tpl->load_template( 'djbar3.tpl' );
     $tpl->compile( 'content' );
		$tpl->clear();
		return;
		}
		else if($_GET[poll])
{
	if($_GET[pollchange]){
	$votad=stripslashes($_POST['pollfield']);
	$wave=$_POST[wave];
	if(!$wave) $wave=1;
		$db->query( "INSERT INTO radiovote  (name,wave) values ('$votad','$wave')" );
	}
	 if($_GET[delop]&&$member_id[user_group]>=1&&$member_id[user_group]<=3)
	 {


		$db->query("DELETE FROM radiovote WHERE id='".intval($_GET['delop'])."'");

	 }
	 $i1=1;
	
		 	  $f3 = $db->query("SELECT  `id`, `vote1`, `vote2`, `vote3`,  `name`   FROM radiovote   where name!='no'   order by id desc  LIMIT 0,40 ");
	
	 $i1=1;
		    while ($im = $db->get_row($images)){
			
			
			if($i1%2==0)
			{
				$clas="c1";
			}
			else
			{
					$clas="c2";
			}
			$cnt=$im[vote1]+$im[vote2]+$im[vote3];
			if($cnt!=0)
			{
			$count=round(100/$cnt,1);
			}
			else
			{
				$count=0;
			}
			$p1=round($count*$im[vote1]);
					$p2=round($count*$im[vote2]);
							$p3=100-$p1-$p2;
							if($p1==0)
							$p1s='display:none;';
							else
							$p1s="";
							
							if($p2==0)
							$p2s='display:none;';
							else
							$p2s="";
							
							if($p3==0)
							$p3s='display:none;';
							else
							$p3s="";
							
							if(strpos($im[name],"1.")!=false&&strpos($im[name],"2.")!=false&&strpos($im[name],"3.")!=false)
		{
			$pos1=strpos($im[name],"1.");
			$pos2=strpos($im[name],"2.");
			$pos3=strpos($im[name],"3.");
			$label1=substr($im[name],$pos1+2,$pos2-$pos1-2);
					$label2=substr($im[name],$pos2+2,$pos3-$pos2-2);
							$label3=substr($im[name],$pos3+2,strlen($im[name])-$pos3-2);
		}
			else
			{
				$label1='Согласен';
				$label2='Не согласен';
				$label3='Всё равно';
			}
			if($member_id[user_group]>=1&&$member_id[user_group]<=3)
			{
				$addlink='<a href="http://nocens.ru/index.php?do=radio2&vote=1&delop='.$im[id].'"><img src="http://nocens.ru/pics/editnews2.png"></a>';
			}
			
			 if($_GET['system']!="1")
 {
	 
		//	$shout.='<div class="'.$clas.'"><span style="font-size: 14px; color: blue; ">'.$i1.'. <b>'.strip_tags($im[name]).'</b></span><br> <span style="color: green;">['.$p1.'%]</span> <span style="color: red;">['.$p2.'%] </span>['.$p3.'%]  <span style="color: grey;">('.$cnt.' всего)</span></div>';
		if($i1==1)
		$shout.='<div class="news"><h1>Последний опрос</h1></div>';
		if($i1==2)
		$shout.='<div class="news"><h1>Архив опросов</h1></div>';
				$shout.='<div><span style="font-size: 14px; ">'.$i1.'. <b>'.strip_tags($im[name]).'</b> ('.$cnt.' голосов) '.$addlink.'</span><div style="clear: both; height: 4px;"></div><div  style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; background-color: rgb(125, 197, 125); color: #000; '.$p1s.' width: '.$p1.'%;  " title="'.$label1.' ('.$p1.'%)"><b>'.$label1.' ('.$p1.'%)</b></div><div style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; background-color: rgb(240, 153, 153); color: #000;    '.$p2s.' width: '.$p2.'%; " title="'.$label2.' ('.$p2.'%)"> <b>'.$label2.' ('.$p2.'%)</b></div><div style="padding: 4px; white-space: nowrap; height: 16px; overflow: hidden; font-size: 14px; '.$p3s.' background-color: rgb(180, 180, 180); color: #000;  width: '.$p3.'%; " title="'.$label3.' ('.$p3.'%)"> <b>'.$label3.' ('.$p3.'%)</b></div></div><div style="clear: both; height: 8px;"></div>';
 }
			
			
			
			$i1++;
		}
		$tpl->set( '{bank}', $shout);
		   $tpl->load_template( 'djbar4.tpl' );
     $tpl->compile( 'content' );
		$tpl->clear();
		return;
}
	else if($_POST[potok]||$_POST[potok2])
	{
		list ($d1, $m1, $y1) = split ('[/.-]', $_POST[potok4]);
		list ($h1, $i1) = split ('[/:.-]', $_POST[potok5]);
	
		 $month =  date("Y-m-d, H:i:s",mktime($h1, $i1+$_POST[potok3], 0, $m1, $d1,   $y1));
		$month2 = date("Y-m-d, H:i:s", mktime($h1, $i1, 0, $m1, $d1,   $y1));
		$wave=$_POST[wave];
		$potok=$_POST[potok];
		$potok2=$_POST[potok2];
		$potok64=$_POST[potok64];
		$potok256=$_POST[potok256];
		$dsc=$_POST[potok6];
		$dsc2=$_POST[description2];
		$link1=$_POST[potok7];
		$link2=$_POST[potok8];
		$picl=$_POST[potok9];
			$efir=$_POST[efir];
			$djay=$_POST[djay];
				$twitter=$_POST[twitter];
			$vk=$_POST[vk];
			$call=$_POST[potok10];
				$overlay=$_POST[overlay];
		if($potok=="")
		$potok="no";
			if($potok2=="")
		$potok2="no";
		if($potok64=="")
		$potok64="no";
		if($potok256=="")
		$potok256="no";
		$typ=$_POST[repeat];
		$hidden=intval($_POST[hidden]);
		if($typ=='1')
		$typ=2;
		else
		$typ=1;
			  if($_GET[prid])
			  {
		   $db->query( "UPDATE radioadmin set `src`='" . $potok . "', `src2`='" . $potok64 . "',`src3`='" . $potok256 . "', `efir`='".$efir."', `name`='" . $potok2 . "', `end`='".$month."', `begin`='".$month2."', `type`='".$typ."', `picture`='".$picl."',`link1`='".$link1."',`link2`='".$link2."',`description`='".$dsc."',`description2`='".$dsc2."', `call`='".$call."',`dj`='".$djay."',`overlay`='".$overlay."',`hidden`='".$hidden."' ,`wave`='".$wave."'  ,`vk`='".$vk."',`twitter`='".$twitter."'   where id = '".$_GET[prid]."'" );
			  }
			  else
			  {
	//	$db->query("DELETE FROM radioadmin WHERE type='1' && begin <= NOW()");
	
								  $db->query("INSERT  INTO radioadmin (`src`,`src2`,`src3`, `name`, `end`, `begin`, `type`, `picture`,`link1`,`link2`,`description`,`description2`,`call`,`efir`,`dj`,`overlay`,`hidden`,`wave`,`vk`,`twitter`) values ('" . $potok . "','" . $potok64 . "','" . $potok256 . "','" . $potok2 . "', '".$month."', '".$month2."','".$typ."','".$picl."','".$link1."','".$link2."','".$dsc."','".$dsc2."','".$call."','".$efir."','".$djay."','".$overlay."','".$hidden."','".$wave."','".$vk."','".$twitter."' )");
			  }
	
	}
	   $month = mktime(date("H"), date("i"), date("s"), date("m"), date("d"),   date("Y"));
	   

   $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";
	   if(!$_GET[prid])
	   {
$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where  (WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."') order by id desc LIMIT 0,1;");
   $time1= time();
		
		  $time3=60;
		    $tpl->set( '{potok5}',  date("H:00", $time1));
	   }
	   else
	   {
		
		   
		   $pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where  id='".$_GET[prid]."' order by type asc, id desc LIMIT 0,1;");
	    $time1= strtotime($pot[begin]);
		  $time2=strtotime($pot[end]);
		  $time3=floor(($time2-$time1)/60);
		    $tpl->set( '{potok5}',  date("H:i", $time1));	   }

	  $tpl->set( '{potok}', $pot[src]);
	  $tpl->set( '{potok64}', $pot[src2]);
	  $tpl->set( '{potok256}', $pot[src3]);
	  	  $pot[name]= str_replace ('"', "",$pot[name]);
	  	  $tpl->set( '{potok2}', $pot[name]);
			  $tpl->set( '{overlay}', $pot[overlay]);
		  if($time3==0)
		  {
			  $time3=60;
		  }
		    	  $tpl->set( '{potok3}', $time3);
				  $tpl->set( '{potok4}',   date("d.m.Y",$time1));
				
				   $tpl->set( '{potok6}', $pot[description]);
				   $tpl->set( '{description2}', $pot[description2]);
				    $tpl->set( '{potok7}', $pot[link1]);
					 $tpl->set( '{potok8}', $pot[link2]);
					   $tpl->set( '{vk}', $pot[vk]);
					 $tpl->set( '{twitter}', $pot[twitter]);
					  $tpl->set( '{potok9}', $pot[picture]);
					  $wave=$pot[wave];
					  if($wave=='1')
					  $checked1='selected="selected"';
					  else if($wave=='2')
					   $checked2='selected="selected"';
					   else if($wave=='3')
					    $checked3='selected="selected"';
					  		  $tpl->set( '{checked1}', $checked1);
							    $tpl->set( '{checked2}', $checked2);
								  $tpl->set( '{checked3}', $checked3);
					  			  $tpl->set( '{potok10}', $pot[call]);
								  $tpl->set( '{potok11}', $pot[dj]);
			if($pot[type]=="2")
		  {		 					 $tpl->set( '{check}', "checked");
		  }
		
		  else
		  {
			  $tpl->set( '{check}', "");
		  }
		  					  $tpl->set( '{potok11}', $pot[dj]);
			if($pot[hidden]=="1")
		  {		 					 $tpl->set( '{hidden}', "checked");
		  }
		
		  else
		  {
			  $tpl->set( '{hidden}', "");
		  }
		    if($pot[efir]=="1")
		  {		 					 $tpl->set( '{checkef}', "checked");
		  }
		  else
		  {
			   $tpl->set( '{checkef}', "");
		  }
		  if($pot[minutes])
		  {
			  $tpl->set( '{end}', $pot[minutes]);
		  }
		  else
		  {
			  $tpl->set( '{end}', "XXX");
		  }
		     $potnow = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where wave='1' AND hidden!='1' AND  ((WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."')) order by type asc, id desc LIMIT 0,1;");
			 $tpl->set( '{nowname}', $potnow[name]);
			  $tpl->set( '{nowid}', $potnow[id]);
			  if(!$potnow[picture])
			  {
				   $potnow[picture]='http://nocens.ru/pics/buts/que.png';
						 }
			  			  $tpl->set( '{nowpic}', $potnow[picture]);
						
						    $tpl->set( '{nowautor}', $potnow[dj]);
							    $tpl->set( '{nowpotok}', $potnow[src]);
		 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, TIME(begin) as h1 FROM radioadmin  order by  WEEKDAY(begin) asc, TIME(begin) asc LIMIT 0,200;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
	 $weekd=233;
	 $progs="<table><tr>";
	 $k1=0;
	    while ($im = $db->get_row($fsch)){
			if($im[beg]!=$weekd)
			{
				if($k1!=0)
				{
				$progs.="</td>";
				
				}
				$k1++;
				$weekd=$im[beg];
				
				$progs.= "<td valign=\"top\" style=\"padding: 2px;\"><b>".$days[$weekd]."</b><br>";
			}if($im[type]<2)
				{
					$pl="<i>";
					$pm="</i>";
				}
				else
				{
					$pl="";
					$pm="";
				}
				$alert="";
				if($im[src]!=""&&$im[src]!="no")
				{
					$alert='<img style="margin: 0px;" title="Поток изменен на '.$im[src].'" src="http://nocens.ru/pics3/interface/lightning.png">';
				}
				$hidder="";
				if($im[hidden]=='1')
				{
					$hidder='style="opacity: 0.5;" title="Программа не вещает в настоящее время"';
				}
				if($im[wave]!='1')
				{
					$waver='('.$im[wave].' волна)';
				}
				else
				$waver="";
			$delb='<a href="http://nocens.ru/index.php?do=radio2&djbar=1&clear='.$im[id].'">[X]</a>';
			if($im[id]==$potnow[id])
			{
				$addstyle.='font-weight: bold;';	
			}
			else
			{
				$addstyle='';
			}
		$progs.='<p style="'.$addstyle.'">'.$alert.$delb.$pl."[".substr($im[h1],0,strlen($im[h1])-3)."] <a ".$hidder." href=\"http://nocens.ru/index.php?do=radio2&djbar=1&prid=".$im[id]."\">".$im[name].$pm."</a> ".$waver."</p>";
		
}
$progs.="</td></tr></table>";
  $tpl->set( '{progs}', $progs);
  if($_GET[prid])
  { $tpl->load_template( 'djbar2.tpl' );
  }
  else
  {
 $tpl->load_template( 'djbar.tpl' );
  }

     $tpl->compile( 'content' );
		$tpl->clear();
}



else if($_GET['top'])
{
	 
	include (ROOT_DIR .'/engine/api/api.class.php');
require_once ENGINE_DIR . '/classes/parse.class.php';

$parse = new ParseFilter( );
$parse->safe_mode = true;
$parse->allow_url = false;
$parse->allow_image = false;
$_TIME = time() + ($config['date_adjust'] * 60);
$name = @$db->safesql( $_GET['page'] );
if($name=="" || !$name)
{
	$name="blogs";
	
}
	 $tpl->load_template( 'Radio.tpl' );
	 $i1=1;
	 $a1[1]="ЛУЧШЕЕ";
	  $a1[6]="ИНТЕРЕСНОЕ";
	   $a1[11]="С ПИВОМ ПОТЯНЕТ";
	   	    $a1[21]="УНЫЛОЕ И НЕОЦЕНЕННОЕ";
		    $a1[31]="ТРЭШ И УГАР";
	
	 $shout='<table class="pm" cellpadding="0" cellspacing="0" width="100%"><tbody>';
	 if($_GET['system']=="1")
	 {
	  $f3 = $db->query("SELECT  `id`,`songname`, `votes`, `votes2`, (votes-votes2) as vote3 FROM radiotop   order by vote3 desc, votes desc  LIMIT 0,10 ");
	 }
	 else
	 {
		 	  $f3 = $db->query("SELECT DISTINCT a.id,b.id as prid, a.songname, a.mvotes1, a.lastmonth, a.mvotes2, a.gold, a.silver, a.bronze, a.ygold, a.ysilver, a.ybronze, a.votes, a.votes2, (a.votes-a.votes2) as vote3,(a.mvotes1-a.mvotes2) as mvotes, b.dj as name,b.picture as foto  FROM radiotop a LEFT JOIN radioadmin b ON (a.songname = b.name)  GROUP by a.songname  order by mvotes desc, lastmonth desc, vote3 desc,  a.votes desc  LIMIT 0,50 ");
	 }
	    while ($im = $db->get_row($images)){
			
			$medals="";
		
				
			for($i=0; $i<$im[ygold]; $i++)
			{
				$medals.='<img title="Лучший эфир года" align="texttop" src="http://nocens.ru/pics2/clubs/starbigg.png">';
			}
			for($i=0; $i<$im[ysilver]; $i++)
			{
				$medals.='<img   title="Выдающийся эфир года"  align="texttop" src="http://nocens.ru/pics2/clubs/starbigs.png">';
			}
			for($i=0; $i<$im[ybronze]; $i++)
			{
				$medals.='<img   title="Примечательный эфир года"  align="texttop" src="http://nocens.ru/pics2/clubs/starbigb.png">';
			}
			
			for($i=0; $i<$im[gold]; $i++)
			{
				$medals.='<img title="Лучший эфир месяца" align="texttop" src="http://nocens.ru/pics2/clubs/star2.png">';
			}
			for($i=0; $i<$im[silver]; $i++)
			{
				$medals.='<img   title="Выдающийся эфир месяца"  align="texttop" src="http://nocens.ru/pics2/clubs/star2s.png">';
			}
			for($i=0; $i<$im[bronze]; $i++)
			{
				$medals.='<img   title="Примечательный эфир месяца"  align="texttop" src="http://nocens.ru/pics2/clubs/star2b.png">';
			}
			
			if($im[votes2]<='0')
			{
				$im[votes]-=$im[votes2];
				$im[votes2]="";
			}
			else
			{
				$im[votes2]="-".$im[votes2];
			}
			
			if(($im[votes3])>200)
		{
			$sizer=28;
			
		}
		else 
		{
			$sizer=13+round(($im[vote3])/15);
		}
		
		if($sizer>22)
		{
$col="#FCCA45";
		}
		else if($sizer>18)
		{
			$col="#FDF4D5";
		}
		else
		{
			$col="#FFF";
		}
		
		if($sizer>28)
		$sizer=28;
			 
					
					if($im[foto])
		{
			  $imginfo = @getimagesize($im[foto]);
					if($imginfo[1]==0){ $imginfo[1]=100; $imginfo[0]=100;}

					$img_koeff = $imginfo[1]/$imginfo[0];
					$imgal=intval(45*$img_koeff-15);
                    $imgw=$img_koeff*45;
		$foto='<div class="ava2"><a href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[prid].'"><img  width="45"  height="'.$imgw.'"  src="'.$im[foto].'"></a></div>';
		}
		else if ($im[name])
		{
			$foto='<div class="ava2"><a href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[prid].'"><img width="45"  height="45"  src="http://nocens.ru/uploads/fotos/que.png"></a></div>';
		}
		else
		{
			$foto='<div class="ava2"><a href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[prid].'"><img title="Автор не указан" width="45"  height="45"  src="http://nocens.ru/uploads/fotos/que.png"></a></div>';
		}
		if($a1[$i1])
		{
			
			$shout.= '<tr><td colspan="5"><div class="infoinside2" style="padding-top: 10px;">'.$a1[$i1].'</div></td></tr><tr style=" background-color: #CCC; text-shadow: 0px 1px 0px rgba(255, 255, 255, 0.5);"><td width="80" class="pm_head"></td><td width="600" class="pm_head">Название передачи</td><td class="pm_head" align="center">Рейтинг (месяц)</td><td class="pm_head" align="center">Рейтинг (пред. месяц)</td><td class="pm_head" align="center">Рейтинг (всего)</td></tr>';
		}
		
		if($member_id['user_group']=='1'||$member_id['user_group']=='3')
			{
				
				$modr=' <a target="_blank" href="http://nocens.ru/index.php?do=radio&del='.$im[id].'"><img src="/pics/editnews2.png" alt="" width="25" height="20" border="0"></a>';
			}
			 if($_GET['system']!="1")
 {
//$shout.=$foto.' <span style="font-size: '.$sizer.'px; color: '.$col.'; ">'.$i1.'. <b>'.$im[songname].'</span></b> <sup> <b><font color="#DDFEDA">+'.$im[votes].'</font> <font color="#CC0000">'.$im[votes2].'</font></b></sup>'.$modr.'<div  style="clear: both;"></div>';
			$shout.='<tr><td class="pm_list">'.$foto.'</td><td class="pm_list" align="left"><h2><a style="  color: rgb(117, 117, 117); text-decoration: none;"href="http://nocens.ru/index.php?do=radio2&schedule=1&prid='.$im[prid].'">'.$i1.'. '.$im[songname].'</a> '.$modr.'</h2><a href="http://nocens.ru/index.php?user='.$im[name].'">'.$im[name].'</a> '.$medals.'<br></td><td class="pm_list"  align="center"><font color="green"><b>'.$im[mvotes].'</b></font></td><td class="pm_list"  align="center"><font color="green"><b>'.$im[lastmonth].'</b></font></td><td class="pm_list" align="center"><font color="green">'.$im[vote3].'</font></td></tr>';
 }
 else
 {
				if(strlen( $im[songname]) > 30 ) 
				{
				$im[songname] = substr( $im[songname], 0, 30);
				}
 	$shout.='<span style="font-size: 14px; color: blue; ">'.$i1.'. <b>'.$im[songname].'</span></b> <b><font color="#009900">+'.$im[votes].'</font> <font color="#CC0000">'.$im[votes2].'</font></b>';
		$shout.="<br>";
			}
		
			
			
		
			$i1++;
		}
		
 $shout.='</tbody></table>';
 if($_GET['system']=="1")
 {

$shout= ''.mb_convert_encoding('<br>'.$shout,"UTF8", "CP1251");

	 echo($shout);
 }
 else
 {

	 $i2=-1;
	  $i1=1;
	   $f3 = $db->query("SELECT  `id`, `songname`, `votes2` FROM radiotop   order by votes2 desc  LIMIT 0,50 ");
	 
	    while ($im = $db->get_row($images)){if($member_id['user_group']=='1'||$member_id['user_group']=='3')
			{
				$shout2.='<a target="_blank" href="http://nocens.ru/index.php?do=radio&del='.$im[id].'">[X]</a>';
			}
			
			$shout2.='<span style="font-size: 14px; color: red; ">-'.$i1.'. <b>'.$im[songname].'</b></span>  <font color="#CC0000"><b>-'.$im[votes2].'</b></font><br>';
			
			$i1++;
		}
	
		 $shout.="";
		 $tpl->set( '{bank}', $shout);
	 $tpl->set( '{bank2}', $shout2);
 $tpl->compile( 'content' );
  $shout="";
 }
}
else
{
   $month = mktime(date("H"), date("i"), date("s"), date("m"), date("d"),   date("Y"));

	

$nexttime = time() + 30;


   $wday=date("w")-1;
      $wdaynext= $wday+1;
	   $wdayprev= $wday-1;
   if($wday=='-1')
   $wday=6;
      if($wdaynext=='7')
   $wdaynext=0;
        if($wdayprev=='-1')
  $wdayprev=6;
	   $hday=date("H:i").":00";
$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where  (WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."') order by type asc, begin desc LIMIT 0,1;");
if($pot[src]=="no"||$pot[src]==""||!$pot[src]||$member_id[user_group]<=3)
{
if(!$_SESSION[timer]||$_SESSION[timer]<=$nexttime||$_SESSION[fl])
{

$_SESSION[fl]=$fl;
}

	else
	{
	$fl=$_SESSION[fl];
	
}
}


$f2 = file_get_contents('http://nocens.ru/radio/news2.txt');
$fh = file_get_contents('http://nocens.ru/radio/hello.txt');
if(!$_GET['from'])
{
	$from=0;
}
else
{
		$from=$_GET['from']*20;
}
$voteres = $db->super_query("SELECT * FROM radiovote order by id desc  LIMIT 0,1;");

$vot= mb_convert_encoding($voteres[name],"UTF8", "CP1251");

if($_GET['type']!="dj")
{
		    $f3 = $db->query("SELECT `id`, `autor`, `date`, `short_story`,`type`,`autorvk` FROM radiomes  order by id desc  LIMIT ".$from.",40 ");
}
else
{
	 $f3 = $db->query("SELECT  id, autor, short_story, date, type, autorvk FROM radiomes  order by id desc  LIMIT ".$from.",40 ");
}
			$i=39;
			 while ($outer= $db->get_row($row4)){
				
				 if($member_id[user_group]<4)
				 {
					 $moder=' <a target="_blank" href="http://nocens.ru/index.php?do=radio2%26delmes='.$outer[id].'">[X]</a>';
				 }
				 	$dat=date("H:i", strtotime($outer['date']));
					if($outer[autor]=="Гость"&&$outer[autorvk]&&$outer[autor]!="0")
				 {
				$at=' <font color="#666666"><b>['.$outer[autorvk].']</b></font> ';
				 }
				 else if($outer[autor]=="Гость")
				 {
				$at=' <font color="#666666"><b>['.$outer[autor].']</b></font> ';
				 }
				 else
				 {
			$at='<b><a target="_blank" href="http://nocens.ru/index.php?info='.$outer[autor].'"> ['.$outer[autor].']</a></b> ';
				 }
				 
					if($outer[type]=='100500'||$outer[type]=='0')
			 {
			 $n[$i]="<br/>"."".$dat.''.$at.'';
			 }
			 else
			 {
				  $n[$i]="<br>"."<img align=\"right\" width=\"20\" height=\"20\" src=\"http://nocens.ru/pics/status/p".$outer[type].".png\">".$dat.''.$at.'';
			 }
			  $n2[$i]= str_replace ("&", "%26",$outer[short_story]);
	  $n2[$i]= stripslashes(str_replace ("<p>", " ",$n2[$i])).$moder."";
			  $i--;
			
			 }
			 
			 for($i=0;$i<41;$i++)
			 {
				 $chat.='&autor'.$i.'='.$n[$i].'&txtel'.$i.'='.$n2[$i];
			 }
			
function utf8_convert($str, $type)
{
   static $conv = '';
   if (!is_array($conv))
   {
      $conv = array();
      for ($x=128; $x <= 143; $x++)
      {
         $conv['utf'][] = chr(209) . chr($x);
         $conv['win'][] = chr($x + 112);
      }
      for ($x=144; $x<= 191; $x++)
      {
         $conv['utf'][] = chr(208) . chr($x);
         $conv['win'][] = chr($x + 48);
      }
      $conv['utf'][] = chr(208) . chr(129);
      $conv['win'][] = chr(168);
      $conv['utf'][] = chr(209) . chr(145);
      $conv['win'][] = chr(184);
   }
   if ($type == 'w')
   {
      return str_replace($conv['utf'], $conv['win'], $str);
   }
   elseif ($type == 'u')
   {
      return str_replace($conv['win'], $conv['utf'], $str);
   }
   else
   {
      return $str;
   }
}
$chat= mb_convert_encoding($chat,"UTF8", "CP1251");


function rus($str){
$nstr="";
for($i=0;$i<strlen($str);++$i){
$symbol=substr($str,$i,1);
$asci=ord($symbol);
  if($asci<128) {
  $nstr.=$symbol;
  }elseif($asci>191 and $asci<256){
    $nstr.="&#".(string)(848+ord($symbol)).';';
    } else {
      $nstr.=$symbol;
      }
     }
     return $nstr;
     }

if ($member_id[user_group]!=5)
{
	$fotka=$member_id[foto];
	$panel=$member_id[name];
		$panel= mb_convert_encoding($panel,"UTF8", "CP1251");

}
else
{
		$panel="no";
}
if (($member_id[user_group]<4)&&preg_match('#<td>Current Listeners:<\/td>\n<td class=\"streamdata\">(.*)<\/td>#Ui',$fl,$m)) {
$radio = "1Subcultural";
$cur=  "";
}
$n1="";
if (($pot[src]=="no"||$pot[src]==""||!$pot[src])&&preg_match('#<td>Current Song:<\/td>\n<td class=\"streamdata\">(.*)<\/td>#Ui',$fl,$m)) {
$song = $m[1];


$vowels = array("&amp","&","(", ")", ";", ",");	
 $song= mb_convert_encoding($song,mb_detect_encoding($song , "CP1252"), "UTF8");
$song= mb_convert_encoding($song,"UTF8", "CP1251");
$song = str_replace ($vowels, " ", $song);


if (preg_match('#<td>Stream Title:<\/td>\n<td class=\"streamdata\">(.*)<\/td>#Ui',$fl,$m)) {
$radio = "Underground TimeZero";
$dj= "1Subcultural";
$dj= mb_convert_encoding($dj,"UTF8", "CP1251");
}
else
{
	$radio = "no";
}
if($pot[name]=="no"||$pot[name]==""||!$pot[name])
{
//$url="http://radlo.listen.moeradio.ru:10000/radlo";
	 $n1=date("H").":".date("i");
}
else
{

		$song=mb_convert_encoding($pot[name],"UTF8", "CP1251");
		
}
if($pot[src]=="no"||$pot[src]==""||!$pot[src])
{
}
else
{
	$url=$pot[src];
}
$inbox=$member_id[pm_unread];
echo "date={$n1}&radio={$radio}&inbox={$inbox}&dj={$dj}&song={$song}&way={$url}&alt={$url}&panel={$panel}&foto={$fotka}&logo={$fh}&news={$cur}{$f2}{$chat}&vote={$vot}";
} else {
	$dj="1Subcultural";
	$url="http://sssradio.ru:88/cccp-128";
	$inbox=$member_id[pm_unread];
	if($pot[name]=="no"||$pot[name]==""||!$pot[name])
{
	$song= mb_convert_encoding("Музыка нон-стоп","UTF8", "CP1251");}
	else
	{
		$song= mb_convert_encoding($pot[name],"UTF8", "CP1251");
		
	}
	if($pot[src]=="no"||$pot[src]==""||!$pot[src])
{
}
else
{
	$url=$pot[src];
}
if ($member_id[user_group]<4) {

$cur1=  "";
}
	$f2= mb_convert_encoding("<a target=\"_blank\" href=\"http://sssradio.ru/Archive.aspx?cat=6\"><img src=\"http://nocens.ru/radio/radiologo2.png\"></a>","UTF8", "CP1251").$cur1;
echo "song={$song}&date={$n1}&inbox={$inbox}&dj={$dj}&radio=no&way={$url}&panel={$panel}&foto={$fotka}&logo={$fh}&news={$cur}{$f2}{$chat}&vote={$vot}";
}



if (preg_match('#<td>Content Type\:<\/td><td class=\"streamdata\">(.*)<\/td>#Ui',$fl,$m)) {
$url = $m[1];
}
}

	
	
?>