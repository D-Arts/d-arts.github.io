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
//include_once ENGINE_DIR . '/modules/functions.php';
require_once(ENGINE_DIR.'/data/config.gallery.php');

function updateclans($clan,$operation)
{
	 global $db,$member_id;
	if($operation=="del")
	{
				$select = $db->query("SELECT user_id,clan FROM " .PREFIX."_users where clan='".$clan."' OR clan like '".$clan.",%' OR clan like '%, ".$clan."%'");
      if($db->num_rows($select) >  0 ){
    	while($row1 = $db->get_row($select)){
$row1[clan]=stripslashes($row1[clan]);
if(strpos($row1[clan],',')){
					$clans= explode( ", ",$row1[clan]);
					
		foreach($clans as $s){
			if(trim($s)!=""&&trim($s)!=$clan){
		$newclan.=''.trim($s).', ';
			}
		}
}
else
{
	if($row1[clan]==$clan)
	{
		$newclan="";
	}
}
		
					$db->query( "UPDATE " . USERPREFIX . "_users set clan='".addslashes($newclan)."' where user_id='".$row1[user_id]."'"  );
			
						 	$db->query( "UPDATE " . USERPREFIX . "_post set clan='".addslashes($newclan)."' where autor='".$row1[name]."'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='".addslashes($newclan)."' where user_id='".$row1[user_id]."'"  );
						
		}}
	}
	else if($operation=="add")
	{
			
				$select = $db->query("SELECT user_id,clan,name FROM " .PREFIX."_users where clan='".$clan."' OR clan like '".$clan.",%' OR clan like '%, ".$clan."%'");
      if($db->num_rows($select) >  0 ){
    	while($row1 = $db->get_row($select)){
$row1clan=stripslashes($row1[clan]);
if(strpos($row1clan,',')){
					$clans= explode( ", ",$row1clan);
					
		foreach($clans as $s){
			
		$newclan.=''.trim($s).', ';
			
		}
		$newclan.=$clan.', ';
}
else
{
	if($row1clan=="")
	{
		$newclan=$desc;
	}
	else
	{
		$newclan=$row1clan.', '.$desc;
	}
}
		
			$db->query( "UPDATE " . USERPREFIX . "_users set clan='".addslashes($newclan)."' where user_id='".$row1[user_id]."'"  );
			
						 	$db->query( "UPDATE " . USERPREFIX . "_post set clan='".addslashes($newclan)."' where autor='".$row1[name]."'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='".addslashes($newclan)."' where user_id='".$row1[user_id]."'"  );
						
		}}}
}
//####################################################################################################################
//         Обновление информации о пользователе
//####################################################################################################################
if(!$_GET[search]){
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
$looking = intval($_POST['looking']);
$clanblog = $_POST['clanblog'];
$deleted = intval($_POST['deleted']);
$ribbon = intval($_POST['ribbon']);
$cust = stripslashes($_POST['custom']);
$smilepack = stripslashes($_POST['smilepack']);
$showbird= $_POST['showbird'];
$showtype = intval($_POST['showtype']);
$sex= intval($_POST['sex']);
$hugs= intval($_POST['hugs']);
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
	
		$infov = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['infov'] ), false ) );
			$infog = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['infog'] ), false ) );
			
	$email = $db->safesql( $parse->process( $_POST['email'] ) );
	
	$fullname = $db->safesql( $parse->process( $_POST['fullname'] ) );
	$land = $db->safesql( $parse->process( $_POST['land'] ) );
	$icq =  $db->safesql( $parse->process( $_POST['icq'] ));
	$subculture =  $db->safesql( $parse->process( strip_tags($_POST['subculture']) ));
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
	$timer="-".time();
	if( is_uploaded_file( $image ) and ! $stop ) {
		
		if( intval( $user_group[$member_id['user_group']]['max_foto'] ) > 0 ) {
			
			if( $image_size < 10000000 ) {
				
				$allowed_extensions = array ("jpg", "png", "jpe", "jpeg", "gif" );
				
				if( (in_array( $type, $allowed_extensions ) or in_array( strtolower( $type ), $allowed_extensions )) and $image_name ) {
					
					include_once ENGINE_DIR . '/classes/thumb.class.php';
					if($row['foto']){
					@unlink( ROOT_DIR . "/uploads/fotos/" . $row['foto'] );
					}
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/fotos/" . $row['user_id'] .$timer. "." . $type );
					
					if( $res ) {
						
						@chmod( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] .$timer. "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] . $timer."." . $type );
						
						if( $thumb->size_auto( $user_group[$member_id['user_group']]['max_foto'] ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] .$timer. "." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] .$timer. "." . $type, ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] .$timer. "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fotos/foto_" . $row['user_id'] .$timer. "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] .$timer. "." . $type;
						
						$db->query( "UPDATE " . USERPREFIX . "_users set foto='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
			} else
				$stop .= $lang['news_err_16'];
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/fotos/" . $row['user_id'] .$timer. "." . $type );
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
					
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/toppic/" . $row['user_id'] .$timer. "." . $type );
					
					if( $res ) {
						if($row['bgpic2']){
							@unlink( ROOT_DIR . "/uploads/toppic/" . $row['bgpic2'] );
						}
						@chmod( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] .$timer. "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] .$timer. "." . $type );
						//$thumb->crop(830,300);
							if( $thumb->size_auto( 820,3000 ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/toppic/foto_" . $row['user_id'] .$timer. "." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] .$timer. "." . $type, ROOT_DIR . "/uploads/toppic/foto_" . $row['user_id'] .$timer. "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] .$timer. "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] .$timer. "." . $type;
						
						$db->query( "UPDATE " . USERPREFIX . "_users set bgpic2='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
		
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/toppic/" . $row['user_id'] . $timer."." . $type );
	}
	
	if( $_POST['del_foto3'] == "yes" ) {
		
		@unlink( ROOT_DIR . "/uploads/toppic/" . $row['bgpic2'] );
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
					
					$res = @move_uploaded_file( $image, ROOT_DIR . "/uploads/fon/" . $row['user_id'] .$timer. "." . $type );
					
					if( $res ) {
							if($row['bgpic']){
								@unlink( ROOT_DIR . "/uploads/fon/" . $row['bgpic'] );
							}
						@chmod( ROOT_DIR . "/uploads/fon/" . $row['user_id'] . "." . $type, 0666 );
						$thumb = new thumbnail( ROOT_DIR . "/uploads/fon/" . $row['user_id'] .$timer. "." . $type );
					
					if( $thumb->size_auto( 1000,1000 ) ) {
							$thumb->jpeg_quality( $config['jpeg_quality'] );
							$thumb->save( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] . $timer."." . $type );
						} else {
							@rename( ROOT_DIR . "/uploads/fon/" . $row['user_id'] .$timer. "." . $type, ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] .$timer. "." . $type );
						}
						
						@chmod( ROOT_DIR . "/uploads/fon/foto_" . $row['user_id'] .$timer. "." . $type, 0666 );
						$foto_name = "foto_" . $row['user_id'] .$timer. "." . $type;
						if($_POST['scrollcover']&&$_POST['scrollcover']=='1')
						{
							$foto_name.=',scroll,cover';
						}
					else if($_POST['scrollbg']&&$_POST['scrollbg']=='1')
						{
							$foto_name.=',scroll';
						}
						
						
						$db->query( "UPDATE " . USERPREFIX . "_users set bgpic='$foto_name' where name='$user'" );
					
					} else
						$stop .= $lang['news_err_14'];
				} else
					$stop .= $lang['news_err_15'];
		
		} else
			$stop .= $lang['news_err_32'];
		
		@unlink( ROOT_DIR . "/uploads/fon/" . $row['user_id'] .$timer. "." . $type );
	}
	
	if( $_POST['del_foto2'] == "yes" ) {
		
		@unlink( ROOT_DIR . "/uploads/fon/" . $row['bgpic'] );
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
		if( intval( $user_group[$member_id['user_group']]['max_info'] ) > 0 and strlen( $infov ) > $user_group[$member_id['user_group']]['max_info'] ) {
		
		$stop .= $lang['news_err_22'];
	}
		if( intval( $user_group[$member_id['user_group']]['max_info'] ) > 0 and strlen( $infog ) > $user_group[$member_id['user_group']]['max_info'] ) {
		
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
	if( strlen( $icq ) > 200 ) {
		
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
			$sql_user = "UPDATE " . USERPREFIX . "_users set fullname='$fullname', land='$land', icq='$icq', bdate_view='$bdate_view', birthdate='$birthdate',  email='$email', info='$info', infov='$infov',  infog='$infog',  cens='$cens', smiles='$smilepack', signature='$signature', password='$password1', allow_mail='$allow_mail',  custom='$cust', xfields='$filecontents', allowed_ip='$allowed_ip', allow_wall='$allow_wall', wall_subscr='$allow_subscribe', clanblog='$clanblog', deleted='$deleted', design='$dis', ribbon='$ribbon',showbird='$showbird',showtype='$showtype',sex='$sex',hugs='$hugs',subculture='$subculture',looking='$looking' where name='$user'";
		
		} else {
			
			$sql_user = "UPDATE " . USERPREFIX . "_users set fullname='$fullname', land='$land', icq='$icq', bdate_view='$bdate_view', birthdate='$birthdate', email='$email', info='$info',infov='$infov',  infog='$infog',  cens='$cens', smiles='$smilepack', signature='$signature', allow_mail='$allow_mail', xfields='$filecontents', allowed_ip='$allowed_ip', allow_wall='$allow_wall',  custom='$cust', wall_subscr='$allow_subscribe', clanblog='$clanblog', deleted='$deleted', design='$dis', ribbon='$ribbon',showbird='$showbird',showtype='$showtype',sex='$sex',hugs='$hugs',subculture='$subculture',looking='$looking'  where name='$user'";
		
		}
		   	clear_cache("topnews2_".$row[user_id]);
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
  
$sql_result = $db->query( "SELECT a.* FROM " . USERPREFIX . "_users a where a.name = '$user'  LIMIT 0 , 1" );


$tpl->load_template( 'userinfo.tpl' );

  
while ( $row = $db->get_row( $sql_result ) ) {
        
		if ($row[deleted]=='1')
{ 
 if($member_id[name]==$row [name])
 {
	 	 msgbox( "Вы удалили страницу", '<a href="http://nocens.ru/index.php?do=change&unblock=1">Восстановить её?</a>' );
 }
 else
 {
					 msgbox( "Пользователь удалил страницу", "Сожалеем об этом." );
 }
 if($member_id[user_group]>2){
					 					return;
 }
				 }
				 
		if($row[user_group]=="11")
		{
			$_GET[clan]=$user;
			 include ENGINE_DIR . '/modules/profile2.php';
                return;	
		}
	  $user_found = TRUE;
        $profile_id = $row['user_id'];
        $profile_name = $row['name'];
		$logo='http://nocens.ru/i/clans/'.$row[logo].'.gif';
		if($member_id[user_group]!='5'){
		$banned= checkblack( $profile_name,$member_id[name]);
	$mebanned= checkblack($member_id[name], $profile_name);
		}
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
	 
	 
	 if($act=="ban"&&$member_id['user_id']!=$profile_id)
		{
			// add record if it is not thtere
			if(!in_array($profile_name, explode(", ", $member_id['black'])))
			{
				$NewIs =$member_id['black'].", ".$profile_name; 
				// make request 
				$SqlReq = "UPDATE `".PREFIX."_users` SET `black` = '$NewIs' where user_id = ".$member_id['user_id']."";
				$db->query($SqlReq);
				$mid=$member_id[user_id];
				$db->query("DELETE FROM ".PREFIX."_users_friends WHERE user_id = '$mid' AND friend_id = '$profile_id'");
			$db->query("DELETE FROM ".PREFIX."_users_friends WHERE user_id = '$profile_id' AND friend_id = '$mid'");

$time = time() + ($config['date_adjust'] * 60);
	$n1=''."<br>Персонаж ".$member_id[name]." заблокировал вас. Вы не сможете совершать большую часть действий по отношению к этому участнику.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] заблокировал вас', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
						
							$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
				   	clear_cache("topnews2_".$member_id[user_id]);
					header("Location: http://nocens.ru/".$profile_name."");
			}
		}
   
		if($act=="unban")
		{
			// add record if it is not thtere
			if(in_array($profile_name, explode(", ", $member_id['black'])))
			{
				$NewIs = str_replace(", ".$profile_name, "", $member_id['black']); 
				// make request 
				$SqlReq = "UPDATE `".PREFIX."_users` SET `black` = '$NewIs' where user_id = ".$member_id['user_id']."";
				$db->query($SqlReq);
				$time = time() + ($config['date_adjust'] * 60);
	$n1=''."<br>Персонаж ".$member_id[name]." разблокировал вас. Вы можете совершать большую часть действий по отношению к этому участнику.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] разблокировал вас!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
						
							$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
	clear_cache("topnews2_".$member_id[user_id]);
			   	header("Location: http://nocens.ru/".$profile_name."");
			}
		}
		if($act=="leaveclan"&&$member_id[clantype]!=1&&$member_id[clantype])
			 {
				 
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$member_id[user_id]'"  );
			
						if(strpos($member_id[clan],',')){
					$clans= explode( ", ",$member_id[clan]);
					
		foreach($clans as $s){
			if(trim($s)!=""&&trim($s)!=$clan){
		$newclan.=''.trim($s).', ';
			}
		}
}
else
{
	if($member_id[clan]==$clan)
	{
		$newclan="";
	}
}
		
					$db->query( "UPDATE " . USERPREFIX . "_users set clan='".addslashes($newclan)."' where user_id='".$member_id[user_id]."'"  );
			
						 	$db->query( "UPDATE " . USERPREFIX . "_post set clan='".addslashes($newclan)."' where autor='".$member_id[name]."'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='".addslashes($newclan)."' where user_id='".$member_id[user_id]."'"  );
			 }
			 
			 	 if($act=="kick"&&strpos($row[clan],$member_id[owner])!==false)
			 {
				 
				 
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$member_id[user_id]'"  );
			
						if(strpos($row[clan],',')){
					$clans= explode( ", ",$row[clan]);
					
		foreach($clans as $s){
			if(trim($s)!=""&&trim($s)!=$clan){
		$newclan.=''.trim($s).', ';
			}
		}
}
else
{
	if($row[clan]==$clan)
	{
		$newclan="";
	}
}
		
					$db->query( "UPDATE " . USERPREFIX . "_users set clan='".addslashes($newclan)."' where user_id='".$profile_id."'"  );
			
						 	$db->query( "UPDATE " . USERPREFIX . "_post set clan='".addslashes($newclan)."' where autor='".$profile_name."'"  );
						$db->query( "UPDATE " . USERPREFIX . "_gallery_photos set clan='".addslashes($newclan)."' where user_id='".$profile_id."'"  );
		
				
			 }
			 else if ($act=="kick")
			 {
				  msgbox( $lang['all_err_1'], "Ошибка... Нет прав на удаление. " );
			 }
			 
	 if($act&&$mebanned)
	 {
		 $stop = "Пользователь заблокировал вас";
		 	msgbox( $lang['all_err_1'], $stop );
	 }
	
	 else{
	
		
		/*
	 if($act=="slavery"&&$_SESSION['slav'.$profile_id]!='1'&&$member_id['cash']>=100)
	 {
		 
		  if(!$row[foto])
		 {
			$row[foto]='que.png'; 
					 }
					 		 if(!$member_id[foto])
		 {
			$member_id[foto]='que.png'; 
					 }
		 $waypic='<a href="http://nocens.ru/index.php?user='.$member_id[name].'"><img  src="http://nocens.ru/uploads/fotos/'.$member_id[foto].'"></a>';
		  $waypic2='<a href="http://nocens.ru/index.php?user='.$profile_name.'"><img  src="http://nocens.ru/uploads/fotos/'.$row[foto].'"></a>';
		 
		 		 $month = mktime(0, 0, 0, date("m"), date("d")+1,   date("Y"));
	  
	  
	  				$desc = $profile_name." является хозяином ".$member_id[name];
						   $desc2 = $profile_name." является хозяином ".$member_id[name];

						   $to=$profile_name;
						     	$db->query( "INSERT INTO " . PREFIX . "_gifts (idfrom, idto, type, description, data, code) values ('$member_id[name]', '$to', 'pic', '$desc', '$month', '$waypic')" );
								$db->query( "INSERT INTO " . PREFIX . "_gifts (idfrom, idto, type, description, data, code) values ('$to', '$member_id[name]', 'pic', '$desc2', '$month', '$waypic2')" );
	
				 $time = date( "Y-m-d H:i:s", $_TIME );
						$link='стал рабом';
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-100 where user_id='$member_id[user_id]'" );
						
				      	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
						$_SESSION['slav'.$profile_id]='1';
						
						
						
						$time = time() + ($config['date_adjust'] * 60);
							$rhug=rand(1,6);
						$n1='<img src="http://nocens.ru/pics3/slavery.jpg"><br>'."<br>Персонаж ".$member_id[name]." добровольно попал в ваше рабство! Вы можете ответить взаимностью в его профиле.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] стал вашим рабом!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation+1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
							
	 }
	 
	 	 if($act=="slavery2"&&$_SESSION['slav2'.$profile_id]!='1'&&$member_id['cash']>=3000)
	 {
		 if(!$row[foto])
		 {
			$row[foto]='que.png'; 
					 }
					 		 if(!$member_id[foto])
		 {
			$member_id[foto]='que.png'; 
					 }
		 $waypic='<a href="http://nocens.ru/index.php?user='.$profile_name.'"><img  src="http://nocens.ru/uploads/fotos/'.$row[foto].'"></a>';
		  $waypic2='<a href="http://nocens.ru/index.php?user='.$member_id[name].'"><img  src="http://nocens.ru/uploads/fotos/'.$member_id[foto].'"></a>';
		 		 $month = mktime(0, 0, 0, date("m"), date("d")+1,   date("Y"));
	  
	   $desc = $member_id[name]." является хозяином ".$profile_name;
	  					   $desc2 = $member_id[name]." является хозяином ".$profile_name;
						   $to=$profile_name;
						     	$db->query( "INSERT INTO " . PREFIX . "_gifts (idfrom, idto, type, description, data, code) values ('$member_id[name]', '$to', 'pic', '$desc2', '$month', '$waypic2')" );
								$db->query( "INSERT INTO " . PREFIX . "_gifts (idfrom, idto, type, description, data, code) values ('$to', '$member_id[name]', 'pic', '$desc', '$month', '$waypic')" );
	
				 $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
						$link='поработил';
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-3000 where user_id='$member_id[user_id]'" );
						
				      	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
						$_SESSION['slav2'.$profile_id]='1';
						
						
						
						$time = time() + ($config['date_adjust'] * 60);
							$rhug=rand(1,6);
						$n1='<img src="http://nocens.ru/pics3/slavery.jpg"><br>'."<br>Персонаж ".$member_id[name]." сделал Вас своим рабом! Вы можете ответить взаимностью в его профиле.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] закабалил вас!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation+1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
							
	 }
	 */
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
	
			 if($act=="removeclan")
			 {
	
				 $db->query( "UPDATE " . USERPREFIX . "_map set name='Нет владельца', type='0', description='' where description='$member_id[owner]'"  );
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where user_id='$member_id[user_id]'"  );
				$db->query( "UPDATE " . USERPREFIX . "_users set clantype=0, owner='' where owner='$member_id[owner]'"  );
				$db->query("DELETE FROM `".PREFIX."_users` WHERE user_group='11' and email ='".$member_id[owner]."@nocens.ru'");
					$db->query("DELETE FROM `".PREFIX."_actions` WHERE ufrom ='".$member_id[owner]."'");
					
				updateclans($member_id[owner],"del");
				
			 }
			 		

			 	
		 if($member_id[user_id]!=$profile_id)
		 {
			 if($act=="addclan"&&$member_id['owner'])
			 {
				 if ($row[clan]&&substr_count ( ',', $row[clan] )>4)
				 {
					 	msgbox("Превышено число сообществ", "Попросите пользователя выйти из какого-либо коммьюнити, чтобы пригласить к себе.");
						return;
				 }
				 else{
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=1 where (friend_id='$member_id[user_id]' AND user_id='$profile_id')"  );
				$n1="Персонаж  ".$member_id[name]." пригласил вас в клан-коммьюнити ".$member_id[owner]."! Вы можете <a href=\"http://nocens.ru/".$member_id[name]."&act=enterclan\"><b>СОГЛАСИТЬСЯ</b></a> или проигнорировать предложение.<br>Можно быть одновременно в пяти коммьюнити и возглавлять одно из них.";
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('$member_id[name] пригласил в клан!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
						$db->query( "UPDATE " . USERPREFIX . "_users set pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
				 }
			 }
			  if($act=="enterclan")
			 {
				 $rowe = $db->super_query("SELECT invite from ".USERPREFIX . "_users_friends where (user_id='$member_id[user_id]' AND friend_id='$profile_id')");
				 if($rowe[invite]==1&&$row[owner]!="")
				 {
					 
			 	$db->query( "UPDATE " . USERPREFIX . "_users_friends set invite=0 where (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
				if(strpos($member_id[clan],',')){
					$clans= explode( ", ",$member_id[clan]);
					
		foreach($clans as $s){
				if(trim($s)!=""&&trim($s)!=$row[owner]){
		$newclan.=''.trim($s).', ';
				}
			
		}
		$newclan.=$row[owner].', ';
}
else
{
	if($member_id[clan]=="")
	{
		$newclan=$row[owner];
	}
	else
	{
		$newclan=$member_id[clan].', '.$row[owner];
	}
}
				$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-' $sum', clan='".addslashes($newclan)."', clantype='3'   where user_id='$member_id[user_id]'" );
				$db->query( "UPDATE " . USERPREFIX . "_gallery_photos SET clan='".addslashes($newclan)."' where uname='".$member_id[name]."'" );
				$db->query( "UPDATE " . USERPREFIX . "_post SET clan='".addslashes($newclan)."' where autor='".$member_id[name]."'" );
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
						if($row[hugs]!='2'){
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('Вас обнял $member_id[name]!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation+1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						}
						$db->query( "UPDATE " . USERPREFIX . "_users set cash=cash-30 where user_id='$member_id[user_id]'" );
							$db->query( "UPDATE " . USERPREFIX . "_users_friends set relation=relation+1 where (friend_id='$member_id[user_id]' AND user_id='$profile_id') or (user_id='$member_id[user_id]' AND friend_id='$profile_id')"  );
										$n1="Вам переведены флопсы от  ".$member_id[name]."!";
	$link='обнял';
	$time = date( "Y-m-d H:i:s", $_TIME );
        	$db->query( "INSERT INTO " . PREFIX . "_actions (ufrom, uto, action, time, type) values ('$member_id[name]', '$profile_name', '$link', '$time', 'act')" );	
			
			  $check = $db->super_query("SELECT COUNT(*) as num FROM `".PREFIX."_actions` WHERE `uto` = '".$profile_name."' and action = 'обнял'");
			
							  if($check[num]>=100)
               {
           achievements(13,$row[user_id],$row[achieves]);
            
               }
			   	header("Location: http://nocens.ru/".$profile_name."");
							$system="<b>> ОТПРАВЛЕНО!</b>";		
							
							
			 }
			 else if($act=="engage"&&$relation[love]>=500&&$member_id['cash']>=1000)
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
								header("Location: http://nocens.ru/".$profile_name.""); 
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
								header("Location: http://nocens.ru/".$profile_name.""); 
							$system="<b>> ОТПРАВЛЕНО!</b>";		
			 }
			 		else if($act=="punch"&&$member_id['cash']>=30)
			 {
			
			 $time = date( "Y-m-d H:i:s", $_TIME );
							$time = time() + ($config['date_adjust'] * 60);
							
						$n1="<img src=\"http://nocens.ru/pics/actions/pin.jpg\" alt=\"\" width=\"170\" /><br>Вас пнул персонаж  ".$member_id[name]."! <i></i><br> Вы можете расплатиться с обидчиком в его профиле.";
						if($row[hugs]!='2'){
						$db->query( "INSERT INTO " . USERPREFIX . "_pm (subj, text, user, user_from, date, pm_read, folder) values ('Вас пнул $member_id[name]!', '$n1', '$profile_id', '$member_id[name]', '$time', 'no', 'inbox')" );
							$db->query( "UPDATE " . USERPREFIX . "_users set forum_reputation=forum_reputation-1, pm_all=pm_all+1, pm_unread=pm_unread+1  where user_id='$profile_id'" );
						}
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
			
							header("Location: http://nocens.ru/".$profile_name.""); 
							$system="<b>> ОТПРАВЛЕНО!</b>";		
			 }
			 	
			 else
			 {
				 $system="<b>> ОШИБКА!</b>";
			 }
		 }
	 }
	 $birthdate = $row['birthdate'];    
    $bdate_view = $row['bdate_view'];
    $birthdate_see = format_date_html($birthdate,$bdate_view);
	if(strpos($birthdate_see,"0000"))
	$birthdate_see="Скрыто";
    $birthdate_array = explode('-',$birthdate);
    $birth_y = $birthdate_array[0];
    $birth_m = $birthdate_array[1];
    $birth_d = $birthdate_array[2];
	$g2=$row[game2];
	
			$list = explode( ", ", $member_id['clan'] );
			if($row[clanblog]==""||$row[clanblog]=="0")
				$variants.= '<option selected="selected" value="">Не перенаправлять</option>';
			else
		$variants.= '<option value="">Не перенаправлять</option>';
	foreach ( $list as $clan ) {
		if($clan==$row[clanblog]){
		$variants.= '<option selected="selected" value="'.$clan.'">'.$clan.'</option>';
		}
		else
		{
		$variants.= '<option value="'.$clan.'">'.$clan.'</option>';
				}
	}
	
			if($variants!=""){
			$clanblog='
<select name="clanblog" id="clanblog">
  '.$variants.'

</select>';}
	else
	{
		$clanblog="";
	}
	if($row[deleted]!="0"&&$row[deleted])
	{
	$deleted="checked";

	}
	else
	{
		$deleted="";
	}
	      $bgscroll = explode( ",",$row[bgfon]);
	if($bgscroll[1]=='scroll')
		{
	$checkscroll="checked";

	}
	else
	{
		$checkscroll="";
	}
	
	if($bgscroll[1]=='cover'&&$bgscroll[2]=='cover')
		{
	$checkcover="checked";

	}
	else
	{
		$checkcover="";
	}
	
	$tpl->set( '{deleted}', $deleted);
	$tpl->set( '{clanblog}', $clanblog);
		$tpl->set( '{checkscroll} ', $checkscroll);
			$tpl->set( '{checkcover} ', $checkcover);
	
	if($row[design]!="0")
	{
		$row[game2]=$row[design];
		
	}
	$tpl->set( '{bgpic}', $row['bgpic']);
	$fonpic= $row['bgpic'];
		$tpl->set( '{bgpic2}', $row['bgpic2']);
	if($row['bgpic2'])
	{	$tpl->set( '{height}', "topprof");
	$tpl->set( '{height2}', "toptitle");
	}
	else
	{	$tpl->set( '{height}',"topprof2");
	$tpl->set( '{height2}', "toptitle2");
	}
	if ( $user_group[$member_id['user_group']]['allow_pm'] && !$mebanned )
	if($member_id[user_id]==$row['user_id'])
	{
		if($member_id[pm_unread]>0)
		{
			$addpm=" <b>+".$member_id[pm_unread]."</b>";
		}
		$tpl->set( '{pm}', "<a onclick=\"DlePage('do=pm&amp;doaction=inbox'); return false;\"  href=\"$PHP_SELF?do=pm&amp;doaction=inbox\">Мои сообщения".$addpm."</a><br><a onClick=\"gototop(); $('#options').fadeIn(200); return false;\" href=\"#\">Настройки профайла</a><br>");
	}
	else{
		
		$tpl->set( '{pm}', "<a onclick=\"DlePage('do=pm2&user=" . $row['name'] . "'); return false;\" href=\"$PHP_SELF?do=pm2&user=" . $row['name'] . "\">Диалог в чате</a><br><a onclick=\"DlePage('do=pm&doaction=newpm&user=" . $row['user_id'] . "'); return false;\" href=\"http://nocens.ru/index.php?do=pm&doaction=newpm&user=" . $row['user_id'] . "\">Сообщение</a><br>" );}
	else
		$tpl->set( '{pm}', "", $output );



			$tagsearch="";
			$keytags =  $db->query("SELECT tag,  COUNT(*) as cnt from  ".PREFIX."_tags WHERE name='".$row['name']."' GROUP BY tag HAVING cnt>1  ORDER BY cnt desc  LIMIT 0,15  ");
			$i=0;

			 	while($row1 = $db->get_row($keytags)){
					
								$fontsize=10+ round($row1[cnt]/5);
								if($fontsize>24)
								$fontsize=24;
					if($i==0)
					{$tagsrch.='<b><a onclick="DlePage(\'do=blogs&user='.$row['name'].'&filter='.$row1[tag].'\'); return false;" style="font-size: '.$fontsize.'px;" href="http://nocens.ru/index.php?do=blogs&user='.$row['name'].'&filter='.$row1[tag].'">'.$row1[tag].'</a></b> ';
					}
					else
					{$tagsrch.='<a  onclick="DlePage(\'do=blogs&user='.$row['name'].'&filter='.$row1[tag].'\'); return false;"  style="font-size: '.$fontsize.'px;"  href="http://nocens.ru/index.php?do=blogs&user='.$row['name'].'&filter='.$row1[tag].'">'.$row1[tag].'</a> ';
					}
					$i++;
				}

		

$tpl->set( '{tagsrch}', $tagsrch);


	
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
	if($row[clan]){
		if(strpos($row[clan],',')!==false)
	{
			$clans=explode(', ',$row[clan]);
		foreach($clans as $c){
			if($c!=""){
				if($c==$row[owner])
				$add=" (глава)";
				else
				$add="";
				 $link1.='<b><a onclick="DlePage(\'clan='.$c.'\'); return false;" href="http://nocens.ru/index.php?clan='.$c.'">'.$c.'</a>'.$add.'</b><br>';
			}
		}
	}
	else
	{
		if($row[clan]==$row[owner])
				$add=" (глава)";
				else
				$add="";
		 $link1.='<b><a onclick="DlePage(\'clan='.$row[clan].'\'); return false;" href="http://nocens.ru/index.php?clan='.$row[clan].'">'.$row[clan].'</a>'.$add.'</b><br>';
	}



	 $acl='';
	 $tpl->set( '{clanpanel}', stripslashes( "<div class=\"ava2\"><div class=\"infoto\"><h3 class=\"h3left\">Коммьюнити</h3>".$link1."</div></div>" ) );
	$tpl->set( '{clan}', "" );
 }
 else
 {
	 $tpl->set( '{clan}', ""  );
	 $tpl->set( '{clanpanel}', ""  );
 }
 
 
	$conf="onClick=\"return confirm('Вы точно этого хотите?');\"";
		/*
	if($member_id['cash']>=100&&$_SESSION['slav'.$profile_id]!='1'&&$member_id['user_id']!=$profile_id)
	{
	$hug.='<a  href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=slavery" >Отдаться в рабство (100)</a><br> ';
	}
	if($member_id['cash']>=3000&&$_SESSION['slav2'.$profile_id]!='1'&&$member_id['user_id']!=$profile_id)
	{
	$hug.='<a  href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=slavery2" >Поработить (3000)</a><br> ';
	}
	

	
if($member_id[user_group]!=5&&$member_id['user_id']!=$profile_id)
	{
		$hug.='<a onclick="return confirm(\'Заняться виртуальным сексом с персонажем?\');" href="http://nocens.ru/index.php?do=change&sex=1">Секс</a><br><a onclick="return confirm(\'Устроить Битву на птицах?\');" href="http://nocens.ru/index.php?do=change&battle=1">Битва на птицах</a><br>';
	}
	*/
	if(!$mebanned){
		
		
	if($member_id['cash']>=30&&$member_id['user_id']!=$profile_id)
	{$hug.='<a onclick="DlePage(\'do=bank&send&user='.$row[name].'\'); return false;" href="http://nocens.ru/index.php?do=bank&send&user='.$row[name].'">Подарок</a><br> ';
	
		$good.='<a  onClick="ajact('.$row['user_id'].',\'hug\'); return false;" href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=hug" >Обнять (30)</a><br> ';
			$good.='<a onClick="ajact('.$row['user_id'].',\'3\'); return false;" href="#" >Пожать руку (30)</a><br> ';
				$bad.='<a onClick="ajact('.$row['user_id'].',\'punch\'); return false;" href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=punch" >Пнуть (30)</a><br> ';
				
		if($member_id[level]>$row[level]&&$member_id[level]>=7)
		{
		$good.='<a onClick="ajact('.$row['user_id'].',\'6\'); return false;" href="#" >Благословить (50)</a><br> ';
				$bad.='<a onClick="ajact('.$row['user_id'].',\'4\'); return false;" href="#" >Облить грязью (50)</a><br> ';
		}
		else if($member_id[level]<$row[level]&&$row[level]>=7)
		{
				$good.='<a onClick="ajact('.$row['user_id'].',\'5\'); return false;" href="#" >Поклониться (50)</a><br> ';
		}
		
}

if($relation[love]>=50&&$relation[relation]>=50&&$member_id['cash']>=50&&$member_id['user_id']!=$profile_id)
{
			$good.='<a onClick="ajact('.$row['user_id'].',\'1\'); return false;" href="#" >Поцеловать (50)</a><br> ';
}

if($member_id['cash']>=50&&$member_id['user_id']!=$profile_id)
{
			$bad.='<a onClick="ajact('.$row['user_id'].',\'2\'); return false;" href="#" >Набить морду (50)</a><br> ';
}
if($member_id['cash']>=30&&$member_id['user_id']!=$profile_id)
{
		
}




if($relation[love]>=500&&$relation[engage]!=2&&$relation[engage]!=1&&$member_id['cash']>=1000)
{
		$hug2.='<a  '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=engage">Сделать предложение (1000)</a><br> ';
}
else if($relation[engage]==2&&$member_id['cash']>=1000)
{
			$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=noengage">Закончить отношения (1000)</a><br> ';
	
}


if($row['showbird']!=0&&$member_id['cash']>=100)
					{ 
					$good.='<a onclick="DlePage(\'subaction=userinfo&user='.$row[name].'&act=feed\'); return false;"  '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=feed">Кормить пета (100)</a><br> ';
					}
					
					if($relation[relation]>=0){
$hug.=$good;
$hug2=$bad.$hug2;
}
else
{
$hug2=$good.$hug2;
$hug.=$bad;
}
					if($member_id['user_id']!=$profile_id&&$member_id['owner']&&strpos($row[clan],$member_id[owner])===false)
{

	$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=addclan">Позвать в клан</a><br> ';
}
					}
else
{
	$hug="Пользователь заблокировал вас";
}




if($member_id['user_id']!=$profile_id&&$member_id['owner']&&strpos($row[clan],$member_id[owner])!==false)
{
	$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=kick">Выгнать из клана</a><br> ';
}
if($member_id['user_id']==$profile_id&&$member_id['clan']&&($member_id['clantype']==1))
{
	$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=removeclan">Удалить клан</a><br> ';
}
	$hug2.='<a href="http://nocens.ru/index.php?do=bank&money&user='.$row[name].'">Перевести флопсы</a><br> ';

	if($banned==true&&$member_id['user_id']!=$profile_id&&$member_id[user_group]!='5')
{
	$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=unban">Разблокировать</a><br> ';
}
else if($member_id['user_id']!=$profile_id&&$member_id[user_group]!='5')
	{
			$hug2.='<a '.$conf.' href="http://nocens.ru/?subaction=userinfo&user='.$row[name].'&act=ban">Заблокировать</a><br> ';
	}
	else if($member_id[user_group]=='5')
	{
		$hug2='Зарегистрируйтесь, чтобы совершать действия.';
	}
$tpl->set( '{hugs}', $hug  );
$tpl->set( '{hugs2}', $hug2  );
	$tpl->set( '{game}', stripslashes( $row['game'] ) );
		$tpl->set( '{system}', stripslashes( $member_id[cash]." <img title=\"флопсов\"align=\"texttop\" src=\"http://nocens.ru/pics/watermelon.png\">") );
		$tpl->set( '{cash}', stripslashes( $row['cash'] ) );
	$tpl->set( '{icq}', stripslashes( $row['icq'] ) );
	$subc= explode( ",", $row['subculture'] );
		foreach($subc as $s){
			if($s!=""){
		$subs.='<a  onclick="DlePage(\'subaction=userinfo&search=1&user=subculture:'.trim($s).'\'); return false;" href="http://nocens.ru/index.php?subaction=userinfo&search=1&user=subculture:'.trim($s).'">'.trim($s).'</a>, ';
			}
			
		}
		if($subs){
		$subs=substr($subs,0,strlen($subs)-2);
		}
		$tpl->set( '{subculturetext}', stripslashes( $subs ) );
		$sextext[0]='мужской';
		$sextext[1]='мужской';
		$sextext[2]='женский';
		$tpl->set( '{sextext}', stripslashes( $sextext[$row['sex']] ) );

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
	
				
 $row3 = $db->query("SELECT `id`, `date`, `name`, `title` as titl, `category`, `user_id`,`cens` FROM `".PREFIX."_gallery_photos` WHERE user_id='".$row['user_id']."' and category!='32' order by userfixed desc, date DESC LIMIT 0 , 5 ");

       if ($db->num_rows($row3)) {  
                
                    $galleryCenter = '<table width="100%"><tr>'; 
                    
                    while ($image = $db->get_row($row3)){
                        if (!$i)
						
						
						$titl = str_replace("\r"," ",$image['titl']);
$titl = str_replace("\n"," ",$titl);
$titl=stripslashes(strip_tags($titl));

                            $date = langdate($config['timestamp_comment'],  $image['date']);
	                  
	                        $TplThumb = file_get_contents(ROOT_DIR ."/templates/".$config['skin']."/gallery_thumb2.tpl");
							$TplThumb = str_replace("{date}", date('', $image['date']), $TplThumb);
							//onmouseover=\"tooltip.show('".$titl."');\" onmouseout=\"tooltip.hide();\"
							$TplThumb = str_replace("[link-full-foto]", "<a  onclick=\"DlePage('do=gallery&bigphoto=".$image['id']."'); return false;\"  href=\"http://nocens.ru/index.php?do=gallery&bigphoto=".$image['id']."\">", $TplThumb);
							$TplThumb = str_replace("[/link-full-foto]", "</a>", $TplThumb);
							 	if(($member_id[user_group]=='5'||$member_id[cens]==0)&&$image[cens]=='1')
	{
    $TplThumb = str_replace("{src}", "http://nocens.ru/pics/censura.png", $TplThumb);
    }
    else{
							$TplThumb = str_replace("{src}", "/".$config_gallery['uploaddir'].$row['id']."".$image['user_id']."/thumb/".$image['name'], $TplThumb);
	}
							$TplThumb = str_replace("{com-num}", $comments['num'], $TplThumb);							
							$TplThumb = str_replace("{title}", "", $TplThumb);
							$galleryCenter .= '<td>'.$TplThumb.'</td>';        
								$TplThumb = str_replace("{author}", "", $TplThumb);
	                        $i++;
                    }                               
                    
                    $galleryCenter .= '</tr></table>';   
                    $blog3="<a onclick=\"DlePage('do=album&user=".$row['name']."'); return false;\"  href=\"http://nocens.ru/index.php?do=album&user=".$row['name']."\"><img title=\"Галерея\"  align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf3.png\">Галерея</a>";
		
		$tpl->set( '{blog3}', $blog3 );
	
			$tpl->set( '[blog3]', "" );
		$tpl->set( '[/blog3]', "" );

			
	
                } else {
                    $galleryCenter = 'Нет фотографий.';
					$blog3="";
					$tpl->set_block( "'\\[blog3\\](.*?)\\[/blog3\\]'si", "<!-- profile -->" );
		
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
		 
  }
 }
 //Птицы
 
  $rowbird = $db->super_query("SELECT * from bird where owner='$row[name]'");
  if(!$rowbird&&($member_id[name]==$row[name]or $member_id['user_group'] < 3))
  {
	  
	  $month = mktime(0, 0, 0, date("m"), date("d")+30,   date("Y"));
	  	$db->query( "INSERT INTO bird (name, owner, hunger) values ('$row[name]', '$row[name]', '$month')" );
  }
	  else
  {
 if($row['showbird']!=0)
 {
	  $tpl->set('{showbird}', '<input type="checkbox" name="showbird" value="yes" checked="checked" /> Показывать питомца');
 	$_SESSION['bird']=$row['name'];
	    	  $tpl->set('{bird}', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="150" height="150" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
<param name="src" value="http://nocens.ru/save/bird.swf">
<param name="wmode" value="opaque">
<embed src="http://nocens.ru/save/bird.swf" width="150" type="application/x-shockwave-flash" height="150" wmode="opaque">
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
$myclans="'".implode("','",explode(", ",$row[clan]))."'";
 $row4 = $db->query("SELECT `id`, `idfrom`, `idto`, `description`, `type` ,`data`, `code` FROM `".PREFIX."_gifts` WHERE idto='".$row['name']."' OR  idto in (".$myclans.")   order by id desc ");
$nump=0;
       if ($db->num_rows($row4)) {  
                
                       
                    
                    while ($image = $db->get_row($row4)){
                        if (!$i)
                                 {}
								  $i1=mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
								  
								if($image[idto]==$row['clan'])
								{
									$add='клану '.$image[idto].', ';
								}
								else
								{
									$add="";
								}
							
								if($i1<=$image['data'])
								{
									$time = date( "d.m.Y", $image['data'] );
									if($image['type']!='pic'&&$image['type']!='ring')
									{
								 $outq.="<div style=\"float: left; height: 100px; \"><img onmouseover=\"tooltip.show('".striptext($image['description'])." (".$add."от ".$image['idfrom'].")<br>Годен до: ".$time."');\" onmouseout=\"tooltip.hide();\" width=\"100\" height=\"100\"  src=\"http://nocens.ru/pics/presents/pr".$image['type'].".png\"></div>";   
									}
									else if($image['type']=='ring')
									{
									
												 $outq.="<div style=\"float: left; height: 100px;  padding-left: 1px; padding-right: 1px;\" onmouseover=\"tooltip.show('".striptext($image['description'])."');\" onmouseout=\"tooltip.hide();\">".$image['code']."</div>";   
									
	                        $i++;
							if($image['type']==1)
							$nump++;
									}
									else
									{
										if($member_id[name]==$row[name]||$member_id[user_group]<3)
										{
											$delka="<div  onclick=\"return confirm('Вы точно хотите удалить подарок?')\" style=\"position: relative;\"><div style=\"position: absolute;\"><a  href=\"http://nocens.ru/index.php?subaction=userinfo&user=".$row[name]."&delpr=".$image[id]."\"><img src=\"http://nocens.ru/pics/buts/l3.png\"></a></div></div>";
										}
												 $outq.="<div style=\"float: left; height: 100px;  padding-left: 1px; padding-right: 1px;\" onmouseover=\"tooltip.show('".striptext($image['description'])." (".$add."от ".$image['idfrom'].") <br>Годен до: ".$time."');\" onmouseout=\"tooltip.hide();\">".$delka."".$image['code']."</div>";   
									}
	                        $i++;
							if($image['type']==1)
							$nump++;
                    }                               
                
					}    
					
					
					//Награды
					$aw['user1']='10000';
						$aw['user2']='10001';
							$aw['user3']='10002';
					$about['user1']='Лучший участник NoCENS';		
					$about['user2']='Выдающийся участник NoCENS';
					$about['user3']='Примечательный участник NoCENS';
					if($row[awards])
					{
						
						$awards=explode(", ", $row['awards']);
						 foreach($awards as $c => $d)
 {
	 if($d!=""){
	 					 $outq.="<img onmouseover=\"tooltip.show('".$about[$d]."');\" onmouseout=\"tooltip.hide();\" width=\"100\" height=\"100\"  src=\"http://nocens.ru/pics/presents/pr".$aw[$d].".png\">";   
	 }
 }
					}
					
					$outq=$outq.$leftq.'<div style="clear:both;"></div>';
	   }
	    if($nump>=8)
	$outq="<div style=\"float: left; height: 100px; \"><img onmouseover=\"tooltip.show('Кирпичный дом <br><i>Из халявного кирпича</i>');\" onmouseout=\"tooltip.hide();\" width=\"65\" height=\"65\"  src=\"http://nocens.ru/pics/presents/house.png\"></div>".$outq;  
	
	$outq.='<div style="clear: both; height: 15px;"></div>';
if($member_id[name]&&$member_id[name]!=$row[name]){
	  $outpr.='<a onclick="DlePage(\'do=bank&send&user='.$row[name].'\'); return false;" href="http://nocens.ru/index.php?do=bank&send&user='.$row[name].'">Отправить подарок</a>';
	  	 
}
	   $outr= "<a onclick=\"DlePage('do=bank&send&user=".$row['name']."'); return false;\" href=\"http://nocens.ru/index.php?do=bank&send&user=".$row['name']."\">+</a>";  
	$tpl->set( '{presents}', $outq );
		$tpl->set( '{addpr}', $outr );
		$tpl->set( '{newpr}', $outpr );
		 $rowv = $db->query("SELECT `autor`, `category`, `id`, `date` ,`title`,`short_story` FROM `".PREFIX."_post` WHERE autor='".$row['name']."' and category='31'  order by userfixed desc, id desc LIMIT 0,5");

       if ($db->num_rows($rowv)) {  
                
                       
                          $outv.= '<table width="100%"><tr>'; 
                    while ($image = $db->get_row($rowv)){
                        if (!$i)
                                 {}
								
								 $outv.="<td style=\"padding-left: 10px;\"><div class=\"mainblocktops\" align=\"center\"><a onmouseover=\"tooltip.show('".$image['title']."');\" onmouseout=\"tooltip.hide();\"  href=\"http://nocens.ru/index.php?newsid=".$image['id']."\">".$image['short_story']."</a></div></td>";   
	                        $i++;
                    }   $outv.='</tr></table>';   
						$blogv="<a onclick=\"DlePage('do=video&user=".$row['name']."'); return false;\"  href=\"http://nocens.ru/index.php?do=video&user=".$row['name']."\"><img src=\"http://nocens.ru/pics/linkinfvid.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Видео</a>";
					
					      }
					else
					{
						$blogv="";
						 $outv.= 'Пользователь ничего не добавлял.';
					}
                    $outv.= '<div style="clear: both;></div>';  
					

 $row4 = $db->query("SELECT `autor`, `category`, `id`, `date` ,`title` ,`userfixed` FROM `".PREFIX."_post` WHERE autor='".$row['name']."' and category!='31' order by  userfixed desc, id desc LIMIT 0,6");

       if ($db->num_rows($row4)) {  
                
                       
                    
                    while ($image = $db->get_row($row4)){
                        if (!$i)
                                 {}
								if($image[userfixed])
								 $out1.="» <a onclick=\"DlePage('newsid=".$image['id']."'); return false;\" href=\"http://nocens.ru/index.php?newsid=".$image['id']."\"><b>".stripslashes($image['title'])."</b></a><br>";
								else
								 $out1.="» <a onclick=\"DlePage('newsid=".$image['id']."'); return false;\" href=\"http://nocens.ru/index.php?newsid=".$image['id']."\">".stripslashes($image['title'])."</a><br>";   
	                        $i++;
                    }                               
                    $out1.= '';    
                     $blog="<a onclick=\"DlePage('do=blogs&user=".$row['name']."'); return false;\" href=\"http://nocens.ru/index.php?do=blogs&user=".$row['name']."\"><img  title=\"Блоги\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf1.png?1\">Блог</a>";
					 
	$blog2="<a onclick=\"DlePage('do=creo&user=".$row['name']."'); return false;\" href=\"http://nocens.ru/index.php?do=creo&user=".$row['name']."\"><img  title=\"Публикации\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf2.png\">Публикации</a>";

		$tpl->set( '{blog}', $blog );
		
		$tpl->set( '[blog]', "" );
		$tpl->set( '[/blog]', "" );
			
	
		$tpl->set( '{blog2}', $blog2 );
                    
                } else {
                    $out1.= 'Пользователь ничего не добавлял.';
					     $tpl->set_block( "'\\[blog\\](.*?)\\[/blog\\]'si", "<!-- profile -->" );

					$blog="";
					$blog2="";
				
	$tpl->set( '{blog}', $blog );
		$tpl->set( '{blog2}', $blog2 );
                }            
				    $blogfr="<a  onclick=\"DlePage('do=blogs&friends=".$row['name']."'); return false;\" href=\"http://nocens.ru/index.php?do=blogs&friends=".$row['name']."\"><img  title=\"Блоги\" align=\"absmiddle\" border=\"0\" src=\"http://nocens.ru/pics/linkinf1.png\"></a>";   
              $tpl->set( '{blogfr}', $blogfr );  
$blog4="<p><a  onclick=\"DlePage('do=actions&list&user=".$row['name']."'); return false;\"  href=\"http://nocens.ru/index.php?do=actions&list&user=".$row['name']."\"><img src=\"/pics/actions/abut.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Логи</a>";
$blog5.="<a  onclick=\"DlePage('do=files&list&user=".$row['name']."'); return false;\"  href=\"http://nocens.ru/index.php?do=files&list&user=".$row['name']."\"><img src=\"/pics/actions/abut2.png\" width=\"25\" height=\"25\" align=\"absmiddle\" />Файлы</a></p>";

	$tpl->set( '{blog4}', $blog4 );
	$tpl->set( '{blog5}', $blog5 );
	if($blogv){
			$tpl->set( '[blogv]', "" );
		$tpl->set( '[/blogv]', "" );
	}
	else{
			$tpl->set_block( "'\\[blogv\\](.*?)\\[/blogv\\]'si", "<!-- profile -->" );
	}
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
	$tpl->set('{reputation}', level($row['forum_reputation'])." ур.");
	$tpl->set('{reputationnum}', $row['forum_reputation']);
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
	
	$achs=array_reverse(explode(",", $row[achieves]));
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
												   $an2[17]="Раксемус дается всем друзьям Raxemus.";   
												     $an2[18]="Caelestis Rose дается всем друзьям Dingo.";  
														   $an2[19]="Союз даётся всем друзьям StalkerWerewolf.";  
														    $an2[20]="Лис даётся всем друзьям Nikko.";  
															 $an2[21]="Игротека даётся всем друзьям Mao_Dzedyn.";  
															  $an2[22]="Крылья даётся всем друзьям Dragon-Man.";  
														   $an2[23]="Хиппи даётся всем друзьям Pepel.";  
														    $an2[25]="ErilaZ даётся всем друзьям KenderMistik.";  
																   	   $an2[24]="Барсик даётся всем друзьям Furry_Smith.";  
																	   	   $an2[26]="Косточка даётся всем друзьям Fatzi.";  
	$i=0;	
	
		foreach ($achs as $ach)
	{
		
		if($ach!=""){
			if(strpos($ach,'-2'))
			{
				$level='<div class="achnum">2</div>';
				$levlabel=" 2 уровень. ";
				$ach=str_replace( "-2", "", $ach );
			}
			else if(strpos($ach,'-3'))
			{
				$level='<div class="achnum">3</div>';
					$levlabel=" 3 уровень. ";
				$ach=str_replace( "-3", "", $ach );
			}
			else 
			{
			$level="";
			$levlabel=". ";
			}
			$achadd="onmouseover=\"tooltip.show('".$an[$ach].$levlabel.$an2[$ach]."');\" onmouseout='tooltip.hide();'";
			if($i<10)
		$awards.='<div '.$achadd.' class="tabcell2" style="height: 20px; padding: 0px; margin-top: 2px;"><a >'.$level.'<img  style=" border-radius: 2px;" src="http://nocens.ru/pics2/ach/ach'.$ach.'.png"></a></div>';
else
	$awards2.='<div '.$achadd.' class="tabcell2" style="height: 20px; padding: 0px; margin-top: 2px;"><a>'.$level.'<img  style=" border-radius: 2px;" src="http://nocens.ru/pics2/ach/ach'.$ach.'.png"></a></div>';
	$i++;
		}
	}
	$awards.="</div>";
	$op = "userinfo";
require_once ENGINE_DIR."/modules/friends/friends.php";
$tpl->set('{game2}',$row['game2']);
$tpl->set('{awards}', $awards);
$tpl->set('{awards2}', $awards2);
if($awards2!="")
{
		
		$tpl->set_block( "'\\[awards\\](.*?)\\[/awards\\]'si", "\\1" );
}
else{
			$tpl->set_block( "'\\[awards\\](.*?)\\[/awards\\]'si", "" );
}
$tpl->set('{awardsnum}', $i);


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
	
		$tpl->set( '{editinfov}', $parse->decodeBBCodes( $row['infov'], false ) );
			$tpl->set( '{editinfog}', $parse->decodeBBCodes( $row['infog'], false ) );
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
 if($member_id['cash']>=0)
 {$addstatus="<option value=\"11\">Агрессив</option><option value=\"5\">Депрессивный</option><option value=\"6\">Кавайный</option><option value=\"7\">Фуррёвый</option><option value=\"8\">Патриотичный</option><option value=\"9\">Геймерский</option><option value=\"10\">Денежный</option><option value=\"12\">Важный</option><option value=\"13\">Праздничный</option>";
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
 if($row[custom]=='3')
 {
	 $c[3]='selected';
 }
 else if($row[custom]=='2')
 {
	  $c[2]='selected';
 }
 else
 {
	  $c[1]='selected';
 }
 $custom=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"custom\" selected=\"selected\"><option value=\"\" ".$c[1].">Информационные блоки</option><option value=\"2\" ".$c[2].">Новости и блоги</option><option value=\"3\" ".$c[3].">Последние действия</option></select>";
 		 $tpl->set( '{custom}',  $custom);
		 
		 
		  if($row[looking]=='3')
 {
	 $cf[3]='selected';
 }
 else if($row[looking]=='2')
 {
	  $cf[2]='selected';
 }
 else if($row[looking]=='1')
 {
	  $cf[1]='selected';
 }
 else
  {
	  $cf[0]='selected';
 }
 
  $custom=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"looking\" selected=\"selected\"><option value=\"0\" ".$cf[0].">Никого</option><option value=\"1\" ".$cf[1].">Девушку</option><option value=\"2\" ".$cf[2].">Парня</option><option value=\"3\" ".$cf[3].">Кого-нибудь</option></select>";
		
			 $tpl->set( '{looking}',  $custom);
 if($row[showtype]=='0'||$row[showtype]=='')
 {
	 $cs[1]='selected';
 }
 else if($row[showtype]=='1')
 {
	  $cs[2]='selected';
 }
else if($row[showtype]=='2')
 {
	  $cs[3]='selected';
 }
 $showtype=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"showtype\" selected=\"selected\"><option value=\"0\" ".$cs[1].">Всех, кроме игнорируемых</option><option value=\"1\" ".$cs[2].">Только друзей и подписки</option><option value=\"2\" ".$cs[3].">Показывать всех без ограничений, анархия</option></select>";
 		 $tpl->set( '{showtype}',  $showtype);
		 
		 
		 if($row[hugs]=='0'||$row[hugs]=='')
 {
	 $ch[1]='selected';
 }
 else if($row[hugs]=='1')
 {
	  $ch[2]='selected';
 }
else if($row[hugs]=='2')
 {
	  $ch[3]='selected';
 }
 $howhugs=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"hugs\" selected=\"selected\"><option value=\"0\" ".$ch[1].">Все, кроме игнорируемых</option><option value=\"2\" ".$ch[3].">Никто не может</option></select>";
 		 $tpl->set( '{howhugs}',  $howhugs);
		 
		  		
 if($row[sex]=='1'||$row[sex]<1)
 {
	 $cx[1]='selected';
 }
 else if($row[sex]=='2')
 {
	  $cx[2]='selected';
 }

 $sex=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"sex\" selected=\"selected\"><option value=\"0\" ".$cx[1].">Мужской</option><option value=\"2\" ".$cx[2].">Женский</option></select>";
 		 $tpl->set( '{sex}',  $sex);
		 		 
		
		
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
		 $custom=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"ribbon\" selected=\"selected\">".$listcens."</select>";
		  
 		 $tpl->set( '{ribbon}',  $custom);
		    $tpl->set( '{subculture}',  strip_tags($row[subculture]));
		 
		  $custom=" <select  style =\"width: 200px; height:20px; padding: 2px;   background-color:#FFF; \" name=\"smilepack\" selected=\"selected\"><option value=\"".$row['smiles']."\">...</option><option value=\"\">Основной набор</option><option value=\"2\">Флуд-смайлики сверху</option></select>";
 		 $tpl->set( '{smilepack}',  $custom);
		 
$nastr=stripslashes( "Выбрано: ".$add1."<br>Выбрать другое: <select onChange=\"uncheck()\" style =\"width: 100px; height:20px;padding: 2px;   background-color:#FFF; \" name=\"dis2\" selected=\"selected\"><option value=\"".$row['design']."\">...</option><option value=\"100\">Чистый</option><option value=\"1\">Радостный</option><option value=\"2\">Печальный</option><option value=\"3\">Любовный</option><option value=\"4\">Задумчивый</option>".$addstatus."</select>" ) ;

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
			
			$tpl->set( '{news}', "<a onclick=\"DlePage('do=static&page=catalog&category=3&user=" . urlencode( $row['name'] ) . "'); return false;\"  href=\"" . $config['http_home_url'] . "user/" . urlencode( $row['name'] ) . "/news/" . "\">" . $lang['all_user_news'] . "</a>" );
			$tpl->set( '[rss]', "<a href=\"" . $config['http_home_url'] . "user/" . urlencode( $row['name'] ) . "/rss.xml" . "\" title=\"" . $lang['rss_user'] . "\">" );
			$tpl->set( '[/rss]', "</a>" );
		
		} else {
			
			$tpl->set( '{news}', "<a onclick=\"DlePage('do=static&page=catalog&category=3&user=" . urlencode( $row['name'] ) . "'); return false;\" href=\"" . $PHP_SELF . "?do=static&page=catalog&category=3&user=" . urlencode( $row['name'] ) . "\">" . $lang['all_user_news'] . "</a>" );
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
	if($row[looking]!=""&&$row[looking]!="0"){
		$lookingpub='';
			  if($row[looking]=='3')
 {
	 $lookingpub.='кого-нибудь';
	 $lookingpub2.='somebody';
 }
 else if($row[looking]=='2')
 {
	   $lookingpub.='парня';
	    $lookingpub2.='male';
 }
 else if($row[looking]=='1')
 {
	  $lookingpub.='девушку';
	   $lookingpub2.='female';
 }
  $lookingpub='<b>Ищу:</b> <a href="http://nocens.ru/index.php?subaction=userinfo&search=1&user=gender:'.$lookingpub2.'">'. $lookingpub.'</a>';
   $lookingpub.='<br>';
	}
 else
  {
	   $lookingpub='';
 }
 
 $tpl->set( '{lookingpub}', $lookingpub );
 
	
	$xfieldsaction = "list";
	$xfieldsadd = false;
	$xfieldsid = $row['xfields'];
	include (ENGINE_DIR . '/inc/userfields.php');
	$tpl->set( '{xfields}', $output );
	
	// Обработка дополнительных полей
	$xfieldsdata = xfieldsdataload( $row['xfields'] );
	
	foreach ( $xfields as $value ) {
		$preg_safe_name = preg_quote( $value[0], "'" );
		if($preg_safe_name=='twitter')
		$twitter=stripslashes( $xfieldsdata[$value[0]] );
				if($preg_safe_name=='yamoney')
		$yamoney=stripslashes( $xfieldsdata[$value[0]] );
				if($preg_safe_name=='qiwi')
		$qiwi=stripslashes( $xfieldsdata[$value[0]] );
				if($preg_safe_name=='webmoneyr')
		$webmoneyr=stripslashes( $xfieldsdata[$value[0]] );
			if($preg_safe_name=='webmoneyz')
		$webmoneyz=stripslashes( $xfieldsdata[$value[0]] );
			if($preg_safe_name=='webmoneye')
		$webmoneye=stripslashes( $xfieldsdata[$value[0]] );
				if($preg_safe_name=='youtube')
		$youtube=stripslashes( $xfieldsdata[$value[0]] );
		if($preg_safe_name=='vkontakte')
		$vkontakte=stripslashes( $xfieldsdata[$value[0]] );
		if($preg_safe_name=='facebook')
		$facebook=stripslashes( $xfieldsdata[$value[0]] );
		if($preg_safe_name=="igry"||$preg_safe_name=="kniga"||$preg_safe_name=="music"||$preg_safe_name=="kino" ||$preg_safe_name=="vdoxnovlyaet"||$preg_safe_name=="demotiviruet"){
			$subs="";
		 $subc= explode( ",",$xfieldsdata[$value[0]]);
		foreach($subc as $s){
			if($s!=""){
		$subs.='<a  onclick="DlePage(\'subaction=userinfo&search=1&user=filter:'.trim($s).'\'); return false;" href="http://nocens.ru/index.php?subaction=userinfo&search=1&user=filter:'.trim($s).'">'.trim($s).'</a>, ';
			}
			
		}
		
		if($subs){
		$subs=substr($subs,0,strlen($subs)-2);
		}
		$xfieldsdata[$value[0]]=$subs;}
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
	//Виджеты
	if($row[icq])
	{
		$widgets.='<a href="skype:'.$row[icq].'" ><img align="texttop" alt="Skype" src="http://nocens.ru/pics2/accounts/skype.png"></a> <a href="skype:'.$row[icq].'" >Skype</a><br>';
}

	if($vkontakte)
	{
		$widgets.='<a href="https://vk.com/'.$vkontakte.'" target="_blank"><img align="texttop" alt="Vkontakte" src="http://nocens.ru/pics2/accounts/vk.png"></a> <a href="https://vk.com/'.$vkontakte.'" target="_blank">Вконтакте</a><br>';
}
if($youtube)
	{
		$widgets.='<a href="http://youtube.com/user/'.$youtube.'" target="_blank"><img align="texttop" alt="Facebook" src="http://nocens.ru/pics2/accounts/youtube.png"></a> <a href="https://youtube.com/user/'.$youtube.'" target="_blank">YouTUBE</a><br>';
}

if($facebook)
	{
		$widgets.='<a href="https://facebook.com/'.$facebook.'" target="_blank"><img align="texttop" alt="Facebook" src="http://nocens.ru/pics2/accounts/facebook.png"></a> <a href="https://facebook.com/'.$facebook.'" target="_blank">Facebook</a><br>';
}

	if($twitter)
	{
			$widgets.='<a href="https://twitter.com/'.$twitter.'" target="_blank"><img align="texttop" alt="Twitter" src="http://nocens.ru/pics2/accounts/twitter.png"></a> <a href="https://twitter.com/'.$twitter.'" target="_blank">Twitter</a><br>';
		$widgets.="<a href=\"https://twitter.com/".$twitter."\" class=\"twitter-follow-button\" data-show-count=\"false\" data-lang=\"ru\" >Читать @".$row[name]."</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script><br>";
	}
	
	if($yamoney)
	{
		$money.='<span title="Яндекс.Деньги"><img align="texttop" alt="Яндекс.Деньги" src="http://nocens.ru/pics2/accounts/yamoney.png"> '.$yamoney.'</span><br>';
}

if($qiwi)
	{
		$money.='<span title="QIWI-кошелек"><img align="texttop" alt="QIWI-кошелек" src="http://nocens.ru/pics2/accounts/qiwi.png"> '.$qiwi.'</span><br>';
}

	if($webmoneyr)
	{
		$money.='<span title="Webmoney Рубли"><img align="texttop" alt="Webmoney Рубли" src="http://nocens.ru/pics2/accounts/webmoney.png"> '.$webmoneyr.'</span><br>';
}
if($webmoneyz)
	{
		$money.='<span title="Webmoney Доллары"><img align="texttop" alt="Webmoney Доллары" src="http://nocens.ru/pics2/accounts/webmoney.png"> '.$webmoneyz.'</span><br>';
}
if($webmoneye)
	{
		$money.='<span title="Webmoney Евро"><img align="texttop" alt="Webmoney Евро" src="http://nocens.ru/pics2/accounts/webmoney.png"> '.$webmoneye.'</span><br>';
}

if($widgets)
$widgets= stripslashes("<div class=\"ava2\"><div class=\"infoto\" ><h3 class=\"h3left\">Ссылки</h3>".$widgets."</div></div>");
if($money)
$money= stripslashes("<div class=\"ava2\"><div class=\"infoto\" ><h3 class=\"h3left\">Кошельки</h3>".$money."</div></div>");

	if($widgets||$money)
 {
	  $tpl->set( '{widgets}', $widgets.$money );
 }
 else
 {
	  $tpl->set( '{widgets}', ""  );
 }
 
	
 if($member_id['cash']>=0)
 {$addstatus="<option value=\"5\">Депресняк</option><option value=\"6\">Кавай</option><option value=\"7\">Фурри</option><option value=\"8\">Патриот</option><option value=\"9\">Играю</option><option value=\"10\">Деньги</option>";
 }
 else
 {$addstatus="";
 }
	if( $is_logged and ($member_id['user_id'] == $row['user_id'] or $member_id['user_group'] == 1) ) {
		$tpl->set( '{edituser}', "<a href=\"#\" onclick=\"$('#options').fadeIn(200); return false;\">".'<input type="button" value="Настройки профайла" class="bbcodes_poll"  style="margin-top: 4px; width: 170px; ">'."</a>" );
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
			$tpl->set( '{xstatus}', '<h3 class="blogsh'.$row['game2'].'" style=" float: left; padding: 4px;" > <em>'.stripslashes( $im.$row['game']."" ).'</em></h3>' );
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
}
if( $user_found == FALSE || $_GET[search] ) {
	//поиск пользователей
	$allow_active_news = false;
	$srch=$_GET[user];
	      if( mb_detect_encoding($srch, 'UTF-8',true))
           $srch= addslashes( mb_convert_encoding(stripslashes(urldecode($srch)), "CP1251","UTF8"));
            else
             $srch= addslashes(stripslashes(urldecode($srch)));
	$srchq=$srch;
	$tpl->load_template( 'foundusers.tpl' );
	if(strpos($srchq,'city:')!==false)
	{$srchq=str_replace( "г.", "", $srchq );
		$string=substr($srchq,$i=(strpos($srchq,"city:")+5),strpos($srchq,";",$i)-$i);
		if(strlen($string)<2)
		{
		$string=substr($srchq,$i=(strpos($srchq,"city:")+5),strlen($srchq)-$i);
			
		}
		
		$queue.="AND land  LIKE '%".$string."%' ";
		
	}
	
		if(strpos($srchq,'subculture:')!==false)
	{
	
$string=substr($srchq,$i=(strpos($srchq,"subculture:")+11),strpos($srchq,";",$i)-$i);
		if(strlen($string)<2)
		$string=substr($srchq,$i=(strpos($srchq,"subculture:")+11),strlen($srchq)-$i);
				$queue.="AND subculture LIKE '%".$string."%' ";
		
	}

		if(strpos($srchq,'filter:')!==false)
	{
	
$string=substr($srchq,$i=(strpos($srchq,"filter:")+11),strpos($srchq,";",$i)-$i);
		if(strlen($string)<2)
		$string=substr($srchq,$i=(strpos($srchq,"filter:")+11),strlen($srchq)-$i);
				$queue.="AND xfields LIKE '%".$string."%' ";
		
	}


	if(strpos($srchq,'gender:')!==false)
	{
	
$string=substr($srchq,$i=(strpos($srchq,"gender:")+7),strpos($srchq,";",$i)-$i);
		if(strlen($string)<2)
		$string=substr($srchq,$i=(strpos($srchq,"gender:")+7),strlen($srchq)-$i);
		
		if($string=='female')
		$looking=1;
		else if($string=='male')
		$looking=2;
		else if($string=='somebody')
		$looking=3;
	
		$queue.="AND looking ='".$looking."' ";
		
	}
	
	
	
if($queue=="")
$queue="AND name LIKE '%".$srch."%' OR fullname LIKE '%".$srch."%' OR land  LIKE '%".$srch."%' OR subculture LIKE '%".$srch."%'  ";

	$keytags =  $db->query("SELECT name,foto,fullname,land, icq, bdate_view, birthdate,lastdate,subculture from  ".PREFIX."_users WHERE name!='' ".$queue." ORDER BY lastdate DESC LIMIT 0,50 ");
		$i = 0;
	$users = array();
    $pmlist .= "<table class=\"pm\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td width=\"20\">&nbsp;</td><td width=\"80\" class=\"pm_head\"></td><td   width=\"240\" class=\"pm_head\"></td><td class=\"pm_head\" align=\"center\"></td><td width=\"50\" class=\"pm_head\" align=\"center\"></td>";


	while ( $row = $db->get_row() ) {
		
		$i ++;
		
			
			
        		if(!$row[foto])
					{
$row['foto']='que.png';
}
         $imginfo = @getimagesize("http://nocens.ru/uploads/fotos/" . $row['foto']);
					if($imginfo[0]==0){ $imginfo[1]=100; $imginfo[0]=100;}

					$img_koeff = $imginfo[1]/$imginfo[0];
					$imgal=intval(45*$img_koeff-15);
                    $imgw=$img_koeff*45;
                    $foto='<a  onclick="DlePage(\'user='.$row['name'].'\'); return false;" href="http://nocens.ru/'.$row['name'].'"><img title="'.$row['name'].'" src="http://nocens.ru/uploads/fotos/'.$row[foto].'" width="45"  height="'.$imgw.'" /></a>';
                    
		
		if(!in_array($row['name'],$users)){
        $users[]=$row['name'];
      
        	 if($row[fullname])
		 {
$xname = explode( ' ', $row[fullname] );
 $nick = $xname[0].' <b>'.$row['name'].'</b> '.$xname[1];
		 }
		 else
		 {
			 $nick='<b>'.$row['name'].'</b>';
		 }
		  $birthdate = $row['birthdate'];    
    $bdate_view = $row['bdate_view'];
    $birthdate_see = format_date_html($birthdate,$bdate_view);

	if(strpos($birthdate_see,"0000"))
	$birthdate_see="Скрыто";
	$subj="";
		if($row['lastdate']){
$subj.='<b>Последнее посещение:</b> '.langdate( "j F Y H:i", $row['lastdate'] ) .'<br>';
	}
	if($birthdate_see&&!strpos($birthdate_see,"0000")){
$subj.='<b>Дата рождения:</b> '.$birthdate_see.'<br>';
	}
	
	
	if($row[land])
	{$subc= explode( " ", str_replace(",", " ", $row[land] ));
	$subs="";
		foreach($subc as $s){
		$subs.='<a onclick="DlePage(\'subaction=userinfo&search=1&user=city:'.trim($s).'\'); return false;"  href="http://nocens.ru/index.php?subaction=userinfo&search=1&user=city:'.trim($s).'">'.trim($s).'</a> ';
		}
		//$subs=substr($subs,0,strlen($subs)-2);
		$subj.='<b>Город:</b> '.$subs.'<br>';
	}
	$subs="";
	if($row[subculture])
	{
		$subc= explode( ",", $row[subculture] );
		foreach($subc as $s){
		$subs.='<a onclick="DlePage(\'subaction=userinfo&search=1&user=subculture:'.trim($s).'\'); return false;" href="http://nocens.ru/index.php?subaction=userinfo&search=1&user=subculture:'.trim($s).'">'.trim($s).'</a>, ';
		}
		$subs=substr($subs,0,strlen($subs)-2);
	}
	
		if($subs){
$subj.='<b>Субкультуры:</b> '.$subs.'<br>';
	}
	
		$pmlist .= "<tr><td></td><td class=\"pm_list\" >{$foto}</td><td class=\"pm_list\" align=\"left\"><a onclick=\"DlePage('user=".$row[name]."'); return false;\"   href=\"http://nocens.ru/".$row[name]."\">" .$nick.'</a><br>'. $data . "</td><td class=\"pm_list\">{$subj}</td><td class=\"pm_list\" align=\"center\"></td></tr>";
        }
	
	}
		$pmlist .= "</table>";
			if( $i ) $tpl->set( '{pmlist}', $pmlist );
	else $tpl->set( '{pmlist}', "<h2>Ничего не найдено.</h2> Это крайне печально, и мы очень сожалеем об этом." );
	$tpl->set( '{searched}',$srch); 
	$tpl->compile( 'content' );
	$tpl->clear();
	//msgbox( $lang['all_err_1'], $lang['news_err_26'] );
	
}
?>