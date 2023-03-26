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
 Файл: index.php
-----------------------------------------------------
 Назначение: Главная страница
=====================================================
*/
@session_start ();
@ob_start ();
@ob_implicit_flush ( 0 );

@error_reporting ( E_ALL ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_NOTICE );

define ( 'DATALIFEENGINE', true );

$member_id = FALSE;
$is_logged = FALSE;

define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );

/*if(!$_GET[system]&&($_SESSION[timer]&&time()-$_SESSION[timer]<=0.1))
{
	$output='<html><head> 
<meta http-equiv="content-type" content="text/html; charset=windows-1251"/></head><body> <p>D-Arts AntiSpam error: слишком много запросов за короткий промежуток времени.</p></body></html>';
	echo($output);
	
	exit;
	
}
else if(!$_GET[system])
{
	$_SESSION[timer]=time();
}

*/
require_once ROOT_DIR . '/engine/init.php';
require_once ENGINE_DIR . '/chat/chat_block.php';

require_once ROOT_DIR.'/engine/forum/sources/modules/show.last.php';
if (clean_url ( $_SERVER['HTTP_HOST'] ) != clean_url ( $config['http_home_url'] )) {

        $replace_url = array ();
        $replace_url[0] = clean_url ( $config['http_home_url'] );
        $replace_url[1] = clean_url ( $_SERVER['HTTP_HOST'] );

} else
        $replace_url = false;

if($_GET['system']!="1")
{
$tpl->load_template ( 'main.tpl' );


$tpl->set ( '{calendar}', $tpl->result['calendar'] );
$tpl->set ( '{archives}', $tpl->result['archive'] );
$tpl->set ( '{tags}', $tpl->result['tags_cloud'] );
$tpl->set ( '{vote}', $tpl->result['vote'] );
$tpl->set ( '{topnews}', $topnews );
$tpl->set ( '{topnews2}', $topnews2 );
$tpl->set ( '{topnews3}', $topnews3 );
$tpl->set ( '{bestnews}', $bestnews );
$tpl->set ( '{bestnews}', $bestnews );
$tpl->set ( '{cool}', $finfo );
$tpl->set ( '{bd3}', $calen );
}
if($is_logged) {
$ti = dle_cache("last_time_news", $member_id['user_id']);
if($ti === FALSE) {
$l = date( "Y-m-d H:i:s", $_SESSION['member_lasttime'] );
$th = date ( "Y-m-d H:i:s", $_TIME );

$t = $db->super_query("SELECT COUNT(id) as count FROM ".PREFIX."_post WHERE date between '$l' and '$th' AND approve = '1'");
$ti = $t['count'];
create_cache("last_time_news", $ti, $member_id['user_id']);
}
if($ti>1&&$ti<5)
{
$tpl->set ( '{last_time_news}', "<a href=\"http://nocens.ru/index.php?subaction=newposts\">$ti новые записи »</a>" );
}
else if($ti==1)
{
$tpl->set ( '{last_time_news}', "<a href=\"http://nocens.ru/index.php?subaction=newposts\">Одна новая запись »</a>" );
}
else if($ti==0)
{
$tpl->set ( '{last_time_news}', "Нет новых записей");
}
else 
{
	$tpl->set ( '{last_time_news}', "<a href=\"http://nocens.ru/index.php?subaction=newposts\">$ti новых записей »</a>" );
}
} else {
$tpl->set ( '{last_time_news}', "" );
}
$tpl->set ( '{login}', $login_panel );
$tpl->set ( '{info}', "<div id='dle-info'>" . $tpl->result['info'] . "</div>" );
$tpl->set ( '{speedbar}', $tpl->result['speedbar'] );
$tpl->set ( '{chat_block}', $tpl->result['chat_block'] );

$tpl->set('{category}', $tpl->result['category']);
$tpl->set('{cash}',  $member_id['cash']);
$tpl->set ( '{lastcomments}', $lastcomments_block );
$tpl->set('{forum}', $tpl->result['forum_table']);
if ($config['allow_skin_change'] == "yes") $tpl->set ( '{changeskin}', ChangeSkin ( ROOT_DIR . '/templates', $config['skin'] ) );

if (count ( $banners ) and $config['allow_banner']) {

        foreach ( $banners as $name => $value ) {
                $tpl->copy_template = str_replace ( "{banner_" . $name . "}", $value, $tpl->copy_template );
        }

}

$tpl->set_block ( "'{banner_(.*?)}'si", "" );

if (count ( $informers ) and $config['rss_informer']) {
        foreach ( $informers as $name => $value ) {
                $tpl->copy_template = str_replace ( "{inform_" . $name . "}", $value, $tpl->copy_template );
        }
}

if ($allow_active_news AND $config['allow_change_sort'] AND !$config['ajax'] AND $do != "userinfo") {

        $tpl->set ( '[sort]', "" );
        $tpl->set ( '{sort}', news_sort ( $do ) );
        $tpl->set ( '[/sort]', "" );

} else {

        $tpl->set_block ( "'\\[sort\\](.*?)\\[/sort\\]'si", "" );

}

if ($dle_module == "showfull" ) {

        if (is_array($cat_list) AND count($cat_list) > 1 ) $category_id = implode(",", $cat_list);

}

if (strpos ( $tpl->copy_template, "[category=" ) !== false) {
        $tpl->copy_template = preg_replace ( "#\\[category=(.+?)\\](.*?)\\[/category\\]#ies", "check_category('\\1', '\\2', '{$category_id}')", $tpl->copy_template );
}

if (strpos ( $tpl->copy_template, "[not-category=" ) !== false) {
        $tpl->copy_template = preg_replace ( "#\\[not-category=(.+?)\\](.*?)\\[/not-category\\]#ies", "check_category('\\1', '\\2', '{$category_id}', false)", $tpl->copy_template );
}

if (strpos ( $tpl->copy_template, "{custom" ) !== false) {
        $tpl->copy_template = preg_replace ( "#\\{custom category=['\"](.+?)['\"] template=['\"](.+?)['\"] aviable=['\"](.+?)['\"] from=['\"](.+?)['\"] limit=['\"](.+?)['\"] cache=['\"](.+?)['\"]\\}#ies", "custom_print('\\1', '\\2', '\\3', '\\4', '\\5', '\\6', '{$dle_module}')", $tpl->copy_template );
}

$config['http_home_url'] = explode ( "index.php", strtolower ( $_SERVER['PHP_SELF'] ) );
$config['http_home_url'] = reset ( $config['http_home_url'] );

if (! $user_group[$member_id['user_group']]['allow_admin']) $config['admin_path'] = "";

$ajax .= <<<HTML
<script language="javascript" type="text/javascript">
<!--
var dle_root       = '{$config['http_home_url']}';
var dle_admin      = '{$config['admin_path']}';
var dle_login_hash = '{$dle_login_hash}';
var dle_skin       = '{$config['skin']}';
var dle_wysiwyg    = '{$config['allow_comments_wysiwyg']}';
var quick_wysiwyg  = '{$config['allow_quick_wysiwyg']}';
var menu_short     = '{$lang['menu_short']}';
var menu_full      = '{$lang['menu_full']}';
var menu_profile   = '{$lang['menu_profile']}';
var menu_fnews     = '{$lang['menu_fnews']}';
var menu_fcomments = '{$lang['menu_fcomments']}';
var menu_send      = '{$lang['menu_send']}';
var menu_uedit     = '{$lang['menu_uedit']}';
var dle_req_field  = '{$lang['comm_req_f']}';
var dle_del_agree  = '{$lang['news_delcom']}';
var dle_del_news   = '{$lang['news_delnews']}';\n
HTML;

if ($user_group[$member_id['user_group']]['allow_all_edit']) {

        $ajax .= <<<HTML
var allow_dle_delete_news   = true;\n
HTML;

} else {

        $ajax .= <<<HTML
var allow_dle_delete_news   = false;\n
HTML;

}

$ajax .= <<<HTML
//-->
</script>
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/menu.js"></script>
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/dle_ajax.js"></script>
<div id="loading-layer" style="display:none;font-family: Verdana;font-size: 11px;width:200px;height:50px;background:#FFF;padding:10px;text-align:center;border:1px solid #000"><div style="font-weight:bold" id="loading-layer-text">{$lang['ajax_info']}</div><br /><img src="{$config['http_home_url']}engine/ajax/loading.gif"  border="0" alt="" /></div>
<div id="busy_layer" style="visibility: hidden; display: block; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; background-color: gray; opacity: 0.1; -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=10)'; filter:progid:DXImageTransform.Microsoft.Alpha(opacity=10); "></div>
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/js_edit.js"></script>
HTML;

if ($allow_comments_ajax AND ($config['allow_comments_wysiwyg'] == "yes" OR $config['allow_quick_wysiwyg'])) $ajax .= <<<HTML

<script type="text/javascript" src="{$config['http_home_url']}engine/editor/jscripts/tiny_mce/tiny_mce.js"></script>

HTML;

if (strpos ( $tpl->result['content'], "hs.expand" ) !== false or strpos ( $tpl->copy_template, "hs.expand" ) !== false or $config['ajax'] or $pm_alert != "") {

        if ($config['thumb_dimming'] AND !$pm_alert) $dimming = "hs.dimmingOpacity = 0.60;"; else $dimming = "";

        if ($config['thumb_gallery'] AND !$pm_alert) {

        $gallery = "
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.addSlideshow({
                interval: 4000,
                repeat: false,
                useControls: true,
                fixedControls: 'fit',
                overlayOptions: {
                        opacity: .75,
                        position: 'bottom center',
                        hideOnMouseOut: true
                }
        });";

        } else {

                $gallery = "";

        }


        $ajax .= <<<HTML

<script type="text/javascript" src="{$config['http_home_url']}engine/classes/highslide/highslide.js"></script>
<script language="javascript" type="text/javascript">
<!--
        hs.graphicsDir = '{$config['http_home_url']}engine/classes/highslide/graphics/';
        hs.outlineType = 'rounded-white';
        hs.numberOfImagesToPreload = 0;
        hs.showCredits = false;
        {$dimming}
        hs.lang = {
                loadingText :     '{$lang['loading']}',
                playTitle :       '{$lang['thumb_playtitle']}',
                pauseTitle:       '{$lang['thumb_pausetitle']}',
                previousTitle :   '{$lang['thumb_previoustitle']}',
                nextTitle :       '{$lang['thumb_nexttitle']}',
                moveTitle :       '{$lang['thumb_movetitle']}',
                closeTitle :      '{$lang['thumb_closetitle']}',
                fullExpandTitle : '{$lang['thumb_expandtitle']}',
                restoreTitle :    '{$lang['thumb_restore']}',
                focusTitle :      '{$lang['thumb_focustitle']}',
                loadingTitle :    '{$lang['thumb_cancel']}'
        };
        {$gallery}
//-->
</script>
{$pm_alert}
HTML;

}
$logo = date ( "H", $_TIME );
if($logo>=17&&$logo<22)
{
$logo=2;
}
else if($logo>0&&$logo<5)
{
$logo=5;
}
else if($logo>7&&$logo<17)
{
$logo=3;
}
else 
{$logo=1;
}

$tpl->set ( '{logo}', $logo );
$tpl->set ( '{AJAX}', $ajax );
$tpl->set ( '{headers}', $metatags );

if($member_id['pm_unread']>0)
{
$pms='<div style="position: absolute; margin-top: 30px; float: left"><a href="http://nocens.ru/index.php?do=pm&doaction=inbox"><img border="0" src="http://nocens.ru/pics/newpm.gif"></a></div>';
}
if($member_id['user_group']==5)
{
$nk1='<div class="ava2"><a href="http://nocens.ru/index.php?do=register"><img src="http://nocens.ru/pics/buts/que.png" width="45" height="45" /></a></div>';
}
else
{
$nk1='<div class="ava2">'.$pms.'<div style="position: absolute; margin-top: 30px; margin-left: 30px; float: left"><img src="http://nocens.ru/pics/status/p'.$member_id['game2'].'.png"></div><a  href="http://nocens.ru/index.php?subaction=userinfo&user='.$member_id['name'].'"><img title="Профайл и настройки" src="http://nocens.ru/uploads/fotos/'.$member_id['foto'].'" width="45" height="45" /></a></div>';
}
$tpl->set ( '{person}', $nk1 );
$tpl->set ( '{content}', "<div id='dle-content'>" . $tpl->result['content'] . "</div>" );
$th1 = date ( "Y-m-d", $_TIME );
    $birthdate_array = explode('-',$th1);
    $birth_y = $birthdate_array[0];
    $birth_m = $birthdate_array[1];
    $birth_d = $birthdate_array[2];


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
$pot = $db->super_query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where (WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."') order by type asc LIMIT 0,1;");
 $showadd='  <a href="http://nocens.ru/radio"><div class="enterline2" style=""><div style="padding-top: 10px; padding-left: 50px;">На радио: <b>'.$pot[name].'</b></div></div></a>';
$tpl->set( '{radlo}',  $showadd);

/* ФЛОППЕР */
$game=strip_tags($member_id[game]);
 if($member_id['cash']>=100)
 {$addstatus="<option value=\"5\">Эмо</option><option value=\"6\">Кавай</option><option value=\"7\">Фурри</option><option value=\"8\">Патриот</option><option value=\"9\">TimeZero</option><option value=\"10\">Деньги</option><option value=\"11\">Ярость</option><option value=\"12\">Важное событие</option><option value=\"13\">Квашу</option>";
 }
 else
 {$addstatus="";
 }
 if($member_id['user_group']!=5)
 {
$gog='<p style="padding-top: 5px;"> <input name="addblog" type="checkbox" value="yes" checked="checked" /> <span style="border-bottom: 1px #F00 dashed;">В блог</span>  <input name="addstat" type="checkbox" value="yes" /> <span style="border-bottom: 1px #F00 dashed;">В статус</span></p>';
 $tpl->set( '{nastr}', stripslashes( "".$row['game']."<select style =\"margin-left: 2px; width: 130px; height:21px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#999;  background-color:#FFF; \" name=\"game2\" selected=\"selected\"><option value=\"".$member_id['game2']."\">...</option><option value=\"0\">Пусто</option><option value=\"1\">Радость</option><option value=\"2\">Печаль</option><option value=\"3\">Любовь</option><option value=\"4\">Думы</option>".$addstatus."
</select> <input style=\"width: 470px; height:15px; padding: 2px; padding-right: 20px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#999;  background-color:#FFF;\" value=\"Что интересного?\" onfocus=\"if(this.value == 'Что интересного?')this.value = ''\"; maxlength=\"550\" type=\"text\" name=\"game\" value=\"".$val."\"   class=\"f_input\" />".$gog."" ) );
 $tpl->set( '{nastrmob}', stripslashes( "".$row['game']."<select style =\"margin-left: 2px; width: 100px; border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF; \" name=\"game2\" selected=\"selected\"><option value=\"".$member_id['game2']."\">...</option><option value=\"0\">Пусто</option><option value=\"1\">Радость</option><option value=\"2\">Печаль</option><option value=\"3\">Любовь</option><option value=\"4\">Думы</option>".$addstatus."
</select> <input style=\"width: 200px;  border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF;\" maxlength=\"550\" type=\"text\" name=\"game\" value=\"".$val."\"   class=\"f_input\" />".$gog."" ) );
$tpl->set('{stat}',"<input type=\"image\" class=\"buttons\" style=\"width:20px; height:20px; border:0\"  value=\" Загрузить \" src=\"http://nocens.ru/pics/subm.png\" align=\"bottom\">");

$tpl->set('{stat2}',"<img width=\"15\" height=\"15\" src=\"http://nocens.ru/pics/status/p".$member_id['game2'].".png\" align=\"baseline\">");
$tpl->set('{statmob}',"<input  type=\"submit\" value=\"Отправить\" style=\"background-color:#F00; border: 0px;\" >");
}
else
{
$tpl->set( '{stat}', "");
 $tpl->set( '{nastrmob}', "");
 $tpl->set('{nastr}','<p align="center"><i><a href="http://nocens.ru/index.php?do=register">Зарегистрируйтесь</a> или зайдите за себя, чтобы оставлять сообщения.</i></p>');
 $tpl->set('{stat2}',"");
 $tpl->set('{statmob}',"");
}
function makeClickableLinks($text) { 

 $text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', 
   '<a href="\\1">\\1</a>', $text); 
 $text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', 
   '\\1<a href="http://\\2">\\2</a>', $text); 
 $text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})', 
   '<a href="mailto:\\1">\\1</a>', $text); 
  
return $text; 

}
function makeClickableLinks2($text) { 

$text = preg_replace('#(^|[\n ])((http|https|ftp|ftps)://[\w\#$%&~/.\-;:=,?@\[\]\(\)+]*)#sie', "'\\1<a href=\"'.trim('\\2').'\" target=\"_blank\" title=\"autolink\">'.'\\2'.(strlen('\\2')>30?substr('\\2', strlen('\\2')-10, strlen('\\2')):'').'</a>'", $text);

  
return $text; 

}

if($_GET['newtags']&&$member_id[user_group]<3)
{

  $file = fopen ("info.txt","w");
  $str = $_GET['newtags'];
  if ( !$file )
  {
    echo("Ошибка открытия файла");
  }
  else
  {
    fputs ( $file, $str);
  }
  fclose ($file);
}

  if($_REQUEST['action']&&$member_id['user_group']!=5&&$_POST['game2']!=""&&$_POST['game']!="Что интересного?")
				  { 
           
      require_once ENGINE_DIR . '/classes/parse.class.php';          
$parse = new ParseFilter( );
$parse->safe_mode = true;
                  $game=$_POST['game'];
                  $game2=$_POST['game2'];
                  $addblog=$_POST['addblog'];
                   $addstat=$_POST['addstat'];
                  $game=makeClickableLinks2($parse->BB_Parse( $parse->process($game)));
                  $game=addslashes($game);
                  
                  if($_POST['nid'])
                  {
                  $nid=$_POST['nid'];
                  
                  }
                  else
                  {
                  $nid='0';
                 }
                  if($member_id['user_group']!=5){
               
                
                  	$time = date( "Y-m-d H:i:s", $_TIME );
                    if($game!=$member_id[game]){
                    if($nid)
                    {
                   
                    $infis = $db->super_query( "SELECT a.ufrom, b.user_id, b.wall_subscr FROM " . PREFIX . "_flopper a, " . PREFIX . "_users b WHERE a.id='$nid' and b.name=a.ufrom" );
                    $uto=$infis[ufrom];
                    if($infis['wall_subscr'])
                    {
                    
                    $subj="Вам ответили на Flopper";
                     $time1 = time() + ($config['date_adjust'] * 60);
                    $comments='Пользователь '.$member_id[name].' ответил на ваше сообщение в <a href="http://nocens.ru/index.php?do=flopper&list&user='.$uto.'">Флоппере</a>.';
                    	$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$subj', '$comments', '$infis[user_id]', '$member_id[name]', '$time1', 'no', 'inbox')" );
			$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$infis[user_id]'" );
            }
                    }
                    else if($addstat=="yes")
                    {
                    $uto=0; 
                   
                    $db->query( "UPDATE " . USERPREFIX . "_users set game='$game', game2='$game2' where name='$member_id[name]'" );
                    }

            
$added_time = time() + ($config['date_adjust'] * 60);
$thistime = date( "Y-m-d H:i:s", $added_time );
$a1[0]="Сообщение от";
$a1[1]="Позитив от";
$a1[2]="Негатив от";
$a1[3]="Любовное послание от";
$a1[4]="Размышление от";
$a1[5]="Депресняк от";
$a1[6]="Кавайчик от";
$a1[7]="Фурревость от";
$a1[8]="Патриотический пост от";
$a1[9]="Задротство от";
$a1[10]="Экономический обзор от";
$a1[11]="Несдержанность от";
$a1[12]="Оповещение от";
$a1[13]="Закваска от";

$title=$a1[$game2]." ".$member_id[name]; 

$counts = $db->super_query("SELECT count(*) as cnt from dle_post where title like '$title%'");
if($counts[cnt]>0)
{
$title=$title." №".$counts[cnt];

}
$category_list="35";
$alt_name="";
$allow_comm=1;
$approve=1;
if($member_id['user_group']==1 || $member_id['user_group']==2)
{
$allow_main=0;
}
else
{
$allow_main=0;
}
$news_fixed=0;
$allow_rating=1;
$allow_br=0;
$short_story="<img src=\"http://nocens.ru/pics/status/p".$game2.".png\" align=\"absmiddle\"> ".$game."";
$type=$game2;

if($_POST['game']!=""&&$addblog=="yes")
{


            	$db->query( "INSERT INTO " . PREFIX . "_post (date, autor, short_story, full_story, xfields, title, keywords, category, alt_name, allow_comm, approve, allow_main, fixed, allow_rate, allow_br, flag, tags, type) values ('$thistime', '$member_id[name]', '$short_story', '', '', '$title', '', '$category_list', '$alt_name', '$allow_comm', '$approve', '$allow_main', '$news_fixed', '$allow_rating', '$allow_br', '1', '" . $_POST['tags'] . "', '$type')" );
                $short=$title;
                $db->query( "UPDATE " . USERPREFIX . "_users set news_num=news_num+1,  cash=cash+50 where user_id='$member_id[user_id]'" );
                $time = date( "Y-m-d H:i:s", $_TIME );
                	$link='добавил <b><a href="http://nocens.ru/index.php?do=blogs&user='.$member_id[name].'">'.$title.'</a></b>';
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '0', '$link', '$time', 'news')" );
			
                $row['id'] = $db->insert_id();
            $link='<b><a href="http://nocens.ru/index.php?do=flopper&list&user='.$member_id[name].'">'.$game.'</a></b>';
           clear_cache();
           $tpl->compile( 'content' );
		$tpl->clear();
}
            }  else if($addstat=="yes")
                {
                  $db->query( "UPDATE " . USERPREFIX . "_users set game2='$game2' where name='$member_id[name]'" );
                }
                     header("Location: http://nocens.ru/index.php?do=blogs&user=my");
                }
              
				   }
             
$todate = date ( "d", $_TIME );

$q[1]="января"; 
$q[2]="февраля"; 
$q[3]="марта"; 
$q[4]="апреля"; 
$q[5]="мая";
$q[6]="июня"; 
$q[7]="июля"; 
$q[8]="августа"; 
$q[9]="сентября"; 
$q[10]="октября"; 
$q[11]="ноября";
$q[12]="декабря";

$todate.= " ".$q[date ( "m", $_TIME )*1];
$tpl->set ( '{todate}', $todate);


//perks

function linker($a1, $ids)
{
$outing["blog"]="http://nocens.ru/index.php?do=blogs&user=my";
$outing["creo"]="http://nocens.ru/index.php?do=creo&user=my";
$outing["pic"]="http://nocens.ru/index.php?do=album&user=".$ids;
$outing["addnews"]="http://nocens.ru/index.php?do=addnews";
$outing["addpict"]="http://nocens.ru/index.php?do=gallery&addimage";
$outing["dem"]="http://nocens.ru/index.php?do=demotivater";
$outing["textmes"]="http://nocens.ru/index.php?do=pm&doaction=newpm";
$outing["rating"]="http://nocens.ru/index.php?do=stats";
$outing["blogs"]="http://nocens.ru/bl";
$outing["creos"]="http://nocens.ru/public";
$outing["pics"]="http://nocens.ru/index.php?do=gallery";
$outing["radio"]="http://nocens.ru/radio";
$outing["forum"]="http://nocens.ru/index.php?do=forum";

if($outing[$a1])
{
$out=$outing[$a1];
}
else
$out=$a1;
return $out;
}


if($_SESSION[perkpanel]&&$member_id[user_group]!=5)
{
$perkpanel=$_SESSION[perkpanel];
}
else
{
  $rowperks = $db->super_query("SELECT * from dle_perks where id='$member_id[user_id]'");
  if(!$rowperks&&$member_id[user_group]!=5)
  {
	  	$db->query( "INSERT INTO dle_perks (id) values ('$member_id[user_id]')" );
		  echo("Перкпанель добавлена. Обновите страницу.");
          	header("Location: http://nocens.ru/index.php"); 
  }
  else if($member_id[user_group]==5)
  {
    $perkpanel= '<div class="ava2"><a href="http://nocens.ru/index.php?do=stats"><img title="Рейтинги" src="/pics/info/ava1.png" width="45" height="45" /></a></div><div class="ava2"><a href="http://nocens.ru/radio"><img title="Радио TimeZero" src="/pics/info/ava3.png" width="45" height="45" /></a></div><div class="ava2"><a href="http://nocens.ru/index.php?do=forum&amp;showforum=21"><img title="Терезы" src="/pics/info/ava4.png" width="45" height="45" /></a></div><div class="ava2"><a href="http://nocens.ru/index.php?do=demotivater"><img src="/pics/info/ava2.png" width="45" height="45" border="0" title="Добавить демотиватор" /></a></div>';
  }
  else
  {
  
  $perkpanel="";
   $imginfo = @getimagesize("http://nocens.ru/uploads/fotos/" . $member_id['foto']);
					if($imginfo[1]==0) $imginfo[1]=1;
					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=intval(45*$img_koeff-15);

  for($i=1;$i<9;$i++)
		{ 
        
       $link=linker($rowperks['link'.$i], $member_id[user_id]);
       $a1=$rowperks['link'.$i];
      
$outing["blog"]="<img title=\"Мой блог\" src=\"http://nocens.ru/uploads/fotos/".$member_id[foto]."\"  width=\"".(45*$img_koeff)."\" height=\"45\"  >";
$podpic["blog"]='<div style="position: absolute; margin-top: 30px; margin-left: 30px; float: left"><img src="http://nocens.ru/pics/linkinf1.png"></div>';
$outing["creo"]="<img title=\"Мои креативы\" src=\"http://nocens.ru/uploads/fotos/".$member_id[foto]."\" width=\"".(45*$img_koeff)."\" height=\"45\">";
$podpic["creo"]='<div style="position: absolute; margin-top: 30px; margin-left: 30px; float: left"><img src="http://nocens.ru/pics/linkinf2.png"></div>';
$outing["pic"]="<img title=\"Моя галерея\" src=\"http://nocens.ru/uploads/fotos/".$member_id[foto]."\" width=\"".(45*$img_koeff)."\" height=\"45\">";
$podpic["pic"]='<div style="position: absolute; margin-top: 30px; margin-left: 30px; float: left"><img src="http://nocens.ru/pics/linkinf3.png"></div>';
$outing["addnews"]="<img title=\"Добавить публикацию\" src=\"http://nocens.ru/pics/linkinf1add.png\" width=\"45\" height=\"45\">";
$outing["addpict"]="<img title=\"Добавить картинку\" src=\"http://nocens.ru/pics/linkinf3add.png\" width=\"45\" height=\"45\">";
$outing["dem"]="<img title=\"Сделать демотиватор\" src=\"http://nocens.ru/pics/info/ava2.png\" width=\"45\" height=\"45\">";
$outing["textmes"]="<img title=\"Отправить сообщение юзеру\" src=\"http://nocens.ru/pics/ach/act1.png\" width=\"45\" height=\"45\">";
$outing["rating"]="<img title=\"Рейтинг\" src=\"http://nocens.ru/pics/info/ava1.png\" width=\"45\" height=\"45\">";
$outing["blogs"]="<img title=\"Все блоги\" src=\"http://nocens.ru/pics/linkinf1b.png\" width=\"45\" height=\"45\">";
$outing["creos"]="<img title=\"Все креативы\" src=\"http://nocens.ru/pics/linkinf2b.png\" width=\"45\" height=\"45\">";
$outing["pics"]="<img title=\"Все картинки\" src=\"http://nocens.ru/pics/linkinf3b.png\" width=\"45\" height=\"45\">";
$outing["radio"]="<img title=\"Радио\" src=\"http://nocens.ru/pics/info/ava3.png\" width=\"45\" height=\"45\">";
$outing["forum"]="<img title=\"Форум\" src=\"http://nocens.ru/pics/info/ava4.png\" width=\"45\" height=\"45\">";

if($outing[$a1])
{
$out=$outing[$a1];
$pod=$podpic[$a1];
}
else
{
$out="<img title=\"Ссылка\" src=\"http://nocens.ru/pics/cens.png\" width=\"45\" height=\"45\">";
$pod='';
}

       if($link==""||$link=="no")
       {
       }
       else
           $perkpanel.='<div class="ava2">'.$pod.'<a href="'.$link.'">'.$out.'</a></div>';
         }
  
      
  }
  if($member_id[user_group]!=5)
  {
  $_SESSION[perkpanel]=$perkpanel;
  }
  else
  {
  !$_SESSION[perkpanel];
  }
 }
 

$tpl->set ( '{perkpanel}',  $perkpanel);





$tpl->compile ( 'main' );
$tpl->result['main'] = str_replace ( '{THEME}', $config['http_home_url'] . 'templates/' . $config['skin'], $tpl->result['main'] );
if ($replace_url) $tpl->result['main'] = str_replace ( $replace_url[0]."/", $replace_url[1]."/", $tpl->result['main'] );

# !!!включаем PHP в шаблонах
eval (' ?' . '>' . $tpl->result['main'] . '<' . '?php ');
#echo $tpl->result['main'];
$tpl->global_clear ();
$db->close ();



GzipOut ();
?>