<body>
<style type="text/css">
.infernal {	color: #000;
	background-color: #FFF;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 10px;
	padding: 2px;
	border: 1px solid #CCC;
	clear:both
}
.infoinside {	font-size: 16px;
	border-bottom-width: thin;
	border-bottom-style: dashed;
	border-bottom-color: #CCC;
	font-weight: bold;
	padding-left: 10px;
	background-color: #F5F5F5;
}

		#video
		{
		
			
			background: #FFF;
			padding: 0px;
			display: none;
			border: 1px solid #CCC;
		}
		.youtube
		{
			width: 1000px;
			height: 563px;
		}
		.twitch
		{
			width: 1000px;
			height: 594px;
		}
			.twitchchat
		{
					width: 1000px;
			height: 425px;
		}
		
		
</style>
</head>


 [nobanned]

<script language="javascript">
var radiosrc='{url}';
var wave='{wave}';
var isPlaying=1;
var pagenum=1;
var currentVideo="something";
var playerver='html'+Math.random();
var audio=null;

function scrollToTheEnd(id){
	if(prevent!=true){
$('#'+id).delay(1000).scrollTop(99999999);
	}
	}
	
	var prevent=false;
function preventscroll() {
prevent=true;
 
}
function unpreventscroll() {
prevent=false;

}

   function refreshsize()
{
	if($('#video').html()!="")
 {
	 var height=$(window).height()-$('#video').height();
	 if(height<650)
	 height=650;
	

 }
 else
 {
	 
 }
}
	
	  
$(document).ready(function(){

 $("#backlayer").hover(
  function () {
	
    preventscroll();
  },
  function () {
    unpreventscroll();
	
  }
 

);
scrollToTheEnd('chat-window');
//setInterval( function() { scrollToTheEnd('chat-window'); } , 100);

audio = document.getElementById("radioblock");



 audio.addEventListener('volumechange', function() {
    console.log('changed.', arguments);

	$.cookie("radiovolume",audio.volume, { expires: 7 });
}, false);
startOrStopVideo('{currentVideo}');
	  }
	  
	 );
	 
function putin(a1)
{if(document.getElementById('indo').value.indexOf(a1.innerText)=="-1"&&document.getElementById('indo').value.length<100)
	{
	 document.getElementById('indo').value = a1;
	 document.location.replace("#answer");
return false;

	}
}
function listRadios(){

var menu=new Array();

	menu[0]='<a onclick="DlePage(\'do=chat&wave=1\'); return false;" href="//nocens.ru/index.php?do=chat&wave=1">Первый субкультурный</a>';
menu[1]='<a onclick="DlePage(\'do=chat&wave=2\'); return false;" href="//nocens.ru/index.php?do=chat&wave=2">Радиоволна Бронивиля</a>';
menu[2]='<a onclick="DlePage(\'do=chat&wave=3\'); return false;" href="//nocens.ru/index.php?do=chat&wave=3">Субкультурное ТВ</a>';
menu[3]='<a onclick="DlePage(\'do=chat&wave=4\'); return false;" href="//nocens.ru/index.php?do=chat&wave=4">Music-Non-Ever-Stop</a>';
menu[4]='<a onclick="DlePage(\'do=chat&wave=5\'); return false;" href="//nocens.ru/index.php?do=chat&wave=5">LFRM Pro Club Radio</a>';

return menu;
};



function startOrStopVideo(a1)
{
	if(currentVideo!=a1){
		currentVideo=a1;
	if(currentVideo!="")
	{
		 startVideo(a1,isPlaying) 
		
 
     $('audio').each(function(){
    this.pause(); // Stop playing
    this.currentTime = 0; // Reset time
}); 

document.getElementById('radioblock').pause()
	 $('#radioblock').css('display','none');
	}
	else
	{
		
		closeVideo();
		  if($.cookie("radiovolume")!=null&&$.cookie("radiovolume")!='undefined'&&$.cookie("radiovolume")!="")
		  {
			  audio.volume=$.cookie("radiovolume");
		  }
    audio.load(); //call this to just preload the audio without playing
        audio.play(); //call this to play the song right away
			 $('#radioblock').css('display','block');
	}
	
	}
}



function startVideo(src,autoplay) 
{ 
   var pattern1 = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/?(.+)/g;
        var pattern2 = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g;
		
        var pattern3 = /([-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?(?:jpg|jpeg|gif|png))/gi;
		      var pattern4 = /(?:http?s?:\/\/)?(?:www\.)?(?:twitch\.tv)\/?(.+)/g;
			  if(src.indexOf('&')!=-1);
			  src=src.replace('&', '?');
			 
	if(autoplay!="false"&&autoplay!="0")
	autoplay='autoplay=1';
	else
	autoplay='';
        if(pattern1.test(src)){
           var replacement = '<div class="youtube"><iframe width="100%" height="100%" src="//player.vimeo.com/video/$1" frameborder="0" autoplay="'+autoplay+'"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

           var html = src.replace(pattern1, replacement);
        }


        if(pattern2.test(src)){
			if(autoplay!=""){
			if(src.indexOf('?')=='-1')
			autoplay='?'+autoplay;
			else
			autoplay='&'+autoplay;
			}
			var replacement = '<div class="youtube"><iframe width="100%" height="100%" src="http://www.youtube.com/embed/$1?'+autoplay+'"  frameborder="0"  allowfullscreen></iframe></div>';
              var html = src.replace(pattern2, replacement);
		html=html.replace('&amp;','&');
		
			html=html.replace('&list=','?list=');
			
        } 


        if(pattern3.test(src)){
            var replacement = '<a href="$1" target="_blank"><img class="sml" src="$1" /></a><br />';
            var html = src.replace(pattern3, replacement);
        }          
       
	      if(pattern4.test(src)){	
		  
		
			   if(src.indexOf("chat=1")!=-1){
				   
				     src=src.replace('chat=1','');
					src=src.replace('&amp;','');
					
         var replacement = '<div class="twitchchat"><iframe src="http://www.twitch.tv/$1/embed" frameborder="0" scrolling="no" width="70%" height="100%"></iframe><iframe src="http://www.twitch.tv/$1/chat?popout=" frameborder="0" scrolling="no" height="100%" width="30%"></iframe></div>';
			  }
			  else
			  {
				    var replacement = '<div class="twitch"><iframe src="http://www.twitch.tv/$1/embed" frameborder="0" scrolling="no" width="100%" height="100%"></iframe></div>';
			  }
     
            var html = src.replace(pattern4, replacement);
				
        }    
	


	//	html='<div style="display:block; position: absolute; z-index: 10; " class="delel"><a onClick="closeVideo(); return false;" href="#"><span>Скрыть</span></a></div>'+html;

	
	 $('#video').html(html);
	 $('#video').css('display','block');
	   refreshsize();

}
function closeVideo() 
{ 
$('#video').html("");
   $('#video').css('display','none');
     refreshsize()
      //  getSWF("radiov3ribbon").compactView(false); 
	
   
} 

</script>
<style>

.infernal {color: #000;
	background-color: #FFF;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 160px;
	padding: 2px;
	border: 1px solid #CCC;
}
.infoinside {font-size: 16px;
	border-bottom-width: thin;
	border-bottom-style: dashed;
	border-bottom-color: #CCC;
	font-weight: bold;
	padding-left: 10px;
	background-color: #F5F5F5;
}
.infernal1 {
	color: #000;

	text-align: left;
}
</style>
</head>
<script>
  
$(document).ready(function() {

});
</script>
<div class="headers"><span class="withugol"><img width="35" height"35" style="vertical-align:text-bottom; width: 35px; height: 35px;" src="//nocens.ru/pics3/radio/wave{wave}{dark}.png"/> <a style="font-size: 30px;" onClick="return dropdownmenu(this, event, listRadios(), ($(this).width()+20)+'px')" href="#">{nam}</a></span>
          <div style="float: right; width: 300px; " class="whiter"> <audio id="radioblock" controls >
    <source id="radiosource" src="{url}" type='audio/mpeg'>
   Потоковое mp3-аудио не поддерживается браузером. Попробуйте <a href="//nocens.ru/radio">flash-плеер.</a>
  </audio>
 
        
 
          </div><div style="clear: both;"></div></div><div id="show4">
            
<div align="center">
<div id="video"></div>
      <table width="100%" border="0">
        <tr>
         
          <td valign="top" style="background-color: #FFF;"><div class="infernal1">
       <div id="backlayer"><div id="userlist" style="width: 150px; margin:0px;padding:0px;height: 300px;  color:{text-color}; background-color: {background}; padding: 5px; overflow:auto; display:inline-block; border-right: 1px solid #CCC;">{online}</div>   <div id="chat-window" style="margin:0px;padding:0px;height: 300px; width: 810px; display:inline-block; color:{text-color}; background-color: {background}; padding: 5px; overflow:auto;" onchange="scrollToTheEnd('chat-window');" > {chat}</div>
           </div>
            <div class="whiter" >
             <div style="display:none;">
                {bbcodes}  </div><p class="stext" style="padding-left: 2px;background-color: #E7E7E7;border: 1px solid #CCC;">
					  <input type="text" name="message" style="width: 853px" class="f_input" id="message" />
                    
    <input type="button" onClick="DoAddMessage(); return false;" class="bbcodes" style="background-color: #616161;" value="Отправить" />
              </p> 
              <p class="stext"></p>
            </div>
            <div id="capture" style="text-align: left; color: #ccc !important; width:200px;"> {captcha}</div>
</p>
<p></p>
          </div></td>
        </tr>
      </table>
  <div style="clear: both;"></div>      

  </div>
  
  <style>

.infernal {
	color: #000;
	background-color: #FFF;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 5px;
	padding: 0px;
}
.infoinside {
	font-size: 16px;
	border-bottom-width: 0px;
	border-bottom-style: solid;
	border-bottom-color: #00F;
	font-weight: bold;
	padding-left: 10px;
	background-color: #DFC1BD;
	color: #FFF;
	border-radius: 8px;
}
.c1
{
	background-color: #FFEAEA;
	border-radius: 8px;
	padding: 4px;
}
	.c2
{
	background-color: #FFFFFF;
	border-radius: 8px;
		padding: 4px;
		color: #C00;   
		
}
	
.leftbackf .mainleftf table tr td p {
	font-size: 24px;
	color: #900;
	font-weight: bold;
}
.a1 {
	color: #F00;
}
.leftbackf .mainleftf table tr td p .a1 {
	font-size: 24px;
}
</style>
  



<div  class="headers" style="padding-right:0px;">  
  <div style="border-color:#FFF; border-width: 0px;   "><div style="float: right; width: 450px; text-align: right;   margin-top: 0px;"><span class="sublink"><a target="_blank" href="//nocens.ru/index.php?do=radio2&schedule=1&prid={prid}">Страница передачи &rarr;</a></span></div>{potok2}<a onClick="makevote(1); return false;" href="#"><img width="20" height="20" src="//nocens.ru/pics3/interface/thumbup{dark}.png"></a><a onClick="makevote(-1); return false;" href="#"><img width="20" height="20" src="//nocens.ru/pics3/interface/thumbdown{dark}.png"></a>
           
            </div>
        </div><div id="show4">
           
<div align="center"></div></div>
      
      
      <div class="{text2}">
<div  style="padding-top: 4px;" ><div style="background-color: #FFF;  margin-right: 4px; padding: 4px;    box-shadow: 1px 1px 2px  #666 ;"> <div class="newsdivin1c" style=" padding: 4px;"><div style="margin-left: 4px; margin-right: 2px;"><div  style="float:right; position: relative; z-index: 1; width: 205px; text-align: right; height: 20px; ">{linkbar}</div><div style="position:relative; margin-bottom: 3px;  bottom: 0px;"> 
</div>
</div>
    <div class="news" > 
{potok10}{potok6}
      </div></div>
    
</div><div style="margin-left: 200px; margin-top: 4px;">  <p class="whiter" style="font-size: 16px;">{potok7}<span class="whiter" style="font-size: 16px;">{potok8}</span> </p></div>
<div style="clear: both; "></div>
</div></div>
    <div style="clear: both; "></div>
    
      

</div>

</div>

</div><div class="headers">Программа на сегодня</div>
          <div style="clear: both;"></div> <div id="show4"> {schedule}   </div>
[/nobanned] 