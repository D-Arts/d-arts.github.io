<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />

{headers}<script type="text/javascript" language="javascript"> 
function ser(obj){
obj.className="res2"; 
}
</script>
<script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>
<script src='/engine/djs.js?3' type='text/javascript'></script>
 <script type="text/javascript" src="/engine/history.min.js"></script>
<script src='/engine/jquery.js' type='text/javascript'></script>
<script type="text/javascript" src="/engine/jquery-ui.min.js"></script>
<script type="text/javascript" src="/engine/jquery.cookie.js"></script>
<script language="javascript" type="text/javascript" src="/engine/ajax/payments/payments.js"></script>
<script type="text/javascript" src="/engine/jquery.carouFredSel-5.2.2-packed.js"></script>
<script src='/engine/slidemenu.js?1' type='text/javascript'></script>
<script>jqueryslidemenu.buildmenu("myslidemenu", arrowimages, 1)</script>
<script src="/engine/jquery.textchange.min.js"></script>

<style type="text/css" media="all">
@import url(/templates/Darts/css/style.css?7);
 

	
</style>
<style type="text/css" media="all">
@import url(/templates/Darts/css/engine.css?7);
@import "/mainf.css?24"; 
@import "/main_{skin}.css?17"; 
</style>


<script language="javascript" type="text/javascript">
 window.onpopstate = function( e ) {

              
                     DlePage( window.location.search.substr(1)+'&prevblock=1');

                    // тут можете вызвать подгруздку данных и т.п.
                    // ...
                }
				
function vkbut(a1)
{
	document.write(VK.Share.button({ image:a1},{type: "custom",text: "<img title=\"Отправить на стену Вконтакте\" src=\"pics3/interface/sendvk.png\" />"}));
}
var intads;
$('#addpict').bind('textchange', function (event, previousText) {
	alert("changed");
});


function startMenu () {
var a = $("#startMenu");
a[ a.is(':hidden') ? 'fadeIn' : 'fadeOut' ](300);
}
var scrH1 = 300;
$(window).scroll(function(){
	   checkscroll();
	   })

function checkscroll()
{
	var scro = $(this).scrollTop();
		if(scro<scrH1)
	{
	
		document.getElementById("gotop").style.display="none";
	}
	else
	{
		
			if(document.getElementById("gotop").style.display=="none")
			{
		document.getElementById("gotop").style.display="block";
			}
	}

}

<!--
function bookmarkthis(title,url) {
  if (window.sidebar) { // Firefox
     window.sidebar.addPanel(title, url, "");
  } else if (document.all) { // IE
     window.external.AddFavorite(url, title);
  } else if (window.opera && window.print) { // Opera
     var elem = document.createElement('a');
     elem.setAttribute('href',url);
     elem.setAttribute('title',title);
     elem.setAttribute('rel','sidebar');
     elem.click();
  }
}
//-->
	var mode = (window.opera) ? ((document.compatMode == "CSS1Compat") ? $('html') : $('body')) : $('html,body');
	
function gototop() {
	$('body,html').animate({scrollTop:0},100);
    return false;
	};
</script>
<style type="text/css">

body
{

	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	margin: 0px;
	padding: 0px;

	min-height: 700px;
}
IMG {
 border: 
  0px;
}
#gotop
{
 display: none;	position: fixed; top: 0px; z-index: 2; width: 100%; height: 40px; opacity: 0; background-color: #000; text-align: center; padding-top: 15px; font-size: 24px; color: #000; cursor: pointer;
}
.bumper
{cursor: pointer;
background-color: rgba(255, 255, 255, 0.1);
padding: 4px;
padding-bottom: 2px;
margin: 4px;
border: 1px solid rgba(255, 255, 255, 0.13);
box-shadow: 0px 1px 1px #052208;
margin-left: 5px;
margin-top: 0px;
-webkit-transition: background-color 200ms linear, color 200ms linear;
-moz-transition: background-color 200ms linear, color 200ms linear;
-o-transition: background-color 200ms linear, color 200ms linear;
transition: background-color 200ms linear, color 200ms linear;
padding-left: 0px;
max-height: 20px; 
overflow: hidden;
}
.bumper span
{
color: #FFF;
	padding: 5px;
padding-bottom: 6px;
margin-right: 2px;
}
.bumper:hover
{background-color: rgba(255, 255, 255, 0.15);

}
</style>
	[aviable=main]
<script type="text/javascript" language="JavaScript">
var curform;
function doInsertImg()
{
}
  
			$(function() {

				//	Basic carousel, no options
				$('#foo0').carouFredSel();

				//	Basic carousel + timer
				$('#foo1').carouFredSel({
					width: 480,
					items: {
						visible: 1,
						start: Math.floor(Math.random() * (5)),

						width: 'variable'
					},
					scroll: 1,
					
			
					pagination: "#pager2",
					auto: {
						pauseOnHover: "resume",
						pauseDuration: 5000,
						onPauseStart: function( percentage, duration ) {
							$(this).trigger( 'configuration', ['width', function( value ) { 
								$('#timer1').stop().animate({
									width: value
								}, {
									duration: duration,
									easing: 'linear'
								});
							}]);
						},
						onPauseEnd: function( percentage, duration ) {
							$('#timer1').stop().width( 0 );
						
													},
						onPausePause: function( percentage, duration ) {
							$('#timer1').stop();
							
						}
					}
				});

				//	Scrolled by user interaction
			

				//	Variable number of visible items with variable sizes
			

				//	Fluid layout example 1
			

				//	Fuild layout example 2
			
				
			
			});
		</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32645997-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
[/aviable]
</head>

<body>

{AJAX}
<div id="gotop" onmouseover="this.style.opacity=0.5" onmouseout="this.style.opacity=0" onClick="gototop();"  style="">Наверх</div>
 <div align="center" class="shapka"> 
<div align="center" style="max-width: 1000px;  ">
<script type="text/javascript">
var selField; 
var fombj;
</script>

<script type="text/javascript">
function cb(e) {
  if (e){
     e.stopPropagation();
   }
    else{

     window.event.cancelBubble = true;
  }
     
  
  
}
  $(document).ready(function(){
	  var first=0;
checkscroll();
	  setInterval( function() { newMail(); } , 20000);

	 $('.mainblock5w').hover(
         function () {// функция, исполняемая в момент когда курсор наведён на элемент
           		$('#fadelayer').fadeIn();
         },
         function () {// исполняемая функция, в момент когда курсор отведён от элемента
          		$('#fadelayer').fadeOut();
         }
     );


	function clearintervals(a1)
{
if(a1=="1")
	clearInterval(inteval1);
	if(a1=="2")
	clearInterval(inteval2);
	if(a1=="3")
	clearInterval(inteval3);
if(a1=="4")
	clearInterval(inteval4);

}

function makeintervals(a1)
{

if(a1.indexOf("1")!=-1)
inteval1=setInterval(function(){ $(".mainblock:lt({block1})").animate({backgroundColor: "#58B548" }, 400);  $(".mainblock:lt({block1})").animate({backgroundColor: "#58843C"}, 400);},800);	
if(a1.indexOf("2")!=-1)  			
inteval2=setInterval(function(){ $(".mainblock2:lt({block2})").animate({backgroundColor: "#8393EB" }, 400);  $(".mainblock2:lt({block2})").animate({backgroundColor: "#545F98"}, 400);},800);
if(a1.indexOf("3")!=-1)
inteval3=setInterval(function(){ $(".mainblock3:lt({block3})").animate({backgroundColor: "#BB82EA" }, 400);  $(".mainblock3:lt({block3})").animate({backgroundColor: "#785393"}, 400);},800);
if(a1.indexOf("4")!=-1)
inteval4=setInterval(function(){ $(".mainblock4:lt({block4})").animate({backgroundColor: "#666" }, 400);  $(".mainblock4:lt({block4})").animate({backgroundColor: "#363636"}, 400);},800);
if(a1.indexOf("newpic")!=-1) 
inteval1=setInterval(function(){ $("div[id*=newpic]").animate({backgroundColor: "#58B548" }, 400);  $("div[id*=newpic]").animate({backgroundColor: "#58843C"}, 400);},800);	
}
function makecolor()
{

 $("[id*=newpic]").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");
		
 $("[id*=newblog]").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");
	
 $("[id*=newvideo]").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");
	
 $("[id*=newaction]").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");

 
}
function colornew()
{
	$(".mainblock:lt({block1})").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");
  			
 $(".mainblock2:lt({block2})").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");

 $(".mainblock3:lt({block3})").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");

 $(".mainblock4:lt({block4})").css('backgroundImage',"url(http://nocens.ru/pics3/interface/whiter.png)");
}
[aviable=main]
	  		
		colornew(); 
[/aviable]
makecolor();

 $(".topmenu").mousedown(function() {
		
                $(this).css('opacity',"0.8");
                });
				 $(".topmenu").click(function() {
		
                $(this).css('opacity',"1");
                });

		
             //  hoverers();
				
				
			
         });
	
	
	function animator(block,bg1,bg2,timer)
	{
		 $(block).hover(function() {
		
                $(this).stop().animate({ backgroundColor: bg1}, timer);
                },function() {
                $(this).stop().animate({ backgroundColor: bg2 }, timer);
					
                });  
	}
	function animator2(block,bg1,bg2,timer)
	{
		 $(block).hover(function() {
		
                $(this).animate({ backgroundColor: bg1}, timer);
				$(this).animate({ backgroundColor: bg2 }, timer);
				 $(this).animate({ backgroundColor: bg1}, timer);
                },function() {
                $(this).stop().animate({ backgroundColor: bg2 }, timer);
				
					
                });  
	}
	
	function dropdown()
	{	

		$('.mainblock').stop().animate({opacity: '0'},700,function(){
			$('.mainblock2').stop().animate({opacity: '0'},500);
				$('.mainblock5').stop().animate({opacity: '0'},500,function() {
					$('.mainblock2w').stop().animate({opacity: '0'},500);
					
				$('.mainblock3').stop().animate({opacity: '0'},500);
						$('.mainblock4').stop().animate({opacity: '0'},500,function() {$('.mainblock5w').stop().animate({opacity: '0'},500);
								});});});
		setTimeout(function(){$('body').stop().animate({opacity: '0'},500, function(){$('body').css('display','none'); document.title = 'Пустая страница';
});
},3000);					
	}
function hoverers()
{
	animator(".mainblock3","{colormax}"," {colormin}",200);
	animator(".mainblock2","{colormax}"," {colormin}",200);
		animator(".mainblock2w","{colormax}"," {colormin}",200);	
			animator(".mainblock","{colormax}"," {colormin}",200);		    
	animator(".mainblockbig","{colormax}"," {colormin}",200);	
	animator(".mainblock4","{colormax}"," {colormin}",200);					
		animator(".mainblock5","{colormax}"," {colormin}",200);			
			animator("#votation","{colormax}"," {colormin}",200);		
		animator("#votation2","{colormax}"," {colormin}",200);	
			animator(".mainblock5w","{colormax}"," {colormin}",200);				
		
}


function newscroll(newclass)
{
	$("body").css('overflow','hidden');
	$(newclass).css('overflow','auto');
	$(newclass).fadeIn(100);
}
function oldscroll(newclass)
{$(newclass).fadeOut(100);
	$("body").css('overflow','auto');
	$(newclass).css('overflow','hidden');
}
</script>
[aviable=main]
<script type="text/javascript">
var tml;
function overflower(a1)
{
	conter=2;
if(tml)
{
	clearTimeout(tml);
}

	tml=setTimeout(function(){ovmain(a1)}, 300);
	
}
function clearflower(a1)
{
clearTimeout(tml);
conter=1; 
a1.style.overflow='visible';


}

function ovmain(a1){

	if(conter==2)
	{
		
	$("#hidelayer").css('overflow','hidden');
	$("#hidelayer2").css('overflow','hidden');

	}
	clearTimeout(tml);
	}
$(document).ready(function(){
	
});
function open1(a1)
{
var visible=$.cookie("show"+a1);

if(visible=="unvisible")
{
ShowOrHide("show"+a1);
document.getElementById("plus"+a1).src="http://nocens.ru/pics2/plus.png";
}
}
function showblock (a1)
{
	if(document.getElementById("show"+a1).style.display!='none')
{
	document.getElementById("show"+a1).style.display="none";
	$.cookie("show"+a1, "unvisible", { expires: 7 });

document.getElementById("plus"+a1).src="http://nocens.ru/pics2/plus.png";

}
else
{
	document.getElementById("plus"+a1).src="http://nocens.ru/pics2/minus.png";
	document.getElementById("show"+a1).style.display="block";
		
			$.cookie("show"+a1, "true", { expires: 7 });
}
}


</script>
 [/aviable]
<a name="top"></a>
<table id="topper" width="1000" border="0" cellspacing="0" cellpadding="0">
    <tr style="">
     
      <td  width="300" align="left" valign="bottom" style=" no-repeat left;"><div style="float:left; width: 10px; padding-top: 10px; "><a href="http://nocens.ru/index.php?do=change&changeskin=1"><div title="Скин морской волны" style="height: 10px; width: 10px; background-color:#6BE4C0; margin-bottom: 2px;"></div></a><a  href="http://nocens.ru/index.php?do=change&changeskin=2"><div  title="Скин мечты Томки" style="height: 10px; width: 10px; background-color: #F9F; margin-bottom: 2px;"></div></a><a   href="http://nocens.ru/index.php?do=change&changeskin=3"><div  title="Скин детектива Нуара" style="height: 10px; width: 10px; background-color: #FFF; margin-bottom: 2px;"></div></a></div><div class="logotype"><a href="http://nocens.ru"></a></div>
      </td>
      <td align="center" valign="middle" ><div style="position: relative; "><div id="log1" name="log1" style="position: absolute; left: 100px; width: 300px; height: 150px; top: 42px; background: {colormin} ; border: #000 2px solid; border-top-width: 2px; border-bottom-width: 4px; display: none;  z-index: 100; box-shadow: rgba(0, 0, 0, 0.34) 0px 5px 5px;   ">[group=5]{login}[/group]</div></div>
      [group=1,2]
  <div style=" right: 0px; position: absolute; padding: 4px; background-color: #FFF; border-radius: 4px;">
  <p class="copy"> <a href="http://nocens.ru/admin.php"><strong>Админ-панелька&raquo; </strong></a> {changeskin}</p></div>[/group] [not-group=5]  {login}    
        [/not-group][group=5]
        <div id="myslidemenu" class="jqueryslidemenu">
  <ul>
  <li class="mainli"><a href="#"><strong>Гость </strong></a>
    <ul>
  <li><a href="#" onClick="javascript:ShowOrHide('log1');" >Вход</a></li>
  <li><a href="http://nocens.ru/index.php?do=register">Регистрация</a></li>
  <li><a href="http://nocens.ru/index.php?do=lostpassword">Забыл пароль</a></li>
      </ul>
  </li>
    
  <li class="mainli"><a href="#"><b>Меню</b></a>
    <ul>
      <li><a href="http://nocens.ru/index.php?do=cat&category=blogs"> Блоги</a></li>
  <li><a href="http://nocens.ru/index.php?do=gallery"> Галерея</a></li>
  <li><a href="http://nocens.ru/index.php?do=cat&category=public"> Публикации</a></li>
  <li><a href="http://nocens.ru/index.php?do=cat&amp;category=videos"> Видео</a></li>
  <li><a href="http://nocens.ru/index.php?do=forum"> Форум</a></li>
  <li><a href="http://nocens.ru/index.php?do=stats"> Рейтинг</a></li>
      </ul>
  </li>
    
    
  </ul>
          
  </div>
        [/group] </td> 
    </tr>
  </table>
  </div></div>
  [aviable=main]

  [/aviable]
  <form onsubmit="javascript: showBusyLayer()" method="post" name="add" id="add" enctype="multipart/form-data" action="index.php?do=change"> 
 <div class="fullfon" onClick="oldscroll('#adder');  
" id="adder" style="display:none; position: fixed;">
 <div  onClick="cb(event);"  class="fullfonin" style="padding: 4px;" ><div class="infoinside2"><span>Быстрое сообщение</span></div> <input type="hidden" name="action" value="upload"> <div style="position: relative; float:right"><div style="position: absolute; right: 185px;">{stat}</div></div>{nastr}</div></div><