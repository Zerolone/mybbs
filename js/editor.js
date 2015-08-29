function getActiveText(selectedtext) {
  text = (document.all) ? document.selection.createRange().text : document.getSelection();
  if (selectedtext.createTextRange) {	
    selectedtext.caretPos = document.selection.createRange().duplicate();	
  }
	return true;
}

function checklength(theform)
{
	alert('已有字节数'+theform.atc_content.value.length);
}

function AddText(NewCode) {
	if (document.FORM.atc_content.createTextRange && document.FORM.atc_content.caretPos) {
		var caretPos = document.FORM.atc_content.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? NewCode + ' ' : NewCode;
	} 	else 	{
		document.FORM.atc_content.value+=NewCode
	}
	setfocus();
}

function setfocus(){
  document.FORM.atc_content.focus();
}

function showsize(size) {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[size="+size+"]"+text+"[/size]";
		AddText(AddTxt);
	}
}

function showfont(font) {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[font="+font+"]"+text+"[/font]";
		AddText(AddTxt);
	}
}

function showcolor(color) {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[color="+color+"]"+text+"[/color]";
		AddText(AddTxt);
	}
}

/**
 * 字加粗、斜体、下划线
 */
function bold() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[b]"+text+"[/b]";
		AddText(AddTxt);
	}
}

function italicize() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[i]"+text+"[/i]";
		AddText(AddTxt);
	}
}

function underline() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[u]"+text+"[/u]";
		AddText(AddTxt);
	}
}

function center() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[align=center]"+text+"[/align]";
		AddText(AddTxt);
	}
}

function quoteme() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[quote]"+text+"[/quote]";
		AddText(AddTxt);
	}
}

function image() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[img]"+text+"[/img]";
		AddText(AddTxt);
	}
}

function showurl() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[url="+text+"]"+text+"[/url]";
		AddText(AddTxt);
	}
}

function showcode() {
	if (document.selection && document.selection.type == "Text") {
		AddTxt="[code]"+text+"[/code]";
		AddText(AddTxt);
	}
}

function copytext(theField) {
	var tempval=eval("document."+theField);
	tempval.focus();
	tempval.select();
	therange=tempval.createTextRange();
	therange.execCommand("Copy");
}

function replac(){
	txt2=prompt('请输入搜寻目标关键字',"");
	if (txt2 != null){
		if (txt2 != "") {
			txt=prompt('关键字替换为:',txt2);
		}	else{
			replac();
		}
		var Rtext = txt2; var Itext = txt;
		Rtext = new RegExp(Rtext,"g");
		document.FORM.atc_content.value =document.FORM.atc_content.value.replace(Rtext,Itext);
	}
}

cnt = 0;
function quickpost(event){
	if((event.ctrlKey && event.keyCode == 13)||(event.altKey && event.keyCode == 83)){
	 cnt++;
	 if(cnt==1){
		 this.document.FORM.submit();
	 }else{
		 alert('提交中，请稍后！');
	 }
	}
}