<link rel="stylesheet" type="text/css" href="../css/template.css"/>
<script type="text/javascript" src="../js/SWFSupport.js"></script>

<script src="../js/jquery-1.4.2.min.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/cufon/cufon-yui.js"></script>
<script type="text/javascript" src="../js/cufon/supermarket_400.font.js"></script>
<script type="text/javascript">
	Cufon.replace('h1, h3, h4, h5, ul#navmenu-h');

</script>

<script type="text/javascript" src="../js/vtip.js"></script>
<link rel="stylesheet" type="text/css" href="../css/vtip.css" />

<script type="text/javascript" src="../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../js/ui/jquery.ui.tabs.js"></script>
<link rel="stylesheet" type="text/css" href="../css/custom-theme/jquery.ui.all.css"/>

<script type="text/javascript" src="../js/treeview/jquery.treeview.js"></script>
<link rel="stylesheet" href="../css/treeview/jquery.treeview.css" />

<link media="screen" rel="stylesheet" href="../css/colorbox.css" />
<script src="../js/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$("a[rel='example1']").colorbox();
			$("a[rel='example2']").colorbox({transition:"fade"});
			$("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
			$("a[rel='example4']").colorbox({slideshow:true});
			$(".example5").colorbox();
			$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
			$(".example7").colorbox({width:"80%", height:"80%", iframe:true});
			
			$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
			$(".example82").colorbox({width:"50%", inline:true, href:"#inline_example82"});
			
			$(".example9").colorbox({
				onOpen:function(){ alert('onOpen: colorbox is about to open'); },
				onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
				onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
				onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
				onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
			});
			
			//Example of preserving a JavaScript event for inline calls.
			$("#click").click(function(){ 
				$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	</script>
    
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>

<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: false,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
</script>

<!--<script type="text/javascript">
      $(document).ready(function(){
	  
	  $('#province').hide();
   
   			$('showProvince').click(function(){
			
			$('#province').show('slow');
   
   });
   
   $('a#close').click(function(){
   		$('#province').hide('slow');
		})
   
 	  });
</script>-->

<script type="text/javascript">
	$(document).ready(function(){
	$('#boxProvince').hide();
   		$("#show").click(function(){
		$("#boxProvince").slideToggle("slow");
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('.boxSub').hide();
   		$(".showSub").click(function(){
			$(".boxSub").toggle();
			 if($(".boxSub").is(':hidden')) {
				$(".showSub").html('<img src="../images/tree/add.jpg" width="16" height="15" />');
			}else{
				$(".showSub").html('<img src="../images/tree/minimize.png" width="16" height="15" />');
			}
		});
	});
</script>



