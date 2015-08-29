/**
 * 轮显
 * 
 * @version 2009-12-3 10:21:51
 * @author Zerolone
 */
window.addEvent('domready',function(){
	//初始化小图
	var cycle=new Array();
	for(var i=0;i<=5;i++){
		cycle[i]=$('cycle_img'+i);
		$('li'+i).set('text',Switcher[i]['title']);
		$('li'+i).set('href',Switcher[i]['url']);
	}

	//大图
	var bigpic=$('bigpic');
	//初始化大图
	bigpic.src=Switcher[0]['pic'];

	//循环li
	var li=new Array();
	for(var i=0;i<=5;i++){
		li[i]=$('li'+i);		
	}

	//增加鼠标移入事件
	$('li0').addEvent('mouseenter', function(e){lienter(0);});
	$('li1').addEvent('mouseenter', function(e){lienter(1);});
	$('li2').addEvent('mouseenter', function(e){lienter(2);});
	$('li3').addEvent('mouseenter', function(e){lienter(3);});
	$('li4').addEvent('mouseenter', function(e){lienter(4);});
	$('li5').addEvent('mouseenter', function(e){lienter(5);});

	//增加鼠标移出事件
	$('li0').addEvent('mouseleave', function(e){cycleplay();});
	$('li1').addEvent('mouseleave', function(e){cycleplay();});
	$('li2').addEvent('mouseleave', function(e){cycleplay();});
	$('li3').addEvent('mouseleave', function(e){cycleplay();});
	$('li4').addEvent('mouseleave', function(e){cycleplay();});
	$('li5').addEvent('mouseleave', function(e){cycleplay();});

	//添加鼠标点击事件
	//li[0].addEvent('click', function(e){window.open(Switcher[0]['url']);});
	
	//整体
	$('cycle').addEvent('mouseenter', function(e){cyclestop();});	
	$('cycle').addEvent('mouseleave', function(e){cycleplay();});

	//大图
	$('bigpic').addEvent('mouseenter', function(e){cyclestop();});	
	$('bigpic').addEvent('mouseleave', function(e){cycleplay();});
	
	//默认
	var slidint;
	Switchid=0;

	cycleplay();
	lienter(0);
	cycleplay();
});

/**
 * 移入换背景
 */
function lienter(id){
	//停止滚动
	cyclestop();

	//隐藏所有
	liclear();
	
	//选定背景
	$('li'+id).setStyle('background-image', 'url(css/img/cycle.gif)');
	$('li'+id).setStyle('color', '#FFFFFF');
	
	//大图
	$('bigpic').src=Switcher[id]['pic'];
	
	//大图效果

	var bigpic = $('bigpic');
	var fx = new Fx.Tween(bigpic,{
		duration: 50,
		onComplete: function(){
			bigpic.src=Switcher[id]['pic'];
			bigpic.fade('in');
		}
	});
	fx.start('opacity',1,0);

}

/**
 * 清除背景
 */
function liclear(){
	for(var i=0;i<=5;i++){
	$('li'+i).setStyle('background-image', '');
	$('li'+i).setStyle('color', '#666');
//			$('li'+i).set('class', '');
	}	
}

/**
 * 循环速度，三秒效果最佳
 */
function cycleplay(){
	slidint = setTimeout(playnext,4000);
}

/**
 * 显示下一个
 */
function playnext(){
	if(Switchid>=5){
		Switchid = 0;
	}
	else{
		Switchid++;
	};
	
	lienter(Switchid);
	cycleplay();
}

/**
 * 停止
 */
function cyclestop(){
	clearTimeout(slidint);
}