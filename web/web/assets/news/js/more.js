/*列表样式函数*/
$(function(){	
	var page = 1;
    var nexURL = "http://app.ikanchai.com/roll.php?do=more&sectionid=255&status=1&sort=0&page=1&pagesize=5&callback=?";	
		var mainFun={
			init:function(){			               
				this.ajaxFun();                      //数据动态加载
			},		
			 //数据动态加载
			 //
			 ajaxFun:function(){
			 		var moreBtn=$("#moreBtn");					
			 		moreBtn.on("click",function(event){
						event.preventDefault();
						page = page+1;						
						if(page>9){
							alert("木有啦~~ ");
							return;
						}						
						nextURL = "http://app.ikanchai.com/roll.php?do=more&sectionid=255&status=1&sort=0&pagesize=5&page="+page+"&callback=?";
			 				$.ajax({
			 						type:"GET",
			 						url:nextURL,   //存储数据的网址地址
			 						beforeSend: function(){},   //数据发送前要执行的函数
			 						data:{Name:"keyun"},        //要发送的数据，类似json格式
									dataType: 'json',			//从服务器返回的数据类型
									complete:function(){
										
									},      //请求结束时要执行的函数
									success: function(data){
										event.preventDefault();	
											$.each(data.data,function(k,v){
												$("#mainList ul").append("<li class='rtmj-box'>"
												+"<dl>"
												+"<dt>"
												+"<a href='"+v.url+"' target='_blank'><img src='"+v.thumb+"' alt='"+v.title+"'/></a>"
												+"</dt>"
												+"<dd>"
												+"<h3>"
												+"<a href='"+v.url+"' target='_blank' class='list_title'>"+v.title+"</a>"												
												+"</h3>"
												+"<p>"+v.desc+"</p>"
												+"<p>"+v.editor+"  / "+v.catname+"  / "+v.date+"</p>"
												+"</dd>"											
												
												+"</dl>"
												+"</li>");
											});											
										//
	
										//更新下一页的链接
										if(page<9){
											$("#moreBtn a").attr("href",www.ikanchai.com);
											mainFun.listFun();
										}else{
											$("#moreBtn a").text("木有啦~~ 返回页首查看频道");
										}
										// this.listFun();										
									}//result是返回的数据，放到页面上
			 				});
			 		});
			 },
	
			backTopFun:function(){

					var backBtn=$("#backTop");

					var srcTop=$(document).scrollTop();
                    	if(srcTop>200){
							backBtn.show();
						}else{
							backBtn.hide();
						
						}
					
                    $(window).scroll(function(){

                    	var srcTop=$(document).scrollTop();
                    	if(srcTop>200){
							backBtn.show();
						}else{
							backBtn.hide();
						
						}

                    });
					
					backBtn.on("click",function(){
							$("html,body").animate({scrollTop:0},800);
					});

			}
		}

		mainFun.init();
		
		
});
