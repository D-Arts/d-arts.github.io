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

$name = @$db->safesql( $_GET['page'] );

if( ! $static_result['id'] ) $static_result = $db->super_query( "SELECT * FROM " . PREFIX . "_static WHERE name='$name'" );

if( $static_result['id'] ) {
	
	$db->query( "UPDATE " . PREFIX . "_static set views=views+1 where id='{$static_result['id']}'" );
	
	$static_result['grouplevel'] = explode( ',', $static_result['grouplevel'] );
	
	if( $static_result['date'] ) $_DOCUMENT_DATE = $static_result['date'];
	
	if( $static_result['grouplevel'][0] != "all" and ! in_array( $member_id['user_group'], $static_result['grouplevel'] ) ) {
		msgbox( $lang['all_err_1'], $lang['static_denied'] );
	} else {
		
		$template = stripslashes( $static_result['template'] );
		$static_descr = stripslashes( strip_tags( $static_result['descr'] ) );
		
		if( $static_result['metakeys'] == '' AND $static_result['metadescr'] == '' ) create_keywords( $template );
		else {
			$metatags['keywords'] = $static_result['metakeys'];
			$metatags['description'] = $static_result['metadescr'];
		}

		if ($static_result['metatitle']) $metatags['header_title'] = $static_result['metatitle'];
		
		if( $static_result['allow_template'] or $view_template == "print" ) {
			
			if( $view_template == "print" ) $tpl->load_template( 'static_print.tpl' );
			elseif( $static_result['tpl'] != '' ) $tpl->load_template( $static_result['tpl'] . '.tpl' );
			else $tpl->load_template( 'static.tpl' );
			
			if( strpos( $tpl->copy_template, "{custom" ) !== false ) {
				
				$tpl->copy_template = preg_replace( "#\\{custom category=['\"](.+?)['\"] template=['\"](.+?)['\"] aviable=['\"](.+?)['\"] from=['\"](.+?)['\"] limit=['\"](.+?)['\"] cache=['\"](.+?)['\"]\\}#ies", "custom_print('\\1', '\\2', '\\3', '\\4', '\\5', '\\6', '{$do}')", $tpl->copy_template );
			
			}
			
			if( ! $news_page ) $news_page = 1;
			
			if( $view_template == "print" ) {
				
				$template = str_replace( "{PAGEBREAK}", "", $template );
				$template = str_replace( "{pages}", "", $template );
				$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", "", $template );
			
			} else {
				
				$news_seiten = explode( "{PAGEBREAK}", $template );
				$anzahl_seiten = count( $news_seiten );
				
				if( $news_page <= 0 or $news_page > $anzahl_seiten ) {
					$news_page = 1;
				}
				
				$template = $news_seiten[$news_page - 1];
				
				$template = preg_replace( '#(\A[\s]*<br[^>]*>[\s]*|<br[^>]*>[\s]*\Z)#is', '', $template ); // remove <br/> at end of string
				

				$news_seiten = "";
				unset( $news_seiten );
				
				if( $anzahl_seiten > 1 ) {
					
					if( $news_page < $anzahl_seiten ) {
						$pages = $news_page + 1;
						if( $config['allow_alt_url'] == "yes" ) {
							$nextpage = " | <a href=\"" . $config['http_home_url'] . "page," . $pages . "," . $static_result['name'] . ".html\">" . $lang['news_next'] . "</a>";
						} else {
							$nextpage = " | <a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=" . $pages . "\">" . $lang['news_next'] . "</a>";
						}
					}
					
					if( $news_page > 1 ) {
						$pages = $news_page - 1;
						if( $config['allow_alt_url'] == "yes" ) {
							$prevpage = "<a href=\"" . $config['http_home_url'] . "page," . $pages . "," . $static_result['name'] . ".html\">" . $lang['news_prev'] . "</a> | ";
						} else {
							$prevpage = "<a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=" . $pages . "\">" . $lang['news_prev'] . "</a> | ";
						}
					}
					
					$tpl->set( '{pages}', $prevpage . $lang['news_site'] . " " . $news_page . $lang['news_iz'] . $anzahl_seiten . $nextpage );
					
					if( $config['allow_alt_url'] == "yes" ) {
						$replacepage = "<a href=\"" . $config['http_home_url'] . "page," . "\\1" . "," . $static_result['name'] . ".html\">\\2</a>";
					} else {
						$replacepage = "<a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=\\1\">\\2</a>";
					}
					
					$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", $replacepage, $template );
				
				} else {
					
					$tpl->set( '{pages}', '' );
					$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", "", $template );
				
				}
			
			}
			
			if( $config['allow_alt_url'] == "yes" ) $print_link = $config['http_home_url'] . "print:" . $static_result['name'] . ".html";
			else $print_link = $config['http_home_url'] . "engine/print.php?do=static&amp;page=" . $static_result['name'];

			if( @date( "Ymd", $static_result['date'] ) == date( "Ymd", $_TIME ) ) {
				
				$tpl->set( '{date}', $lang['time_heute'] . langdate( ", H:i", $static_result['date'] ) );
			
			} elseif( @date( "Ymd", $static_result['date'] ) == date( "Ymd", ($_TIME - 86400) ) ) {
				
				$tpl->set( '{date}', $lang['time_gestern'] . langdate( ", H:i", $static_result['date'] ) );
			
			} else {
				
				$tpl->set( '{date}', langdate( $config['timestamp_active'], $static_result['date'] ) );
			
			}
	
			$tpl->copy_template = preg_replace ( "#\{date=(.+?)\}#ie", "langdate('\\1', '{$static_result['date']}')", $tpl->copy_template );
			

			$tpl->set( '{description}', $static_descr );
			$tpl->set( '{static}', $template );
			$tpl->set( '{views}', $static_result['views'] );
			
			 $out1='';
		$n1=$_GET['user'];
		$n2=$_GET['from']*1;
		$n3=$n2+20;
	
		$n4=$_GET['category'];
		$n6=$_GET['page'];
	$n5=0;
	if($category=='blog'||$category==17 ||$category==0)
					   {
 $row4 = $db->query("SELECT `autor`, `short_story`, `category`, `id`, `date` ,`title`,`comm_num`  FROM `".PREFIX."_post` WHERE autor='".$n1."' and  ( category='17' or category='0' )  order by id desc  LIMIT $n2,$n3 ");
					   }
					   else
					   {
						    $row4 = $db->query("SELECT `autor`, `short_story`, `category`, `id`, `date` ,`title`  ,`comm_num` FROM `".PREFIX."_post` WHERE autor='".$n1."' and category='".$n4."'  order by id desc  LIMIT $n2,$n3 ");
					   }
$quer = $db->num_rows($row4);
       if ($db->num_rows($row4)) {  
                if($image['comm_num']==0)
				{
					$image['comm_num']="Нет";
				}
                       
                     $out1.="<table><div align=\"center\">";
					 
					if($n2>=20)
								 {
									 $out1.="<a href=\"http://fluders.ru/index.php?do=static&page=".$n6."&category=".$n4."&user=".$n1."&from=".($n2-20)."\">Назад</a>";
								 }  
					if($quer>=20)
								 {
									 $out1.="|<a href=\"http://fluders.ru/index.php?do=static&page=".$n6."&category=".$n4."&user=".$n1."&from=".$n3."\">Далее</a><br>";
								 }   
								     $out1.="</div>";
                    while ($image = $db->get_row($row4)){
                        if (!$i)
                                 {}
								 $out1.="<tr><td width=\"10\" align=\"left\" valign=\"top\" bgcolor=\"#161D60\" class=\"bgnews2\"><img src=\"pics/thumb64.png\" alt=\"\" width=\"20\" height=\"20\" align=\"absbottom\" /></td><td height="20"  bgcolor=\"#989898\" align=\"left\" class=\"bgnews1\"><a href=\"http://fluders.ru/index.php?newsid=".$image['id']."\">".stripslashes($image['title'])."</a>&nbsp;</td></tr>"
								 $out1.="<tr><td>".stripslashes($image['short_story'])."";
								     $out1.= "<div align=\"right\">(опубликовано ".$image['date'].", <a href=\"http://fluders.ru/index.php?newsid=".$image['id']."#comment\">".$image['comm_num']." комментов</a>)</div><p>&nbsp;</p></td></tr><tr><td align=\"left\" valign=\"top\" class=\"a_block_12\"><img src=\"{THEME}/images/spacer.gif\" width=\"1\" height=\"8\" /></td></tr>";    
	                        $i++;
                    }  
					 $out1.="</table><div align=\"center\">";
					
					if($n2>=20)
								 {
									 $out1.="<a href=\"http://fluders.ru/index.php?do=static&page=".$n6."&category=".$n4."&user=".$n1."&from=".($n2-20)."\">Назад</a>";
								 }  
					if($quer>=20)
								 {
									 $out1.="|<a href=\"http://fluders.ru/index.php?do=static&page=".$n6."&category=".$n4."&user=".$n1."&from=".$n3."\">Далее</a><br>";
								 }                             
               
                      $out1.="</div>";
                    
                } else {
                    $out1.= 'Пусто';
                }               
                


	
$tpl->set('{out1}', $out1);
$tpl->set('{category}', $tpl->result['category']);
			if ($config['allow_search_print']) {

				$tpl->set( '[print-link]', "<a href=\"" . $print_link . "\">" );
				$tpl->set( '[/print-link]', "</a>" );

			} else {

				$tpl->set( '[print-link]', "<noindex><a href=\"" . $print_link . "\" rel=\"nofollow\">" );
				$tpl->set( '[/print-link]', "</a></noindex>" );

			}
			
			if( $_GET['page'] == "dle-rules-page" ) if( $do != "register" ) {
				
				$tpl->set( '{ACCEPT-DECLINE}', "" );
			
			} else {
				
				$tpl->set( '{ACCEPT-DECLINE}', "<form  method=\"post\" name=\"registration\" id=\"registration\" action=\"" . $config['http_home_url'] . "index.php?do=register\"><input type=\"submit\" class=\"bbcodes\" value=\"{$lang['rules_accept']}\" />&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"bbcodes\" value=\"{$lang['rules_decline']}\" onclick=\"history.go(-1); return false;\" /><input name=\"dle_rules_accept\" type=\"hidden\" id=\"dle_rules_accept\" value=\"yes\" /></form>" );
			
			}
			
			$tpl->compile( 'content' );

			if( $user_group[$member_id['user_group']]['allow_hide'] ) $tpl->result['content'] = preg_replace( "'\[hide\](.*?)\[/hide\]'si", "\\1", $tpl->result['content']);
			else $tpl->result['content'] = preg_replace ( "'\[hide\](.*?)\[/hide\]'si", "<div class=\"quote\">" . $lang['news_regus'] . "</div>", $tpl->result['content'] );

			$tpl->clear();
		
		} else
			$tpl->result['content'] = $template;
	}
	
	if( $config['files_allow'] == "yes" ) if( strpos( $tpl->result['content'], "[attachment=" ) !== false ) {
		
		$tpl->result['content'] = show_attach( $tpl->result['content'], $static_result['id'], true );
	
	}

} else {
	
	@header( "HTTP/1.0 404 Not Found" );
	msgbox( $lang['all_err_1'], $lang['news_page_err'] );

}
?>