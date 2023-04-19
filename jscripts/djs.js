// JavaScript Document

/*
$(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    // Do something
	if(scroll>100)
	{
			$('.bumper').css("position","fixed");
				$('.bumper').css("width","100px");
						$('.bumper').css("height","1000px");
							$('.bumper').css("overflow","hidden");
		$('.bumper').css("margin-left","-120px");
$('.bumper span').css("display","block");
$('.bumper span').css("top","0px");
	}
});
*/
	function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function fadeafterload(a1)
{
$(a1).hide();    
var imgCount=$(a1).length;
$(a1).load(function(){
    if(!--imgCount){
        $(a1).fadeIn();
            // your code after load
    } else {
        // your code onloading time
    }
});
}


function media_upload ( area, author, news_id, wysiwyg){

		var rndval = new Date().getTime();
		var shadow = 'none';

		$('#mediaupload').remove();
		$('body').append("<div id='mediaupload' title='Загрузка' style='display:none'></div>");
	
		$('#mediaupload').dialog({
			autoOpen: true,
			width: 680,
			height: 600,
			dialogClass: "modalfixed",
			open: function(event, ui) { 
				$("#mediaupload").html("<iframe name='mediauploadframe' id='mediauploadframe' width='100%' height='550' src='"+dle_root+"engine/ajax/upload.php?area=" + area + "&author=" + author + "&news_id=" + news_id + "&wysiwyg=" + wysiwyg + "&skin=" + dle_skin + "&rndval=" + rndval + "' frameborder='0' marginwidth='0' marginheight='0' allowtransparency='true'></iframe>");
				$( ".ui-dialog" ).draggable( "option", "containment", "" );
			},
			dragStart: function(event, ui) {
				shadow = $(".modalfixed").css('box-shadow');
				$(".modalfixed").fadeTo(0, 0.6).css('box-shadow', 'none');
				$("#mediaupload").hide();
			},
			dragStop: function(event, ui) {
				$(".modalfixed").fadeTo(0, 1).css('box-shadow', shadow);
				$("#mediaupload").show();
			},
			beforeClose: function(event, ui) { 
				$("#mediaupload").html("");
			}
		});

		if ($(window).width() > 830 && $(window).height() > 530 ) {
			$('.modalfixed.ui-dialog').css({position:"fixed"});
			$('#mediaupload').dialog( "option", "position", ['0','0'] );
		}
		return false;

};



//Auto adress ajax changer

var prewid='';
var nextid='';
$(document).keyup(function(e) {
if ( $('input:focus').length ==0 && $('textarea:focus').length ==0 ){ 
  if(e.keyCode == 37&&prewid!="") { // left
  if(window.location.pathname.indexOf('/photo/')!='-1'){
DlePage('do=gallery&bigphoto='+prewid+'&goleft=1');
  }
  else if(window.location.pathname.indexOf('/post/')!='-1')
  {
	  DlePage('newsid='+prewid+'');
  }
  }
  else if(e.keyCode == 39&&nextid!="") { // right
    if(window.location.pathname.indexOf('/photo/')!='-1'){
  DlePage('do=gallery&bigphoto='+nextid+'&goright=1');
	}
	else  if(window.location.pathname.indexOf('/post/')!='-1')
	{
			  DlePage('newsid='+nextid+'');

	}
  }
}
});

var curloc=window.location.search.substr(1);
if(curloc.indexOf('#')!='-1')
{
	curloc=curloc.substring(0,curloc.indexOf("#"))
}
	var newlocation="";
 window.onpopstate = function( e ) {


				  
              if(window.location.pathname.substr(1).indexOf('#')!='-1'&&window.location.pathname.substr(1).substring(0,curloc.indexOf("#"))==curloc){
				  return false;
			  }
			  else if(window.location.pathname.substr(1)==curloc)
			  {
				  return false;
			  }
			  else{
				  /*
				  if(window.location.search.substr(1)!='undefined'&&window.location.search.substr(1)!=''){
					  			
                     DlePage( window.location.search.substr(1)+'&prevblock=1');
					 curloc=window.location.search.substr(1);
				  }
				  else
*/
				  if(window.location.pathname!='undefined'&&window.location.pathname!=""&&window.location.pathname!="/")
				  {
					 
if(window.location.pathname.indexOf('/photo/')!='-1'){
DlePage(window.location.pathname.replace('/photo/','do=gallery&bigphoto=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/gallery/')!='-1'){

	newlocation=(window.location.pathname.replace("/gallery\/real/", "do=gallery&view=26"));
					newlocation=(newlocation.replace("/gallery\/world/", "do=gallery&view=27"));
					newlocation=(newlocation.replace( '/gallery\/hitech/', "do=gallery&view=40"));
						newlocation=(newlocation.replace('/gallery\/portfolio/',  "do=gallery&view=30"));
						newlocation=(newlocation.replace('/gallery\/stickers/', "do=gallery&view=60"))
						newlocation=(newlocation.replace('/gallery\/gifts/', "do=gallery&view=61"));
						newlocation=(newlocation.replace('/gallery\/scraps/', "do=gallery&view=62"))
						newlocation=(newlocation.replace('/gallery\/handmade/', "do=gallery&view=33"));
						newlocation=(newlocation.replace('/gallery\/anthro/', "do=gallery&view=36"));
										newlocation=(newlocation.replace('/gallery\/pokemon/', "do=gallery&view=49"));
							newlocation=(newlocation.replace('/gallery/brony/', "do=gallery&view=42"));
							newlocation=(newlocation.replace('/gallery\/fanart/', "do=gallery&view=37"));
							newlocation=(newlocation.replace('/gallery\/trash/', "do=gallery&view=38"));
							newlocation=(newlocation.replace('/gallery\/landscape/', "do=gallery&view=34"));
							newlocation=(newlocation.replace( '/gallery\/anime/', "do=gallery&view=39"));
								newlocation=(newlocation.replace('/gallery\/sport/', "do=gallery&view=44"));
								newlocation=(newlocation.replace('/gallery\/comics/', "do=gallery&view=41"));
								newlocation=(newlocation.replace( '/gallery\/tasty/',  "do=gallery&view=46"));
								newlocation=(newlocation.replace('/gallery\/music/',  "do=gallery&view=47"));
								newlocation=(newlocation.replace('/gallery\/logs/',  "do=gallery&view=48"));
									newlocation=(newlocation.replace('/gallery\/human/',  "do=gallery&view=35"));
									 	
											newlocation=(newlocation.replace('/gallery\/trash/', "do=gallery&view=28"));
	
											 			 		newlocation=(newlocation.replace("/gallery\/all/",  "do=gallery&view=1"));
			 	newlocation=(newlocation.replace("/gallery/",  "do=gallery"));
newlocation=(newlocation.replace('/gallery/','do=gallery')+'&prevblock=1');
  //window.location.pathname=newlocation;

 DlePage(newlocation);
}
else if(window.location.pathname.indexOf('/album/')!='-1'){
	newlocation=(window.location.pathname.replace('/album/',  "do=album&user="));
	newlocation=(newlocation.replace('/real/', "&view=26"));
					newlocation=(newlocation.replace('/world/', "&view=27"));
					newlocation=(newlocation.replace( '/hitech/', "&view=40"));
						newlocation=(newlocation.replace('/portfolio/',  "&view=30"));
						newlocation=(newlocation.replace('/stickers/', "&view=60"));
						newlocation=(newlocation.replace('/gifts/', "&view=61"));
						newlocation=(newlocation.replace('/scraps/', "&view=62"));
						newlocation=(newlocation.replace('/handmade/', "&view=33"));
						newlocation=(newlocation.replace('/landscape/', "&view=34"));
						newlocation=(newlocation.replace('/anthro/', "&view=36"));
							newlocation=(newlocation.replace('/brony/', "&view=42"));
							newlocation=(newlocation.replace('/fanart/', "&view=37"));
							newlocation=(newlocation.replace('/trash/', "&view=38"));
							newlocation=(newlocation.replace( '/anime/', "&view=39"));
								newlocation=(newlocation.replace('/sport/', "&view=44"));
								newlocation=(newlocation.replace('/comics/', "&view=41"));
								newlocation=(newlocation.replace( '/tasty/',  "&view=46"));
								newlocation=(newlocation.replace('/music/',  "&view=47"));
								newlocation=(newlocation.replace('/logs/',  "&view=48"));
									newlocation=(newlocation.replace('/human/',  "&view=35"));
												newlocation=(newlocation.replace('/pokemon/',  "&view=49"));
								newlocation=(newlocation.replace('/all/',  "&view=1"));
											newlocation=(newlocation.replace('/trash/', "&view=28"));
			 		newlocation=(newlocation.replace('/', "&view=1"));
  //window.location.pathname=newlocation;

 DlePage(newlocation);
}

else if(window.location.pathname.indexOf('/post/')!='-1'){
DlePage(window.location.pathname.replace('/post/','newsid=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/pm/')!='-1'){
DlePage(window.location.pathname.replace('/pm/','do=pm')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stats/')!='-1'){
DlePage(window.location.pathname.replace('/stats/','do=stats')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stats2/')!='-1'){
DlePage(window.location.pathname.replace('/stats2/','do=stats2')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stats3/')!='-1'){
DlePage(window.location.pathname.replace('/stats3/','do=stats3')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stats4/')!='-1'){
DlePage(window.location.pathname.replace('/stats4/','do=stats4')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stats5/')!='-1'){
DlePage(window.location.pathname.replace('/stats5/','do=stats5')+'&prevblock=1');
}

else if(window.location.pathname.indexOf('/blog/')!='-1'){
DlePage(window.location.pathname.replace('/blog/','do=blogs&user=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/tags/')!='-1'){
DlePage(window.location.pathname.replace('/tags/','do=tags&tag=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/video/')!='-1'){
DlePage(window.location.pathname.replace('/video/','do=video&user=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/creo/')!='-1'){
DlePage(window.location.pathname.replace('/creo/','do=creo&user=')+'&prevblock=1');
}

else if(window.location.pathname.indexOf('/review/')!='-1'){
DlePage(window.location.pathname.replace('/review/','do=review&user=')+'&prevblock=1');
}

else if(window.location.pathname.indexOf('/album/')!='-1'){
DlePage(window.location.pathname.replace('/album/','do=album&user=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/clanblog/')!='-1'){
DlePage(window.location.pathname.replace('/clanblog/','do=blogs&clan=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/clancreo/')!='-1'){
DlePage(window.location.pathname.replace('/clancreo/','do=creo&clan=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/clanreview/')!='-1'){
DlePage(window.location.pathname.replace('/clanreview/','do=review&clan=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/clanvideo/')!='-1'){
DlePage(window.location.pathname.replace('/clanvideo/','do=video&clan=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/clanalbum/')!='-1'){
DlePage(window.location.pathname.replace('/clanalbum/','do=album&clan=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/actions/')!='-1'){
DlePage(window.location.pathname.replace('/actions/','do=actions&user=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/chat/')!='-1'){
DlePage(window.location.pathname.replace('/chat/','do=pm2&user=')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/radio/')!='-1'){
DlePage(window.location.pathname.replace('/radio/','do=chat&wave=1')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/brony/')!='-1'){
DlePage(window.location.pathname.replace('/brony/','do=chat&wave=10')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/gamingradio/')!='-1'){
DlePage(window.location.pathname.replace('/gamingradio/','do=chat&wave=5946')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/bronytv/')!='-1'){
DlePage(window.location.pathname.replace('/bronytv/','do=chat&wave=11')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/flood/')!='-1'){
DlePage(window.location.pathname.replace('/flood/','do=chat&wave=2')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/tv/')!='-1'){
DlePage(window.location.pathname.replace('/tv/','do=chat&wave=3')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/music/')!='-1'){
DlePage(window.location.pathname.replace('/music/','do=chat&wave=4')+'&prevblock=1');


}else if(window.location.pathname.indexOf('/lfrm/')!='-1'){
DlePage(window.location.pathname.replace('/lfrm/','do=chat&wave=5')+'&prevblock=1');
}

else if(window.location.pathname.indexOf('/radio')!='-1'){
DlePage(window.location.pathname.replace('/radio','do=chat&wave=1')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/brony')!='-1'){
DlePage(window.location.pathname.replace('/brony','do=chat&wave=10')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/tv')!='-1'){
DlePage(window.location.pathname.replace('/tv','do=chat&wave=3')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/music')!='-1'){
DlePage(window.location.pathname.replace('/music','do=chat&wave=4')+'&prevblock=1');


}else if(window.location.pathname.indexOf('/lfrm')!='-1'){
DlePage(window.location.pathname.replace('/lfrm','do=chat&wave=5')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/other')!='-1'){
DlePage(window.location.pathname.replace('/other','do=chat&wave=8')+'&prevblock=1');
}
else if(window.location.pathname.indexOf('/stream/')!='-1'){
DlePage(window.location.pathname.replace('/stream/','do=chat&user=')+'&prevblock=1');
}
else if(window.location.pathname!='/index.php'&&window.location.pathname!=''){
	
					  DlePage("user="+window.location.pathname+'&prevblock=1');
}
else
{
	 DlePage(""+window.location.search.replace('?','')+'&prevblock=1');
}
					 curloc=window.location.pathname;
				  }
				  else
				  {
					  window.location="//nocens.net";
				  }
			  }
                    // тут можете вызвать подгруздку данных и т.п.
                    // ...
                }
				

	var mode = (window.opera) ? ((document.compatMode == "CSS1Compat") ? $('html') : $('body')) : $('html,body');
	
	
	//END
function serr(obj){
obj.className="res"; 
}
window.mobilecheck = function() {
  var check = false;
  (function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|pad|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);

  if(navigator.userAgent=="Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.4) Gecko/20100101 Firefox/4.0")
	  check=true;
   if(navigator.userAgent=="Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36")
  check=true;

  return check;
 
}

function entgal (a1, id)
{
	  id = id|| "";
	n1=document.getElementById('enttag').value;
	if(n1=="Поиск..")
	{
	alert("Напишите поисковую фразу!");
	return;	
	
	}
	else 
	{
		
		if(id=="")
		{
		DlePage('do=gallery&view=1&tags='+n1); return false;
		//	self.location.href='//nocens.net/index.php?do=gallery&view=1&tags='+n1;
		}
			else
	{
		DlePage('do=album&user='+id+'&view=1&tags='+n1); return false;
	//	self.location.href='//nocens.net/index.php?do=album&user='+id+'&view=1&tags='+n1;
	}
		
	}
}
function enttag(a1, a2, id)
{
	  id = id|| "";
	if(a1==13)
	{
	
	n1=document.getElementById('enttag').value;
		if(n1=="Поиск...")
	{
	alert("Введите фразу для поиска в галерее!");
	return;	
	
	}

	if(id=="")
	{
		DlePage('do=gallery&view='+a2+'&tags='+n1); return false;
			//self.location.href='//nocens.net/index.php?do=gallery&view=1&tags='+n1;
	}
			else
	{
		DlePage('do=album&user='+id+'&view='+a2+'&tags='+n1); return false;
		//self.location.href='//nocens.net/index.php?do=album&user='+id+'&view=1&tags='+n1;
	}
	}
}

function entblog(a1)
{
	 
	if(a1==13)
	{
	
	n1=document.getElementById('blogtag').value;
		if(n1=="Быстрый поиск...")
	{
	alert("Введите фразу для поиска!");
	return;	
	
	}

	
	
		DlePage('do=tags&category='+curcat+'&tag='+n1); return false;
	}
}



function fadedownup (a1)
{
		srchnum=a1.getAttribute("rel");
		//alert(srchnum);
	srchid="entinp"+srchnum;

	if( $('#menudownlist'+srchnum+'').css('display')=="none"|| $('#menudownlist'+srchnum+'').css('opacity')<=0)
	{
		$('#menudownlist'+srchnum+'').css('height',"0px");
		 $('#menudownlist'+srchnum+'').css('display',"block");$('#menudownlist'+srchnum+'').css('opacity',"0");		//$('#menudownlist'+srchnum+'').fadeIn(200).slideDown(200);
		$('#menudownlist'+srchnum+'').stop().animate({
    height: 152,
    opacity: 1
}, 200);
			$('.srch').css('border-bottom-left-radius','0px');  
	}
	else
	{
	//	$('#menudownlist'+srchnum+'').slideUp(200);
	$('#menudownlist'+srchnum+'').stop().animate({
    height: 0,
    opacity: 0
}, 200);
					
	}
	
}
	var srchpodpis=new Array();

	 $(document).ready(function(){

	 
	 $( ".srch" ).click(function() {
	if( $('#menudownlist'+srchnum+'').css('display')=="none"|| $('#menudownlist'+srchnum+'').css('opacity')<=0)
	{
		$('#menudownlist'+srchnum+'').css('height',"0px");
		 $('#menudownlist'+srchnum+'').css('display',"block");$('#menudownlist'+srchnum+'').css('opacity',"0");		//$('#menudownlist'+srchnum+'').fadeIn(200).slideDown(200);
		$('#menudownlist'+srchnum+'').stop().animate({
    height: 152,
    opacity: 1
}, 200);
			$('.srch').css('border-bottom-left-radius','0px');  
	}
	 
	 
});

$( ".srch" ).focusout(function() {
if( $('#menudownlist'+srchnum+'').css('display')!="none"|| $('#menudownlist'+srchnum+'').css('opacity')>0)
	{

var isHovered = !!$('.menudownlist').  filter(function() { return $(this).is(":hover"); }).length;
					
			if(isHovered==false){		
		
		$('#menudownlist'+srchnum+'').stop().animate({
    height: 0,
    opacity: 0
}, 200);
	}
	}
});



$("#overflowpage").scroll(function(){
	   checkscroll();

	   })
	   
	   
	srchpodpis['v']=''+minisearchlabl2[2]+'';
	srchpodpis['p']=''+minisearchlabl2[1]+'';
	srchpodpis['b']=''+minisearchlabl2[3]+'';
	srchpodpis['u']=''+minisearchlabl2[0]+'';
		srchpodpis['a']=''+minisearchlabl2[5]+'';
	 });
function changesrch(a1,play)
{
	play=play||"";

	
	$('#'+srchid+'').attr('placeholder',srchpodpis[a1]);
	
	srchtype[srchnum]=a1;
		if($('#menudownlist'+srchnum+'').css('display')=='block')
	$(".srchfield").focus();

	$('#menudownlist'+srchnum+'').fadeOut(200);
	
	
	$('#menudown'+srchnum+'').html('<img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/search'+a1+'.png">');
	if(play=="true"&&$('#entinp'+srchnum+'').val()!="")
	{		

			n1=$('#entinp'+srchnum+'').val();
		 ent()
	}

}

var srchid="";
var srchnum="";
var srchtype=new Array();
var lastsrch="";
var albumid='';
function buildsearch(a1,def,position)
{
	def=def||"";
	position=position||"";
	if(lastsrch!=""&&def==""){
	def=lastsrch;
	
	}

srchnum=Math.floor((Math.random() * 1000) + 1);
	srchid="entinp"+srchnum;
	srchtype[srchnum]=a1;
	var addname="";
	if(position=="bottom")
addname="2"; 
	$('.floater').html('<div  id="menudownlist'+srchnum+'" class="menudownlist'+addname+'"><p onClick="changesrch(\'u\',\'true\');"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searchu.png"> '+minisearchlabl[0]+'</p><p onClick="changesrch(\'p\',\'true\');"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searchp.png"> '+minisearchlabl[1]+'</p><p  onClick="changesrch(\'v\',\'true\');"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searchv.png"> '+minisearchlabl[2]+'</p><p  onClick="changesrch(\'b\',\'true\');"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searchb.png"> '+minisearchlabl[3]+'</p><p  onClick="changesrch(\'a\',\'true\');"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searcha.png"> '+minisearchlabl[5]+'</p></div><div onClick="fadedownup(this);" rel="'+srchnum+'" class="menudown" id="menudown'+srchnum+'"><img align="absmiddle" width="30" height="30" src="//nocens.net/pics3/interface/searchb.png"></div><div class="srch" style=""><input  maxlength="150" placeholder="Поиск..." x-webkit-speech="x-webkit-speech"  onkeydown="entnew(event, this);" value="'+def+'" class="srchfield"   rel="'+srchnum+'" name="'+srchid+'" type="text" id="'+srchid+'" size="45"></div>');
	 changesrch(a1)
	  $('.floater').removeClass('floater').addClass('floater2');
}

function ent()
{
	
	
	//var n1=$("#ent").val();
	var getvalue = srchtype[srchnum];

	if(getvalue=='undefined')
	{
		getvalue='u';
	}
	if(n1=="Ник флудера...")
	{
	alert("Напишите ник");
	return;	
	
	}
	n1=n1.trim();
	if(n1.indexOf(':')!='-1')
	{
		var n3=n1.substring(0,n1.indexOf(':')).trim();
		n2=n1.substring(n1.indexOf(':')+1,n1.length).trim();
		if(getvalue=="u")
	{
		DlePage('user='+n3+'&search=1'); return false;
	//self.location.href='//nocens.net/index.php?subaction=userinfo&user='+n1;
	}
	else if (getvalue=="b")
	{
	DlePage('do=blogs&user='+n3+'&filter='+n2); return false;
			//self.location.href='//nocens.net/index.php?do=blogs&user='+n1;
	}
	else if (getvalue=="p")
	{
		if(albumid=="")
		albumid='1';
		DlePage('do=album&user='+n3+'&view=1&tags='+n2); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
		else if (getvalue=="v")
	{
		DlePage('do=video&user='+n3+'&filter='+n2); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
			else if (getvalue=="a")
	{
		DlePage('do=actions&user='+n3+'&tag='+n2); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
	}
	else{
	if(getvalue=="u")
	{
		DlePage('user='+n1+'&search=1'); return false;
	//self.location.href='//nocens.net/index.php?subaction=userinfo&user='+n1;
	}
	else if (getvalue=="b")
	{
		DlePage('do=tags&category=blogs&tag='+n1); return false;
			//self.location.href='//nocens.net/index.php?do=blogs&user='+n1;
	}
	else if (getvalue=="p")
	{
		if(albumid=="")
		albumid='1';
		DlePage('do=gallery&view='+albumid+'&tags='+n1); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
		else if (getvalue=="v")
	{
		DlePage('do=tags&category=videos&tag='+n1); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
			else if (getvalue=="a")
	{
		DlePage('do=actions&tag='+n1); return false;
		//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
	}
}


function entnew(a1,a2)
{  
if (!a1)a1 = window.event;
var keyCode = a1.keyCode;
		srchnum= a1.target.getAttribute("rel");
		
	if(keyCode==13)
	{
	$('#menudownlist'+srchnum+'').stop().animate({
    height: 0,
    opacity: 0
}, 200);
	n1=a2.value;
	
	//echo(n1);
		ent();
	//self.location.href='//nocens.net/index.php?subaction=userinfo&search=1&user='+n1;
	}
}

function ent2(keyCode,a2)
{
	
	if(keyCode==13)
	{
	
	n1=a2.value;
	//echo(n1);
		if(n1=="Ник флудера...")
	{
	alert("Напишите ник");
	return;	
	
	}
	DlePage('search=1&user='+n1); return false;
	//self.location.href='//nocens.net/index.php?subaction=userinfo&search=1&user='+n1;
	}
}

function ent3(a1)
{
	
	if(a1==13)
	{
	
	n1=document.getElementById('ent').value;
		if(n1=="Ник флудера...")
	{
	alert("Напишите ник");
	return;	
	
	}
	DlePage('do=album&search='+n1); return false;
//	self.location.href='//nocens.net/index.php?do=album&search='+n1;
	}
}

var shown=false;
    var tooltip=function(){ 

  var id = 'tt'; 
  var top = 3; 
  var left = 0; 
  var maxw = 300; 
  var speed = 30; 
  var timer = 20; 
  var endalpha = 100; 
  var alpha = 0; 
  var tt,t,c,b,h; 
  var ie = document.all ? true : false; 
  return{ 
  show:function(v,w){ 
  if(ismobile==true)
	  return;
  shown=true;
  if(tt == null){ 
  tt = document.createElement('div'); 
  tt.setAttribute('id',id); 
  t = document.createElement('div'); 
  t.setAttribute('id',id + 'top'); 
  c = document.createElement('div'); 
  c.setAttribute('id',id + 'cont'); 
    c.setAttribute('class','copy'); 
  b = document.createElement('div'); 
  b.setAttribute('id',id + 'bot'); 
  tt.appendChild(t); 
  tt.appendChild(c); 
  tt.appendChild(b); 
  document.body.appendChild(tt); 
  tt.style.opacity = 0; 
  tt.style.filter = 'alpha(opacity=0)'; 
  document.onmousemove = this.pos; 
  } 
  tt.style.display = 'block'; 
  c.innerHTML = v; 
  tt.style.width = w ? w + 'px' : 'auto'; 
  if(!w && ie){ 
  t.style.display = 'none'; 
  b.style.display = 'none'; 
  tt.style.width = tt.offsetWidth; 
  t.style.display = 'block'; 
  b.style.display = 'block'; 
  } 
  if(tt.offsetWidth > maxw){tt.style.width = maxw + 'px'} 
  h = parseInt(tt.offsetHeight) + top; 
  clearInterval(tt.timer); 
  tt.timer = setInterval(function(){tooltip.fade(1)},timer); 
  }, 
  pos:function(e){ 
  var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY; 
  var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX; 
  if( event.clientY>200)
  tt.style.top = (u-h) + 'px'; 
  else
	  tt.style.top = (u) + 'px';   
  if(u<100)
  {
	    tt.style.top = 100 + 'px'; 
  }

  if(l<document.body.clientWidth-tt.offsetWidth-60)
  {
  tt.style.left = (l - left+5) + 'px'; 
  }
  else
  {
	    tt.style.left = (l - left-150) + 'px'; 
  }
  }, 
  fade:function(d){ 
  	  if(ismobile==true)
	  return;
  var a = alpha; 
  if((a != endalpha && d == 1) || (a != 0 && d == -1)){ 

  var i = speed; 
  if(endalpha - a < speed && d == 1){
  
  
  i = endalpha - a; 
  }else if(alpha < speed && d == -1){ 
  i = a; 
 
 
  } 
  alpha = a + (i * d); 
  tt.style.opacity = alpha * .01; 
  tt.style.filter = 'alpha(opacity=' + alpha + ')'; 
  }else{ 
  clearInterval(tt.timer); 
  
  if(d == -1){tt.style.display = 'none'} 
  } 
  }, 
  hide:function(){ 
  if(shown==true){
  clearInterval(tt.timer); 
  tt.timer = setInterval(function(){tooltip.fade(-1)},timer); 
  shown=false;
  }
  } 
  }; 
}();  


function overPunkt(obj_listPunkt)
{ 
/* делаем выпадающее меню видимым */ 
obj_listPunkt.childNodes[1].style.display="table"; 
/* ставим выпадающее меню ниже пункта меню */
obj_listPunkt.childNodes[1].style.top=obj_listPunkt.offsetHeight; 

/*дальше идет оформление пункта меню */ 

obj_listPunkt.childNodes[0].style.borderBottom="none";
/* запоминаем цвет текста пункта меню, чтоб потом его можно было восстановить */ 
color_text=obj_listPunkt.style.color;
 obj_listPunkt.style.backgroundImage="none";
obj_listPunkt.style.color="#ffffff";
obj_listPunkt.style.backgroundColor="#C00";

}

function outPunkt(obj_listPunkt)
{ 
/* делаем выпадающее меню невидимым */ 
obj_listPunkt.childNodes[1].style.display="none";

/* дальше восстанавливаем первоначальный внешний вид пункта меню */
obj_listPunkt.style.background="transparent";

 obj_listPunkt.style.backgroundImage="";
obj_listPunkt.style.color=color_text;
}




(function($){  
  
    $.fn.autoResize = function(options) {  
  
        // Just some abstracted details,  
        // to make plugin users happy:  
        var settings = $.extend({  
            onResize : function(){  
  
            },  
            animate : false,  
            animateDuration : 150,  
            animateCallback : function(){},  
            extraSpace : 20,  
            limit: 1000  
        }, options);  
  
        // Only textarea's auto-resize:  
        this.filter('textarea').each(function(){  
  
                // Get rid of scrollbars and disable WebKit resizing:  
            var textarea = $(this).css({resize:'none','overflow-y':'hidden'}),  
  
                // Cache original height, for use later:  
                origHeight = textarea.height(),  
  
                // Need clone of textarea, hidden off screen:  
                clone = (function(){  
  
                    // Properties which may effect space taken up by chracters:  
                    var props = ['height','width','lineHeight','textDecoration','letterSpacing'],  
                        propOb = {};  
  
                    // Create object of styles to apply:  
                    $.each(props, function(i, prop){  
                        propOb[prop] = textarea.css(prop);  
                    });  
  
                    // Clone the actual textarea removing unique properties  
                    // and insert before original textarea:  
                    return textarea.clone().removeAttr('id').removeAttr('name').css({  
                        position: 'absolute',  
                        top: 0,  
                        left: -9999  
                    }).css(propOb).attr('tabIndex','-1').insertBefore(textarea);  
  
                })(),  
                lastScrollTop = null,  
                updateSize = function() {  
                    // Prepare the clone:  
                    clone.height(0).val($(this).val()).scrollTop(10000);  
  
                    // Find the height of text:  
                    var scrollTop = Math.max(clone.scrollTop(), origHeight) + settings.extraSpace,  
                        toChange = $(this).add(clone);  
  
                    // Don't do anything if scrollTip hasen't changed:  
                    if (lastScrollTop === scrollTop) { return; }  
                    lastScrollTop = scrollTop;  
  
                    // Check for limit:  
                    if ( scrollTop >= settings.limit ) {  
                        $(this).css('overflow-y','');  
                        return;  
                    }  
                    // Fire off callback:  
                    settings.onResize.call(this);  
  
                    // Either animate or directly apply height:  
                   settings.animate && textarea.css('display') === 'block' ?  
                        toChange.stop().animate({height:scrollTop}, settings.animateDuration, settings.animateCallback)  
                        : toChange.height(scrollTop);  
  
                };  
  
            // Bind namespaced handlers to appropriate events:  
            textarea  
                .unbind('.dynSiz')  
                .bind('keyup.dynSiz', updateSize)  
                .bind('keydown.dynSiz', updateSize)  
                .bind('change.dynSiz', updateSize);  
  
        });  
  
        // Chain:  
        return this;  
  
    };  
  
    /* инициализируем растягивание textarea */  

  
})(jQuery);  
//End resize


// Бывшие скрипты с Main.tpl

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
var scrH1 = 70;
$(window).scroll(function(){
	   checkscroll();
	   })

	   function getScrollbarWidth() 
{
    var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div></div>'); 
    $('#overflowpage').append(div); 
    var w1 = $('div', div).innerWidth(); 
    div.css('overflow-y', 'auto'); 
    var w2 = $('div', div).innerWidth(); 
    $(div).remove(); 
    return (w1 - w2);
}
var numcomments=0;
function checkscroll()
{
	var right=4;
	var top1=4;
	 if($("#overflowpage").is(":visible") == true )
		 {
			 	var scro = $("#overflowpage").scrollTop();
				right= 4+getScrollbarWidth() ;
				top1=4;
		 }
		 else
		 {
	var scro = $(this).scrollTop();
	top1=45;
		 } 
		if(scro<scrH1)
	{ 
		
		document.getElementById("gotop2").style.display="none";
	}
	else
	{
		
			if(document.getElementById("gotop2").style.display=="none")
			{
					$('#gotop2').css('top',top1+'px');
				$('#gotop2').css('right',right+'px');
		document.getElementById("gotop2").style.display="block";
			}
	}
var changenumlikes='0'; 
if(numcomments<99)
	changenumlikes=numcomments;
else
	changenumlikes='99';
$( "#commentsnum" ).html(changenumlikes);
if($( "#commheader" ).length && ismobile==false){

if((scro<($("#commheader").offset().top-$(window).height()+100)||scro<10)&&changenumlikes>0)
{
	$('#showmake').css('display','block');
		$('#showmake').css('bottom','4px');
				$('#showmake').css('right',right+'px');
}
else
{
	$('#showmake').css('display','none');
}
}
else
{

	$('#showmake').css('display','none');
}

if(scro>10&&$("#overflowpage").is(":visible") == true &&( $(".fullfonoverflow").height()<($(window).height()+200))){

		$('#showmake').css('display','none');
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

function ser(obj){
obj.className="res2"; 
}
function goTo(where) {
  document.location.replace(where);
  return false;
  }
  
  function goTo2(where) {


  event.preventDefault();
  var target_top= $('#'+where).offset().top;
  $('html, body').animate({scrollTop:target_top}, 'fast');

  }

  
  


function listSort2(){

var menu=new Array();

menu[0]='<a href="//nocens.net/index.php?'+curform+'&bytime=no">'+searchtime[0]+'</a>';
menu[3]='<a href="//nocens.net/index.php?'+curform+'&bytime=today">'+searchtime[1]+'</a>';
menu[2]='<a href="//nocens.net/index.php?'+curform+'&bytime=week">'+searchtime[2]+'</a>';
menu[1]='<a   href="//nocens.net/index.php?'+curform+'&bytime=month">'+searchtime[3]+'</a>';
return menu;
};


function listSort3(){

var menu=new Array();

menu[0]='<a href="//nocens.net/index.php?'+curform+'&sort=date">'+searchorder[0]+'</a>';
menu[1]='<a href="//nocens.net/index.php?'+curform+'&sort=rating">'+searchorder[1]+'</a>';
menu[2]='<a href="//nocens.net/index.php?'+curform+'&sort=news_read">'+searchorder[2]+'</a>';
menu[3]='<a   href="//nocens.net/index.php?'+curform+'&sort=comm_num">'+searchorder[3]+'</a>';
menu[4]='<a   href="//nocens.net/index.php?'+curform+'&sort=title">'+searchorder[4]+'</a>';
return menu;
};

function listSort4(){

var menu=new Array();

menu[0]='<a href="//nocens.net/index.php?'+curform+'&cens=yes">'+searchcens[0]+'</a>';
menu[1]='<a href="//nocens.net/index.php?'+curform+'&cens=no">'+searchcens[1]+'</a>';
menu[2]='<a href="//nocens.net/index.php?'+curform+'&cens=only">'+searchcens[2]+'</a>';
return menu;
};


function listSort5(){

var menu=new Array();

menu[0]='<a href="//nocens.net/index.php?'+curform+'&score=all">'+searchscore[0]+'</a>';
menu[1]='<a href="//nocens.net/index.php?'+curform+'&score=5">'+searchscore[1]+'</a>';
menu[2]='<a href="//nocens.net/index.php?'+curform+'&score=10">'+searchscore[2]+'</a>';
return menu;
};


function menuTags(type,author,tag){

var menu=new Array();
tag=tag.replace('#','')
if(type=='gallery'){
	if(author!="")
		menu[0]='<a onClick="DlePage(\'do=album&user='+author+'&view=1&tags='+tag+'\'); return false;" href="//nocens.net/index.php?do=album&user='+author+'&view=1&tags='+tag+'">'+socfur_searchtag3p+'</a>';
	menu[1]='<a onClick="DlePage(\'do=gallery&view=1&tags='+tag+'\'); return false;"href="//nocens.net/index.php?do=gallery&view=1&tags='+tag+'">'+socfur_searchtag3+'</a>';
}
if(type=='video'){
		if(author!="")
	menu[0]='<a onClick="DlePage(\'do=video&user='+author+'&filter='+tag+'\'); return false;"href="//nocens.net/index.php?do=video&user='+author+'&filter='+tag+'">'+socfur_searchtag2p+'</a>';
	menu[1]='<a onClick="DlePage(\'do=tags&category=videos&tag='+tag+'\'); return false;"href="//nocens.net/index.php?do=tags&category=videos&tag='+tag+'">'+socfur_searchtag2+'</a>';
}

if(type=='blog'){
		if(author!="")
	menu[0]='<a onClick="DlePage(\'do=blogs&user='+author+'&filter='+tag+'\'); return false;"href="//nocens.net/index.php?do=blogs&user='+author+'&filter='+tag+'">'+socfur_searchtag1p+'</a>';
	menu[1]='<a onClick="DlePage(\'do=tags&category=blogs&tag='+tag+'\'); return false;"href="//nocens.net/index.php?do=tags&category=blogs&tag='+tag+'">'+socfur_searchtag1+'</a>';
}

menu[2]='<a onClick="DlePage(\'do=actions&tag='+tag+'\'); return false;"href="//nocens.net/index.php?do=actions&tag='+tag+'">'+socfur_searchtag4+'</a>';
return menu;
};

function gototop() {
	 if($("#overflowpage").is(":visible") == true )
		 {
			  $("#overflowpage").animate({scrollTop:0},100);
		 }
		 else
		 {
	$('body,html').animate({scrollTop:0},100);
		 }
    return false;
	};
	
	
	function makegalpage()
{
	  if ($.active > 0) {

                console.log("Loader active...");
				return;
            
            }
			
	if(type=="gallery"){

 scro = $(this).scrollTop();
 scrHP = $("#wall").height();
    scrH2 =0;
    scrH2 = scro;
	//Высота стены - прокрутка
 leftH = scrHP;
if((scro>maxscroll && scro+scrH > leftH-200)){

cont=cont+1; 
GalleryPage(wallqueue+'&wasp='+cont, cont); 

	newwallmain=scrHP;
	maxscroll=scro+200;
	 
    }
	}
	if(type=="wall"){

 scro = $(this).scrollTop();
  scrHP = $("#wallmain").height();
   scrH2 =0;
	


    scrH2 = scro;
    leftH = scrHP -  scro;
if(scrHP-newwallmain>20)
{

if( scro>550 && leftH < 250){

cont=cont+1; 
WallPage(wallqueue+'&wasp='+cont+'&', cont); 
	newwallmain=scrHP;
    }
}

	}
	else	if(type=="custom"&&wallqueue!=""){

	 scro = $(this).scrollTop();
	if(document.getElementById('pin')!=null){
 pin =  document.getElementById('pin').offsetTop;

   scrH = $(window).height();
  	if(scro+scrH>=pin-300&&scro>savey+200)
	{

cont=cont+1; 
CustomPage(wallqueue, cont); 
	newwallmain=scrHP;
    }
}

	}
	else if(type=="actions")
	{
		 scro = $(this).scrollTop();
	if(document.getElementById('pin')!=null){
 pin =  document.getElementById('pin').offsetTop;

   scrH = $(window).height();
  	if(scro+scrH>=pin-300&&scro>savey+200)
	{
cont=cont+1; 
savey=scro;
ActionsPage(wallqueue+'pager='+cont+'&lastdate='+lastdate+'', cont); 

	newwallmain=scrHP;
	maxscroll=scro+120;

	
    }
	}}
}


function makecolor()
{

 $("[id*=newpic]").css('backgroundImage',"url(//nocens.net/pics3/interface/whiter.png)");
		
 $("[id*=newblog]").css('backgroundImage',"url(//nocens.net/pics3/interface/whiter.png)");
	
 $("[id*=newvideo]").css('backgroundImage',"url(//nocens.net/pics3/interface/whiter.png)");
	
 $("[id*=newaction]").css('backgroundImage',"url(//nocens.net/pics3/interface/whiter.png)");

 
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



function newscroll(newclass)
{
		if(dle_skin!='smartphone'){
	$("body").css('overflow','hidden');
	$(newclass).css('overflow','auto');
	$(newclass).fadeIn(100);
		}
}
function oldscroll(newclass)
{
	

		if(dle_skin!='smartphone'){
	$(newclass).fadeOut(100,function(){checkscroll();});
if(newclass!='#overflowpage'&&$('#overflowpage').css('display')!='none'){
	$("#overflowpage").css('overflow','auto');
}
else
{
	$("body").css('overflow','auto');
}
	$(newclass).css('overflow','hidden');
}
}
function overflower(a1)
{
	conter=2;
if(tml)
{
	clearTimeout(tml);
}

	tml=setTimeout(function(){ovmain(a1)}, 30);
	
}
function clearflower(a1)
{
clearTimeout(tml);
conter=1; 
if( $(window).height()< $(window).width()|| $(window).width()>800)
a1.style.overflow='visible';


}

function ovmain(a1){

	if(conter==2)
	{
		
	$("#hidelayer").css('overflow','hidden');
	$("#hidelayer2").css('overflow','hidden');
$("#hidelayerg").css('overflow','hidden');
$("#hidelayerv").css('overflow','hidden');
	}
	clearTimeout(tml);
	}


function cb(e) {
  if (e){
     e.stopPropagation();
   }
    else{

     window.event.cancelBubble = true;
  }
     
  
  
} 
function fadeinout(customel)
{
	if(customel.indexOf('.')!='-1'||customel.indexOf('#')!='-1')
	{
if( $(''+customel+'').css('display')=='none')
{
	$(''+customel+'').fadeIn(200); $('#'+customel+'').css('visibility','visible');  return false;

	} 
else {
	
	$(''+customel+'').fadeOut(200); return false;
	};
	}
	else
	{
if( $('#'+customel+'').css('display')=='none')
{$('#'+customel+'').fadeIn(200); $('#'+customel+'').css('visibility','visible');  return false;} 
else {$('#'+customel+'').fadeOut(200); return false;};
	}
}


