
{literal}
<script type="text/javascript">
$("#progressbar").reportprogress(0);

var pct=0;
var handle=0;
var n_emails={/literal}{$n_emails}{literal};
var mailInter=0;
var logs="";
var locked=0;
var SERVER = "http://localhost/www/";

var getLogs="{/literal}{jurl 'getLogs' , array('id'=>$id)}{literal}";
var nbSent="{/literal}{jurl 'getNbSent' , array('id'=>$id)}{literal}";
var send="{/literal}{jurl 'send' , array('id'=>$id)}{literal}";
var percent="{/literal}{jurl 'getPercentDone' , array('id'=>$id)}{literal}";
var getEmailsToSend="{/literal}{jurl 'getEmailsToSend' , array('id'=>$id)}{literal}";

function update(){   
        $.get(getLogs, {
                     }, function(data){  
      					$("#emails").html(data);
                     });
        $.get(percent, {
                     }, function(data){  
                     	if(data == "100") stop();
                     	
                     	$("#progressbar").reportprogress(data);
                     });
        $.get(nbSent, {
                     }, function(data){  
                     	$("#n_emails_sent").html(data);
                     });
        $.get(getEmailsToSend, {
                     }, function(data){  
                     	$("#n_emails_to_send").html(data);
                     });
        
        if(pct==16){
                clearInterval(handle);
                $("#run").val("start");
                pct=0;
        }
}
function mail(){
       $.get(send, {
                     }, function(data){
                     		logs+= data;
                  			 $("#logs").html(logs);
                     });
      logs+="<b>Send Request Planned for {/literal}{$maxMailPerMin}{literal} mails</b><br>";
      $("#logs").html(logs);
                    
}
function stop(){
	 clearInterval(handle);
     clearInterval(mailInter);
     document.body.style.cursor = ''; 
     
}
jQuery(function($){
        $("#run").click(function(){
                if(this.value=="start"){
						$("#progressbar").reportprogress(0);
						document.body.style.cursor = 'wait'; 
                        handle=setInterval("update()",1000);
                        mail();
                        mailInter=setInterval("mail()",60000);
                        this.value="stop";
                }else{
                       stop();
                       this.value="start";
                }
        });
        $("#reset").click(function(){
                pct=0;
                $("#progressbar").reportprogress(0);
        });
});

var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name');
	if (window.focus) {
		newwindow.focus()
	}
}

</script>
{/literal}
<h1>NewsLetter APP</h1>
<b>Servers :</b><br>
{foreach $servers as $k=>$serv}
	{$serv}<br>
{/foreach}
<b>Max number of mails per min :</b> {$maxMailPerMin}<br>
<b>Max number of mails per day :</b> {$maxMailPerDay}<br>
<b>Mail not sent yet : </b> <span id="n_emails_to_send">{$n_emails}</span>.<br>
<b>Mail sent : </b> <span id="n_emails_sent">{$n_emails_sent}</span>.<br>



<div id="progressbar"></div>
<p>
<input id="run" value="start" type="button">
<input id="reset" value="reset" type="button">
</p>
<a href="javascript:poptastic('http://appengine.google.com/dashboard/quotadetails?&app_id=helenklingserv1&version_id=1.333113632130813954');">
	Check the quotas
</a><br> 
<h1>Logs</h1>
<div id="logs"></div>
<h1>Sent Emails</h1>
<div id="emails"></div>