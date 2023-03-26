
<script type="text/javascript">
 var hiding = new Array();
	function allshow(a1,a2){
		   if(hiding[a1]!=true){
$(a1).slideDown(100);
  //$(a2).css('display',"none");

 hiding[a1]=true;
	$(a2).html("скрыть");
		   }
		   else
		   {
			   $(a1).slideUp(100);
  //$(a2).css('display',"none");

 hiding[a1]=false;
	$(a2).html("ещё");
		   }
		return false;
	}
	
		var frv="";
		function filtfriend(a1,a2)
		{
		
	
		frv=a2.toLowerCase();
	

			if(a1==13)
	{
		ent2(event.keyCode, document.getElementById('friendsnam'));
	}
	else if(frv!="")
	{
		$(".friendclass").each(function (){
				$(this).css('display',"none");
				
    if($(this).text().toLowerCase().indexOf(frv)!=-1)
    {
 	$(this).css('display',"block");
    }
	else
	{
	
	}
});
		
	}
	else
	{
					$(".friendclass").css('display',"block");
	}
		}
function gottam(n1){
	
	for(n2=1; n2<4; n2++)
	{
	if(n2==n1)
	{
		
		 document.getElementById('nr'+n2).style.display="table";
		 document.getElementById('sp'+n2).className ="";
		  	}
	else
	{
		 document.getElementById('nr'+n2).style.display="none";
		 	
			document.getElementById('sp'+n2).className ="sublink";

	}
	}
	return false;
	}
	
function putin(a1)
{if(document.getElementById('indo').value.indexOf(a1.innerText)=="-1"&&document.getElementById('indo').value.length<100)
	{
	 document.getElementById('indo').value = a1.innerHTML;
	  
	}
}
function gottam(a1, n1){
	
	for(n2=1; n2<5; n2++)
	{
	if(n2==n1)
	{
		
		 document.getElementById('n'+n2).style.display="table";
	}
	else
	{
		 document.getElementById('n'+n2).style.display="none";
	}
	}
	}

window.onload = function() {

    document.getElementById('example').onclick = function() {

        document.getElementById('tags').value += this.innerText || this.textContent;

        return false;

    };

};

</script>
<style>

.infernal {color: #000;
	background-color: #FFF;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 5px;
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
</style>

    <div class="headers">Перевести флопсы  (у вас {cash} флопсов)</div>
    <table width="100%" border="0">
      <tr>
        <td valign="top"><div class="ava3" style="position: relative; width: 155px;">
  <div class="infoto"><div onclick="ent2(13, document.getElementById('friendsnam'));" style="position: absolute; cursor: pointer; right: 2px;"><img src="http://nocens.ru/pics3/interface/lupa.png"></div>
    <h3 class="h3left"><input placeholder="Поиск друга..." onkeyup="filtfriend(event.keyCode, this.value);" value="" class="typeleft" name="friendsnam" type="text" id="friendsnam" size="45"></h3>
    {friends}
  </div></div></td>
        <td valign="top"><div class="infernal">
          <form  method="post" name="add" id="add" enctype="multipart/form-data" action="">
            <p>
              <input type="hidden" name="action" value="upload" />
              {bank}<br/><div style="clear: both;"></div>
            </p>
            <p>
            <h1>Отправить флопсы</h1>
            Ник:
              <input name="nick" type="text" id="indo" value="{name}" readonly />
              Сумма:
<input name="desc" type="text" value="100" maxlength="150"/>
              <input style="width: 160px;" type="submit" class="bbcodes_poll"  value=" Отправить " />
            </p>
        </form>
        </div></td>
      </tr>
  </table>

