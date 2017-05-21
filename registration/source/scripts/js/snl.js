function NewOdnaknopka3() {
this.domain=location.href+'/';
this.domain=this.domain.substr(this.domain.indexOf('://')+3);
this.domain=this.domain.substr(0,this.domain.indexOf('/'));
this.location=false;
this.selection=function() {
var sel;
if (window.getSelection) sel=window.getSelection();
else if (document.selection) sel=document.selection.createRange();
else sel='';
if (sel.text) sel=sel.text;
return encodeURIComponent(sel);
}
this.url=function(system) {
var title=encodeURIComponent(document.title);
var url=encodeURIComponent(location.href);
switch (system) {
case 1: return 'http://www.livejournal.com/update.bml?event='+url+'&subject='+title;
case 2: return 'http://vkontakte.ru/share.php?url='+url;
case 3: return 'http://www.facebook.com/sharer.php?u='+url;
case 4: return 'http://twitter.com/home?status='+title+' '+url;

}
}
this.redirect=function() {
if (this.location) location.href=this.location;
this.location=false;
}
this.go=function(i) {
this.location=this.url(i);
//setTimeout('odnaknopka2.redirect()',2000);
window.open(this.location,'odnaknopka');
var scr=document.createElement('script'); 
scr.type='text/javascript'; 
//scr.src='http://odnaknopka.ru/save2/?domain='+this.domain+'&system='+i;
document.body.appendChild(scr);
return false;
}
this.init=function() {
var titles=new Array('Разместить в блоге','ВКонтакте','Facebook','Twitter');
var html='';


for (i=0;i<4;i++) {
html+='<a href="'+this.url(i+1)+'" onclick="return odnaknopka3.go('+(i+1)+');"><img src="http://www.cluub.ru/i/1x1.gif" width="90" height="25" alt=" #" title="'+titles[i]+'" style="border:0;padding:0;margin:0 4px 0 0;background:url(http://www.cluub.ru/i/buttons.png) no-repeat -0px -'+(i*25)+'px"/></a>';
}
document.write(html);
}
}
odnaknopka3=new NewOdnaknopka3();
odnaknopka3.init();