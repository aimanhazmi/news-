
$(function () {
	var top = window.screen.height / 2 - 250;   
	var left = window.screen.width / 2 - 300;  
	var pic = thumb;   
	var rLink =url; 
	var site = source_link;
	var summary = summary;
	$(".share_wb").click(shareTSina);
	$(".sinawb").click(shareTSina);
	/*title是标题，rLink链接，summary内容，site分享来源，pic分享图片路径,分享到新浪微博*/  
	function shareTSina() {
		window.open("http://service.weibo.com/share/share.php?pic=" +encodeURIComponent(pic) +"&title=" +    
		encodeURIComponent(title.replace(/&nbsp;/g, " ").replace(/<br \/>/g, " "))+ "&url=" + encodeURIComponent(rLink),   
		"分享至新浪微博",   
		"height=500,width=600,top=" + top + ",left=" + left + ",toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no");   
	}
		
});
