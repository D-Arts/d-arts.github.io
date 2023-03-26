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
 Файл: topnews.php 
-----------------------------------------------------
 Назначение: вывод рейтинговых статей
=====================================================
*/

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}
include ('engine/api/api.class.php');

if($member_id[black]!=""&&$member_id[showtype]=='0')
{
	$black=explode(", ", $member_id['black']);
	 $blacklist="AND autor NOT IN ('" . implode( "','",  $black ) . "') ";
	

	 $blacklist2="AND a.autor NOT IN ('" . implode( "','",  $black ) . "') ";
	 	 $blacklist3="AND uname NOT IN ('" . implode( "','",  $black ) . "') ";
}
else if($member_id[friends]!=""&&$member_id[showtype]=='1')
{
		$black=explode(", ", $member_id['friends']);
	 $blacklist="AND (user_id IN ('" . implode( "','",  $black ) . "') OR user_id = '".$member_id[user_id]."') ";
	

	 $blacklist2="AND (a.user_id  IN ('" . implode( "','",  $black ) . "') OR a.user_id = '".$member_id[user_id]."') ";
	 	 $blacklist3="AND (user_id IN ('" . implode( "','",  $black ) . "') OR user_id = '".$member_id[user_id]."')";
}
else
{
		
	 $blacklist="";
	

	 $blacklist2=" ";
	 	 $blacklist3=" ";
}
	if(($member_id[user_group]=='5'||$member_id[cens]==0))
						{
							 $addcens = "AND cens!='1' ";
							  $addcens2 = "AND a.cens!='1' ";
						}
						
$topnews = dle_cache( "topnews", $config['skin'] );

$topnews2 = dle_cache( "topnews2_".$member_id[user_id], $config['skin'] );
$toppics = dle_cache( "toppics_".$member_id[user_id], $config['skin'] );

$toppics18 = dle_cache( "toppics18_".$member_id[user_id], $config['skin'] );
$topvids = dle_cache( "topvids_".$member_id[user_id], $config['skin'] );

$bestnews = dle_cache( "bestnews", $config['skin'] );
$topmen = dle_cache( "topmen", $config['skin'] );
$calen = dle_cache( "calen", $config['skin'] );
$calen2 = dle_cache( "calen2", $config['skin'] );
$topposts = dle_cache( "topposts", $config['skin'] );
$toppostsv = dle_cache( "toppostsv", $config['skin'] );
$toppostsg = dle_cache( "toppostsg", $config['skin'] );
$bestpics = dle_cache( "bestpics", $config['skin'] );
$recommend = dle_cache( "recommend", $config['skin'] ); 
require_once(ENGINE_DIR.'/data/config.gallery.php');
	
	if( ! $topnews2 && !$_GET['subaction']&&!$_GET['do']&&!$_GET[user]) {

	 	 $row3 = $db->query( "(SELECT a.*, b.foto, (a.rating-DATEDIFF(NOW(),a.date)/2) as param  FROM " . PREFIX . "_post a, " . PREFIX . "_users b  WHERE a.autor=b.name AND a.approve='1'  AND a.date>(CURRENT_TIMESTAMP - INTERVAL 14 DAY)  AND category!='31'  ".$blacklist2.$addcens2."  ORDER BY param DESC LIMIT 0,3) UNION ALL(SELECT a.*, b.foto , (a.rating*30-TIMESTAMPDIFF(MINUTE,a.date,NOW())) as param  FROM " . PREFIX . "_post a, " . PREFIX . "_users b  WHERE a.autor=b.name AND approve='1' AND category!='31' ".$blacklist2.$addcens2." ORDER BY  fixed desc, param desc, id DESC LIMIT 0,11)" );
	$ik=0;

       if ($db->num_rows($row3)) {  
               
                    $galleryCenter = '<div style=""> '; 
                    
                    while ($image = $db->get_row($row3)){
								
								$image['title'] = str_replace("<br>"," \n",$image['title']);
									$image['title'] = str_replace("<br\>"," \n",$image['title']);
$image['title'] = str_replace("</p>"," \n",$image['title']);
	$image['short_story'] = str_replace("<br\>"," \n",$image['short_story']);
	$image['short_story'] = str_replace("<br>"," \n",$image['short_story']);
$image['short_story'] = str_replace("</p>"," \n",$image['short_story']);

						$ik++;
if($ik>8)
		break;						
                        if (!$i)
					{
					}
					if(!$image[foto])
					{
						$image[foto]="que.png";
					}
					if($image['category']=='35'&&$ik>3)
					{
							$image['title']=trim(strip_tags($image['short_story']));
								if( strlen( $image['title'] ) > 105 && $ik>3 ) { 
								$image['title'] = trim(stripslashes(substr( $image['title'], 0, 105 ))) . " ...";}
		else $image['title'] = ''.stripslashes($image['title']).'';
	
		$shortstory="";
		if($ik<=3)
		{
					$shortstory=substr($image[title], 0, 150 );
						$shortstory="«".$shortstory."»";
						$image[title]="<span style=\"font-size: 14px;\"><b>{socfur_messagefrom} ".$image[autor].":</b></span>";
		}
		
					}
					else if($ik>3)
					{	$image[title]="".$image[title]."";
							$image['title']=strip_tags($image['title']);
								if( strlen( $image['title'] ) > 105 ) $image['title'] = stripslashes(substr( $image['title'], 0, 105 )) . " ...";
		else $image['title'] = stripslashes($image['title']);
		$image[title]="<span style=\"font-size: 14px;\"><b>".$image[title]."</b></span>";
				$shortstory="";
				if(strlen($image[short_story])>=200){
		$shortstory=substr(stripslashes(strip_tags($image[short_story])), 0, 200 )."...";
				}
				else
				{$shortstory=stripslashes(strip_tags($image[short_story]));
				}
					}
				
				else if($ik>3)
					{
							$image['title']=strip_tags($image['title']);
								if( strlen( $image['title'] ) > 105 ) $image['title'] = stripslashes(substr( $image['title'], 0, 105 )) . " ...";
		else $image['title'] = stripslashes($image['title']);
		$image[title]="<span style=\"font-size: 14px;\"><b>".$image[title]."</b></span>";
				$shortstory="";
		$shortstory="";
					}
					else
					{
							$image['title']=strip_tags($image['title']);
								if( strlen( $image['title'] ) > 105 ) $image['title'] = stripslashes(substr( $image['title'], 0, 105 )) . " ...";
		else $image['title'] = stripslashes($image['title']);
		$image[title]="<span style=\"font-size: 14px;\"><b>".$image[title]."</b></span>";
	//<span style=\"color: #060;\"> +".$image[rating]."</span>
				$shortstory=substr(stripslashes(strip_tags($image[short_story])), 0, 150 )."...";
					}
						$id=$image[id];
						
						if($image['id']==""||$image['id']=="0")
						{
							$image['id']='//nocens.ru/blogs/'.$image['autor'];
						}
						else
						{
							$image['id']='//nocens.ru/post/'.$image['id'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
						 if($ik>3)
						 {
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainbl.tpl");
							$TplThumb = str_replace("{cnt}", $ik-3, $TplThumb);
						 }
						 else
						 {$TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainblw.tpl");
							 $TplThumb = str_replace("{cnt}", "", $TplThumb);
						 }
						
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$image['title'] = str_replace("\r","&nbsp;",$image['title']);
$image['title'] = str_replace("\n","&nbsp;<br>",$image['title']);

if($image['rating']>0)
{
	$pad='<img src=\\\"//nocens.ru/templates/Darts2/images/news_up.png\\\">';
}
else
{
	$pad='<img src=\\\"//nocens.ru/templates/Darts2/images/news_down.png\\\">';
}
							//$add1="onmouseover=\"tooltip.show('<b>Рейтинг:</b> ".$image['rating']."<br><b>Комментариев:</b> ".$image['comm_num']."<br><b>Просмотров:</b> ".$image['news_read']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('newsid=".$id."','1'); return false;\" $add1  href=\"".$image['id']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
								   $imginfo = @getimagesize("http://nocens.ru/uploads/fotos/" . $image[foto]);
					if($imginfo[1]==0){ $imginfo[1]=100; $imginfo[0]=100;}

					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=intval(45*$img_koeff-15);
                    $imgw=$img_koeff*45;
					
					if($ik<=3)
					{
									$g2='<a onclick="DlePage(\'user='.$image[autor].'\'); return false;" href="//nocens.ru/"><img width="'.$imgw.'" height="45" align="left"  src="//nocens.ru/uploads/fotos/'.$image[foto].'"></a>';	$TplThumb = str_replace("{foto}", $g2, $TplThumb);
										$TplThumb = str_replace("{src}", $image['title']."", $TplThumb);
					}
					else
					{
							$g2='<img  src="//nocens.ru/pics/status/p'.$image[type].'.png"> ';	$TplThumb = str_replace("{src}", $g2.$image['title']."", $TplThumb);
					}
									
							
									$TplThumb = str_replace("{text2}", "<p class=\"grayer\" style=\"text-align: left;\">".$shortstory."</p>", $TplThumb);
							
								
							
								$TplThumb = str_replace("{src}", $g2.$image['title'], $TplThumb);
							
					if($image['rating'])
							{
						//	$divright='<div  style="float: right; color: #FFF;">&#x2665; '.$image['rating'].'</div>';
							}
							else
							{	$divright="";
							}
							$censadd="";
				
				if($ik<=3)
		$censadd=' <span class="adult">&hearts;'.$image[rating].'</span>'.$censadd;
if($image[cens]=='1'){
							 $censadd.=' <span class="adult">18+</span>';
						}
						else
						{
								 $censadd.='';
						}
							$TplThumb = str_replace("{author}", $divright.'<a onclick="DlePage(\'do=blogs&user='.$image[autor].'\'); return false;"  title="К блогу '.$image[autor].'" href="//nocens.ru/blogs/'.$image[autor].'">'.$image[autor].'</a>'.$censadd, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                       
				   }                        
                     $galleryCenter = $galleryCenter.'';
                    $galleryCenter .= '<div style="float: left;"></div>';   
                 
                } else {
                    $galleryCenter .= 'В этом альбоме нет фотографий.';
			
		
                }       
				$topnews2= $galleryCenter;
				
				//secound new
				
		 	 $row3 = $db->query( "(SELECT a.*, b.foto, (a.rating-DATEDIFF(NOW(),a.date)/3) as param  FROM " . PREFIX . "_post a, " . PREFIX . "_users b  WHERE a.autor=b.name AND a.approve='1'  AND a.date>(CURRENT_TIMESTAMP - INTERVAL 14 DAY)  AND category='31'  ".$blacklist2.$addcens2."  ORDER BY param DESC LIMIT 0,3) UNION ALL(SELECT a.*, b.foto , (a.rating*30-TIMESTAMPDIFF(MINUTE,a.date,NOW())) as param   FROM " . PREFIX . "_post a, " . PREFIX . "_users b  WHERE a.autor=b.name AND approve='1' AND category='31' ".$blacklist2.$addcens2." ORDER BY  fixed desc, param desc, id DESC LIMIT 0,11)" );
	$i=0;
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
								if($image['category']=="31")
						{
                        if (!$i)
					{
					}
					
					if($image[fixed]=='0'&&$i==0)
					$i++;
				if($i>8)
				break;
$image['title'] = stripslashes($image['title']);
		
		 if($i==4&&$image[fixed]=='1'){
			 $matches = array();
					 preg_match_all( "#<!--dle_youtube_begin:(.+?)-->(.+?)<!--dle_youtube_end-->#is", $image[full_story], $matches );
				$srcn=	$matches[0][0];
				//$src1=str_replace("560","486",$src1);
				//	$src1=str_replace("350","290",$src1);
		
				preg_match('/src="([^"]+)"/', $image[full_story], $matches2);
				$url = $matches2[1];
				$endurl=substr($url,strpos($url,"/embed/")+7,11);

			
					$src1='<div style=" margin: 3px; background-repeat: no-repeat; border: 1px solid #000; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.43); "><div style=" width: 478px;  height: 286px; background-image: url(//img.youtube.com/vi/'.$endurl.'/0.jpg);  background-size: 100% 166%;  background-position: center center;"></div></div>';
				
		}
		else if($i<4)
		{
			 $matches = array();
					 preg_match_all( "#<!--dle_youtube_begin:(.+?)-->(.+?)<!--dle_youtube_end-->#is", $image[full_story], $matches );
				$srcn=	$matches[0][0];
				//$src1=str_replace("560","486",$src1);
				//	$src1=str_replace("350","290",$src1);
		
				preg_match('/src="([^"]+)"/', $image[full_story], $matches2);
				$url = $matches2[1];
				$endurl=substr($url,strpos($url,"/embed/")+7,11);

			//	$src1='<img width="486" height="290" src="//img.youtube.com/vi/'.$endurl.'/0.jpg">';
				$src1='<div style=" margin-top: 2px; background-repeat: no-repeat; border: 1px solid #000; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.43); "><div style=" width: 311px;  height: 117px; background-image: url(//img.youtube.com/vi/'.$endurl.'/0.jpg);  background-size: 100% 166%;  background-position: center center;"></div></div>';
		}
		else
		{
						
							$src1='<div style="padding-left: 15px;">'.$image['short_story']."</div>";
		}
					
						
						if($image['id']==""||$image['id']=="0")
						{
							$image['link']='//nocens.ru/video/'.$image['autor'];
						}
						else
						{
							$image['link']='//nocens.ru/post/'.$image['id'];
						}
						
						if($image[fixed]=='1'){
					$addautoplay='&autoplay=1';
						
						}
						else
						{
								$addautoplay='';
						}
							$image['link'].=$addautoplay;
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
						 		 if($i==4&&$image[fixed]=='1'){
							            $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainvideobig.tpl");
										$i--;
						 }
						  else if($i<4)
						 {$TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainvw.tpl");
							 $TplThumb = str_replace("{cnt}", "", $TplThumb);
						 }
						 else
						 {
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainv.tpl");
						 }
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);
$image['short_story']=strip_tags($image['short_story']);
							$add1="onmouseover=\"tooltip.show('".$image['title']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('newsid=".$image['id'].$addautoplay."','1'); return false;\" $add1 href=\"".$image['link']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
					
							if(!$image['game2']||$image['game2']=='0')
							{
							$g2='';
							}
							else
							{
										$g2='';
							}
								$TplThumb = str_replace("{src}", $g2.$src1, $TplThumb);
							
							
							
				

								 if($i==0&&$image[fixed]=='1'){
							$divright='<div  style="float: right; color: #FFF; padding-right: 2px;"><a  onclick="DlePage(\'newsid='.$image[id].'\',1); return false;" href="//nocens.ru/post/'.$image[id].'">Страница видео &rarr;</a></div>';
							}
							else
							{	$divright="";
							}
							
							$censadd="";
							if($i<4)
					$censadd=' <span class="adult">&hearts;'.$image[rating].'</span>'.$censadd;
					
							 if($image[cens]=='1'){
							 $censadd.=' <span class="adult">18+</span>';
						}
						else
						{
								 $censadd.='';
						}
							$TplThumb = str_replace("{author}", $divright.'<a onclick="DlePage(\'do=video&user='.$image['autor'].'\'); return false;"  title="К видеоблогу '.$image['autor'].'" href="//nocens.ru/?do=video&user='.$image['autor'].'">'.$image['autor'].'</a>'.$censadd, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }   
							if($image['type']=="news"||$image['type']=="news2")
						{
                        if (!$i)
					{
					}
					$image['src']=strip_tags($image['src']);
					if( strlen( $image['src'] ) > 105 ) $image['src'] = stripslashes(substr( $image['src'], 0, 105 )) . " ...";
		else $image['src'] = stripslashes($image['src']);
		
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1=$image[action];
						}
						else if($image[type]=="news2")
						{
							$src1='<i>«'.$image['src'].'»</i>';
						}
						else
						{
							$src1=$image['src'];
						}
						$id=$image[link];
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/blogs/'.$image['ufrom'];
						}
						else
						{
							$image['link']='//nocens.ru/post/'.$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
						 if($i==0&&$image[fixed]=='1'){
							            $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainvideobig.tpl");
										
						 }
						 else
						 {
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainbl.tpl");
						 }
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);

							$add1="onmouseover=\"tooltip.show('Автор: ".$image['ufrom']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('newsid=".$id."','1'); return false;\" $add1 href=\"".$image['link']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
					
							if(!$image['game2']||$image['game2']=='0')
							{
								$g2='<img align="texttop" src="//nocens.ru/pics/status/p'.$n1[game2].'.png"> ';
							}
							else
							{
									$g2='<img align="texttop" src="//nocens.ru/pics/status/p'.$image[game2].'.png"> ';
							}
								$TplThumb = str_replace("{src}", $g2.$src1, $TplThumb);
							
							
							
				
						
							$TplThumb = str_replace("{author}", '<a onclick="DlePage(\'do=video&user='.$image['autor'].'\'); return false;"  title="К видеоблогу '.$image[autor].'" href="//nocens.ru/video/'.$image['autor'].'">'.$image['autor'].'</a>', $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }   
						else if($image['type']=="pic")
						{
                        if (!$i)
					{
					}
						
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1="//nocens.ru/pics/linkinf3add.png";
						}
						else
						{
							$src1=$image['src'];
						}	
							$n1=$dle_api->take_user_by_name($image['ufrom']);
							$id=$image[link];
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/album/'.$n1[name].'&view=1';
						}
						else
						{
							$image['link']="//nocens.ru/photo/".	$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmain.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);

							$add1="onmouseover=\"tooltip.show('Автор: ".$image['ufrom']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('do=gallery&bigphoto=".$id.",'1'); return false;\" $add1 href=\"".$image['link']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
						
							
								$TplThumb = str_replace("{src}", $src1, $TplThumb);
							
							
					
						
						
							$TplThumb = str_replace("{author}", '<span class="copy"><b><a onclick="DlePage(\'do=album&user='.$n1[name].'&view=1\'); return false;"  href="//nocens.ru/'.$n1['name'].'">'.$n1['name'].'</a></b><b><a onclick="DlePage(\'do=album&user='.$n1[name].'&view=1\'); return false;" href="//nocens.ru/album/'.$n1[name].'&view=1"><img title="Персональная галерея" align="left" border="0" src="//nocens.ru/pics/addpic.png"></a></b></span>', $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }       }                        
                     $galleryCenter = $galleryCenter.'';
                    $galleryCenter .= '<div style="float: left;"></div>';   
                 
                } else {
                    $galleryCenter .= 'В этом альбоме нет фотографий.';
			
		
                }       
				$topvids= $galleryCenter;
				
			$galleryCenter="";
			
			
		
				//3 new
			    
				
				$galleryCenter="";
				$addg="(rating/4-(time_to_sec(timediff(NOW(),FROM_UNIXTIME(date)))/360)) as score";

 $sevendays =  $_TIME-604800;
		
		if($member_id[name]==""||$member_id[cens]!='1')
		{
			$censq=" AND cens!='1' ";
		}
		
				// 3600
				// 1300*rating
				 
				 $row3 = $db->query("( SELECT *, (rating*100-TIMESTAMPDIFF(MINUTE,FROM_UNIXTIME(date),NOW())) as param  FROM ".PREFIX."_gallery_photos where (category!='32')  and (hide!= '1') ".$blacklist3.$censq."  order by   param DESC, date desc LIMIT 0,11)");
				 
							
	$i1=0;
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
					
                        if (!$i)
					{
					}
						
					$src1='//nocens.ru/i/'.$image['user_id'].'/thumb/'.$image['name'].'';
					$linkfoto='//nocens.ru/photo/'.$image['id'].'';
						
					
							$newlink='//nocens.ru/album/'.$image[uname].'&view=1';
						
						
                            $date = langdate($config['timestamp_comment'],  $image['date']);
							
								
					if($i1==220)
					{
						$src1='//nocens.ru/uploads/gallery/thumbbig/'.$image['name'].'';
						 $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainbig.tpl");
							$TplThumb = str_replace("{src}", $src1, $TplThumb);
					}
					else if($i1>-1)
					{
						  $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmain_new.tpl");
							$TplThumb = str_replace("{src}", $src1, $TplThumb);
					}
					else
					{
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmain.tpl");
							$TplThumb = str_replace("{src}", $src1, $TplThumb);
					}
					$i1++;
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r"," ",$image['title']);
$titl = str_replace("\n"," ",$titl);

$titl=stripslashes(strip_tags($titl));
$titl = str_replace("\""," ",$titl);
$titl = str_replace("'"," ",$titl);
							$add1="onmouseover=\"tooltip.show('".$titl."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('do=gallery&bigphoto=".$image['id']."','1'); return false;\" $add1 href=\"".$linkfoto."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
						$TplThumb = str_replace("{alter}", $titl, $TplThumb);
							
								
						if($image['rating'])
							{
							//$divright='<div  style="float: right; color: #FFF;">&#x2665; '.$image['rating'].'</div>';
							}
							else
							{	$divright="";
							}
							
					
					if($image[cens]=='1'){
							 $censadd=' <span class="adult">18+</span>';
						}
						else
						{
								 $censadd='';
						}
						if($image[param]>=-10&&$image[rating]>4)
												$censadd=' <span class="adult"><b>TOP</b></span>'.$censadd;

//&hearts;'.$image[rating].'
							$TplThumb = str_replace("{author}", $divright.'<a onclick="DlePage(\'do=album&user='.$image['uname'].'&view=1\'); return false;"   title="К галерее '.$image[uname].'" href="//nocens.ru/album/'.$image['uname'].'&view=1">'.$image['uname'].'</a>'.$censadd, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }                     
                     $galleryCenter = $galleryCenter.'';
                    $galleryCenter .= '<div style="float: left;"></div>';   
                 
                } else {
                    $galleryCenter .= 'В этом альбоме нет фотографий.';
			
		
                }       
				
				$toppics18= $galleryCenter;
						$toppics= $galleryCenter;
				create_cache( "topnews2_".$member_id[user_id], $topnews2, $config['skin'] );
	create_cache( "topvids_".$member_id[user_id], $topvids, $config['skin'] );
		create_cache( "toppics_".$member_id[user_id], $toppics, $config['skin'] );
				create_cache( "toppics18_".$member_id[user_id], $toppics18, $config['skin'] );
	}

if( ! $topnews ) {
	
	$this_month = date( 'Y-m-d H:i:s', $_TIME );
	
	
		 $rowach = $db->query( "SELECT name, user_id, achieves,forum_reputation from dle_users where (forum_reputation>10000 and achieves not like '%6,%') OR (forum_reputation>50000 and achieves not like '%6-2,%') OR (forum_reputation>100000 and achieves not like '%6-3,%')  " );
	
       if ($db->num_rows($rowach)) {  
             while ($image = $db->get_row($rowach)){
				 if($image[forum_reputation]>=100000)
				  achievements(6,$image[user_id],$image[achieves],3);
				 else if ($image[forum_reputation]>=50000)
				 	  achievements(6,$image[user_id],$image[achieves],2);
				 else
				 achievements(6,$image[user_id],$image[achieves]);
						
			 }
	   }
	   
	   	 $rowach = $db->query( "SELECT name, user_id, achieves,cash from dle_users where (cash>50000 and achieves not like '%7,%') OR  (cash>100000 and achieves not like '%7-2,%') OR   (cash>500000 and achieves not like '%7-3,%') " );
	
       if ($db->num_rows($rowach)) {  
             while ($image = $db->get_row($rowach)){
				  if($image[cash]>=500000)
				  achievements(7,$image[user_id],$image[achieves],3);
				 else if ($image[cash]>=100000)
				 	  achievements(7,$image[user_id],$image[achieves],2);
				 else
				 achievements(7,$image[user_id],$image[achieves]);
						
			 }
	   }


	   
	 $row3 = $db->query( "SELECT a.*, b.foto FROM " . PREFIX . "_post a, " . PREFIX . "_users b  WHERE a.autor=b.name AND a.approve='1' AND a.date>(CURRENT_TIMESTAMP - INTERVAL 14 DAY) ORDER BY a.fixed desc, a.rating DESC LIMIT 0,3" );
	
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
								
						
                        if (!$i)
					{
					}
					if($image['category']=='35')
					{
							$image['title']=strip_tags($image['short_story']);
								if( strlen( $image['title'] ) > 105 ) { 
								$image['title'] = stripslashes(substr( $image['title'], 0, 105 )) . " ...";}
		else $image['title'] = stripslashes($image['title']);
		$image[title]="«".$image[title]."»";
						$shortstory=$image[title];
						$image[title]="<span style=\"font-size: 14px;\"><b>{socfur_messagefrom} ".$image[autor].":</b> </span><span style=\"color: #060;\">+".$image[rating]."</span>";
					}
					else
					{
							$image['title']=strip_tags($image['title']);
								if( strlen( $image['title'] ) > 105 ) $image['title'] = stripslashes(substr( $image['title'], 0, 105 )) . " ...";
		else $image['title'] = stripslashes($image['title']);
		$image[title]="<span style=\"font-size: 14px;\"><b>".$image[title]."</b> </span><span style=\"color: #060;\">+".$image[rating]."</span>";
				$shortstory=substr(stripslashes(strip_tags($image[short_story])), 0, 200 )."...";
					}
			
		
		
						$id=$image[id];
						
						if($image['id']==""||$image['id']=="0")
						{
							$image['id']='//nocens.ru/blogs/'.$image['autor'];
						}
						else
						{
							$image['id']='//nocens.ru/post/'.$image['id'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainrow.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);
if($image['rating']>0)
{
	$pad='<img src=\\\"//nocens.ru/templates/Darts2/images/news_up.png\\\">';
}
else
{
	$pad='<img src=\\\"//nocens.ru/templates/Darts2/images/news_down.png\\\">';
}
							//$add1="onmouseover=\"tooltip.show('<b>Рейтинг:</b> ".$image['rating']."<br><b>Комментариев:</b> ".$image['comm_num']."<br><b>Просмотров:</b> ".$image['news_read']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('newsid=".$id."','1'); return false;\"  $add1 href=\"".$image['id']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
						
							   $imginfo = @getimagesize("http://nocens.ru/uploads/fotos/" . $image[foto]);
					if($imginfo[1]==0){ $imginfo[1]=100; $imginfo[0]=100;}

					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=intval(45*$img_koeff-15);
                    $imgw=$img_koeff*45;
					
									$g2='<a onclick="DlePage(\'user='.$image[autor].'\'); return false;"  href="//nocens.ru/'.$image[autor].'"><img width="'.$imgw.'" height="45" align="left"  src="//nocens.ru/uploads/fotos/'.$image[foto].'"></a>';
										$TplThumb = str_replace("{foto}", $g2, $TplThumb);
								$TplThumb = str_replace("{src}", $image['title']."", $TplThumb);
									$TplThumb = str_replace("{text2}", "<p class=\"grayer\" style=\"text-align: left;\">".$shortstory."</p>", $TplThumb);
					/*		if($image['comm_num'])
							{
							$divright='<div title="Комментарии" style="float: right;"><a href="'.$image['id'].'#comment"><img align="texttop" src="//nocens.ru/pics2/comms.png">'.$image['comm_num'].'</a></div>';
							}
				*/
						
							$TplThumb = str_replace("{author}", $divright.'<span class="copy"><a onclick="DlePage(\'user='.$image[autor].'\'); return false;"  href="//nocens.ru/'.$image[autor].'"><b>'.$image[autor].'</b></a></span>', $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                       
				   }                        
                     $galleryCenter = $galleryCenter.'';
                    $galleryCenter .= '<div style="float: left;"></div>';   
                 
                } else {
                    $galleryCenter .= 'В этом альбоме нет фотографий.';
			
		
                }       
				$topnews.= $galleryCenter;
	
		
	
	$db->free();
	
	
	//Советуем почитать
	
	$th1 = date ( "Y-m-d", $_TIME );
    $birthdate_array = explode('-',$th1);
    $birth_y = $birthdate_array[0];
    $birth_m = $birthdate_array[1];
    $birth_d = $birthdate_array[2];
$nb=0;
$nb2="";
 $timing=time()-60*60*24*7;
                $addqueue.="AND date>'".$timing."' ";
 $row3 = $db->query("SELECT * FROM ".PREFIX."_gallery_photos where (cens= '0') and (category!='32') and (hide!= '1') ".$addqueue." order by rating DESC LIMIT 0,4");
	$i1=0;
	$PagesArr = array();

					
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
					
                   	$src1='//nocens.ru/i/'.$image['user_id'].'/thumb/'.$image['name'].'';
					$linkfoto='//nocens.ru/photo/'.$image['id'].'';
					
					$pad=0;
								$imginfo = @getimagesize($src1);
					if($imginfo[1]==0) $imginfo[0]=1;
					if($imginfo[0]>$imginfo[1])
					{
					$img_koeff = $imginfo[1]/$imginfo[0];
					$imgal=intval(74*$img_koeff-15);
					$w='74';
					$h=(74*$img_koeff);
					if($h<74)
					$pad=round((74-$h)/2);
				
					}
					else
					{
							
					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=intval(74*$img_koeff-15);
						$h='74';
					$w=(74*$img_koeff);
					}
					$img='<p align="center" style="padding: 2px; padding-top: '.$pad.'px;"><a onclick="DlePage(\'do=gallery&bigphoto='.$image['id'].'\',\'1\'); return false;" href="'.$linkfoto.'"><img  title="'.$image['title'].'"  src="'.$src1.'" width="'.$w.'" height="'.$h.'" /></a></p>';
					$PagesArr[]=$img;
					}
			
		
                }       
				$bestpics='<div class="mainblockmini">'.$PagesArr[0].'</div><div class="mainblockmini" style=" margin-left: 5px;">'.$PagesArr[1].'</div><div class="mainblockmini" style="margin-top:5px;">'.$PagesArr[2].'</div><div class="mainblockmini" style="margin-top:5px; margin-left: 5px;">'.$PagesArr[3].'</div>';

$data=time() - (7 * 24 * 60 * 60);
$events = $db->query("Select * from ((SELECT id, date, short_story, title, autor, type, YEAR(date) as year, rating FROM ".PREFIX."_post WHERE date>(CURRENT_TIMESTAMP - INTERVAL 7 DAY) or (MONTH(date)='".$birth_m."' AND DAY(date)='".$birth_d."')  order by  fixed desc, ((year-2009)*3+rating) DESC LIMIT 0,10) UNION (SELECT id, from_unixtime(date), name as title, title as short_story, uname as autor, type, YEAR(from_unixtime(date)) as year, rating FROM ".PREFIX."_gallery_photos WHERE date>'".$data."'  order by  rating DESC LIMIT 0,10)) as p2 order by date desc");
$numfr=0;


		while ($row1 = $db->get_row($events)){
			
			if(strpos($row1[type],'image')||strpos($row1[type],'swf')||strpos($row1[type],'shockwave'))
{
		$row1[short_story]='<img src="'.$row1[title].'"><br>'.strip_tags($row1[short_story]);
}
else
{
			$row1[short_story]='<h2><img width="14" height="14" src="//nocens.ru/pics/status/p'.$row1['type'].'.png">'.$row1[title].'</h2>'.strip_tags($row1[short_story]);
}
			
			if( strlen( $row1[short_story] ) >250) 
			{
$short_story = stripslashes(substr( $row1[short_story], 0, 250 ))."...";
			}
else
$short_story = stripslashes($row1[short_story]);
$short_story = str_replace("\n","",$short_story);
$short_story= str_replace("\r","",$short_story);
$short_story= str_replace("\"","",$short_story);
$title=stripslashes($row1['title']);
if(strpos($row1[title],'/thumb/'))
{
	$show="onmouseover=\"tooltip.show('".$short_story."<br><i>(".$row1['autor']." &hearts;".$row1['rating'].", ".$row1['year']."г.)</i>');\" onmouseout=\"tooltip.hide();\"";

		$ev.='<p class="toprow"><span '.$show.' style=""><a  onclick="DlePage(\'do=gallery&bigphoto='.$row1['id'].'\',1); return false;"  href="//nocens.ru/photo/'.$row1['id'].'"><b>'.$short_story.'</b></a></span></p>';

}
else
{
$show="onmouseover=\"tooltip.show('".$short_story."<br><i>(".$row1['autor']." &hearts;".$row1['rating'].", ".$row1['year']."г.)</i>');\" onmouseout=\"tooltip.hide();\"";

		$ev.='<p class="toprow"><span '.$show.' style=""><a  onclick="DlePage(\'newsid='.$row1['id'].'\',1); return false;"  href="//nocens.ru/post/'.$row1['id'].'"><b>'.$title.'</b></a></span></p>';

}
            }
            
         


           
		 
		   

 
                    $nb3='<h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px; margin-top: -2px;" >{socfur_popular} <img align="texttop" src="pics/buts/arrow.png"></h2>'.$ev;
					
$topposts=$nb3;

$nb3="";
$ev="";
$eventsv = $db->query("SELECT id, short_story, full_story, title, autor, type, YEAR(date) as year, rating FROM ".PREFIX."_post WHERE (date>(CURRENT_TIMESTAMP - INTERVAL 7 DAY) or (MONTH(date)='".$birth_m."' AND DAY(date)='".$birth_d."')) AND category='31' AND rating>='8'  order by RAND() LIMIT 0,1");
if(!$eventsv)
$eventsv = $db->query("SELECT id, short_story, full_story, title, autor, type, YEAR(date) as year, rating FROM ".PREFIX."_post WHERE (date>(CURRENT_TIMESTAMP - INTERVAL 7 DAY) or (MONTH(date)='".$birth_m."' AND DAY(date)='".$birth_d."')) AND category='31'  order by rating DESC LIMIT 0,1");
$numfr=0;


		while ($row1 = $db->get_row($eventsv)){
		$short_story='<h2>'.$row1[title].'</h2>'.strip_tags($row1[full_story]);
	$short_story = str_replace("\n","",$short_story);
$short_story= str_replace("\r","",$short_story);
$short_story= str_replace("\"","",$short_story);
$title=stripslashes($row1[short_story]);

$show="onmouseover=\"tooltip.show('".$short_story."<br><i>(".$row1['autor']." &hearts;".$row1['rating'].", ".$row1['year']."г.)</i>');\" onmouseout=\"tooltip.hide();\"";
		$ev.='<div class="mainblocktops" style="padding-left: 15px;"><span '.$show.' style=""><a  onclick="DlePage(\'newsid='.$row1['id'].'\',1); return false;"  href="//nocens.ru/post/'.$row1['id'].'">'.$title.'</a></span></div>';
       
     
            }
            
         


           
		 
		   


	     
                    $nb3='<h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px; margin-top: -2px;" >Свежее видео <img align="texttop" src="pics/buts/arrow.png"></h2>'.$ev;
$toppostsv=$nb3;


$nb3="";
$ev="";
$data=time() - (7 * 24 * 60 * 60);
$eventsg = $db->query("SELECT * FROM ".PREFIX."_gallery_photos WHERE (date>'".$data."') and rating>5 order by RAND()  LIMIT 0,1");
if(!$eventsg)
$eventsg = $db->query("SELECT * FROM ".PREFIX."_gallery_photos WHERE (date>'".$data."') order by rating DESC LIMIT 0,1");
$numfr=0;


		while ($row1 = $db->get_row($eventsg)){
		$short_story=''.strip_tags($row1['title']);
		$imagelink="<a onclick=\"DlePage('do=gallery&bigphoto=".$row1['id']."',1); return false;\" href=\"//nocens.ru/photo/".$row1['id']."\">";
		$imagesrc='//nocens.ru/i/'.$row1[user_id].'/thumb/'.$row1[name];
		
	$short_story = str_replace("\n","",$short_story);
$short_story= str_replace("\r","",$short_story);
$short_story= str_replace("\"","",$short_story);
$th = date ( "Y", $row1[date]);

$show="onmouseover=\"tooltip.show('".$short_story."<br><i>(".$row1['uname']." &hearts;".$row1['rating'].", ".$th."г.)</i>');\" onmouseout=\"tooltip.hide();\"";
		$ev.='<div style="text-align: center; width: 100%"><span '.$show.' style="">'."<a onclick=\"DlePage('do=gallery&bigphoto=".$row1['id']."',1); return false;\" href=\"//nocens.ru/photo/".$row1['id']."\">".'<img style="border: 1px solid #000; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.43);" src="'.$imagesrc.'"></a></span></div>';
       
     
            }
            
         


           
		 
		   


	     
                    $nb3='<h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px; margin-top: -2px;" >Свежее фото <img align="texttop" src="pics/buts/arrow.png"></h2>'.$ev;
$toppostsg=$nb3;

	$nb3="";
	$ev="";
	//calen
	
	$th1 = date ( "Y-m-d", $_TIME );
    $birthdate_array = explode('-',$th1);
    $birth_y = $birthdate_array[0];
    $birth_m = $birthdate_array[1];
    $birth_d = $birthdate_array[2];
$nb=0;
$nb2="";


$events = $db->query("SELECT id, short_story, title, autor, rating, YEAR(date) as year, type FROM ".PREFIX."_post WHERE  MONTH(date)='".$birth_m."' AND DAY(date)='".$birth_d."' order by  fixed desc,  rating DESC LIMIT 0,7");
$numfr=0;


		while ($row1 = $db->get_row($events)){
			$row1[short_story]=strip_tags($row1[short_story]);
			
			if( strlen( $row1[short_story] ) >250) 
			{
$short_story = stripslashes(substr( $row1[short_story], 0, 250 ))."...";
			}
else
$short_story = stripslashes($row1[short_story]);
$short_story = str_replace("\n","",$short_story);
$short_story= str_replace("\r","",$short_story);
$short_story= str_replace("\"","",$short_story);
$title=stripslashes($row1['title']);
$show="onmouseover=\"tooltip.show('".$short_story."<br><i>(".$row1['autor'].", ".$row1['year']."г.)</i>');\" onmouseout=\"tooltip.hide();\"";
		$ev.='<p class="toprow"><span '.$show.'><img width=15; height=15; src="//nocens.ru/pics/status/p'.$row1['type'].'.png"> <a   onclick="DlePage(\'newsid='.$row1['id'].'\',1); return false;" href="//nocens.ru/post/'.$row1['id'].'"><b>'.$title.'</b></a></span></p>';
       
     
            }
            
            if($ev!="")
		   {
			   $ev='<h2 class="inlinel" style=" padding-bottom: 2px;">В этот день <img align="texttop" src="pics/buts/arrow.png"></h2>'.$ev;
		   }  


$events = $db->query("SELECT id, short_story, title, autor, datebegin, dateend, YEAR(date) as year, type FROM ".PREFIX."_post WHERE category='36' AND ((datebegin<NOW() AND dateend>NOW())  or datebegin>NOW()) order by datebegin ASC LIMIT 0,10");
$numfr=0;


		while ($row1 = $db->get_row($events)){
			$row1[short_story]=strip_tags($row1[short_story]);
			
			if( strlen( $row1[short_story] ) >250) 
			{
$short_story = stripslashes(substr( $row1[short_story], 0, 250 ))."...";
			}
else
$short_story = stripslashes($row1[short_story]);
$short_story = str_replace("\n","",$short_story);
$short_story= str_replace("\r","",$short_story);
$short_story= str_replace("\"","",$short_story);
$title=stripslashes($row1['title']);
$row1['datebegin']=strtotime($row1['datebegin']);
if($row1['datebegin']!="0"&&$row1['datebegin']!='-62169993000'){
if( date( Ymd,$row1['datebegin'] ) == date( Ymd, $_TIME ) ) {
			
		$datebegin= $lang['time_heute'] . langdate( ", H:i", $row1['datebegin']  );
		
		} elseif( date( Ymd, $row1['datebegin'] ) == date( Ymd, ($_TIME - 86400) ) ) {
			
				$datebegin=  $lang['time_gestern'] . langdate( ", H:i", $row1['datebegin']  );
		
		} 
			else if( date( Ymd, $row1['datebegin'] ) == date( Ymd, ($_TIME + 86400) ) ) {
			$datebegin=  "Завтра". langdate( ", H:i", $row1['datebegin'] );
		
		} 
		else {
			
	$datebegin= langdate( $config['timestamp_active'], $row1['datebegin']  );
		
		}
}
$show="onmouseover=\"tooltip.show('".$short_story."<br><i>".$datebegin." (".$row1['autor'].")</i>');\" onmouseout=\"tooltip.hide();\"";
		$evs.='<p class="toprow"><span '.$show.'><img width=15; height=15; src="//nocens.ru/pics/status/p'.$row1['type'].'.png"> <a  onclick="DlePage(\'newsid='.$row1['id'].'\',1); return false;"  href="//nocens.ru/post/'.$row1['id'].'"><b>'.$title.'</b></a></span></p>';
       
     
            }
            
       

$result = $db->query("SELECT name, DAY(birthdate) as day FROM ".PREFIX."_users WHERE  MONTH(birthdate)='".$birth_m."'  AND  DAY(birthdate)='".$birth_d."' ORDER BY lastdate desc limit 0,7 ");
$numfr=0;
		while ($row1 = $db->get_row($result)){
		
        if($row1['day']==$birth_d)
        {
			
			$show="onmouseover=\"tooltip.show('День Рождения у <b>".$row1['name']."</b>! Нажмите, чтобы поздравить.');\" onmouseout=\"tooltip.hide();\"";

       $evd.='<p class="toprow"><span  '.$show.'> <img  width="15" height="15"  src="//nocens.ru/pics/status/p13.png">'." <a href=\"//nocens.ru/index.php?do=bank&send&user=".urlencode($row1['name'])."\"><b>".$row1['name']."</b></a></span></p>";
        }
        else if($row1['day']>$birth_d)
        {$nb++;
         $nb3.="<a href=\"//nocens.ru/".urlencode($row1['name'])."\"><b>".$row1['name']."</b></a> (".$row1['day']."-го), ";
        }
     
            }
       
	   
	
		     if($evd!="")
		   {
			   $evd='<div style="height: 6px;"></div><h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px; margin-top: -2px;">{socfur_congr_main} <img align="texttop" src="pics/buts/arrow.png"></h2>'.$evd;
		   }  
		      


   //
	   
if($nb2!="")
{
$nb2='<h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px;" >{socfur_congr_main}<img align="texttop" src="pics/buts/arrow.png"></h2>'.$nb2;
}
else
{
$nb2="";

}


if($evs!="")
{
	$evs='<h2 class="inlinel" style=" padding-bottom: 2px; padding-left: 2px; margin-top: -2px;" >{socfur_congr_current} <img align="texttop" src="pics/buts/arrow.png"></h2>'.$evs.'<div style="height: 6px;"></div>';
	$topposts=$evs.$topposts;
	     
}
	      if($nb3&&$nb3!="")
                    $nb3='<h2 class="inlinel" style=" padding-bottom: 2px;" >В этом месяце <img align="texttop" src="pics/buts/arrow.png"></h2> '.$nb3;
	   //    
		 
	   
	   
$calen= $evd;
	$calen2=$ev;
	
	
	
	
	
	$db->query( "SELECT a.id, a.type, a.title, a.date, a.short_story, a.alt_name, a.category, a.autor, a.flag, b.name, b.game2, b.foto FROM " . PREFIX . "_post a," . PREFIX . "_users b WHERE a.autor=b.name and (a.rating+a.comm_num)>5 order by RAND() DESC LIMIT 0,5");
	$i1=1;
	
	
	while ( $row = $db->get_row() ) {
		$i1++;		
		
		if( $config['allow_alt_url'] == "yes" ) {
			
			if( $row['flag'] and $config['seo_type'] ) {
				
				if( $row['category'] and $config['seo_type'] == 2 ) {
					
					$full_link = $config['http_home_url'] . get_url( $row['category'] ) . "/" . $row['id'] . "-" . $row['alt_name'] . ".html";
				
				} else {
					
					$full_link = $config['http_home_url'] . $row['id'] . "-" . $row['alt_name'] . ".html";
				
				}
			
			} else {
				
				$full_link = $config['http_home_url'] . date( 'Y/m/d/', $row['date'] ) . $row['alt_name'] . ".html";
			}
		
		} else {
			
			$full_link = $config['http_home_url'] . "post/" . $row['id'];
		
		}
		
		if($row['type']&&$row['type']>0)
		{$row['game2']=$row['type'];
		}
		if($row['category']==35)
	{
		
		$adt=":";
		$title=strip_tags($row['short_story']);
		
		
	}
	else if ($row['category']==17)
	{
			$adt=":";
		$title=$row['title'];
	}
	
	else  
	{
			$adt=":";
		$title=$row['title'];
	}
	if( strlen( $title ) > 105 ) $title = stripslashes(substr( $title, 0, 105 )) . " ...";
		else $title = stripslashes($title);

	
	
		if($i1!=1)
			{
		
			$link='';
		
			}
			if($i1%2==0)
			{
				$col1="#FFFFFF";
			}
			else
			{
					$col1="#F0F0F0";
			}
	
			if(1)
			{
				if(!$row['foto']||$row['foto']=="")
				{$row['foto']="que.png";
				}
				
					$imginfo = @getimagesize($config['http_home_url'] . "uploads/fotos/" . $row['foto']);
					if($imginfo[0]==0) $imginfo[0]=1;
					$img_koeff = $imginfo[1]/$imginfo[0];
					$imgal=intval(40*$img_koeff-15);
		
	$link.= '<div class="res" onMouseOver=ser(this) onClick=location.href="'.$full_link.'" onMouseOut=serr(this); "><a href="//nocens.ru/'.urlencode ($row['autor']).'"><img style="padding-right: 4px;" title="'.$row['autor'].'" align="left" src="//nocens.ru/uploads/fotos/'.$row['foto'].'" width="40" height="'.(40*$img_koeff).'" /></a><a href="' . $full_link . '">' .  $title . '</a><div style="clear: both;"></div></div>';
			}
			else
			{
	$link.= "<div class=\"res\"  onMouseOver=ser(this) onClick=location.href=\"".$full_link."\" onMouseOut=serr(this); ><div class=\"blogsh".$row['game2']."\" style=\"border-radius: 4px; margin: 4px;\"><span class=\"copy\"><img width=15; height=15; src=\"//nocens.ru/pics/status/p".$row['game2'].".png\"> <b><a  style=\"font-size: 12px; \" href=\"//nocens.ru/". urlencode (stripslashes( $row['autor']  )) ."\">". stripslashes( $row['autor'] ) ."</a></b> ".$adt." &nbsp;<a style=\"font-size: 12px; \"{$go_page}href=\"" . $full_link . "\">" . $title. "</a> </span></div></div>";
			}

		
		
		$bestnews .= "" . $link . "";
	
		
	}
		
		$db->free();

		$rowvid = $db->query("SELECT a.id, a.type, a.title, a.date, a.short_story, a.alt_name, a.category, a.autor, a.flag  FROM " . PREFIX . "_post a WHERE  a.approve='1' AND category='31' order by a.id DESC LIMIT 0,5");
	$kvid.='<div align="center" style="position: relative; ">';
       if ($db->num_rows($rowvid)) {  
                
                    	$i1=0;
                    while ($image = $db->get_row($rowvid)){
					
							if($i1%2==0)
			{
				$col1="#F0F0F0";
			}
			else
			{
					$col1="#F0F0F0";
			}
                    $kvid.='<div style="float: left; padding-left: 4px; margin-bottom: 4px; background-color: '.$col1.';"><a href="//nocens.ru/post/'.$image[id].'" title="'.stripslashes($image[title]).'" href="">'.$image[short_story]."</a></div>";
					$i1++;
                    }           
	   }
	
	    $kvid='<div style=" margin: 3px; margin-bottom: 8px; border:solid; border-width: 1px; border-color:#CCC; border-radius: 8px; box-shadow: 0 0 3px #CCC;  	background-image:url(pics/boktopv.png); background-repeat:repeat-x;  padding:0px; background-color: #FFF; " align="right"><div style="float: right; padding-right: 4px;"><a title="Добавить видео" href="//nocens.ru/index.php?do=addvideo"><img style="padding: 0px; margin: 0px;" src="pics/addvid.png"></a></div>
<p style="text-align: left; padding-top: 2px;"><a href="//nocens.ru/index.php?do=cat&category=2m4utube"><img width="150" height="24" src="pics/alt2.png"></a></p> <div style="clear:both;"></div>'.$kvid.' </div><div style="clear: both;"></div></div> ';
	$db->free();
	
				
				$this_month = date( 'Y-m-d H:i:s', $_TIME );
		$db->query( "SELECT a.user_id, a.name, a.foto, a.user_group, a.reg_date, a.lastdate, a.news_num, a.comm_num, a.game, a.game2, a.cash, a.forum_reputation FROM " . USERPREFIX . "_users a WHERE a.forum_reputation!=0 AND a.name!='D-Arts' ORDER BY a.forum_reputation DESC LIMIT 0,10");
	
	
	$i1=0;
	$link="";
	
	while ( $row = $db->get_row() ) {
		$i1++;
		
		
		
	
			if($i1<20)
			{
					$imginfo = @getimagesize($config['http_home_url'] . "uploads/fotos/" . $row['foto']);
					if($imginfo[0]==0) $imginfo[0]=1;
					if($imginfo[1]==0) $imginfo[1]=1;
					$img_koeff = $imginfo[0]/$imginfo[1];
					$imgal=40*$img_koeff-10;
					
	$link= '<div class="ava21"  style="margin-left: 8px;"><div style="position: absolute; margin-right: '.$imgal.'px; margin-top: 30px;  float: left"><img src="//nocens.ru/pics/status/p'.$row['game2'].'.png"></div><a href="//nocens.ru/'.urlencode ($row['name']).'"><img title="'.$row['name'].'" src="//nocens.ru/uploads/fotos/'.$row['foto'].'" width="'.(40*$img_koeff).'" height="40" /></a></div>';
			}
		

	
		
		$topnewsn.= "" . $link ;
	
		
	}
	
		$topnewsn.= '<div class="ava21" style="margin-left: 10px;"><a href="//nocens.ru/index.php?do=stats"><img title="Рейтинг" src="	//nocens.ru/pics/info/ava1.png" width="40" height="40" /></a></div>';
	
/*	$topnews2.='</div><div style="height: 5px;  "></div><div style=" margin: 3px; border:solid; border-width: 1px;border-color:#CCC; border-radius: 8px; box-shadow: 0 0 3px #CCC; 	background-image:url(pics/boktoprat.png); background-repeat:repeat-x;  padding:0px; background-color: #FFFFFF; " align="right">
<p style="text-align: left; padding-top: 1px;"><a href="//nocens.ru/index.php?do=stats"><img width="150" height="24"  src="pics/alt5.png"></a></p> <div style="clear:both;"></div>'.$topnewsn.'<div style="clear:both;"></div></div><div style="height: 5px;  "></div>';*/
$db->free();



						 $row3 = $db->query("SELECT * FROM ".PREFIX."_users WHERE lastdate>='".(time()-2592000)."' order by cash DESC LIMIT 0,6");
	$ir=4;
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
							$ir++;
							if(!$image[foto])
							{$image[foto]="que.png";
							}
							$go1='
                  <div class="mainblocktops"> <div  onmouseout="ShowOrHide(\'hinder'.$ir.'\');  ShowOrHide(\'hinder2'.$ir.'\'); "  onmouseover="ShowOrHide(\'hinder'.$ir.'\');  ShowOrHide(\'hinder2'.$ir.'\'); " class="mainblock5"><div id="hinder'.$ir.'"><img src="//nocens.ru/uploads/fotos/'.$image[foto].'"  /></div><div class="tabcell" style="display: none;" id="hinder2'.$ir.'"  ><p class="whiter" style="color: #FFF; font-size: 20px;">'.$image[name].'</p><p class="whiter"><a href="//nocens.ru/index.php?do=bank&send&user='.$image[name].'">Подарок</a></p><p class="whiter"><a onclick="return confirm(\'Заняться виртуальным сексом с персонажем?\');" href="//nocens.ru/index.php?do=change&sex=1">Секс</a></p><p class="whiter"><a onclick="return confirm(\'Вы действительно желаете прекратить мир и устроить кровавую битву?\');" href="//nocens.ru/index.php?do=change&battle=1">Битва на Птицах!</a></p></div></div></div>';
							$galleryCenter .= ''.$go1.'';        
					
	                        $i++;
                    
					}
					
			
		
                }       
			
				$topmen= $galleryCenter.'';
				
				
				
				//Recommend
				
				$_SESSION[timer]=time();

	// $typer=" AND (type='addfav' OR type='favpost' OR type='favvid')";
	
	$row3=$db->query( "SELECT  * FROM " . USERPREFIX . "_actions WHERE main=1 and (type='video' or type='pic' or type='news'  or type='news2'  or type='news3')  ORDER BY rating DESC LIMIT 0,6" );
	
       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = ' '; 
                    
                    while ($image = $db->get_row($row3)){
						
						
								if($image['type']=="video"||$image['type']=="favvid")
						{
                        if (!$i)
					{
					}
						$moar="";
					if($image['uto'])
						{
							$moar=' <span class="inlinel">&hArr;</span> <a style="" class="copy" href="//nocens.ru/index.php?do=actions&user='.$image[uto].'"><b>'.$image[uto].'</b></a>';
						}
				
$image['src'] = stripslashes($image['src']);
		
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1=$image[action];
						}
						else if($image[type]=="news2")
						{
							$src1='<i>«'.$image['src'].'»</i>';
						}
						else
						{
							$src1='<div style="padding-left: 15px;">'.$image['src']."</div>";
						}
						$idl=$image[link];
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/blogs/'.$image['ufrom'];
						}
						else
						{
							$image['link']='//nocens.ru/post/'.$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                      
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainv.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);
$image['action']=strip_tags($image['action']);
							$add1="onmouseover=\"tooltip.show('".str_replace("добавил видео ","",$image['action'])."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a onclick=\"DlePage('newsid=".$idl."',1); return false;\" $add1 href=\"".$image['link']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
				
							if(!$image['game2']||$image['game2']=='0')
							{
								$g2='';
							}
							else
							{
									$g2='';
							}
								$TplThumb = str_replace("{src}", $g2.$src1, $TplThumb);
							
							
							
				
						
							$TplThumb = str_replace("{author}", '<a onclick="DlePage(\'user='.$image['ufrom'].'\'); return false;"  href="//nocens.ru/index.php?user='.$image['ufrom'].'">'.$image['ufrom'].'</a>'.$moar, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }   
						else	if($image['type']=="news"||$image['type']=="news2"||$image['type']=="favpost")
						{
                        if (!$i)
					{
					}
					$moar="";
					if($image['uto'])
						{
							$moar=' <span class="inlinel">&hArr;</span> <a style="" onclick="DlePage(\'user='.$image['ufrom'].'\'); return false;" class="copy" href="//nocens.ru/index.php?do=actions&user='.$image[uto].'"><b>'.$image[uto].'</b></a>';
						}
					$image['src']=strip_tags($image['src']);
					if( strlen( $image['src'] ) > 105 ) $image['src'] = stripslashes(substr( $image['src'], 0, 105 )) . " ...";
		else $image['src'] = stripslashes($image['src']);
		
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1=$image[action];
						}
						else if($image[type]=="news2")
						{
							$src1='<i>«'.$image['src'].'»</i>';
						}
						else
						{
							$src1='<span style="font-size: 14px; font-weight: bold;">'.$image['src'].'</span>';
						}
							$idl=$image[link];
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/blogs/'.$image['ufrom'];
						}
						else
						{
							$image['link']='//nocens.ru/post/'.$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainbl.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);
$add1=""; 
					//		$add1="onmouseover=\"tooltip.show('Автор: ".$image['ufrom']."');\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\"><a  onclick=\"DlePage('newsid=".$idl."',1); return false;\" $add1 href=\"".$image['link']."\">", $TplThumb); 
							$TplThumb = str_replace("[/link-full-foto]", "</a></span>", $TplThumb);
				
							if(!$image['game2']||$image['game2']=='0')
							{
								$g2='';
							}
							else
							{
									$g2='<img align="texttop" src="//nocens.ru/pics/status/p'.$image[game2].'.png"> ';
							}
								$TplThumb = str_replace("{src}", $g2.$src1, $TplThumb);
							
							
							
				
						
							$TplThumb = str_replace("{author}", '<a onclick="DlePage(\'user='.$image['ufrom'].'\'); return false;"  title="Действия '.$image['ufrom'].'" href="//nocens.ru/index.php?user='.$image['ufrom'].'">'.$image['ufrom'].'</a>'.$moar, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }   
						
						else if($image['type']=="pic"||$image['type']=="addfav")
						{
                        if (!$i)
					{
					}
						
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1="//nocens.ru/pics/linkinf3add.png";
						}
						else
						{
							$src1=$image['src'];
						}	
							$idl=$image[link];
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/album/'.$n1[user_id].'&view=1';
						}
						else
						{
							$image['link']="//nocens.ru/photo/".	$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainpa.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);

							$add1="onmouseover=\"tooltip.show('".strip_tags(str_replace("добавил картинку ","",$image['action']))."')\" onmouseout=\"tooltip.hide();\"";
							$TplThumb = str_replace("[link-full-foto]", "<a $add1 onclick=\"DlePage('do=gallery&bigphoto=".$idl."',1); return false;\" href=\"".$image['link']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a>", $TplThumb);
						
							
								$TplThumb = str_replace("{src}", $src1, $TplThumb);
							
							
					
						$moar="";
						if($image['uto'])
						{
							$moar=' <span class="inlinel">&hArr;</span> <a style="" class="copy" onclick="DlePage(\'user='.$image['uto'].'\'); return false;"  href="//nocens.ru/index.php?do=actions&user='.$image[uto].'"><b>'.$image[uto].'</b></a>';
						}
							
							$TplThumb = str_replace("{author}", '<span><a onclick="DlePage(\'user='.$image['ufrom'].'\'); return false;"  title="Действия '.$image['ufrom'].'" href="//nocens.ru/index.php?user='.$image['ufrom'].'">'.$image['ufrom'].'</a></span>'.$moar, $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }    
					
					else 
						{
                        if (!$i)
					{
					}
					$image['src']=$image['src'];
					if( strlen( $image['src'] ) > 105 ) $image['src'] = stripslashes(substr($image['src'], 0, 105 )) . " ...";
		else $image['src'] = stripslashes($image['src']);
		if($image[uto]=='0')
		{
			$image[uto]="";
		}
		
		
						if($image['src']==""||$image['src']=="0"||!$image['src'])
						{
							$src1=$image[action]." ".$image[uto];
						}
						else if($image[type]=="news2")
						{
							$src1='«'.$image['src'].'»';
						}
						else
						{
							$src1=$image['src'];
						}
						
						if($image['link']==""||$image['link']=="0")
						{
							$image['link']='//nocens.ru/'.$image['ufrom'];
						}
						else
						{
							$image['link']='//nocens.ru/post/'.$image['link'];
						}
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                     
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumbmainall.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$titl = str_replace("\r","",$image['title']);
$titl = str_replace("\n","<br>",$titl);

							$add1="";
							$TplThumb = str_replace("[link-full-foto]", "<span class=\"copy\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</span>", $TplThumb);
					
							if(!$image['game2']||$image['game2']=='0')
							{
								$g2='';
							}
							else
							{
									$g2='<img align="texttop" src="//nocens.ru/pics/status/p'.$image[game2].'.png"> ';
							}
								$TplThumb = str_replace("{src}", $g2.$src1, $TplThumb);
							
							
							
				
						
							$TplThumb = str_replace("{author}", '<a onclick="DlePage(\'user='.$image['ufrom'].'\'); return false;"  title="Действия '.$image['ufrom'].'" href="//nocens.ru/index.php?user='.$image['ufrom'].'">'.$image['ufrom'].'</a>', $TplThumb);
							$galleryCenter .= ''.$TplThumb.'';        
					
	                        $i++;
                    }   
					   }                        
                     $galleryCenter = $galleryCenter.'';
                    $galleryCenter .= '<div style="clear: both;"></div>';   
                 
                } else {
                    $galleryCenter = '';
			
		
                } 
				
$recommend=$galleryCenter;

				
		create_cache( "recommend",$recommend, $config['skin'] );


	create_cache( "topnews", $topnews, $config['skin'] );

		create_cache( "topmen", $topmen, $config['skin'] );
	
	
				create_cache( "bestnews", $bestnews, $config['skin'] );
			
				create_cache( "calen", $calen, $config['skin'] );
					create_cache( "topposts", $topposts, $config['skin'] );
						create_cache( "toppostsv", $toppostsv, $config['skin'] );
								create_cache( "toppostsg", $toppostsg, $config['skin'] );
								create_cache( "bestpics", $bestpics, $config['skin'] );
				create_cache( "calen2", $calen2, $config['skin'] );
}
?>