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
 Файл: profile.php
-----------------------------------------------------
 Назначение: Профиль пользователя
=====================================================
*/

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

include_once ENGINE_DIR . '/classes/parse.class.php';
require_once(ENGINE_DIR.'/data/config.gallery.php');
//####################################################################################################################
//         Обновление информации о пользователе
//####################################################################################################################
if( $allow_userinfo and $doaction == "adduserinfo" ) {
	
	if( $_POST['dle_allow_hash'] == "" or $_POST['dle_allow_hash'] != $dle_login_hash ) {
		
		die( "Hacking attempt! User ID not valid" );
	
	}
	
	
	$parse = new ParseFilter( );
	$parse->safe_mode = false;
	$parse->allow_url = false;
	$parse->allow_image = true;
	
	$stop = false;
	
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
$dis1 = intval($_POST['dis1']);
$dis2 = intval($_POST['dis2']);
$cens = intval($_POST['cens']);
$clanblog = intval($_POST['clanblog']);
$ribbon = intval($_POST['ribbon']);
$cust = stripslashes($_POST['custom']);
$smilepack = stripslashes($_POST['smilepack']);
$showbird= $_POST['showbird'];
if($showbird=="yes")
$showbird=1;
else
{
	$showbird=0;
}
if($dis1==1)
{
	$dis=0;
}
else  if($dis2!=0)
{
	$dis=$dis2;
}
else
{
	$dis="1";
}



	$altpass = md5( $_POST['altpass'] );
	$info = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['info'] ), false ) );
	$email = $db->safesql( $parse->process( $_POST['email'] ) );
	
	$fullname = $db->safesql( $parse->process( $_POST['fullname'] ) );
	$land = $db->safesql( $parse->process( $_POST['land'] ) );
	$icq = intval( $_POST['icq'] );
	$birth_d = $db->safesql($parse->process($_POST['birth_d']));
    $birth_m = $db->safesql($parse->process($_POST['birth_m']));
    $birth_y = $db->safesql($parse->process($_POST['birth_y']));
    $bdate_view = $db->safesql($parse->process($_POST['bdate_view']));
	if( ! $icq ) $icq = "";

	$allowed_ip = str_replace( "\r", "", trim( $_POST['allowed_ip'] ) );
	$allowed_ip = str_replace( "\n", "|", $allowed_ip );
	$allowed_ip = $db->safesql( $parse->process( $allowed_ip ) );
	
	$row = $db->super_query( "SELECT * FROM " . USERPREFIX . "_users WHERE name = '$user'" );
	//////////ACTIONS///////

	$xfieldsid = stripslashes( $row['xfields'] );
	
	if( $user_group[$row['user_group']]['allow_signature'] ) {
		
		$parse->allow_url = $user_group[$member_id['user_group']]['allow_url'];
		$parse->allow_image = $user_group[$member_id['user_group']]['allow_image'];
		$signature = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['signature'] ), false ) );
	
	} else
		$signature = "";
	
	$image = $_FILES['image']['tmp_name'];
	$image_name = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$img_name_arr = explode( ".", $image_name );
	$type = end( $img_name_arr );
	
	
	if( $image_name != "" ) $image_name = totranslit( stripslashes( $img_name_arr[0] ) ) . "." . totranslit( $type );
	
	if( ! $is_logged or ! ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$stop = $lang['news_err_13'];
	}

        
        $birthdate = $birth_y."-".$birth_m."-".$birth_d;
	
	if( is_uploaded_file( $image ) and ! $stop ) {
		
		if( intval( $user_group[$member_id['user_group']]['max_foto'] ) > 0 ) {
			
			if( $image_size < 500000 ) {
				
				$allowed_extensions = array ("jpg", "png", "jpe", "jpeg", "gif" );
				
				if( (in_array( $type, $allowed_extensions ) or in_array( strtolower( $type ), $allowed_extensions )) and $image_name ) {
					
					include_once ENGINE_DIR . '/classes/thumb.class.php';
					
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . "." . $type );
					
					if( $res ) {
						
						@chmod( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . "." . $type );
						
						if( $thumb->size_auto( $user_group[$member_id['user_group']]['max_foto'] ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] . "." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . "." . $type, ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] . "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] . "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] . "." . $type;
						
						$db->query( "UPDATE " . USERPREFIX . "_users set foto='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
			} else
				$stop .= $lang['news_err_16'];
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . "." . $type );
	}
	
	if( $_POST['del_foto'] == "yes" ) {
		
		@unlink( ROOT_DIR . "/uploads/fotos/" . $row['foto'] );
		$db->query( "UPDATE " . USERPREFIX . "_users set foto='' WHERE name='$user'" );
	
	}
	
	//TOPPIC
	$image = $_FILES['image3']['tmp_name'];
	$image_name = $_FILES['image3']['name'];
	$image_size = $_FILES['image3']['size'];
	$img_name_arr = explode( ".", $image_name );
	$type = end( $img_name_arr );
	
	
	if( $image_name != "" ) $image_name = totranslit( stripslashes( $img_name_arr[0] ) ) . "." . totranslit( $type );
	
	if( ! $is_logged or ! ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$stop = $lang['news_err_13'];
	}
	
	if( is_uploaded_file( $image ) and ! $stop ) {
		
		
			
			if( $image_size < 10000000 ) {
				
				$allowed_extensions = array ("jpg", "png", "jpe", "jpeg", "gif" );
				
				if( (in_array( $type, $allowed_extensions ) or in_array( strtolower( $type ), $allowed_extensions )) and $image_name ) {
					
					include_once ENGINE_DIR . '/classes/thumb.class.php';
					
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . "." . $type );
					
					if( $res ) {
						
						@chmod( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . "." . $type );
					
							if( $thumb->size_auto( 820,1000 ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/toppic/foto_" . $row['user_id'] . "." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . "." . $type, ROOT_DIR . "/uploads/toppic/foto_" . $row['user_id'] . "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] . "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] . "." . $type;
						
						$db->query( "UPDATE " . USERPREFIX . "_users set bgpic2='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
		
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . "." . $type );
	}
	
	if( $_POST['del_foto3'] == "yes" ) {
		
		@unlink( ROOT_DIR . "/uploads/toppic/" . $row['foto'] );
		$db->query( "UPDATE " . USERPREFIX . "_users set bgpic2='' WHERE name='$user'" );
	
	}
	
	//FON
	$image = $_FILES['image2']['tmp_name'];
	$image_name = $_FILES['image2']['name'];
	$image_size = $_FILES['image2']['size'];
	$img_name_arr = explode( ".", $image_name );
	$type = end( $img_name_arr );
	
	
	if( $image_name != "" ) $image_name = totranslit( stripslashes( $img_name_arr[0] ) ) . "." . totranslit( $type );
	
	if( ! $is_logged or ! ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$stop = $lang['news_err_13'];
	}
	
	if( is_uploaded_file( $image ) and ! $stop ) {
		
		
			
			if( $image_size < 10000000 ) {
				
				$allowed_extensions = array ("jpg", "png", "jpe", "jpeg", "gif" );
				
				if( (in_array( $type, $allowed_extensions ) or in_array( strtolower( $type ), $allowed_extensions )) and $image_name ) {
					
					include_once ENGINE_DIR . '/classes/thumb.class.php';
					
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type );
					
					if( $res ) {
						
						@chmod( ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type );
					
					if( $thumb->size_auto( 1000,1000 ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] . "." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type, ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] . "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] . "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] . "." . $type;
						
						$db->query( "UPDATE " . USERPREFIX . "_users set bgpic='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
		
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type );
	}
	
	if( $_POST['del_foto2'] == "yes" ) {
		
		@unlink( ROOT_DIR . "/uploads/fon/" . $row['foto'] );
		$db->query( "UPDATE " . USERPREFIX . "_users set bgpic='' WHERE name='$user'" );
	
	}
	
	if( strlen( $password1 ) > 0 ) {
		
		$altpass = md5( $altpass );
		
		if( $altpass != $member_id['password'] ) {
			$stop .= $lang['news_err_17'];
		}
		
		if( $password1 != $password2 ) {
			$stop .= $lang['news_err_18'];
		}
		
		if( strlen( $password1 ) < 6 ) {
			$stop .= $lang['news_err_19'];
		}
	}
	
	if( !preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])'.'(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', $email) or empty( $email ) ) {
		
		$stop .= $lang['news_err_21'];
	}
	if( intval( $user_group[$member_id['user_group']]['max_info'] ) > 0 and strlen( $info ) > $user_group[$member_id['user_group']]['max_info'] ) {
		
		$stop .= $lang['news_err_22'];
	}
	if( intval( $user_group[$member_id['user_group']]['max_signature'] ) > 0 and strlen( $signature ) > $user_group[$member_id['user_group']]['max_signature'] ) {
		
		$stop .= $lang['not_allowed_sig'];
	}
	if( strlen( $fullname ) > 100 ) {
		
		$stop .= $lang['news_err_23'];
	}
	if ( preg_match( "/[\||\'|\<|\>|\"|\!|\]|\?|\$|\@|\/|\\\|\&\~\*\+]/", $fullname ) ) {

		$stop .= $lang['news_err_35'];
	}
	if( strlen( $land ) > 100 ) {
		
		$stop .= $lang['news_err_24'];
	}
	if ( preg_match( "/[\||\'|\<|\>|\"|\!|\]|\?|\$|\@|\/|\\\|\&\~\*\+]/", $land ) ) {

		$stop .= $lang['news_err_36'];
	}
	if( strlen( $icq ) > 20 ) {
		
		$stop .= $lang['news_err_25'];
	}
	
	if( $parse->not_allowed_tags ) {
		
		$stop .= $lang['news_err_34'];
	}

	if( $parse->not_allowed_text ) {
		
		$stop .= $lang['news_err_38'];
	}
	
	$db->query( "SELECT name FROM " . USERPREFIX . "_users WHERE email = '$email' AND name != '$user'" );
	
	if( $db->num_rows() ) {
		$stop .= $lang['reg_err_8'];
	}
	
	$db->free();
	
	if( $stop ) {
		msgbox( $lang['all_err_1'], $stop );
	} else {
		
		if( $_POST['allow_mail'] ) {
			$allow_mail = 0;
		} else {
			$allow_mail = 1;
		}
				if( $_POST['wa_subscr'] ) {
                        $allow_subscribe = 1;
                } else {
                        $allow_subscribe = 0;
                }
                
                $allow_wall = intval( $_POST['wa_avlbl'] );  
		$xfieldsaction = "init";
		$xfieldsadd = false;
		include (ENGINE_DIR . '/inc/userfields.php');
		$filecontents = array ();
		
		if( ! empty( $postedxfields ) ) {
			foreach ( $postedxfields as $xfielddataname => $xfielddatavalue ) {
				if( ! $xfielddatavalue ) {
					continue;
				}
				
				$xfielddatavalue = $db->safesql( $parse->BB_Parse( $parse->process( $xfielddatavalue ), false ) );
				
				$xfielddataname = $db->safesql( $xfielddataname );
				
				$xfielddataname = str_replace( "|", "&#124;", $xfielddataname );
				$xfielddatavalue = str_replace( "|", "&#124;", $xfielddatavalue );
				$filecontents[] = "$xfielddataname|$xfielddatavalue";
			}
			
			$filecontents = implode( "||", $filecontents );
		} else
			$filecontents = '';
		
		if( strlen( $password1 ) > 0 ) {
			
			$password1 = md5( md5( $password1 ) );
			$sql_user = "UPDATE " . USERPREFIX . "_users set fullname='$fullname', land='$land', icq='$icq', bdate_view='$bdate_view', birthdate='$birthdate',  email='$email', info='$info', cens='$cens', smiles='$smilepack', signature='$signature', password='$password1', allow_mail='$allow_mail',  custom='$cust', xfields='$filecontents', allowed_ip='$allowed_ip', allow_wall='$allow_wall', wall_subscr='$allow_subscribe', clanblog='$clanblog', design='$dis', ribbon='$ribbon',showbird='$showbird' where name='$user'";
		
		} else {
			
			$sql_user = "UPDATE " . USERPREFIX . "_users set fullname='$fullname', land='$land', icq='$icq', bdate_view='$bdate_view', birthdate='$birthdate', email='$email', info='$info', cens='$cens', smiles='$smilepack', signature='$signature', allow_mail='$allow_mail', xfields='$filecontents', allowed_ip='$allowed_ip', allow_wall='$allow_wall',  custom='$cust', wall_subscr='$allow_subscribe', clanblog='$clanblog', design='$dis', ribbon='$ribbon',showbird='$showbird' where name='$user'";
		
		}
		$forbd="";
		for($i=1;$i<9;$i++)
		{
			if($_POST['choose'.$i]&&$_POST['choose'.$i]!="null")
			{
				if($_POST['choose'.$i]=="other")
				{
					$_POST['choose'.$i]=$_POST['your'.$i];
				}
				$forbd.="link".$i."='".$_POST['choose'.$i]."', ";
				
			}
		
		
		}
			if($forbd){
			$forbd=substr($forbd, 0, strlen($forbd)-2);
		$db->query( "UPDATE " . USERPREFIX . "_perks set {$forbd} where id='{$row['user_id']}'");
		$_SESSION[perkpanel]=false;
			}
		
	

		$db->query( $sql_user );

		if ( $_POST['subscribe'] ) $db->query( "DELETE FROM " . PREFIX . "_subscribe WHERE user_id = '{$row['user_id']}'" );
	}

}

//####################################################################################################################
//         Просмотр профиля пользователя
//####################################################################################################################


$parse = new ParseFilter( );
  
$user_found = FALSE;

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
	

 $user=utf8_convert($user, w);

 
 $gr[1]='<img width="16" height="16"  title="Пропаганда" src="http://nocens.ru/pics2/clubs/propmini.png">';
  $gr[2]='<img width="16" height="16" title="Пиар" src="http://nocens.ru/pics2/clubs/prmini.png">';
$sql_result = $db->query( "SELECT a.*,  b.logo, b.group FROM " . USERPREFIX . "_users a, " . USERPREFIX . "_map b where a.name = '$user' and a.clan=b.description LIMIT 0 , 1" );

$tpl->load_template( 'userinfo.tpl' );

 
  
while ( $row = $db->get_row( $sql_result ) ) {
        
		
		if($row[user_group]=="11")
		{
			header("Location: http://nocens.ru/index.php?clan=".$row['name'].""); 
		}
	  $user_found = TRUE;
        $profile_id = $row['user_id'];
        $profile_name = $row['name'];
		$logo='http://nocens.ru/i/clans/'.$row[logo].'.gif';
		
		$clan=$row['clan'];
                include_once ENGINE_DIR . '/modules/wall.php';
        

        
        $tpl->set('{wall}', $tpl->result["wall"]);
        
        $tpl->load_template( 'userinfo.tpl' );
	
	if( $row['banned'] == 'yes' ) $user_group[$row['user_group']]['group_name'] = $lang['user_ban'];
	
	if( $row['allow_mail'] ) {

		if ( !$user_group[$member_id['user_group']]['allow_feed'] AND $row['user_group'] != 1 )
			$tpl->set( '{email}', $lang['news_mail'], $output );
		else
			$tpl->set( '{email}', "<a href=\"$PHP_SELF?do=feedback&amp;user=$row[user_id]\">" . $lang['news_mail'] . "</a>" );


	} else {

		$tpl->set( '{email}', $lang['news_mail'], $output );

	}
	$act=$_GET['act'];
	$time = time() + ($config['date_adjust'] * 60);
	 $relation =$db->super_query( "SELECT relation,love,engage FROM " . PREFIX . "_users_friends WHERE user_id='$member_id[user_id]' AND friend_id='$row[user_id]' " );
	 
		if($act=="feed"&&$member_id['cash']>=100)
			 {
			
			 $time = date( "Y-m-d H:i:s", $_TIME );
			 
					if($row['showbird']!=0)
					{ 
					
					 $month = mktime(0, 0, 0, date("m"), date("d")+30,   date("Y"));
	  	$db->query( "UPDATE  bird set hunger='$month' where owner='$profile_name'" );
	
				 $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
						$link='покормил пета';
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-100 where user_id='$member_id[user_id]'" );
						
				      	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
					}
        	
			 }
	if($act=="leaveclan"&&$member_id[clantype]!=1&&$member_id[clantype])
			 {
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$member_id[user_id]'"  );
				$db->query( "UPDATE " . USERPREFIX . "_users set clantype=0, clan='' where user_id='$member_id[user_id]'"  );
					$db->query( "UPDATE " . USERPREFIX . "_post set clan='' where autor='$member_id[name]'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='' where uname='$member_id[name]'"  );
			 }
			 if($act=="removeclan")
			 {
				 	$db->query( "UPDATE " . USERPREFIX . "_post set clan='' where clan='$member_id[clan]'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='' where clan='$member_id[clan]'"  );
						
				 $db->query( "UPDATE " . USERPREFIX . "_map set name='Нет владельца', type='0', description='' where description='$member_id[clan]'"  );
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$member_id[user_id]'"  );
				$db->query( "UPDATE " . USERPREFIX . "_users set clantype=0, clan='' where clan='$member_id[clan]'"  );
				$db->query("DELETE FROM `".PREFIX."_users` WHERE user_group='11' and email ='".$member_id[clan]."@nocens.ru'");
					$db->query("DELETE FROM `".PREFIX."_actions` WHERE ufrom ='".$member_id[clan]."'");
				
			 }
			 			 if($act=="kick"&&$member_id[clantype]==1&&$member_id[clan]==$clan)
			 {
				 
			
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$profile_id'"  );
				$db->query( "UPDATE " . USERPREFIX . "_users set clantype=0, clan='' where user_id='$profile_id'"  );
					$db->query( "UPDATE " . USERPREFIX . "_post set clan='' where autor='$profile_name'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='' where uname='$profile_name'"  );
				
				
			 }
			 else if ($act=="kick")
			 {
				  msgbox( $lang['all_err_1'], "Ошибка... Нет прав на удаление. " );
			 }

			 
		 if($member_id[user_id]!=$profile_id)
		 {
			 if($act=="addclan"&&$member_id['clan']&&($member_id['clantype']==1||$member_id['clantype']==2))
			 {
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=1 where (friend_id='$member_id[user_id]' AND user_id='$profile_id')"  );
				$n1="Персонаж  ".$member_id[name]." пригласил вас в клан ".$member_id[clan]." ! Вы можете <a href=\"http://nocens.ru/?subaction=userinfo&user=".$member_id[name]."&act=enterclan\">согласиться</a> или отклонить.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] пригласил в клан!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
						$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
			 }
			  if($act=="enterclan"&&($member_id['clan']==""||!$member_id['clan']))
			 {
				 $rowe = $db->super_query("SELECT invite from ".USERPREFIX . "_users_friends where (user_id='$member_id[user_id]' AND friend_id='$profile_id')");
				 if($rowe[invite]==1)
				 {
					 
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
				 	$db->query( "UPDATE " . USERPREFIX . "_users set clantype=3, clan='$clan' where user_id='$member_id[user_id]'"  );
							$db->query( "UPDATE " . USERPREFIX . "_post set clan='$clan' where autor='".$member_id['name']."'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='$clan' where uname='".$member_id['name']."'"  );
				
				 }
				 else
				 {
					 msgbox( $lang['all_err_1'], "Ошибка..." );
				 }
			 }
			 	 
			 if($act=="hug"&&$member_id['cash']>=30)
			 {
			
			
			 $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
							$rhug=rand(1,6);
						$n1="<img style=\"padding: 5px;\" src=\"http://nocens.ru/pics/actions/hug".$rhug.".jpg\" alt=\"\"   /><br>Вас обнял персонаж  ".$member_id[name]."! Вы можете ответить взаимностью в его профиле.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('Вас обнял $member_id[name]!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation+1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-30 where user_id='$member_id[user_id]'" );
							$db->query( "UPDATE " . USERPREFIX . "_users_friends set relation=relation+1, love=love+2 where (friend_id='$member_id[user_id]' AND user_id='$profile_id') or (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
										$n1="Вам переведены флопсы от  ".$member_id[name]."!";
	$link='обнял';
	$time = date( "Y-m-d H:i:s", $_TIME );
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
			
			  $check = $db->super_query("SELECT COUNT(*) as num FROM `".PREFIX."_actions` WHERE `uto` = '".$profile_name."' and action = 'обнял'");
			
							  if($check[num]>=100)
               {
           achievements(13,$row[user_id],$row[achieves]);
            
               }
			   	header("Location: http://nocens.ru/index.php?subaction=userinfo&user=".$profile_name."");
							$system="<b>> ОТПРАВЛЕНО!</b>";		
							
							
			 }
			 else if($act=="engage"&&$relation[love]>=50&&$member_id['cash']>=1000)
			 {
				  $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
						$n1="<img src=\"http://nocens.ru/pics2/banners/ff_radosti_03.jpg\" alt=\"\" width=\"170\" /><br>Персонаж  ".$member_id[name]." предлагает вам перейти к серьезным отношениям!  Вы можете: <br><br> <a href=\"http://nocens.ru/?do=change&relation=yes&ufrom=".$member_id[user_id]."\"><b>[СОГЛАСИТЬСЯ]</b></a> или  <a href=\"http://nocens.ru/?do=change&relation=no&ufrom=".$member_id[user_id]."\"><b>[РАЗБИТЬ СЕРДЦЕ  ".$member_id[name]."]</a></b><br><br>Ваше согласие может ухудшить другие ваши отношения.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] признается в чувствах к вам!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation+1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-1000 where user_id='$member_id[user_id]'" );
							$db->query( "UPDATE " . USERPREFIX . "_users_friends set engage='1' where (friend_id='$member_id[user_id]' AND user_id='$profile_id') or (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
										
	$link='признался в серьезных чувствах';
	$time = date( "Y-m-d H:i:s", $_TIME );
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'engage')" );	
								header("Location: http://nocens.ru/index.php?subaction=userinfo&user=".$profile_name.""); 
							$system="<b>> ОТПРАВЛЕНО!</b>";		
			 }
			 	 else if($act=="noengage"&&$relation[engage]==2&&$member_id['cash']>=1000)
			 {
				  $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
						$n1="<br>Персонаж  ".$member_id[name]." рарывает с вами серьезные отношения.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] бросает вас', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation-10,  pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						$db->query( "UPDATE " . USERPREFIX . "_users set  forum_reputation=forum_reputation-10, cash=cash-1000 where user_id='$member_id[user_id]'" );
							$db->query( "UPDATE " . USERPREFIX . "_users_friends set engage='0', love=love-100 where  (friend_id='$member_id[user_id]' AND user_id='$profile_id') or (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
										
	$link='бросает';
	$time = date( "Y-m-d H:i:s", $_TIME );
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'engage')" );
			$db->query("DELETE FROM ".PREFIX."_gifts WHERE code='<img src=\"http://nocens.ru/pics/presents/ring.png\">' AND((idfrom = '$member_id[name]' AND idto = '$profile_name') OR (idfrom= '$profile_name' AND idto = '$member_id[name]'))");	
								header("Location: http://nocens.ru/index.php?subaction=userinfo&user=".$profile_name.""); 
							$system="<b>> ОТПРАВЛЕНО!</b>";		
			 }
			 		else if($act=="punch"&&$member_id['cash']>=30)
			 {
			
			 $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
						$n1="<img src=\"http://nocens.ru/pics/actions/pin.jpg\" alt=\"\" width=\"170\" /><br>Вас пнул персонаж  ".$member_id[name]."! <i></i><br> Вы можете расплатиться с обидчиком в его профиле.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('Вас пнул $member_id[name]!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation-1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-30 where user_id='$member_id[user_id]'" );
							$db->query( "UPDATE " . USERPREFIX . "_users_friends set relation=relation-3, love=love-2 where (friend_id='$member_id[user_id]' AND user_id='$profile_id') or (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
										$n1="Вам переведены флопсы от  ".$member_id[name]."!";
	$link='пнул';
	$time = date( "Y-m-d H:i:s", $_TIME );
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
			  $check = $db->super_query("SELECT COUNT(*) as num FROM `".PREFIX."_actions` WHERE `uto` = '".$profile_name."' and action = 'пнул'");
			
							  if($check[num]>=50)
               {
           achievements(14,$row[user_id],$row[achieves]);
            
               }
			
							header("Location: http://nocens.ru/index.php?subaction=userinfo&user=".$profile_name.""); 
							$system="<b>> ОТПРАВЛЕНО!</b>";		
			 }
			 	
			 else
			 {
				 $system="<b>> ОШИБКА!</b>";
			 }
		 }
	 $birthdate = $row['birthdate'];    
    $bdate_view = $row['bdate_view'];
    $birthdate_see = format_date_html($birthdate,$bdate_view);
    $birthdate_array = explode('-',$birthdate);
    $birth_y = $birthdate_array[0];
    $birth_m = $birthdate_array[1];
    $birth_d = $birthdate_array[2];
	$g2=$row[game2];
	
	if($row[clanblog]!="0"&&$row[clanblog])
	{
	$clanblog="checked";

	}
	else
	{
		$clanblog="";
	}
	$tpl->set( '{clanblog}', $clanblog);
	if($row[design]!="0")
	{
		$row[game2]=$row[design];
		
	}
	$tpl->set( '{bgpic}', $row['bgpic']);
		$tpl->set( '{bgpic2}', $row['bgpic2']);
	if($row['bgpic2'])
	{	$tpl->set( '{height}', "topprof");
	$tpl->set( '{height2}', "toptitle");
	}
	else
	{	$tpl->set( '{height}',"topprof2");
	$tpl->set( '{height2}', "toptitle2");
	}
	if ( $user_group[$member_id['user_group']]['allow_pm'] )
	if($member_id[user_id]==$row['user_id'])
	{
		if($member_id[pm_unread]>0)
		{
			$addpm=" <b>+".$member_id[pm_unread]."</b>";
		}
		$tpl->set( '{pm}', "<a href=\"$PHP_SELF?do=pm&amp;doaction=inbox\"><img title=\"Сообщения\" src=\"pics/ach/act1.png\" width=\"15\" height=\"15\" /> Мои сообщения".$addpm."</a><br> ");
	}
	else{
		$tpl->set( '{pm}', "<a href=\"$PHP_SELF?do=pm&amp;doaction=newpm&amp;user=" . $row['user_id'] . "\"><img title=\"Сообщение\" src=\"pics/ach/act1.png\" width=\"15\" height=\"15\" /> Сообщение</a><br> " );}
	else
		$tpl->set( '{pm}', "", $output );



	if($n1)
		{		$tagsearch="";
			$keytags =  $db->query("SELECT tag,  COUNT(*) as cnt from  ".PREFIX."_tags WHERE name='".$row['name']."' GROUP BY tag HAVING cnt>1  ORDER BY cnt desc  LIMIT 0,30  ");
			$i=0;

			 	while($row1 = $db->get_row($keytags)){
					
								$fontsize=10+ round($row1[cnt]/5);
								if($fontsize>24)
								$fontsize=24;
					if($i==0)
					{$tagsearch.='<b><a style="font-size: '.$fontsize.'px;" href="http://nocens.ru/index.php?do=blogs&user='.$row['name'].'&filter='.$row1[tag].'">'.$row1[tag].'</a></b> ';
					}
					else
					{$tagsearch.='<a style="font-size: '.$fontsize.'px;"  href="http://nocens.ru/index.php?do=blogs&user='.$row['name'].'&filter='.$row1[tag].'">'.$row1[tag].'</a> ';
					}
					$i++;
				}
		}
		

$tpl->set( '{newstags}', $tagsearch );


	
	if( ! $row['allow_mail'] ) $mailbox = "checked";
	else $mailbox = "";
	
	if( $row['foto'] and (file_exists( ROOT_DIR . "/uploads/fotos/" . $row['foto'] )) ) $tpl->set( '{foto}', $config['http_home_url'] . "uploads/fotos/" . $row['foto'] );
	else $tpl->set( '{foto}', "{THEME}/images/noavatar.png" );
	
	$tpl->set( '{hidemail}', "<input type=\"checkbox\" name=\"allow_mail\" value=\"1\" " . $mailbox . " /> " . $lang['news_noamail'] );
	$tpl->set( '{usertitle}', stripslashes( $row['name'] ) );
	
	
	 if($row[fullname])
		 {
$xname = explode( ' ', $row[fullname] );
 $outname = $xname[0].' '.$row['name'].' '.$xname[1];
		 }
		 else
		 {
			 $outname=$row['name'];
		 }
		 $tpl->set( '{fullnick}', $outname);
	$tpl->set( '{fullname}', stripslashes( $row['fullname'] ) );
	$tpl->set('{birth_y}', $birth_y);
    $tpl->set('{birthdate}', $birthdate_see);
	$tpl->set( '{game2}', stripslashes( $row['game2'] ) );
	
 if($row['clan'])
 { 
 $link1.='<a href="http://nocens.ru/index.php?clan='.$row[clan].'">Профайл клана</a><br>';

	 $link1.='<a href="http://nocens.ru/index.php?do=blogs&clan='.$row[clan].'">Блог '.$row['clan'].'</a><br>';
		 $link1.='<a href="http://nocens.ru/index.php?do=album&clan='.$row[clan].'">Галерея '.$row['clan'].'</a><br>'; 
	 if($row['clantype']=='1')
	 {
		 $right=" (глава)";
	 }
	 	

	 $acl='<hr style="height: 0px; background-color:#FFF; width: 100%; border-color:#CCC; border-width: 0px; border-bottom-width: 1px; color:#FFF; border-style: dashed; margin-bottom: 3px;" />';
	 $tpl->set( '{clanpanel}', stripslashes( "<div class=\"ava2\"><div class=\"infoto\"><h3>".$gr[$row['group']]."<img src=".$logo.">".$row['clan'].$right."</h3>".$acl.$link1."</div></div>" ) );
	$tpl->set( '{clan}', "" );
 }
 else
 {
	 $tpl->set( '{clan}', ""  );
	 $tpl->set( '{clanpanel}', ""  );
 }
	$conf="onClick=\"return confirm('Вы точно этого хотите?');\"";
/*	if($member_id[user_group]<5)
	{
		$hug.='<a onclick="return confirm(\'Заняться виртуальным сексом с персонажем?\');" href="http://nocens.ru/index.php?do=change&sex=1"><img width="15" height="15" src="http://nocens.ru/pics/status/p3.png"> Секс</a><br><a onclick="return confirm(\'Устроить Битву на птицах?\');" href="http://nocens.ru/index.php?do=change&battle=1"><img width="15" height="15" src="http://nocens.ru/pics/status/p9.png"> Битва на птицах</a><br>';
	}
	*/
	if($member_id['cash']>=30&&$member_id['user_id']!=$profile_id)
	{$hug.='<a href="http://nocens.ru/index.php?do=bank&send&user='.$row[name].'"><img title="Отправить подарок" src="pics/ach/act2.png" width="15" height="15" /> Подарок</a><br> ';
	
		$hug.='<a  onClick="ajact('.$row['user_id'].',\'hug\'); return false;" href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=hug" ><img title="Обнять персонажа (30 флопсов)" src="pics/ach/act3.png" width="15" height="15" /> Обнять (30)</a><br> ';
				$hug.='<a onClick="ajact('.$row['user_id'].',\'punch\'); return false;" href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=punch" ><img title="Пнуть как нуба (30 флопсов)" src="pics/ach/act6.png" width="15" height="15" /> Пнуть (30)</a><br> ';
					$hug.='<a href="http://nocens.ru/index.php?do=bank&money&user='.$row[name].'"><img title="Перевод денег" src="http://nocens.ru/pics/ach/a8.png" width="15" height="15" /> Перевести флопсы</a><br> ';
		
		
}



if($relation[love]>=50&&$relation[engage]!=2&&$relation[engage]!=1&&$member_id['cash']>=1000)
{
		$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=engage"><img title="Оформить отношения (1000)" src="pics/ach/pic1.png" width="15" height="15" /> Сделать предложение (1000)</a><br> ';
}
else if($relation[engage]==2&&$member_id['cash']>=1000)
{
			$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=noengage"><img title="" src="pics/ach/pic1b.png" width="15" height="15" /> Закончить отношения (1000)</a><br> ';
	
}


if($row['showbird']!=0&&$member_id['cash']>=100)
					{ 
					$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=feed"><img title="Кормить пета (100 флопсов)" src="pics/ach/act7.png" width="15" height="15" /> Кормить пета (100)</a><br> ';
					}
if($member_id['user_id']==$profile_id&&$member_id['clan']&&($member_id['clantype']==3||$member_id['clantype']==2))
{
	$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=leaveclan"><img title="Покинуть клан" src="pics/ach/act5.png" width="15" height="15" /> Уйти из клана</a><br> ';
}

if($member_id['user_id']!=$profile_id&&$member_id['clan']&&$clan==""&&($member_id['clantype']==1||$member_id['clantype']==2))
{
	$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=addclan"><img title="Пригласить в клан" src="pics/ach/act4.png" width="15" height="15" /> Пригл. в клан</a><br> ';
}
if($member_id['user_id']!=$profile_id&&$member_id['clan']==$clan&&($member_id['clantype']==1||$member_id['clantype']==2))
{
	$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=kick"><img title="Выгнать из клана" src="pics/ach/act5.png" width="15" height="15" /> Выгнать</a><br> ';
}
if($member_id['user_id']==$profile_id&&$member_id['clan']&&($member_id['clantype']==1))
{
	$hug.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=removeclan"><img title="Удалить клан" src="pics/ach/act5.png" width="15" height="15" /> Удалить клан</a><br> ';
}
$tpl->set( '{hugs}', $hug  );
	$tpl->set( '{game}', stripslashes( $row['game'] ) );
		$tpl->set( '{system}', stripslashes( $member_id[cash]." <img title=\"флопсов\"align=\"texttop\" src=\"http://nocens.ru/pics/watermelon.png\">") );
		$tpl->set( '{cash}', stripslashes( $row['cash'] ) );
	$tpl->set( '{icq}', stripslashes( $row['icq'] ) );
	$tpl->set( '{id}', stripslashes( $row['user_id'] ) );
		$tpl->set( '{name}', stripslashes( $row['name'] ) );
	$tpl->set( '{land}', stripslashes( $row['land'] ) );
	$tpl->set( '{info}', stripslashes( $row['signature'] ) );
	$tpl->set( '{editmail}', stripslashes( $row['email'] ) );
	$tpl->set( '{comm_num}', $row['comm_num'] );
	$tpl->set( '{news_num}', $row['news_num'] );
	
	$tpl->set('{java}', "<script language=\"javascript\">
function viewphoto(id){
var bigp=window.open('/index.php?do=gallery&bigphoto='+id,'title','width='+(850)+', height='+(700)+', status=1, scrollbars=1');
bigp.focus();
}
</script>".$gallery);
	
	  $tpl->set('{code_name}', urlencode($row['name']));

$row1 = $db->super_query("SELECT COUNT(*) as count_gal_foto FROM dle_gallery_photos WHERE user_id='".$row['user_id']."'");
    $tpl->set('{gallery_foto}', $row1['count_gal_foto']);
	
	$vidcnt = $db->super_query("SELECT COUNT(*) as count_gal_foto FROM dle_post WHERE autor='".$row['name']."' and category='31'");
    $tpl->set('{video_num}', $vidcnt['count_gal_foto']);
	$fotnum=$row1['count_gal_foto'];
$row2 = $db->super_query("SELECT COUNT(*) as count_gal_comm FROM dle_gallery_comments WHERE user_id='".$row['user_id']."'");
    $tpl->set('{gallery_comm}', $row2['count_gal_comm']);
	$config_gallery['kolonok'] = 4;
	$rateCenter = 1; 
	
				
 $row3 = $db->query("SELECT `id`, `date`, `name`, `category` FROM `".PREFIX."_gallery_photos` WHERE user_id='".$row['user_id']."' and category!='32' order by date DESC LIMIT 0 , 5 ");

       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = '<table width="100%"><tr>'; 
                    
                    while ($image = $db->get_row($row3)){
                        if (!$i)
                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                        $comments = $db->super_query("SELECT COUNT(*) as num FROM `".PREFIX."_gallery_comments` WHERE `photo_id` = '".$image['id']."'");
	                        $TplThumb = file_get_contents("templates/".$config['skin']."/gallery_thumb2.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							$TplThumb = str_replace("[link-full-foto]", "<a href=\"http://nocens.ru/index.php?do=gallery&bigphoto=".$image['id']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a>", $TplThumb);
							$TplThumb = str_replace("{src}", "/".$config_gallery['uploaddir'].$row['id']."".$image['category']."/thumb/".$image['name'], $TplThumb);
							$TplThumb = str_replace("{com-num}", $comments['num'], $TplThumb);							
							$TplThumb = str_replace("{title}", "", $TplThumb);
							$galleryCenter .= '<td>'.$TplThumb.'</td>';        
								$TplThumb = str_replace("{author}", "", $TplThumb);
	                        $i++;
                    }                               
                    
                    $galleryCenter .= '</tr></table>';   
                    $blog3="<a href=\"http://nocens.ru/index.php?do=album&user=".$row['user_id']."\"><img title=\"Галерея\"  align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf3.png\">Галерея</a>";
		
		$tpl->set( '{blog3}', $blog3 );
                } else {
                    $galleryCenter = 'Нет фотографий.';
					$blog3="";
		
		$tpl->set( '{blog3}', $blog3 );
                }               
                
  $out1='';

 $tpl->set('{gallery_mini}', $galleryCenter);
 $tpl->set('{author}', "");
 if($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] < 3)
 {
  $rowperks = $db->super_query("SELECT * from dle_perks where id='$row[user_id]'");
  if(!$rowperks)
  {
	  	$db->query( "INSERT INTO dle_perks (id) values ('$row[user_id]')" );
		  echo("Перкпанель добавлена. Обновите страницу.");
  }
 }
 //Птицы
 
  $rowbird = $db->super_query("SELECT * from bird where owner='$row[name]'");
  if(!$rowbird&&($member_id[name]==$row[name]or $member_id['user_group'] < 3))
  {
	  echo("Питомец добавлен");
	  $month = mktime(0, 0, 0, date("m"), date("d")+30,   date("Y"));
	  	$db->query( "INSERT INTO bird (name, owner, hunger) values ('$row[name]', '$row[name]', '$month')" );
  }
	  else
  {
 if($row['showbird']!=0)
 {
	  $tpl->set('{showbird}', '<input type="checkbox" name="showbird" value="yes" checked="checked" /> Показывать питомца');
 	$_SESSION['bird']=$row['name'];
	    	  $tpl->set('{bird}', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="140" height="150" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
<param name="src" value="http://nocens.ru/save/bird.swf" /><embed type="application/x-shockwave-flash" width="140" height="150" src="http://nocens.ru/save/bird.swf"></embed>
</object>');
  $tpl->set('{birdname}', $rowbird[name]);
 }
 else
 {
	   $tpl->set('{showbird}', '<input type="checkbox" name="showbird" value="yes" />  Показывать питомца');
	   $tpl->set('{bird}', '');
	     $tpl->set('{birdname}', $rowbird[name]);
 }
 
  }

if($_GET[delpr]&&($member_id[name]==$row[name]||$member_id[user_group]<3))
{
		$db->query("DELETE FROM `".PREFIX."_gifts` WHERE id ='".$_GET[delpr]."'");
	}

 $row4 = $db->query("SELECT `id`, `idfrom`, `idto`, `description`, `type` ,`data`, `code` FROM `".PREFIX."_gifts` WHERE idto='".$row['name']."' order by id desc ");
$nump=0;
       if ($db->num_rows($row4)) {  
                
                       
                    
                    while ($image = $db->get_row($row4)){
                        if (!$i)
                                 {}
								  $i1=mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
								if($i1<=$image['data'])
								{
									$time = date( "d.m.Y", $image['data'] );
									if($image['type']!='pic'&&$image['type']!='ring')
									{
								 $outq.="<img onmouseover=\"tooltip.show('".striptext($image['description'])." (от ".$image['idfrom'].")<br>Годен до: ".$time."');\" onmouseout=\"tooltip.hide();\" width=\"100\" height=\"100\"  src=\"http://nocens.ru/pics/presents/pr".$image['type'].".png\">";   
									}
									else if($image['type']=='ring')
									{
									
												 $leftq.="<div style=\"float: left; height: 100px;  padding-left: 1px; padding-right: 1px;\" onmouseover=\"tooltip.show('".striptext($image['description'])."');\" onmouseout=\"tooltip.hide();\">".$image['code']."</div>";   
									
	                        $i++;
							if($image['type']==1)
							$nump++;
									}
									else
									{
										if($member_id[name]==$row[name]||$member_id[user_group]<3)
										{
											$delka="<div onclick=\"return confirm('Вы точно хотите удалить подарок?')\" style=\"position: relative;\"><div style=\"position: absolute;\"><a href=\"http://nocens.ru/index.php?subaction=userinfo&user=".$row[name]."&delpr=".$image[id]."\"><img src=\"http://nocens.ru/pics/buts/l3.png\"></a></div></div>";
										}
												 $leftq.="<div style=\"float: left; height: 100px;  padding-left: 1px; padding-right: 1px;\" onmouseover=\"tooltip.show('".striptext($image['description'])." (от ".$image['idfrom'].") <br>Годен до: ".$time."');\" onmouseout=\"tooltip.hide();\">".$delka."".$image['code']."</div>";   
									}
	                        $i++;
							if($image['type']==1)
							$nump++;
                    }                               
                
					}    $outq=$leftq.$outq.'<div style="clear:both;"></div>';
	   }
	    if($nump>=8)
	$outq="<img onmouseover=\"tooltip.show('Кирпичный дом <br><i>Из халявного кирпича</i>');\" onmouseout=\"tooltip.hide();\" width=\"65\" height=\"65\"  src=\"http://nocens.ru/pics/presents/house.png\">".$outq;  
	   $outq.= "<br><a href=\"http://nocens.ru/index.php?do=bank&send&user=".$row['name']."\">Отправить что-то</a>";    
	   $outr= "<a href=\"http://nocens.ru/index.php?do=bank&send&user=".$row['name']."\">+</a>";  
	$tpl->set( '{presents}', $outq );
		$tpl->set( '{addpr}', $outr );
		
		 $rowv = $db->query("SELECT `autor`, `category`, `id`, `date` ,`title`,`short_story` FROM `".PREFIX."_post` WHERE autor='".$row['name']."' and category='31'  order by id desc LIMIT 0,5");

       if ($db->num_rows($rowv)) {  
                
                       
                          $outv.= '<table width="100%"><tr>'; 
                    while ($image = $db->get_row($rowv)){
                        if (!$i)
                                 {}
								
								 $outv.="<td style=\"padding-left: 10px;\"><div class=\"mainblocktops\" align=\"center\"><a onmouseover=\"tooltip.show('".$image['title']."');\" onmouseout=\"tooltip.hide();\"  href=\"http://nocens.ru/index.php?newsid=".$image['id']."\">".$image['short_story']."</a></div></td>";   
	                        $i++;
                    }   $outv.='</tr></table>';   
						$blogv="<a  href=\"http://nocens.ru/index.php?do=video&user=".$row['name']."\"><img src=\"http://nocens.ru/pics/linkinfvid.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Видео</a>";
					
					      }
					else
					{
						$blogv="";
						 $outv.= 'Пользователь ничего не добавлял.';
					}
                    $outv.= '<div style="clear: both;></div>';  
					

 $row4 = $db->query("SELECT `autor`, `category`, `id`, `date` ,`title` FROM `".PREFIX."_post` WHERE autor='".$row['name']."' and category!='31' order by id desc LIMIT 0,5");

       if ($db->num_rows($row4)) {  
                
                       
                    
                    while ($image = $db->get_row($row4)){
                        if (!$i)
                                 {}
								
								 $out1.="» <a href=\"http://nocens.ru/index.php?newsid=".$image['id']."\">".$image['title']."</a><br>";   
	                        $i++;
                    }                               
                    $out1.= '';    
                     $blog="<a href=\"http://nocens.ru/index.php?do=blogs&user=".$row['name']."\"><img  title=\"Блоги\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf1.png\">Блог</a>";
					 
	$blog2="<a href=\"http://nocens.ru/index.php?do=creo&user=".$row['name']."\"><img  title=\"Креативы\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf2.png\">Статьи</a>";

		$tpl->set( '{blog}', $blog );
		
		$tpl->set( '{blog2}', $blog2 );
                    
                } else {
                    $out1.= 'Пользователь ничего не добавлял.';
					     
					$blog="";
					$blog2="";
				
	$tpl->set( '{blog}', $blog );
		$tpl->set( '{blog2}', $blog2 );
                }            
				    $blogfr="<a href=\"http://nocens.ru/index.php?do=blogs&friends=".$row['name']."\"><img  title=\"Блоги\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf1.png\"></a>";   
              $tpl->set( '{blogfr}', $blogfr );  
$blog4="<p><a  href=\"http://nocens.ru/index.php?do=actions&list&user=".$row['name']."\"><img src=\"pics/actions/abut.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Новое</a>";
$blog5.="<a  href=\"http://nocens.ru/index.php?do=files&list&user=".$row['name']."\"><img src=\"pics/actions/abut2.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Файлы</a></p>";

	$tpl->set( '{blog4}', $blog4 );
	$tpl->set( '{blog5}', $blog5 );
		$tpl->set( '{blogv}', $blogv );
$tpl->set('{out1}', $out1);
$tpl->set('{outv}', $outv);


	$tpl->set('{code_name}', urlencode($row['name']));

$rowz = $db->super_query("SELECT COUNT(*) as counta FROM dle_forum_topics WHERE author_topic='".$row['name']."'");
    $forum_topics = $rowz['counta'];
    $tpl->set('{forum_topics}', $forum_topics);
    $tpl->set('{forum_post}', $row['forum_post']);
	$tpl->set( '{status}',  $user_group[$row['user_group']]['group_prefix'].$user_group[$row['user_group']]['group_name'].$user_group[$row['user_group']]['group_suffix'] );

	$tpl->set( '{registration}', langdate( "j F Y H:i", $row['reg_date'] ) );
	$tpl->set( '{lastdate}', langdate( "j F Y H:i", $row['lastdate'] ) );
	$months_array = array (
0=>'',
1=>'Январь',
2=>'Февраль',
3=>'Март',
4=>'Апрель',
5=>'Май',
6=>'Июнь',
7=>'Июль',
8=>'Август',
9=>'Сентябрь',
10=>'Октябрь',
11=>'Ноябрь',
12=>'Декабрь',
);    

$days_array=array(
0=>'',
1=>'1',
2=>'2',
3=>'3',
4=>'4',
5=>'5',
6=>'6',
7=>'7',
8=>'8',
9=>'9',
10=>'10',
11=>'11',
12=>'12',
13=>'13',
14=>'14',
15=>'15',
16=>'16',
17=>'17',
18=>'18',
19=>'19',
20=>'20',
21=>'21',
22=>'22',
23=>'23',
24=>'24',
25=>'25',
26=>'26',
27=>'27',
28=>'28',
29=>'29',
30=>'30',
31=>'31',

);

$bdate_view_array = array (
0=>'Показывать возраст и дату рождения',
1=>'Показывать дату рождения',
2=>'Скрывать возраст и дату рождения',
);


$birth_m_a = makeDropDown($months_array, 'birth_m', $birth_m);
$birth_d_a = makeDropDown($days_array, 'birth_d', $birth_d);
$bdate_view_a = makeDropDown($bdate_view_array, 'bdate_view', $bdate_view);
$tpl->set('{birth_m_a}', $birth_m_a);    
$tpl->set('{birth_d_a}', $birth_d_a);    
$tpl->set('{bdate_view_a}', $bdate_view_a);  


if($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] < 3) 
{
	 $options='  <option value="null" selected="selected">...</option>
	 	  <option value="no">[Пусто]</option>
    <option value="blog">Мой блог</option>
    <option value="creo">Мои креативы</option>
    <option value="pic">Моя галерея</option>
    <option value="addnews">Добавить публикацию</option>
    <option value="addpict">Добавить картинку</option>
    <option value="dem">Сделать демотиватор</option>
    <option value="textmes">Отправить сообщение</option>
    <option value="rating">Рейтинг</option>
    <option value="blogs">Все блоги</option>
    <option value="creos">Все креативы</option>
    <option value="pics">Все картинки</option>
	 <option value="radio">Радио</option>
	  <option value="radio2">Радио ПЕНЁК FM</option>
	  <option value="forum">Форум</option>
   ';
	$tpl->set('{opts}', $options);
}

	if($row['forum_rank']!="0")
	{
	$tpl->set('{rank-title}', $row['forum_rank']);
	}
	else
	{
	$n1="Юзер";
		$tpl->set('{rank-title}', $n1);
		}
	$tpl->set('{reputation}', $row['forum_reputation']);
	$neo=0;
	$awards="<div align=\"center\">";
	
		$result = $db->query("SELECT friend_id, user_id FROM ".PREFIX."_users_friends WHERE approve='1' and user_id='".$row['user_id']."'");
$numfr=0;
		while ($row1 = $db->get_row($result)){
		
			if($row1['friend_id']=="222") 
			{
				$na1=1;
			}
			if($row1['friend_id']=="17") 
			{
				$na2=1;
			}
			if($row1['friend_id']=="2") 
			{
				$na3=1;
			}
			if($row1['friend_id']=="14") 
			{
				$na4=1;
			}
			if($row1['friend_id']=="65"||$row1['friend_id']=="335") 
			{
				$na5=1;
			}
			if($row1['friend_id']=="46") 
			{
				$na7=1;
			}
			if($row1['friend_id']=="25") 
			{
				$na6=1;
			}
			if($row1['friend_id']=="129") 
			{
				$na8=1;
			}
		}
	
	$achs=explode(",", $row[achieves]);
	
	foreach ($achs as $ach)
	{
		if($ach!="")
		$awards.='<div class="tabcell2" style="height: 20px; padding: 0px; margin-top: 2px;"><a><img  style=" border-radius: 2px;" src="http://nocens.ru/pics2/ach/ach'.$ach.'.png"></a></div>';
	}
	$awards.="</div>";
	$op = "userinfo";
require_once ENGINE_DIR."/modules/friends/friends.php";
$tpl->set('{game2}',$row['game2']);
$tpl->set('{awards}', $awards);
	if( $user_group[$row['user_group']]['icon'] ) $tpl->set( '{group-icon}', "<img src=\"" . $user_group[$row['user_group']]['icon'] . "\" border=\"0\" />" );
	else $tpl->set( '{group-icon}', "" );
	
	if( $is_logged and $user_group[$row['user_group']]['time_limit'] and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] < 3) ) {
		
		$tpl->set_block( "'\\[time_limit\\](.*?)\\[/time_limit\\]'si", "\\1" );
		
		if( $row['time_limit'] ) {
			
			$tpl->set( '{time_limit}', langdate( "j F Y H:i", $row['time_limit'] ) );
		
		} else {
			
			$tpl->set( '{time_limit}', $lang['no_limit'] );
		
		}
	
	} else {
		
		$tpl->set_block( "'\\[time_limit\\](.*?)\\[/time_limit\\]'si", "" );
	
	}
	
	$_IP = $db->safesql( $_SERVER['REMOTE_ADDR'] );
	
	$tpl->set( '{ip}', $_IP );
	$tpl->set( '{allowed-ip}', stripslashes( str_replace( "|", "\n", $row['allowed_ip'] ) ) );
	$tpl->set( '{editinfo}', $parse->decodeBBCodes( $row['info'], false ) );
	// Wall 1.0 by Dark5ider
        
$list = array(                     
        '1'     =>     "Все",
        '2'     =>      "Флудеры",
        '4'     =>      "Только я",  
        );
        
if ($wa['allow_intgr_fr'] == "yes")     $list['3'] = $lang['wa_aw_frus'];

        ksort($list);

foreach ( $list as $element => $key) {
        
$returnstring .= "<option value=\"" . $element . '" ';
        if( $element == $row['allow_wall'] ) $returnstring .= 'SELECTED style=\"color: red\"';
$returnstring .= '>' . $key . '</option>';
                
}

$allowwall = "<select name=\"wa_avlbl\">".$returnstring."</select>";

$tpl->set( '{allowwall}', $allowwall );

          if( $row['wall_subscr'] == 1 ) $wa_subscr = " checked=\"checked\"";
        else $wa_subscr = "";
        
        $tpl->set( '{wall-subscribe}', "<input type=\"checkbox\" name=\"wa_subscr\" " . $wa_subscr . "> " . $lang['wa_subscr'] );


  if( $row['design'] == "0" ) $des1 = " checked=\"checked\"";
        else $des1 = "";
        
        $tpl->set( '{dis1}', "<input type=\"checkbox\" id=\"dis1\" name=\"dis1\" ".$des1." value=\"1\">  ");
// Wall 1.0 by Dark5ider
 if($member_id['cash']>=100)
 {$addstatus="<option value=\"11\">Ярость</option><option value=\"5\">Эмо</option><option value=\"6\">Кавай</option><option value=\"7\">Фурри</option><option value=\"8\">Патриот</option><option value=\"9\">Играю</option><option value=\"10\">Деньги</option><option value=\"12\">Важное событие</option><option value=\"13\">Квашу</option>";
 }
 else
 {$addstatus="";
 }
 if($row['design'] == "0")
 {
	 $add1="<img src=\"http://nocens.ru/pics/status/p".$row['game2'].".png\" align=\"baseline\">(изменяется c настроением)";
 }
 else
 {
	 $add1="<img src=\"http://nocens.ru/pics/status/p".$row['design'].".png\" align=\"baseline\">";
 }
 $custom=" <select  style =\"width: 200px; height:20px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF; \" name=\"custom\" selected=\"selected\"><option value=\"".$row['custom']."\">...</option><option value=\"\">Информационные блоки</option><option value=\"2\">Новости и блоги</option></select>";
 		 $tpl->set( '{custom}',  $custom);
		 
		 
		  
		  	$lcnams[0]="Включена подгрузка";
		$lcnams[1]="Меню навигации вместо подгрузки";
		 $listcens="";
		 for ($i=0; $i<2; $i++)
		 {
			 if($row[ribbon]==$i)
			 {
				 $sel="selected";
			 }
			 else
			 {
				 	 $sel="";
			 }
			 $listcens.='<option  value="'.$i.'" '.$sel.'>'.$lcnams[$i].'</option>';
			 
		 }
		 $custom=" <select  style =\"width: 200px; height:20px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF; \" name=\"ribbon\" selected=\"selected\">".$listcens."</select>";
		  
 		 $tpl->set( '{ribbon}',  $custom);
		 
		  $custom=" <select  style =\"width: 200px; height:20px; padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF; \" name=\"smilepack\" selected=\"selected\"><option value=\"".$row['smiles']."\">...</option><option value=\"\">Основной набор</option><option value=\"2\">Флуд-смайлики сверху</option></select>";
 		 $tpl->set( '{smilepack}',  $custom);
		 
$nastr=stripslashes( "Выбрано: ".$add1."<br>Выбрать другое: <select onChange=\"uncheck()\" style =\"width: 100px; height:20px;padding: 2px; border-radius: 3px; border-width: 0px; border-width: 1px; border-style:solid; border-color:#FF9898;  background-color:#FFF; \" name=\"dis2\" selected=\"selected\"><option value=\"".$row['design']."\">...</option><option value=\"1\">Радость</option><option value=\"2\">Печаль</option><option value=\"3\">Любовь</option><option value=\"4\">Думы</option>".$addstatus."</select>" ) ;

	   $tpl->set( '{dis2}', $nastr);

			
		$lcnams[0]="Не показывать разделы 18+";
		$lcnams[1]="Показывать без ограничений"; 
		$listcens="";
		 for ($i=0; $i<2; $i++)
		 {
			 if($row[cens]==$i)
			 {
				 $sel="selected";
			 }
			 else
			 {
				 	 $sel="";
			 }
			
			 $listcens.='<option  value="'.$i.'" '.$sel.'>'.$lcnams[$i].'</option>';
			 
		 }
		 
		 $tpl->set( '{censopts}', $listcens);

		 
	if( $user_group[$row['user_group']]['allow_signature'] ) $tpl->set( '{editsignature}', $parse->decodeBBCodes( $row['signature'], false ) );
	else $tpl->set( '{editsignature}', $lang['sig_not_allowed'] );
	
	if( $row['comm_num'] ) {
		
		$tpl->set( '{comments}', "<a href=\"$PHP_SELF?do=lastcomments&amp;userid=" . $row['user_id'] . "\">" . $lang['last_comm'] . "</a>" );
	
	} else {
		
		$tpl->set( '{comments}', $lang['last_comm'] );
	
	}
	
	if( $row['news_num'] ) {
		
		if( $config['allow_alt_url'] == "yes" ) {
			
			$tpl->set( '{news}', "<a href=\"" . $config['http_home_url'] . "user/" . urlencode( $row['name'] ) . "/news/" . "\">" . $lang['all_user_news'] . "</a>" );
			$tpl->set( '[rss]', "<a href=\"" . $config['http_home_url'] . "user/" . urlencode( $row['name'] ) . "/rss.xml" . "\" title=\"" . $lang['rss_user'] . "\">" );
			$tpl->set( '[/rss]', "</a>" );
		
		} else {
			
			$tpl->set( '{news}', "<a href=\"" . $PHP_SELF . "?do=static&page=catalog&category=3&user=" . urlencode( $row['name'] ) . "\">" . $lang['all_user_news'] . "</a>" );
			$tpl->set( '[rss]', "<a href=\"engine/rss.php?subaction=allnews&amp;user=" . urlencode( $row['name'] ) . "\" title=\"" . $lang['rss_user'] . "\">" );
			$tpl->set( '[/rss]', "</a>" );
		}
	} else {
		
		$tpl->set( '{news}', $lang['all_user_news'] );
		$tpl->set_block( "'\\[rss\\](.*?)\\[/rss\\]'si", "" );
	
	}
	
	if( $row['signature'] and $user_group[$row['user_group']]['allow_signature'] ) {
		
		$tpl->set_block( "'\\[signature\\](.*?)\\[/signature\\]'si", "\\1" );
		$tpl->set( '{signature}', stripslashes( $row['signature'] ) );
	
	} else {
		
		$tpl->set_block( "'\\[signature\\](.*?)\\[/signature\\]'si", "" );
	
	}
	
	$xfieldsaction = "list";
	$xfieldsadd = false;
	$xfieldsid = $row['xfields'];
	include (ENGINE_DIR . '/inc/userfields.php');
	$tpl->set( '{xfields}', $output );
	
	// Обработка дополнительных полей
	$xfieldsdata = xfieldsdataload( $row['xfields'] );
	
	foreach ( $xfields as $value ) {
		$preg_safe_name = preg_quote( $value[0], "'" );
		
		if( $value[5] != 1 or ($is_logged and $member_id['user_group'] == 1) or ($is_logged and $member_id['user_id'] == $row['user_id']) ) {
			if( empty( $xfieldsdata[$value[0]] ) ) {
				$tpl->copy_template = preg_replace( "'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template );
			} else {
				$tpl->copy_template = preg_replace( "'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "\\1", $tpl->copy_template );
			}
			$tpl->copy_template = preg_replace( "'\\[xfvalue_{$preg_safe_name}\\]'i", stripslashes( $xfieldsdata[$value[0]] ), $tpl->copy_template );
		} else {
			$tpl->copy_template = preg_replace( "'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template );
			$tpl->copy_template = preg_replace( "'\\[xfvalue_{$preg_safe_name}\\]'i", "", $tpl->copy_template );
		}
	}
	// Обработка дополнительных полей
	
 if($member_id['cash']>=100)
 {$addstatus="<option value=\"5\">Эмо</option><option value=\"6\">Кавай</option><option value=\"7\">Фурри</option><option value=\"8\">Патриот</option><option value=\"9\">TimeZero</option><option value=\"10\">Деньги</option>";
 }
 else
 {$addstatus="";
 }
	if( $is_logged and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$tpl->set( '{edituser}', "<a href=\"javascript:ShowOrHide('options')\"><img  src=\"http://nocens.ru/pics/bt4.png\"/></a>" );
	} else
		$tpl->set( '{edituser}', "" );
			if($g2)
		$im= "<img align=\"absmiddle\" src=\"http://nocens.ru/pics/status/p".$g2.".png\"> ";
		
		else
		$im= " ";
		
		if( $is_logged and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
			$tpl->set( '{xstatus2}', stripslashes( "" ) );
			$game=strip_tags($row[game]);
			if($row['game']){
			$tpl->set( '{xstatus}', '<h3 class="blogsh'.$row['game2'].' style=" float: left; padding: 4px;" > <em>'.stripslashes( $im.$row['game']."" ).'</em></h3>' );
			}
			else
				$tpl->set( '{xstatus}',"");
		$tpl->set( '{addinf}', "[ <a href=\"http://nocens.ru/index.php?do=gallery&addimage\">Добавить картинку или фото</a> ] [ <a href=\"http://nocens.ru/index.php?do=addnews\">Добавить публикацию или запись в блоге</a> ]" );
	} else
		{
			if($row['game']){
			$tpl->set( '{xstatus2}', '<h3 class="blogsh'.$row['game2'].' style=" float: left; padding: 4px;" > <em>'.stripslashes( $im.$row['game']."" ).'</em></h3>' );}
			else
				$tpl->set( '{xstatus2}',"");
		$tpl->set( '{xstatus}', stripslashes( "" ) );
		$tpl->set( '{addinf}', "" );
	}
	
	if( $is_logged and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$tpl->set( '[not-logged]', "" );
		$tpl->set( '[/not-logged]', "" );
	} else
		$tpl->set_block( "'\\[not-logged\\](.*?)\\[/not-logged\\]'si", "<!-- profile -->" );
	
	if( $config['allow_alt_url'] == "yes" ) $link_profile = $config['http_home_url'] . "user/" . urlencode( $row['name'] ) . "/";
	else $link_profile = $PHP_SELF . "?subaction=userinfo&user=" . urlencode( $row['name'] );
	
	        if( $is_logged and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
				    $tpl->set( '{$dle_login_hash}', $dle_login_hash );
        	$tpl->set( '{$link_profile}', $link_profile );
        }
	
	$tpl->compile( 'content' );

}

$tpl->clear();
$db->free( $sql_result );

if( $user_found == FALSE ) {
	$allow_active_news = false;
	msgbox( $lang['all_err_1'], $lang['news_err_26'] );
}
?>