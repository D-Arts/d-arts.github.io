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
=====================Х================================
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
$_PROXY = getenv('HTTP_X_FORWARDED_FOR');

define ( 'ROOT_DIR', dirname ( __FILE__ ) );
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );


     if (!defined('_SAPE_USER')){
        define('_SAPE_USER', 'f81fbf500f6ffd93e95f4d1870c7b9ae'); 
     }
	 
     require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'); 
     $sape = new SAPE_client();


$pos = strpos($_SERVER['QUERY_STRING'], "dle_users");
if ($pos !== false) {
	exit;
}

if($_GET[embed])
{
	
	
		$add="w";
		$dark="vk";
}

if($_GET[system]!='1'){
//	require_once ROOT_DIR. '/engine/modules/antiddos.php';

}

//АВТОВЫБОР ЯЗЫКА
$aLanguages = array(
    'aa' => 'Afar',
    'ab' => 'Abkhaz',
    'ae' => 'Avestan',
    'af' => 'Afrikaans',
    'ak' => 'Akan',
    'am' => 'Amharic',
    'an' => 'Aragonese',
    'ar' => 'Arabic',
    'as' => 'Assamese',
    'av' => 'Avaric',
    'ay' => 'Aymara',
    'az' => 'Azerbaijani',
    'ba' => 'Bashkir',
    'be' => 'Belarusian',
    'bg' => 'Bulgarian',
    'bh' => 'Bihari',
    'bi' => 'Bislama',
    'bm' => 'Bambara',
    'bn' => 'Bengali',
    'bo' => 'Tibetan Standard, Tibetan, Central',
    'br' => 'Breton',
    'bs' => 'Bosnian',
    'ca' => 'Catalan; Valencian',
    'ce' => 'Chechen',
    'ch' => 'Chamorro',
    'co' => 'Corsican',
    'cr' => 'Cree',
    'cs' => 'Czech',
    'cu' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
    'cv' => 'Chuvash',
    'cy' => 'Welsh',
    'da' => 'Danish',
    'de' => 'German',
    'dv' => 'Divehi; Dhivehi; Maldivian;',
    'dz' => 'Dzongkha',
    'ee' => 'Ewe',
    'el' => 'Greek, Modern',
    'en' => 'English',
    'eo' => 'Esperanto',
    'es' => 'Spanish; Castilian',
    'et' => 'Estonian',
    'eu' => 'Basque',
    'fa' => 'Persian',
    'ff' => 'Fula; Fulah; Pulaar; Pular',
    'fi' => 'Finnish',
    'fj' => 'Fijian',
    'fo' => 'Faroese',
    'fr' => 'French',
    'fy' => 'Western Frisian',
    'ga' => 'Irish',
    'gd' => 'Scottish Gaelic; Gaelic',
    'gl' => 'Galician',
    'gn' => 'GuaranA­',
    'gu' => 'Gujarati',
    'gv' => 'Manx',
    'ha' => 'Hausa',
    'he' => 'Hebrew (modern)',
    'hi' => 'Hindi',
    'ho' => 'Hiri Motu',
    'hr' => 'Croatian',
    'ht' => 'Haitian; Haitian Creole',
    'hu' => 'Hungarian',
    'hy' => 'Armenian',
    'hz' => 'Herero',
    'ia' => 'Interlingua',
    'id' => 'Indonesian',
    'ie' => 'Interlingue',
    'ig' => 'Igbo',
    'ii' => 'Nuosu',
    'ik' => 'Inupiaq',
    'io' => 'Ido',
    'is' => 'Icelandic',
    'it' => 'Italian',
    'iu' => 'Inuktitut',
    'ja' => 'Japanese (ja)',
    'jv' => 'Javanese (jv)',
    'ka' => 'Georgian',
    'kg' => 'Kongo',
    'ki' => 'Kikuyu, Gikuyu',
    'kj' => 'Kwanyama, Kuanyama',
    'kk' => 'Kazakh',
    'kl' => 'Kalaallisut, Greenlandic',
    'km' => 'Khmer',
    'kn' => 'Kannada',
    'ko' => 'Korean',
    'kr' => 'Kanuri',
    'ks' => 'Kashmiri',
    'ku' => 'Kurdish',
    'kv' => 'Komi',
    'kw' => 'Cornish',
    'ky' => 'Kirghiz, Kyrgyz',
    'la' => 'Latin',
    'lb' => 'Luxembourgish, Letzeburgesch',
    'lg' => 'Luganda',
    'li' => 'Limburgish, Limburgan, Limburger',
    'ln' => 'Lingala',
    'lo' => 'Lao',
    'lt' => 'Lithuanian',
    'lu' => 'Luba-Katanga',
    'lv' => 'Latvian',
    'mg' => 'Malagasy',
    'mh' => 'Marshallese',
    'mi' => 'Maori',
    'mk' => 'Macedonian',
    'ml' => 'Malayalam',
    'mn' => 'Mongolian',
    'mr' => 'Marathi',
    'ms' => 'Malay',
    'mt' => 'Maltese',
    'my' => 'Burmese',
    'na' => 'Nauru',
    'nb' => 'Norwegian Bokmal',
    'nd' => 'North Ndebele',
    'ne' => 'Nepali',
    'ng' => 'Ndonga',
    'nl' => 'Dutch',
    'nn' => 'Norwegian Nynorsk',
    'no' => 'Norwegian',
    'nr' => 'South Ndebele',
    'nv' => 'Navajo, Navaho',
    'ny' => 'Chichewa; Chewa; Nyanja',
    'oc' => 'Occitan',
    'oj' => 'Ojibwe, Ojibwa',
    'om' => 'Oromo',
    'or' => 'Oriya',
    'os' => 'Ossetian, Ossetic',
    'pa' => 'Panjabi, Punjabi',
    'pi' => 'Pali',
    'pl' => 'Polish',
    'ps' => 'Pashto, Pushto',
    'pt' => 'Portuguese',
    'qu' => 'Quechua',
    'rm' => 'Romansh',
    'rn' => 'Kirundi',
    'ro' => 'Romanian, Moldavian, Moldovan',
    'ru' => 'Russian',
    'rw' => 'Kinyarwanda',
    'sa' => 'Sanskrit',
    'sc' => 'Sardinian',
    'sd' => 'Sindhi',
    'se' => 'Northern Sami',
    'sg' => 'Sango',
    'si' => 'Sinhala, Sinhalese',
    'sk' => 'Slovak',
    'sl' => 'Slovene',
    'sm' => 'Samoan',
    'sn' => 'Shona',
    'so' => 'Somali',
    'sq' => 'Albanian',
    'sr' => 'Serbian',
    'ss' => 'Swati',
    'st' => 'Southern Sotho',
    'su' => 'Sundanese',
    'sv' => 'Swedish',
    'sw' => 'Swahili',
    'ta' => 'Tamil',
    'te' => 'Telugu',
    'tg' => 'Tajik',
    'th' => 'Thai',
    'ti' => 'Tigrinya',
    'tk' => 'Turkmen',
    'tl' => 'Tagalog',
    'tn' => 'Tswana',
    'to' => 'Tonga (Tonga Islands)',
    'tr' => 'Turkish',
    'ts' => 'Tsonga',
    'tt' => 'Tatar',
    'tw' => 'Twi',
    'ty' => 'Tahitian',
    'ug' => 'Uighur, Uyghur',
    'ua' => 'Ukrainian',
    'ur' => 'Urdu',
    'uz' => 'Uzbek',
    've' => 'Venda',
    'vi' => 'Vietnamese',
    'vo' => 'Volapuk',
    'wa' => 'Walloon',
    'wo' => 'Wolof',
    'xh' => 'Xhosa',
    'yi' => 'Yiddish',
    'yo' => 'Yoruba',
    'za' => 'Zhuang, Chuang',
    'zh' => 'Chinese',
    'zu' => 'Zulu',
);

function tryToFindLang($aLanguages, $sWhere, $sDefaultLang) {

    // установить текущий язык, как язык по умолчанию
    $sLanguage = $sDefaultLang;

    // начальное значение качества
    $fBetterQuality = 0;

    // поиск по всем соответствующим параметрам
    preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?(s*;s*qs*=s*(1.0{0,3}|0.d{0,3}))?s*(,|$)/i", $sWhere, $aMatches, PREG_SET_ORDER);
    foreach ($aMatches as $aMatch) {

        // получить префикс языка
        $sPrefix = strtolower ($aMatch[1]);

        // подготовить временный язык
        $sTempLang = (empty($aMatch[3])) ? $sPrefix : $sPrefix . '-' . strtolower ($aMatch[3]);

        // получить качество языка (если есть)
        $fQuality = (empty($aMatch[5])) ? 1.0 : floatval($aMatch[5]);

        if ($sTempLang) {

            // определение предпочтительного языка
            if ($fQuality > $fBetterQuality && in_array($sTempLang, array_keys($aLanguages))) {

                // установить временный язык, как язык по умолчанию и обновить значения качества
                $sLanguage = $sTempLang;
                $fBetterQuality = $fQuality;
            } elseif (($fQuality*0.9) > $fBetterQuality && in_array($sPrefix, array_keys($aLanguages))) {

                // установить язык по умолчанию, как значение префикса и обновить значения качества
                $sLanguage = $sPrefix;
                $fBetterQuality = $fQuality * 0.9;
            }
        }
    }
    return $sLanguage;
}

$ruslang= array('ru','be','uk','ky','ab','mo','et','lv');
	
if($_SESSION[language]!=$member_id[language]&&$member_id[language]!="")
$_SESSION[language]=$member_id[language];

if(!$_SESSION[language]&&!$member_id[language])
{$sLanguage = tryToFindLang($aLanguages, $_SERVER['HTTP_ACCEPT_LANGUAGE'], 'en');

if(in_array($sLanguage,$ruslang))
{
	$_SESSION[language]="rus";
}
else
{
	$_SESSION[language]="eng";
}
}
	 
require_once ROOT_DIR . '/engine/init.php';

if($_GET[system]!='1'&&$member_id[user_group]=='5'){
	

}
/*
 
//Хак автобан
if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip=$_SERVER['HTTP_CLIENT_IP'];
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
else $ip=$_SERVER['REMOTE_ADDR'];
$bot=$_SERVER['HTTP_USER_AGENT'];

if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex')) {$bot='Yandex';}
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Google')) {$bot='Google';}
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Yahoo')) {$bot='Yahoo';}
elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mail')) {$bot='Mail';}

if ($bot!='Yandex' and $bot!='Google' and $bot!='Yahoo' and $bot!='Mail') {


 $resul=$db->query("INSERT INTO all_visits (ip,date)
         VALUES ('".$ip."','".time(true)."')");
 $result=$db->super_query("SELECT count(id) as cnt FROM all_visits
         WHERE (ip='".$ip."' and date>'".(time(true)-10)."') LIMIT 1");

 if ($result[cnt]>10) {
  $result=$db->query("INSERT INTO black_list_ip (ip) VALUES ('".$ip."')");

  $file_htaccess="hitaccess.txt";

  $lines_htaccess[]="Order Allow,Deny\r\n";
  $lines_htaccess[]="Allow from all\r\n";

  $result=$db->query("SELECT ip FROM black_list_ip ORDER BY INET_ATON(ip)");
 
                    while ($image = $db->get_row($result)){
   $lines_htaccess[]="Deny from ".$image[ip]."\r\n";
  }

  file_put_contents($file_htaccess, $lines_htaccess);
  exit();
 }
}


*/

if($_GET['do']=='chat'){
require_once ENGINE_DIR . '/chat/chat_block.php';
}
if (clean_url ( $_SERVER['HTTP_HOST'] ) != clean_url ( $config['http_home_url'] )) {

        $replace_url = array ();
        $replace_url[0] = clean_url ( $config['http_home_url'] );
        $replace_url[1] = clean_url ( $_SERVER['HTTP_HOST'] );

} else
        $replace_url = false;
if($is_logged&&!$_GET['subaction']&&!$_GET['do']&&!$_GET[user]) {
	//(!$_SESSION[timer]||(time()-$_SESSION[timer]>=60))&&
}

if($_GET['system']!="1")
{
	
if(($_GET[embed]))
{

	$tpl->load_template ( 'main_nodesign.tpl' );
}

else	 if(!$member_id[custom]||$member_id[custom]=="0"||$member_id[custom]=="")
{
$tpl->load_template ( 'main.tpl' );

	

}

else
{
	$tpl->load_template ( 'main.tpl' );
	
	}
$tpl->set ( '{friendlogs}', $galleryCenter );
$tpl->set ( '{calendar}', $tpl->result['calendar'] );
$tpl->set ( '{archives}', $tpl->result['archive'] );
$tpl->set ( '{tags}', $tpl->result['tags_cloud'] );
$tpl->set ( '{vote}', $tpl->result['vote'] );
$tpl->set ( '{topnews}', $topnews );
$tpl->set ( '{recommend}', $recommend );
$tpl->set ( '{topnews2}', $topnews2 );
if($member_id[cens]=='1')
{
	$tpl->set ( '{toppics}', $toppics18 );
}
else
$tpl->set ( '{toppics}', $toppics );
$tpl->set ( '{bestpics}', $bestpics );
$tpl->set ( '{topvids}', $topvids );
$tpl->set ( '{topposts}', $topposts );
$tpl->set ( '{toppostsv}', $toppostsv );
$tpl->set ( '{toppostsg}', $toppostsg );
$tpl->set ( '{topmen1}', $topmen );
$tpl->set ( '{topnews3}', $topnews3 );
$tpl->set ( '{bestnews}', $bestnews );

$tpl->set ( '{cool}', $finfo );
$tpl->set ( '{bd3}', $calen );
$tpl->set ( '{bd4}', $calen2 );
$tpl->set ( '{myname}', $member_id[name] );

$scroll= dle_cache("scroll");
if($scroll)
{
}
else{
     $scroll = file_get_contents("templates/".$config['skin']."/scrollmenu.tpl");
	 $_SESSION[reclam]=$scroll;
 $month = mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
$db->query( "SELECT code FROM dle_banners WHERE banner_tag LIKE '%main%' AND approve='1' AND (dateend>'".$month."' OR dateend='' OR dateend='0') ORDER BY RAND()  LIMIT 0,10;" );

$i=0;
		while ( $row = $db->get_row() ) {
			$i++;
			$banner=stripslashes($row [code]);
			
			

		$ads.='<li>'.$banner.'</li>';
}
//$top_table.= "<a href=\"http://nocens.ru/index.php?do=stats\" ><img style=\"padding-left: 2px;\" src='http://nocens.ru/pics/info/ava1.png'></a>";
$pagerwidth=round(480/$i-1*$i-2).'px';
$scroll = str_replace("{addli}",   $ads, $scroll);
$scroll = str_replace( '{pagerwidth}', $pagerwidth,$scroll);
create_cache("scroll", $scroll);
}

	  $tpl->set ( '{scroll}', $scroll );
	  
	  $ads="";
	  $scroll2= dle_cache("scroll2");
if($scroll2)
{
}
else{
     $scroll2 = file_get_contents("templates/".$config['skin']."/scrollmenu2.tpl");
	 $_SESSION[reclam]=$scroll2;
 $month = mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
$db->query( "SELECT code FROM dle_banners WHERE banner_tag LIKE '%super%' AND approve='1' AND (dateend>'".$month."' OR dateend='' OR dateend='0') ORDER BY RAND()  LIMIT 0,10;" );

$i=0;
		while ( $row = $db->get_row() ) {
			$i++;
			$banner=stripslashes($row [code]);
			
			

		$ads.='<li>'.$banner.'</li>';
}
//$top_table.= "<a href=\"http://nocens.ru/index.php?do=stats\" ><img style=\"padding-left: 2px;\" src='http://nocens.ru/pics/info/ava1.png'></a>";
if($i!=0)
$pagerwidth=round(980/$i-1*$i-2).'px';
$scroll2 = str_replace("{addli}",   $ads, $scroll2);
$scroll2 = str_replace( '{pagerwidth}', $pagerwidth,$scroll2);
if($i!=0){
create_cache("scroll2", $scroll2);
}
else
{
	create_cache("scroll2","");
}
}
	  
	  $tpl->set ( '{scroll2}', $scroll2 );

	if( $i>0) {
		$tpl->set( '[scroll2]', "" );
		$tpl->set( '[/scroll2]', "" );
	} else
		$tpl->set_block( "'\\[scroll2\\](.*?)\\[/scroll2\\]'si", "" );
		
		
$tpl->set ( '{myid}',$member_id[user_id]);
}

 if(!$is_logged&&!$_GET['subaction']&&(!$_GET['do']||$realtype=="main")&&!$_GET[user]&&!$_GET[clan]&&!$_GET[newsid]) {
$guestmain='display: block;';
$usermain='display: none;';
$allmain='display: block;';
$usermain2='display: none;';

$mainwrapper='display: block;';

}
else if ($is_logged&&!$_GET['subaction']&&((!$_GET['do']&&!$_GET[user]&&!$_GET[clan]&&!$_GET[newsid])||$realtype=="main")) 
{
	$guestmain='display: none;';
$usermain='display: block;';
$allmain='display: block;';
$usermain2='display: block;';
$mainwrapper='display: block;';

}
else
{
	$guestmain='display: none;';
$usermain='display: none;';
$allmain='display: none;';
$usermain2='display: none;';

$mainwrapper='display: none;';

}
  $tpl->set ( '{guestmain}', $guestmain );
    $tpl->set ( '{usermain}', $usermain );
	  $tpl->set ( '{allmain}', $allmain );
	    $tpl->set ( '{usermain2}', $usermain2 );
		$tpl->set ( '{mainwrapper}', $mainwrapper );
		$tpl->set ( '{contentmain}', $contentmain );
		




if($member_id[user_id])
{
	$tpl->set ( '{myg}','');
	$tpl->set ( '{myb}','');
	$tpl->set ( '{myv}','');
	/*$tpl->set ( '{myg}',' <span class="sublink"><a href="http://nocens.ru/?do=album&user='.$member_id[user_id].'">Моя галерея</a></span>');
	$tpl->set ( '{myb}',' <span class="sublink"><a href="http://nocens.ru/?do=blogs&user='.$member_id[name].'">Мой блог</a></span>');
	$tpl->set ( '{myv}',' <span class="sublink"><a href="http://nocens.ru/?do=video&user='.$member_id[name].'">Моё видео</a></span>');*/
}
else
{
	$tpl->set ( '{myg}','');
	$tpl->set ( '{myb}','');
	$tpl->set ( '{myv}','');

}


if($_SESSION[language]!="eng")
{
	$changelang='<a href="//nocens.ru/index.php?do=change&language=eng">Switch to English</a>';
}
else
{
	$changelang='<a href="//nocens.ru/index.php?do=change&language=rus">Русская версия</a>';
}

$tpl->set ( '{changelang}', $changelang );
$tpl->set ( '{login}', $login_panel );
$tpl->set ( '{info}', "<div id='dle-info'>" . $tpl->result['info'] . "</div>" );
$tpl->set ( '{speedbar}', $tpl->result['speedbar'] );
$tpl->set ( '{chat_block}', $tpl->result['chat_block'] );

$tpl->set('{category}', $tpl->result['category']);

$tpl->set('{cash}',  $member_id['cash']);
$tpl->set ( '{lastcomments}', $lastcomments_block );
$tpl->set('{forum}', $tpl->result['forum_table']);
 if($_GET['do']=="favorites")
{	
$tpl->set('{cat}', "Избранное");

$hover4='class="round3"';
$hover1= '';
	$hover2= '';
	$hover3= '';
}
else if($_GET[category]=="blogs")
{
	$hover1= 'class="round3"';
	$hover2= '';
	$hover3= '';
	$tpl->set('{cat}', $lang2[socfur_lineblog_allbig]);
}
else if($_GET[subaction]=="newposts")
{
$hover1= 'class="round3"';
	$hover2= '';
	$hover3= '';
	$tpl->set('{cat}', "Непрочитанное");
}

else if($_GET[category]=="public")
{
		$tpl->set('{cat}',  $lang2[socfur_lineblog_allbigpubl]);
$hover2= 'class="round3"';
	$hover1= '';
	$hover3= '';
}
else if($_GET[category]=="service")
{
		$tpl->set('{cat}', $lang2[socfur_lineblog_allbigapps]);
	$hover1= '';
	$hover2= '';
	$hover3= '';
}
else if($_GET[category]=="videos"&&!$_GET[tag])
{	$tpl->set('{cat}', $lang2[socfur_lineblog_allbivids]);
if(!$_GET[tag])
	$hover3= 'class="round3"';
	else
	$hover3= '';
	$hover2= '';
	$hover1= '';
}

else if(!$_GET['do'])
{	
}
else
{
	if($_GET[tag])
		$tpl->set('{cat}', stripslashes($_GET[tag]));
		else if($_GET['do']=="favorites")
		$tpl->set('{cat}',$lang2[socfur_lineblog_allbigfavs]);
		else
	$tpl->set('{cat}',$lang2[socfur_lineblog_allbig]);
	$hover1= '';
	$hover2= '';
	$hover3= '';

}

if($_GET[tag])
$tag=$_GET[tag];
if($_GET[tags])
$tag=$_GET[tag];

	$tpl->set('{tag}',$tag);

/*
if($_GET[category]=="videos")
{$tpl->set('{maincat}','<a onclick="return dropdownmenu(this, event, mainMenu(5), ($(this).width()+20)+\'px\', \'downmain\'"   href="//nocens.ru/index.php?do=cat&category=videos">'.$lang2[socfur_buts_vid].'</a>');
}
else
{$tpl->set('{maincat}','<a  onclick="return dropdownmenu(this, event, mainMenu(5), ($(this).width()+20)+\'px\', \'downmain\'"   href="//nocens.ru/index.php?do=cat&category=blogs">'.$lang2[socfur_buts_blog].'</a>');
}
*/

if($_GET[category]=="videos")
{$tpl->set('{maincat}',''.$lang2[socfur_buts_vid].'');
}
else
{$tpl->set('{maincat}',''.$lang2[socfur_buts_blog].'');
}

	if($watch=="friends"){
				
					$sort2 =$lang2[socfur_sort_friends];
					}
					else if($watch=="clan")
					{
					
						 	$sort2 =$lang2[socfur_sort_clan];
					}
else if($watch=="my")
					{
						 
								$sort2 =$lang2[socfur_sort_me];
					}
					else
					{
						$sort2 =$lang2[socfur_sort_all];
					}
					if($bytime=="today"){
				
					$sort3 =$lang2[socfur_searchtime2];
					}
					else if($bytime=="week")
					{
					
						 	$sort3 =$lang2[socfur_searchtime3];
					}
else if($bytime=="month")
					{
						 
								$sort3 =$lang2[socfur_searchtime4];
					}
					else
					{
						$sort3 =$lang2[socfur_searchtime1];
					}
					
					//
					
					if($allcens=="only"){
				
					$sort4 =$lang2[socfur_searchcens3];
					}
					else if($allcens=="yes")
					{
					
						 	$sort4 =$lang2[socfur_searchcens1];
					}

					else
					{
						$sort4 =$lang2[socfur_searchcens2];
					}
					//
					$curcat=$_GET[category];
					if($_GET[tag])
{
		$curloc='do='.$do.'&tag='.$_GET[tag].'&category='.$_GET[category];
}
else if($_GET[category])
{
		$curloc='do='.$do.'&category='.$_GET[category].'';
}
else
{
					$curloc='do='.$do.'';
}
					if(!$member_id['clan']){
						$tpl->set ( '{clansort}', ""  );
						$tpl->set ( '{clansort2}', ""  );
					}
					else
					{
						$tpl->set ( '{clansort}', "menu[3]='<a href=\"//nocens.ru/index.php?".$curloc."&watch=clan\">".$member_id[clan]." </a>' ");
							$tpl->set ( '{clansort2}', "menu[3]='<a href=\"//nocens.ru/index.php?".$curloc."&watch=clan\">".$member_id[clan]."</a>' ");
					}
						$tpl->set ( '{sort2}',  $sort2 );
							$tpl->set ( '{sort3}',  $sort3 );
							$tpl->set ( '{sort4}',  $sort4 );
				$tpl->set ( '{curloc}',  $curloc );
				$tpl->set ( '{curcat}',  $curcat );
	$tpl->set ( '{curform}',  $curloc );
$add="f";
if($_GET[embed])
{
	
		$tpl->set ( '{colormax}', "#2B9B89" );
			$tpl->set ( '{colormin}', "#27726C" );
		$tpl->set ( '{skin}', "light" );
		$add="w";
		$dark="d";
}
else if($member_id[skin]==2||$_SESSION[skin]==2)
{
	$tpl->set ( '{skin}', "rose" );
	
	$tpl->set ( '{colormax}', "#D16593" );
			$tpl->set ( '{colormin}', "#A0466D" );
}
else if($member_id[skin]==3||$_SESSION[skin]==3)
{
	$tpl->set ( '{skin}', "classic" );
	
	$tpl->set ( '{colormax}', "#6D6D6D" );
			$tpl->set ( '{colormin}', "#4E4E4E" );
}

else if($member_id[skin]==4||$_SESSION[skin]==4)
{
		$tpl->set ( '{colormax}', "#2B9B89" );
			$tpl->set ( '{colormin}', "#27726C" );
		$tpl->set ( '{skin}', "marine" );
}
else if($member_id[skin]==5||$_SESSION[skin]==5)
{
		$tpl->set ( '{colormax}', "#2B9B89" );
			$tpl->set ( '{colormin}', "rgb(236, 236, 236)" );
		$tpl->set ( '{skin}', "light" );
		$add="w";
		$dark="d";
}
else if($member_id[skin]==6||$_SESSION[skin]==6)
{
		$tpl->set ( '{colormax}', "#2B9B89" );
			$tpl->set ( '{colormin}', "#27726C" );
		$tpl->set ( '{skin}', "azure" );
		$add="w";
		$dark="d";
}
else
{
		$tpl->set ( '{skin}', "classic" );
	
	$tpl->set ( '{colormax}', "#6D6D6D" );
			$tpl->set ( '{colormin}', "#4E4E4E" );
}
$tpl->set ( '{dark}', $dark );	
	$tpl->set ( '{skinmain}', $add );		
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
  if($_GET['do']=='cat'||$_GET['do']=='tags'||$_GET['do']=='favorites')
  {
if($_GET[category]!="videos")
{
$mnu.='<span '.$hover1.' class="round4" style="border-radius: 0px ;"><a onclick="DlePage(\'do=cat&category=blogs\'); return false;"  href="//nocens.ru/index.php?do=cat&category=blogs"><b>'.$lang2[socfur_lineblog_all].'</b></a></span><span '.$hover2.' class="round4" style="border-radius: 0px;"><a onclick="DlePage(\'do=cat&category=public\'); return false;"   href="//nocens.ru/index.php?do=cat&category=public"><strong>'.$lang2[socfur_lineblog_creo].'</strong></a></span><span '.$hover4.' class="round4" style="border-radius: 0px;"><a onclick="DlePage(\'do=favorites&category=blogs\'); return false;"  href="//nocens.ru/index.php?do=favorites&category=blogs"><strong>'.$lang2[socfur_lineblog_fav].'</strong></a></span>';
}
else
{
	
$mnu.='<span '.$hover3.' class="round4" style="border-radius: 0px;"><a onclick="DlePage(\'do=cat&category=videos\'); return false;"   href="//nocens.ru/index.php?do=cat&category=videos"><b>'.$lang2[socfur_lineblog_all].'</b></a></span><span '.$hover4.' class="round4" style="border-radius: 0px;"><a onclick="DlePage(\'do=favorites&category=videos\'); return false;"  href="//nocens.ru/index.php?do=favorites&category=videos"><strong>'.$lang2[socfur_lineblog_fav].'</strong></a></span>';
}

 if($addlang=='_eng')
                {
               
                $mylang=" AND a.tag   REGEXP '^[a-z]+$' ";
                }
				
				
if($_GET[category]=="videos")
{
  if($addlang!='_eng')
                {
	$s1[]="новости";
		$s1[]="кино";
			$s1[]="сериал";
			$s1[]="мультфильм"; 
		$s1[]="стрим"; 
	$s1[]="летсплей"; 
	$s1[]="клип"; 
	$s1[]="технологии"; 
$s1[]="игры";

$s1[]="фурри"; 
$s1[]="брони"; 
$s1[]="аниме";
 $s1[]="юмор";
$s1[]="творчество"; 
$s1[]="музыка";
$s1[]="трэш";
				}
				else
				{
						$s1[]="news";
		$s1[]="movie";
			$s1[]="series";
			$s1[]="cartoon"; 
		$s1[]="stream"; 
	$s1[]="letsplay"; 
	$s1[]="clip"; 
	$s1[]="hitech"; 
$s1[]="games";

$s1[]="furry"; 
$s1[]="brony"; 
$s1[]="anime";
 $s1[]="humour";
$s1[]="arts"; 
$s1[]="music";
$s1[]="trash";
				}

$addlinktags="&category=videos";
$num=15;
$num1=13;
	$keytags =  $db->query("SELECT a.tag,  COUNT(*) as cnt from  ".PREFIX."_tags a,  ".PREFIX."_post b WHERE  a.tag!='' ".$mylang." and a.news_id=b.id and b.category='31' GROUP BY a.tag ORDER BY cnt desc  LIMIT 0,59 ");
}
else
{
	
if($addlang!='_eng')
                {
	$s1[]="новости"; 	
$s1[]="технологии"; 
$s1[]="размышления"; 
$s1[]="юмор";
$s1[]="игры";
$s1[]="кино";
$s1[]="фурри"; 
$s1[]="брони"; 
$s1[]="аниме"; 

$s1[]="творчество"; 

$s1[]="спорт"; 
$s1[]="рассказ";
$s1[]="стихи"; 
$s1[]="музыка"; 
$s1[]="трэш"; 
				}
				else
				{
					      
	$s1[]="news"; 	
$s1[]="hitech"; 
$s1[]="thoughts"; 
$s1[]="humour";
$s1[]="games";
$s1[]="movie";
$s1[]="furry"; 
$s1[]="brony"; 
$s1[]="anime"; 

$s1[]="arts"; 

$s1[]="sports"; 
$s1[]="story";
$s1[]="poem"; 
$s1[]="music"; 
$s1[]="trash"; 
				}

$num=13;
$num1=11;
    	$keytags =  $db->query("SELECT a.tag,  COUNT(*) as cnt from  ".PREFIX."_tags a,  ".PREFIX."_post b WHERE  a.tag!=''  ".$mylang." and a.news_id=b.id and b.category!='31' GROUP BY a.tag ORDER BY cnt desc  LIMIT 0,59 ");
}


			while($row1 = $db->get_row($keytags)){
			
				$tlower=strtr( strtolower($row1[tag]), 'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ', 'йцукенгшщзхъфывапролджэячсмитьбюё' );
				if(!in_array($tlower,$s1)&&$tlower!="nocens"){
				$s1[]=$tlower;
				$num++;
				}
				
			}

$newtag=0;
$foundmas="";
for($i=0; $i<=$num; $i++)
{
$addtag="";
	if($i==$num)
	$addtag=' border-right: 0px; ';
	
	if($i<$num1)
	{
		$addtag.='  border-radius: 0px; ' ;
	}
	
	if(strtolower($_GET[tag])==strtolower($s1[$i]))
	{
		if($i>$num1)
		{
			$foundbump='overflow: visible; max-height: 200px; padding-top: 2px;';
			$foundmas='bottom: 0px;';
			
				
		}
	$mnu.='<span class="round3" style=" '.$addtag.'"><a  onclick="DlePage(\'do=tags&tag='.$s1[$i].$addlinktags.'\'); return false;"   href="//nocens.ru/index.php?do=tags&tag='.$s1[$i].$addlinktags.'">'.$s1[$i].'</a></span> ';
	$newtag=1;
	}
	else
	{
			$mnu.='<span class="round4"  style=" '.$addtag.'"><a  onclick="DlePage(\'do=tags&tag='.$s1[$i].$addlinktags.'\'); return false;"   href="//nocens.ru/index.php?do=tags&tag='.$s1[$i].$addlinktags.'">'.$s1[$i].'</a></span> ';
	}
}
	$tpl->set('{foundmas}', $foundmas);
	
	$tpl->set('{foundbump}', $foundbump);
if($newtag!="1")
{
//	$mnu.='<span class="round2"><a href="//nocens.ru/index.php?do=tags&tag='.$_GET[tag].'">'.$_GET[tag].'</a></span> ';
}

   $tpl->set ( '{cattags}', $mnu );
  }
   if($_GET['do']=='cat'||$_GET['do']=='tags'||$_GET['do']=='favorites')
  $curstyle='display: block;';
   else
     $curstyle='display: none;';
	     $tpl->set ( '{curstyle}', $curstyle );
   


        $tpl->set ( '[sort]', "" );
        $tpl->set ( '{sort}', news_sort ( $do ) );
        $tpl->set ( '[/sort]', "" );
	


if ($dle_module == "showfull" ) {
   $tpl->set ( '{cattags}', "" );
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
if($member_id['language']=="eng"||($member_id['language']==""&&$_SESSION['language']=="eng"))
{
	$curlang="eng";
	$addlang="_eng";
}
else
{
	
	$addlang="";
	$curlang="rus";
}
if($_GET[embed])
{
	$fromvk='true';
}
else
{
	
	$fromvk='false';
}
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
var dle_del_news   = '{$lang['news_delnews']}';
var donehug   = '{$lang2['socfur_hug_done']}';
var doneshake   = '{$lang2['socfur_shake_done']}';
var donepunch   = '{$lang2['socfur_punch_done']}';
var donekick   = '{$lang2['socfur_kick_done']}';
var donebless   = '{$lang2['socfur_bless_done']}';
var doneall   = '{$lang2['socfur_all_done']}';
var donenomoney   = '{$lang2['socfur_nomoney']}';
var embed   = '{$fromvk}';
var searchbar = new Array('{$lang2['socfur_buts_pic']}','{$lang2['socfur_buts_vid']}','{$lang2['socfur_buts_blog']}','{$lang2['socfur_buts_files']}','{$lang2['socfur_buts_people']}');
var searchlabl = new Array('{$lang2['socfur_buts_pic_search']}','{$lang2['socfur_buts_vid_search']}','{$lang2['socfur_buts_blog_search']}','{$lang2['socfur_buts_files_search']}','{$lang2['socfur_buts_people_search']}');
var searchmy  = '{$lang2['socfur_buts_my']}';
var searchinsert  = '{$lang2['socfur_buts_insert']}';
var searchmini = '{$lang2['socfur_buts_mini']}';
var searchbig  = '{$lang2['socfur_buts_big']}';
var searchvideos  = '{$lang2['socfur_buts_vid_letter']}';

var nounread  = '{$lang2['socfur_nonew']}';
var oneunread  = '{$lang2['socfur_new1']}';
var twounread  = '{$lang2['socfur_new2']}';
var threeunread  = '{$lang2['socfur_new3']}';
var searchorder = new Array('{$lang['sort_by_date']}','{$lang['sort_by_rating']}','{$lang['sort_by_read']}','{$lang['sort_by_comm']}','{$lang['sort_by_title']}');
var searchtime = new Array('{$lang2['socfur_searchtime1']}','{$lang2['socfur_searchtime2']}','{$lang2['socfur_searchtime3']}','{$lang2['socfur_searchtime4']}');
var searchcens = new Array('{$lang2['socfur_searchcens1']}','{$lang2['socfur_searchcens2']}','{$lang2['socfur_searchcens3']}');
var minisearchlabl = new Array('{$lang2['socfur_searchtypel1']}','{$lang2['socfur_searchtypel2']}','{$lang2['socfur_searchtypel3']}','{$lang2['socfur_searchtypel0']}','{$lang2['socfur_searchtypel4']}');
var minisearchlabl2 = new Array('{$lang2['socfur_searchtype1']}','{$lang2['socfur_searchtype2']}','{$lang2['socfur_searchtype3']}','{$lang2['socfur_searchtype0']}','{$lang2['socfur_searchtype4']}');
	var srchpodpis=new Array();

	srchpodpis['v']=''+minisearchlabl2[2]+'';
	srchpodpis['p']=''+minisearchlabl2[1]+'';
	srchpodpis['b']=''+minisearchlabl2[3]+'';
	srchpodpis['u']=''+minisearchlabl2[0]+'';
	
	var language='{$curlang}';
	var socfur_list_likers = '{$lang2['socfur_list_likers']}';
	var socfur_search_help = '{$lang2['socfur_search_help']}';
	localStorage['mesnum']='{$member_id['pm_unread']}';
	localStorage['actnum']='{$member_id['act_unread']}';
\n
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
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/menu.js?12"></script>
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/dle_ajax.js"></script>
<div id="loading-layer" style="display:none;font-family: Verdana;font-size: 11px;width:10px;height:10px;background:none;padding:10px;text-align:center;border:0px solid #000"><div style="font-weight:bold" id="loading-layer-text"></div><br /></div>
<div id="busy_layer" style="visibility: hidden; display: block; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; background-color: gray; opacity: 0.1; -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=10)'; filter:progid:DXImageTransform.Microsoft.Alpha(opacity=10); "></div>
<script type="text/javascript" src="{$config['http_home_url']}engine/ajax/js_edit.js?20"></script>
HTML;



if (strpos ( $tpl->result['content'], "hs.expand" ) !== false or strpos ( $tpl->copy_template, "hs.expand" ) !== false or $config['ajax'] or $pm_alert != "") {

        if ($config['thumb_dimming'] AND !$pm_alert) $dimming = "hs.dimmingOpacity = 0.60;"; else $dimming = "";

        if ($config['thumb_gallery'] AND !$pm_alert) {

        $gallery = "
        hs.align = 'center';
        hs.transitions = ['fade', 'crossfade'];
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


//ny
$randpic= '//nocens.ru/pics3/2016logo'.rand(1,5).'.png';


//ny

        $ajax .= <<<HTML
<style>
.logotype
{
background-image: url({$randpic}) !important;
}
</style>
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
else if(($logo>0&&$logo<5)||$logo>=22)
{
$logo=5;
}
else if($logo>7&&$logo<17)
{
$logo=2;
}
  else 
{$logo=2;
}

$tpl->set ( '{logo}', $logo );
$tpl->set ( '{AJAX}', $ajax );
$tpl->set ( '{headers}', $metatags );
if(!$member_id[foto])
{
$tpl->set ( '{foto}',  "<img  src=\"//nocens.ru/uploads/fotos/que.png\" >");
$member_id[foto]="que.png";
}
else
{
$tpl->set ( '{foto}',  "<img  src=\"//nocens.ru/uploads/fotos/".$member_id[foto]."\" >");
}
$newpm='';

      $newpm = file_get_contents("templates/".$config['skin']."/mes.tpl");
      if($member_id['pm_unread']=='1')
      {
      $perm = $db->super_query("SELECT id, subj, user_from  FROM ".PREFIX."_pm WHERE user='".$member_id[user_id]."' AND pm_read='no'");
      if (strlen($perm[subj]>30)){
      $perm[subj]=stripslashes(substr($perm[subj], 0,30 ))."..."; }
    
         if($perm[subj]=="Сообщение в чат"){
		$message2=''.$perm[subj].' от '.$perm[user_from];
         $linkread='//nocens.ru/index.php?do=pm2&user='.$perm[user_from];
          $message3=''.$perm[subj].' от '.$perm[user_from].'';
            $linkreadfast='do=pm2&user='.$perm[user_from];
	}
		 else
		 {
                 $message3=''.$perm[subj].' ('.$perm[user_from].')';
			 $message2=''.$perm[subj].'';
		    $linkread='//nocens.ru/index.php?do=pm2&user='.$perm[user_from];
              $linkreadfast='do=pm2&user='.$perm[user_from];
		 }
        
       $message='&nbsp;1</a>';
        
      }
       else if($member_id['pm_unread']=='0')
      {
      $linkread='//nocens.ru/index.php?do=pm&doaction=inbox';
        $linkreadfast='do=pm&doaction=inbox';
       $message='<a id="mainnew" onclick="DlePage(\'do=pm&doaction=inbox\',1); return false;" title="Нет новых сообщений" href="//nocens.ru/index.php?do=pm&doaction=inbox"><img title="Нет новых сообщений" src="//nocens.ru/pics2/nonewmes'.$dark .'.png" width="25" height="25" align="texttop" class="hidebut" >&nbsp;0</a>';
       $message2='';
      }
      
       else if($member_id['pm_unread']<'5')
      {
        $linkread=' //nocens.ru/index.php?do=pm&doaction=inbox';
        $linkreadfast='do=pm&doaction=inbox';
       $message='&nbsp;'.$member_id['pm_unread'].'';
       $message2=''.$message.' новых сообщения';
         $message3='+'.$message.' сообщения';
      }
      else
      {
        $linkread=' //nocens.ru/index.php?do=pm&doaction=inbox';
          $linkreadfast='do=pm&doaction=inbox';
       $message='&nbsp;'.$member_id['pm_unread'].'';
       $message2=''.$message.' сообщений';
          $message3='+'.$message.' сообщений.';
      }
      
         $_SESSION['was']=$member_id['pm_unread'];
         $_SESSION[lastunread]=$member_id['pm_unread']; 
         
         if($member_id[act_unread]>0){
$unr= '<div class="newacts"><a title="+'.$member_id[act_unread].' новых действий в ваших разделах" onclick="DlePage(\'do=actions&amp;user=myposts&rand='.rand(0,10000).'\'); return false;" href="//nocens.ru/index.php?do=actions&amp;user=myposts" ><span>'.$member_id[act_unread].'</span></a></div>';

$addact='Активность (+'.$member_id[act_unread].')';
}
else
{
	$unr="";
	$addact='Нет активности';
}

if($member_id[actf_unread]>0){
$unr.= '<div class="newacts2"><a title="'.$member_id[actf_unread].' '.$lang2[socfur_nonew_actsf].'" onclick="DlePage(\'do=actions&amp;user=friends&rand='.rand(0,10000).'\'); return false;" href="http://nocens.ru/index.php?do=actions&amp;user=friends" >'.$member_id[actf_unread].'</a></div>';

$addactf=$member_id[actf_unread].' '.$lang2[socfur_nonew_actsf];
}
else
{
	$unrf.="";
	$addactf='0 '.$lang2[socfur_nonew_actsf];
}

      
      	$newpm = str_replace("{linkread}",  $linkread, $newpm);
							$newpm = str_replace("{message}",  $message, $newpm);
                            
                            if($member_id[clanmes]>0)
                               $tpl->set ( '{clanmes}', "(+".$member_id[clanmes].')');    
                               else
                                    $tpl->set ( '{clanmes}',"");
                            	
                            	$newpm = str_replace("{uid}", $member_id['user_id'], $newpm);
                                if($member_id['pm_unread']>0){
$pms='<div  style="position: absolute; margin-top: 30px; float: left"><a onclick="DlePage(\'do=pm&doaction=inbox\',1); return false;"  href="//nocens.ru/index.php?do=pm&doaction=inbox"><img id="newmes" border="0" src="//nocens.ru/pics/newpm.gif"></a></div>';
$mobalert='<a  onclick="DlePage(\'do=pm&doaction=inbox\',1); return false;" href="//nocens.ru/index.php?do=pm&doaction=inbox">Cообщения ('.$member_id['pm_unread'].')</a>';}


if($member_id['user_group']==5)
{
$nk1='<div class="topmenu"><a href="//nocens.ru/index.php?do=register"><img src="//nocens.ru/pics/buts/que.png" width="45" height="45" /></a></div>';
}
else
{

   $imginfo = @getimagesize("//nocens.ru/uploads/fotos/" . $member_id['foto']);
					if($imginfo[1]==0){ $imginfo[1]=100; $imginfo[0]=100;}

					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=intval(45*$img_koeff-15);
                    $imgw=$img_koeff*45;
$nk1=''.$pms.'<div class="topmenu"  style="padding-left: 2px; padding-right: 2px;"><div style=" width: 45px; margin-top: 39px; margin-left: -2px; text-align: center; position: absolute;"><p class="menusmall" ><a  onclick="DlePage(\'user='.$member_id['name'].'\'); return false;" href="//nocens.ru/'.$member_id['name'].'">профайл</a></p></div><a onclick="DlePage(\'user='.$member_id['name'].'\'); return false;" href="//nocens.ru/index.php?user='.$member_id['name'].'"><img title="Профайл и настройки" src="//nocens.ru/uploads/fotos/'.$member_id[foto].'" width="'.$imgw.'"  height="45" /></a></div>';
}


   if($member_id['pm_unread']>='1'&&!$_GET[pmid]&&$_GET['do']!="pm2"){
$mese = $unr.'<a style="margin-top: 4px;" onclick="DlePage(\''.$linkreadfast.'\',1); return false;"  href="'.$linkread.'"><img  src="//nocens.ru/pics2/newmes.gif" width="25" height="25" align="left" class="hidebut" ></a>';
$mese2='<a onclick="DlePage(\''.$linkreadfast.'\',1); return false;"  href="'.$linkread.'">'.$message3.'</a>';
$mese3='<li id="rall"> <a onClick="readall();"  href="#">'.$lang2[socfur_allread].'</a></li>';
	  }
	  else
	  {
		 $mese = $unr.'<p class="pmtype" style=""><a onclick="DlePage(\''.$linkreadfast.'\',1); return false;" href="'.$linkread.'"><span>'.$lang2[socfur_nonew].'</span></a></p>';
          $mese2 = '<a onclick="DlePage(\''.$linkreadfast.'\',1); return false;"  href="'.$linkread.'"><span>'.$lang2[socfur_nonew].'</span></a>';
          
       $mese3='<li id="rall" style="display:none;"><a onClick="readall(); return false;"  href="//nocens.ru/index.php?do=pm&doaction=readall">'.$lang2[socfur_allread].'</a></li>';

	  }
                       $tpl->set ( '{mespost}', $mese );
   $tpl->set ( '{inbox}', $mese2 );         
   $tpl->set ( '{chatbox}',  $mese3 );           
$tpl->set ( '{person}', $nk1 );

 if($member_id['pm_unread']=='0')
$tpl->set ( '{newpm}', $message );
else
$tpl->set ( '{newpm}', $newpm );
    if(!$_GET['subaction']&&!$_GET['do']&&!$_GET[user]&&$member_id[user_group]!='5'){
   $place = $db->super_query("SELECT COUNT(*) as cnt FROM dle_users where forum_reputation>'".$member_id[forum_reputation]."' ORDER BY 'id'");
  }
  $curlvl=level($member_id[forum_reputation]);
  	$vals = array ();
	$valslvl[0]=1;
	$valslvl[2]=500;
	$valslvl[3]=2000;
	$valslvl[4]=5000;
	$valslvl[5]=12000;
	$valslvl[6]=25000;
	$valslvl[7]=52000;
	$valslvl[8]=105000;
	$valslvl[9]=215000;
	$valslvl[10]=440000;
    $valslvl[11]=900000;
   if($curlvl>$member_id[level])
   {
   updatelevel($curlvl);
   }
   $wrank=round($member_id[forum_reputation]/$valslvl[($curlvl+1)]*100);
   $tolvl=$valslvl[($curlvl+1)]-$member_id[forum_reputation];
  $ranking= '<div style="float: left; width: 25px; padding-left: 2px; padding-top: 6px; color: #FFF;">'.$curlvl.$lang2[socfur_lvl].'</div> <div style="float: right; padding-right: 2px; padding-top: 6px; width: 25px;  color: #FFF;">'.($curlvl+1).$lang2[socfur_lvl].'</div><div style="color: #FFF; margin-top: 2px; padding: 4px;  padding-left: 30px;  width: 90px; text-align:left;"  onmouseover="tooltip.show(\'Ваш рейтинг: '.$member_id[forum_reputation].' ('.$tolvl.' до '.($curlvl+1).' уровня).\');" onmouseout="tooltip.hide();" "><div style="display: inline-block; background-color:#FFF;  height: 4px; padding-top:2px; padding-bottom: 2px; width: '.$wrank.'%; position: relative;"><div style="position: absolute; right: -4px; top: -2px;width: 12px; height: 12px;  background-color:#FFF; border-radius: 20px;"></div></div></div>';
   $tpl->set ( '{ranking}', $ranking);
//$tpl->set ( '{ranking}', '<div style="color: #FFF; padding-top: 4px;"><img title="Рейтинг" src="//nocens.ru/pics2/ranking'.$dark.'.png" width="25" height="25"  align="absmiddle" class="hidebut" ><a onclick="DlePage(\'do=stats\'); return false;" title="Рейтинг" href="//nocens.ru/index.php?do=stats">'.$curlvl.$lang2[socfur_lvl].' ('.$member_id[forum_reputation].')</a></div>');
$tpl->set ( '{personmob}', $mobalert);

if($_GET['do']=='cat'||$_GET['do']=='tags'||$_GET['do']=='favorites'){
$addiv='<div id="show3">';
$addivend='</div>';
}
$tpl->set ( '{content}', "<div id='dle-content'>".$addiv. $tpl->result['content'] .$addivend. "</div>" );
if($fonpic){
   $fonpic2 = explode( ",",$fonpic);
   
   if($fonpic2[1]=="cover"||$fonpic2[2]=="cover")
{
 $addparam= '-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-attachment: fixed; ';
 }
else if($fonpic2[1]=="scroll")
{
$addparam='background-attachment: fixed; background-position: center top; ';
}
else
$addparam="background-position: center top;";


 
$tpl->set ( '{bgpic}', 'background-image:url(//nocens.ru/uploads/fon/'.$fonpic2[0].');  '.$addparam.'');
}
else
$tpl->set ( '{bgpic}','');

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
        $showadd = dle_cache("radio1");
       if($showadd||$member_id[user_group]=='5')
       {
      
 $showadd2 = dle_cache("radio2");
$radio3 = dle_cache("radio3");
$progs = dle_cache("radio4");

       }
       else
       {
      if(!$_GET['subaction']&&!$_GET['do']&&!$_GET[user]&&(!$_SESSION[timer2]||(time()-$_SESSION[timer2]>=300))){
      
      
      if($member_id['friends']||$member_id['feeds']){
       $friends=explode(", ", $member_id['friends']);
					  $feeds=explode(", ", $member_id['feeds']);
                    $addqrad= " OR  (wave='".$member_id[user_id]."' OR wave IN ('" . implode( "','",  $friends ) . "') OR wave IN ('" . implode( "','",  $feeds) . "'))  ";}
				
                
$fsch = $db->query("SELECT *,  WEEKDAY(begin) as beg, end as minutes FROM radioadmin where  hidden!='1' AND  ((WEEKDAY(begin)='".$wday."'  AND TIME(begin)<='".$hday."'  AND TIME(end)>='".$hday."') OR ( (WEEKDAY(begin)='".$wday."' AND WEEKDAY(end)='".$wdaynext."'  AND TIME(begin)<='".$hday."'  )) OR  (WEEKDAY(end)='".$wday."'  AND WEEKDAY(begin)='".$wdayprev."'  AND TIME(end)>='".$hday."')) AND (wave<4 ".$addqrad.") order by wave asc, type asc, id desc LIMIT 0,3;");
	
	  
	//	 $fsch = $db->query("SELECT *, WEEKDAY(begin) as beg, TIME(begin) as h1, TIME(end) as h2 FROM radioadmin where wave='1' AND hidden!='1' AND   WEEKDAY(begin)='".$wday."'  order by  WEEKDAY(begin) asc, TIME(begin) asc  LIMIT 0,10;");
		 $days=array("ПН","ВТ","СР","ЧТ","ПТ","СБ","ВС");
		 
	 $weekd=22445;
	 $progs="";
	 $k1=0; $vowels = array("\"");
     
$rec="";

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
		
					     if($im[dj])
                         $dj='<br><i>('.$im[dj].')</i>';
                         else
                         $dj="";
			
			$im[name] = str_replace ($vowels, "", $im[name]);
			if($im[picture])
{
	$picline='<img align=\"left\" width=\"100\" height=\"100\" align=\"right\" src=\"'.stripslashes(str_replace('http://nocens.ru','//',$im[picture])).'\">';
}
$im[description] = str_replace ($vowels, "", strip_tags($im[description]));
		
        if($im[dj])
        {
        $dj='('.$im[dj].')';
        }
        else
        {
        $dj="";
        }
             if(!$im[picture])
			  {
				   $im[picture]='//nocens.ru/pics/buts/que.png';
						 }
                         if($im[wave]<10){
	$progs.='<div class="toprow" style="  white-space: normal; overflow:visible; height:auto; padding-top: 4px;" onmouseover="tooltip.show(\''.addslashes($im[description].$dj).'\');" onmouseout="tooltip.hide();"><a   href="//nocens.ru/index.php?do=chat&wave='.$im[wave].'"><img width="50" height="50" align="left" src="'.$im[picture].'" style="padding: 4px; padding-top: 0px;" ><b>'.substr($im[h1],0,strlen($im[h1])-3).' '.$im[name].'</b></a><div style="clear: both;"></div></div>';
    }
    else
    {
    	$progs.='<div class="toprow" style="  white-space: normal; overflow:visible; height:auto; padding-top: 4px;" onmouseover="tooltip.show(\''.addslashes($im[description].$dj).'\');" onmouseout="tooltip.hide();"><a   href="//nocens.ru/stream/'.$im[dj].'"><img width="50" height="50" align="left" src="'.$im[picture].'" style="padding: 4px; padding-top: 0px;" ><b>'.substr($im[h1],0,strlen($im[h1])-3).' '.$im[name].' '.$dj.'</b></a><div style="clear: both;"></div></div>';
    }
    $showadd=$im[name];
			$next1=1;		
            
                if($im[efir]!=0&&$rec=="")
{
$rec='<a   href="//nocens.ru/index.php?do=chat&wave='.$im[wave].'">   <b>{socfur_radio}</b><div style=" position: absolute; top: 0px;right: -8px;"><img title="Прямой эфир" align="absmiddle" src="//nocens.ru/pics3/interface/rec.gif" /></a></div>';
}
else
$rec="<a   href=\"//nocens.ru/radio\">   <b>{socfur_radio}</b></a>";
            
		
            }
            
            if(!$progs){
			
                         
	$progs.='<div class="toprow" style="  white-space: normal; overflow:visible; height:auto; padding-top: 4px;" onmouseover="tooltip.show(\''.addslashes($im[description].$dj).'\');" onmouseout="tooltip.hide();"><a   href="//nocens.ru/index.php?do=chat&wave=1"><img width="50" height="50" align="left" src="//nocens.ru/pics/buts/que.png" style="padding: 4px; padding-top: 0px;" ><b>Музыка нон-стоп</b></a><div style="clear: both;"></div></div>';
            }
            $_SESSION[timer2]=time();
            $_SESSION[progs]=$progs;
            if($rec!="")
            $_SESSION[efir]=$rec;
            }
            else
            {
            $progs=$_SESSION[progs];
            if($_SESSION[efir])
            $rec= $_SESSION[efir];
            }
         
         if(!$_SESSION[efir])
 $radio3="<a   href=\"//nocens.ru/radio\">   <b>{socfur_radio}</b></a>";
 else
 $radio3=$_SESSION[efir];
 create_cache( 'radio1',  $showadd);
create_cache( 'radio2',  $showadd2);
create_cache( 'radio3',  $radio3);
create_cache( 'radio4',  $progs);

}

$tpl->set( '{radio1}',  $showadd);
$tpl->set( '{radio2}',  $showadd2);
$tpl->set( '{radio3}',  $radio3);
$tpl->set( '{radio4}',  $progs);
//Определение отображения всех или друзей
if($member_id[showtype]=='1')
$showtype="friends";
else
$showtype="all";
$tpl->set( '{showtype}',  $showtype);
/* ФЛОППЕР */
$game=strip_tags($member_id[game]);
 if($member_id['cash']>=100)
 {$addstatus="<option value=\"5\">Депрессия</option><option value=\"6\">Кавай</option><option value=\"7\">Фурри</option><option value=\"8\">Патриот</option><option value=\"9\">TimeZero</option><option value=\"10\">Деньги</option><option value=\"11\">Ярость</option><option value=\"12\">Важное событие</option><option value=\"13\">Квашу</option>";
 $addstatus_eng="<option value=\"5\">Depression</option><option value=\"6\">Kawai</option><option value=\"7\">Furry</option><option value=\"8\">Patriot</option><option value=\"9\">Game</option><option value=\"10\">Money</option><option value=\"11\">Angry</option><option value=\"12\">Important</option><option value=\"13\">Party</option>";
 }
 else
 {$addstatus="";
 }
 
 if($addlang!="_eng")
 $nastr= array("Пусто","Радость","Печаль","Любовь","Думы","Депрессия","Кавай","Пушистый","Патриот","Игра","Деньги","Ярость","Важно","Квашу","Союз","Брони");
else
$nastr=  array("Empty","Happy","Sad","Love","Thougts","Depression","Kawai","Furry","Patriot","Game","Money","Angry","Inportant","Party","Soviet","Brony");
 for($i1=0; $i1<16; $i1++)
 {
 if($member_id[game2]==$i1)
 {
  $nas.="<option selected=\"selected\" value=\"$i1\">".$nastr[$i1]."</option>";
 }
 else
 {
 $nas.="<option value=\"$i1\">".$nastr[$i1]."</option>";
 }
 }
 
 
 $jscode="document.forms['add'].action='index.php?do=addnews'; document.forms['add'].submit(); return false;";
 if($member_id['user_group']!=5)
 {
 
 $i = 0;
	$output = "<table id=\"n1\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr >";

    $smilies = explode(",", $config['smilies']);
	 	/* */
	if($member_id[smiles]>1)
	{
		if($member_id[smiles]=='2'||$member_id[smiles]=='100500')
	$smilies2="aloner,ayy,bleat,cuttie,donbass,fyeah,great,imaginer,kidding,maddy,mytongue,no-meme,pokerface,seenit,shhhh,sicking,sthwrong,thinking,trollface,veryhappy,whyy,wowow,fffuuu,mkay,sondisappoint,justin,megusta,sir,please,noway,";  
	
	if($member_id[smiles]=='3'||$member_id[smiles]=='100500')
	$smilies2.="broagree,broangry,brocrazy,broglamour,brohug,browtf,brohappy,broidkn,brony,broretro,brosad,broskype,brotrololo,brocritic,broeww,brodj,broscared,brospike,bromustache,brocrystal,brosun,";
	
	 $smilies2 = explode(",", $smilies2);
    foreach($smilies2 as $smile)
    {
		if($smile!="")
		{
        $i++; $smile = trim($smile);

        $output .= "<td style=\"padding:1px;\" align=\"center\"><a href=\"#\" onclick=\"dle_smiley(':$smile:','emoticons','1'); return false;\"><img style=\"border: none;\" alt=\"$smile\" src=\"".$config['http_home_url']."engine/data/emoticons/$smile.gif\" /></a></td>";
	if ($i%8 == 0) $output .= "</tr><tr>";
		}
    }
	}

/**/	
    foreach($smilies as $smile)
    {
        $i++; $smile = trim($smile);

        $output .= "<td style=\"padding:1px;\" align=\"center\"><a href=\"#\" onclick=\"dle_smiley(':$smile:','emoticons','1'); return false;\"><img style=\"border: none;\" alt=\"$smile\" src=\"".$config['http_home_url']."engine/data/emoticons/$smile.gif\" /></a></td>";
	if ($i%8 == 0) $output .= "</tr><tr>";

    }

	$output .= "</tr></table>";
	$smiles='
<div id="emoticons" style="display: none; position: absolute; width:600px; height: 200px; bottom: 0px; left: 0px; overflow: auto; border: 1px solid #BBB; background:#E9E8F2;filter: alpha(opacity=95, enabled=1) progid:DXImageTransform.Microsoft.Shadow(color=#CACACA,direction=135,strength=3);">'.$output.'</div>';
//$tpl->set( '{smiles}', $smiles);

	$list = explode( ", ", $member_id['clan'] );
	
	foreach ( $list as $clan ) {
    if($clan!="")
		$variants.= '<option value="'.$clan.'">'.$clan.'</option>';
	}
	
			if($variants!=""){
			$choosefrom='<label for="showname"><b>{socfur_from}:</b></label><select name="showname" id="showname"  style="margin-left: 2px; width: 130px; height:21px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#999;  background-color:#FFF; ">
  <option value="0" selected="selected">'.$member_id[name].'</option>
  '.$variants.'

</select>';

$choosefrommob='<label for="showname"><b>От:</b></label><select name="showname" id="showname" style ="margin-left: 2px; width: 100px; border-width: 1px; border-style:solid;  background-color:#FFF; " >
  <option value="0" selected="selected" >'.$member_id[name].'</option>
  '.$variants.'

</select>';}

$gog='<input name="addblog" type="checkbox" value="yes" checked="checked" /> <span style="">{socfur_toblog}</span>  <input name="addstat" id="addstat" type="checkbox" value="yes" /> <span style="">{socfur_tostatus}</span> ';
 $tpl->set( '{nastr}', stripslashes( "".$row['game']."<div class=\"addpanel\"><label for=\"game2\"><b>{socfur_mood}:</b></label><select style =\"margin-left: 2px; width: 130px; height:21px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#999;  background-color:#FFF; \" id=\"game2\" name=\"game2\" selected=\"selected\">".$nas."
</select> ".$choosefrom." ".$gog."</div><input name=\"wysiwyg\" type=\"hidden\" value=\"1\" /> <textarea align=\"center\"  style=\"margin-top: 2px; height: 70px; width: 793px; padding: 2px; padding-top: 0px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#999;  background-color:#FFF;\" onfocus=\"if(this.value == '{socfur_whatsnew}') this.value = ''\" maxlength=\"2850\" type=\"text\" id=\"shortpost\" name=\"game\"  class=\"f_input\" placeholder=\"{socfur_whatsnew}\" />".$lastinput."</textarea><div align=\"right\" style=\"width: 100%;\"><div style=\"float: left;\" class=\"readmore\"> <a onClick=\"edtype='wysiwyg'; ins_emo2(); return false;\" href=\"#\"><img src=\"//nocens.ru/pics3/interface/screpka.png\" alt=\"king\" style=\"border: none;\" height=\"20\" width=\"20\" align=\"texttop\">{socfur_attach}</a></div> <div style=\"float: left;\" class=\"readmore\">&nbsp;&nbsp;<a onClick=\"edtype='wysiwyg'; fadeinout('emoticons'); return false;\" href=\"#\"><img src=\"//nocens.ru/pics3/interface/smile.png\" alt=\"king\" style=\"border: none;\" height=\"20\" width=\"20\" align=\"texttop\">{socfur_smiles}</a></div>".'<div style="position: relative;">'.$smiles.'</div>'."<input type=\"button\" value=\"{socfur_continue_big}\" class=\"bbcodes_poll\" onclick=\"document.forms['add'].action='index.php?do=addnews'; document.forms['add'].submit(); return false;\" style=\"margin-top: 4px; height: 26px; width: 300px\"> <input type=\"submit\" class=\"bbcodes_poll\" style=\"margin-top: 4px; height: 26px; width: 200px;\"   value=\"{socfur_send}\"> </div><div style=\"clear: both;\"></div><script type=\"text/javascript\" src=\"//nocens.ru/engine/ajax/bbcodes.js\"></script>" ) );
 $tpl->set( '{nastrmob}', stripslashes( "".$row['game']."<select style =\"margin-left: 2px; width: 130px; border-width: 1px; border-style:solid;  background-color:#FFF; \" name=\"game2\" selected=\"selected\">".$nas."
</select> ".$choosefrommob."<div style=\"height: 4px;\"></div><textarea placeholder=\"Что интересного?\" align=\"center\" rows=\"5\" style=\"width: 90%;  border-width: 1px; border-style:solid;   background-color:#FFF;\" maxlength=\"2850\" type=\"text\" id=\"comments\" name=\"game\" value=\"".$val."\"   class=\"f_input\" />".$lastinput."</textarea><div style=\"height: 2px;\"></div>".$gog."" ) );
$tpl->set('{stat}',"");

$tpl->set('{stat2}',"<img width=\"15\" height=\"15\" src=\"//nocens.ru/pics/status/p".$member_id['game2'].".png\" align=\"baseline\">");
$tpl->set('{statmob}',"<input  type=\"submit\" value=\"{socfur_send}\" style=\" border: 0px;\" >");
}
else
{
$tpl->set( '{stat}', "");
 $tpl->set( '{nastrmob}', "");
 $tpl->set('{nastr}','<p align="center"><i><a href="//nocens.ru/index.php?do=register">Зарегистрируйтесь</a> или зайдите за себя, чтобы оставлять сообщения.</i></p>');
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
  $text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
    
return $text; 

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
$outing["blogs"]="http://nocens.ru/index.php?do=cat&category=bl";
$outing["creos"]="http://nocens.ru/index.php?do=cat&category=public";
$outing["pics"]="http://nocens.ru/index.php?do=gallery";
$outing["radio"]="http://nocens.ru/radio";
$outing["radio2"]="http://nocens.ru/penek";
$outing["forum"]="http://nocens.ru/index.php?do=forum";

if($outing[$a1])
{
$out=$outing[$a1];
}
else
$out=$a1;
return $out;
}

$def='<a href="http://nocens.ru/radio"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">радио</p></div><img title="Радио" src="http://nocens.ru/pics/info/ava3w.png" width="45" height="45"></div></a><a target="_new" href="http://vkontakte.ru/letruth"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">правда</p></div><img title="ПРАВДА, группа Вконтакте" src="http://nocens.ru/pics2/pravda.png" width="45" height="45"></div></a><a href="http://nocens.ru/index.php?do=tags&tag=%D7%E5%F1%ED%E5%F6"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">чеснец</p></div><img title="Чеснец-шоу, политический видеоблог" src="http://nocens.ru/pics2/chesnecshow.png" width="45" height="45"></div></a><a target="_new" href="http://youtube.com/2m4utube"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">канал</p></div><img title="Видеоблог 2MUCH4U" src="http://nocens.ru/pics2/2m4utube.png" width="45" height="45"></div></a><a target="_new" href="http://vk.com/chinternet"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">ЧИ</p></div><img title="Честный интернет" src="http://nocens.ru/pics2/chinternet.png" width="45" height="45"></div></a><a href="http://nocens.ru/index.php?do=stats"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">рейтинг</p></div><img title="Рейтинг" src="http://nocens.ru/pics2/top.png" width="45" height="45"></div></a><a href="http://nocens.ru/index.php?do=demotivater"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">дем</p></div><img title="Сделать демотиватор" src="http://nocens.ru/pics2/demotiv.png" width="45" height="45"></div></a><a href="http://nocens.ru/index.php?do=forum"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">форумы</p></div><img title="Форум" src="http://nocens.ru/pics/info/ava4.png" width="45" height="45"></div></a>';
if($member_id[user_group]!=5)
{
    $perkpanel= '<a href="http://nocens.ru/index.php?do=blogs&user='.$member_id[name].'"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">блог</p></div><img title="Мой блог" src="http://nocens.ru/pics2/myblog45.png"  width="45" height="45"  ></div></a><a href="http://nocens.ru/index.php?do=album&user='.$member_id[user_id].'"><div class="topmenu" style="padding-top: 1px;"><div style=" width: 45px; margin-top: 40px; margin-left: 0px; text-align: center; position: absolute;"><p class="menusmall">галерея</p></div><img title="Моя галерея" src="http://nocens.ru/pics2/mypics45.png" width="45" height="45"></div></a>'.$def;
  }
  else if($member_id[user_group]==5)
  {
    $perkpanel= $def;
  }

$tpl->set ( '{perkpanel}',  '<div style="padding-top: 0px;">'.$perkpanel.'</div>');

 $n1=$sape->return_links(1);
 $n2=$sape->return_links(1);
$n3=$sape->return_links();
$tpl->set ( '{sape1}', $n1);
$tpl->set ( '{sape2}', $n2);
$tpl->set ( '{sape3}', $n3);

$an = array();
$an[1]="Золотое перо";
 $an[2]="Графоман";
  $an[3]="Вспышкин";
   $an[4]="Радиолюбитель";
      $an[5]="Влогер";
         $an[6]="Суперзвезда";
            $an[7]="Олигархъ";
               $an[8]="";
                  $an[9]="Труселя";
                     $an[10]="Лапа";
                        $an[11]="Бумеранги";
                         $an[12]="Паукан";
                          $an[13]="Плюшка";
                           $an[14]="Плохиш";
						       $an[15]="Радуга";
                        
						 $an[16]="Милитари";
						  $an[17]="Раксемус";
						    $an[18]="Caelestis Rose";
							   $an[19]="Союз";
							     $an[20]="Лис";
								   $an[21]="Игротека";
								     $an[22]="Крылья";
									   $an[23]="Хиппи";
									      $an[25]="ErilaZ";
										     $an[24]="Барсик";
											    $an[26]="Косточка";
													    $an[27]="Меценат";
														$an[28]="Illuminated";
														$an[29]="Апельсинка";
																	 	$an[30]="Кассета";
																 	$an[31]="Kappa";
																		 	$an[32]="Цап-царап";
																			$an[33]="Какаши";
														$an2 = array();
                      $an2[1]="Золотое перо вручается за большое количество популярных больших креативов.";
 $an2[2]="Графоман вручается за большое количество популярных постов в блоге.";
  $an2[3]="Вспышкин дается за активность в Галерее.";
   $an2[4]="Радиолюбителем вы становитесь за активность в чате радио.";
      $an2[5]="Влогер вручается за большое количество популярных видеопостов.";
         $an2[6]="Суперзвезда дается за высокую позицию в рейтингах.";
            $an2[7]="Олигархъ вручается за большое количество флопсов, накопленных вами (если вы их потратите, нашивка не исчезнет).";
               $an2[8]="";
                  $an2[9]="Труселя даются всем друзьям Томки.";
                     $an2[10]="Лапа дается всем друзьям Black_Tiger.";
                        $an2[11]="Бумеранги даются всем друзьям D-Arts.";   
                              $an2[12]="Паукан дается всем друзьям John007Spider7.";   
                                       $an2[13]="Вы стали плюшкой за частые обнимашки со многими участниками.";   
                                                $an2[14]="Козлом отпущения вы стали из-за частых пинков в ваш адрес. Не огорчайтесь, это полноценная нашивка со всеми полагающимися бонусами.";  
													 $an2[15]="Радуга дается всем друзьям Кирилл.";  
													  $an2[16]="Милитари дается всем друзьям Myst.";  
													   $an2[17]="Раксемус, как ни странно, дается всем друзьям Raxemus.";  
													     $an2[18]="Caelestis Rose дается всем друзьям Dingo";  
														   $an2[19]="Союз даётся всем друзьям StalkerWerewolf.";  
														    $an2[20]="Лис даётся всем друзьям Nikko.";  
															 $an2[21]="Игротека даётся всем друзьям Mao_Dzedyn.";  
															  $an2[22]="Крылья даётся всем друзьям Dragon-Man.";  
															   $an2[23]="Хиппи даётся всем друзьям Pepel.";  
															   	   $an2[25]="ErilaZ даётся всем друзьям KenderMistik.";  
																   	   $an2[24]="Барсик даётся всем друзьям Furry_Smith.";  
																	   	   $an2[26]="Косточка даётся всем друзьям Fatzi.";  
																		     $an2[27]="Меценат дается всем, кто пожертвовал деньги на развитие НоЦенса.";  
																			     $an2[28]="Только для истинных иллюминатов.";  
																				     $an2[29]="Апельсинка даётся всем друзьям NightOwl.";  
																					    $an2[30]="Кассета даётся всем друзьям Enotovski.";  
																				     $an2[31]="Kappa даётся всем друзьям Cpt.Agman.";  
																					   $an2[32]="Цап-царап даётся всем друзьям Dark Werwolf.";  
																					    $an2[33]="Какаши даётся всем друзьям Ankor_Wolf.";  

function achievements($a1, $uid, $ach, $level=1)
{
 global $db,$an,$an2;
 

 
 if($level==1)
 {
$sstr=$a1."";
 }
else if($level==2)
{
$sstr=$a1."-2";
}
else if($level==3)
{
$sstr=$a1."-3";
}

$achs = explode(",", $ach);
if(!in_array($sstr,$achs))
{
	
	if((($key = array_search($a1,$achs)) !== FALSE)||(($key = array_search($a1."-2",$achs)) !== FALSE)||(($key = array_search($a1."-3",$achs)) !== FALSE)){
		
     unset($achs[$key]);
}

 $achs[] = $sstr;
$newstr= implode(",", $achs);
$numofzpt=substr_count($newstr, ",");
 $db->query( "UPDATE " . USERPREFIX . "_users set  achieves='".$newstr."' where user_id='$uid'" );
 
 
     $subj="Вы получили нашивку ".$an[$a1]." ".$level." уровня!!!";

                     $time1 = time() + ($config['date_adjust'] * 60);
                     $ratng=50+$numofzpt*50*$level;
                             $cash=500+$numofzpt*100*$level;
                    $comments='<br /><img src="http://nocens.ru/pics2/ach/ach'.$a1.'.png" /><br /><br />'.$an2[$a1].' Вместе с нашивкой вы получаете '.$ratng.' очков рейтинга и '.$cash.' флопсов. <br> Нашивки выдаются за активность в различных разделах <b>NoCENS</b> и отображаются в вашем профайле. Их получение значительно продвигает вас в рейтинге и дает валюту сайта - флопсы. Кроме того, обладателям большого количества нашивок будут открываться дополнительные возможности на сайте.';
                    	$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$subj', '$comments', '$uid', 'Administration', '$time1', 'no', 'inbox')" );
			$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1,cash=cash+$cash, forum_reputation=forum_reputation+$ratng where user_id='$uid'" );
            
 }
}

function updatelevel($a1)
{
 global $db,$member_id;
 if($member_id&&$member_id[user_id]!='0'&&$member_id[user_id]!=""&&$member_id[level]<$a1&&$member_id[level]>0){
$uid=$member_id[user_id];
 $db->query( "UPDATE " . USERPREFIX . "_users set  level='".$a1."' where user_id='$uid'" );
 
 
     $subj="Вы достигли ".$a1." уровня!!!";

                     $time1 = time() + ($config['date_adjust'] * 60);
                 
                             $cash=$a1*1000;
                    $comments='Поздравляем с получением '.$a1.' уровня!<br /> С уровнем растет ваш авторитет и появляются новые возможности NoCENS.<br>Уровень зависит от Вашего рейтинга, который растет благодаря оценкам Ваших публикаций, подаркам и действиям.';
					
						$comments.='<p>Если Вы хотите сделать пользование <strong>NoCENS</strong> максимально комфортным, Вы можете &nbsp;выбрать:</p><p>&nbsp;</p>
<p>- Показывать на главной странице и других разделах сайта блоги, видео и картинки <strong>только от Ваших друзей</strong>.<br /><a href="index.php?do=change&amp;showtype=1" target="_blank">[ПОКАЗЫВАТЬ ТОЛЬКО ОТ ДРУЗЕЙ]</a>&nbsp;<a href="index.php?do=change&amp;showtype=2" target="_blank">[ПОКАЗЫВАТЬ ОТ ВСЕХ]</a></p>
<p>&nbsp;</p>
<p>- Показывать на главной странице только блоги или ленту действий.&nbsp;<br /><a href="index.php?do=change&amp;changemode=2" target="_blank">[ПОКАЗЫВАТЬ БЛОГИ]</a>&nbsp;<a href="index.php?do=change&amp;changemode=3" target="_blank">[ПОКАЗЫВАТЬ ЛЕНТУ ДЕЙСТВИЙ]</a>&nbsp;<a href="index.php?do=change&amp;changemode=1" target="_blank">[ПОКАЗЫВАТЬ СТАНДАРТНУЮ ГЛАВНУЮ]</a></p>
<p>&nbsp;</p>
<p>- Изменить показ&nbsp;информации грубого и&nbsp;непристойного содержания (для лиц старше 18 лет). &nbsp;Администрация NoCENS настоятельно не рекомендует использовать этот параметр впечатлительным людям.<br /><a href="index.php?do=change&amp;access=2" target="_blank">[НЕ ПОКАЗЫВАТЬ СОДЕРЖАНИЕ 18+]</a>&nbsp;<a href="index.php?do=change&amp;access=1" target="_blank">[ПОКАЗЫВАТЬ МАТЕРИАЛЫ 18+]</a></p>
<p>&nbsp;</p>
<p>Изменить эти&nbsp;настройки всегда можно в <a href="{username}" target="_blank">Вашем профайле</a>. Там же можно изменить внешний вид персональных разделов и многое другое.</p>';
					
                    	$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$subj', '$comments', '$uid', 'Administration', '$time1', 'no', 'inbox')" );
			$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1,cash=cash+$cash where user_id='$uid'" );
            
 }
}

//Temlates for main
//$tempwords = array('socfur_main1','socfur_main2','socfur_main3','socfur_main4','socfur_main5', 'socfur_sort_all','socfur_sort_friends','socfur_sort_me','socfur_sort_clan','socfur_gallery_last','socfur_gallery_bestweek','socfur_gallery_my','socfur_gallery_add','socfur_gallery_fav','socfur_gallery_photon','socfur_video_last','socfur_video_fav','socfur_video_my','socfur_video_add','socfur_blogs_last','socfur_blogs_creo','socfur_blogs_fav','socfur_blogs_my','socfur_blogs_add','socfur_actions_acts','socfur_actions_rec','socfur_actions_my','socfur_actions_all','socfur_actions_alllist','socfur_list_enter','socfur_list_register','socfur_list_forgot','socfur_list_menu','socfur_list_blogs','socfur_list_gallery','socfur_guest','socfur_whatsnew','socfur_list_public','socfur_list_video','socfur_list_forum','socfur_list_rating','socfur_fastmes','socfur_radio','socfur_gallery_icon','socfur_video_icon','socfur_blog_icon','socfur_actions_icon','socfur_advanced_search','socfur_suggest','socfur_donate','socfur_ads','socfur_vk','socfur_twi','socfur_Moscow','socfur_subculture','socfur_disclaimer','socfur_pleasereg','socfur_congr_main','socfur_popular','socfur_tostatus','socfur_toblog','socfur_mood','socfur_send','socfur_continue_big','socfur_smiles','socfur_attach','socfur_from','lost_login','lost_pass'); 
foreach ($lang2 as $t => $t2)
{
	$tpl->set ( '{'.$t.'}', $t2 );
}
//Templates for main


$tpl->compile ( 'main' );
$tpl->result['main'] = str_replace ( '{THEME}', $config['http_home_url'] . 'templates/' . $config['skin'], $tpl->result['main'] );
if ($replace_url) $tpl->result['main'] = str_replace ( $replace_url[0]."/", $replace_url[1]."/", $tpl->result['main'] );

# !!!включаем PHP в шаблонах

eval (' ?' . '>' . $tpl->result['main'] . '<' . '?php ');

#echo $tpl->result['main'];
$tpl->global_clear ();
$db->close ();


//echo("");
GzipOut ();
?>