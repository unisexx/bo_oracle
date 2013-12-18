<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="themes/bo/css/template.css">
<link rel="stylesheet" type="text/css" href="themes/bo/css/vtip.css">
<link rel="stylesheet" type="text/css" href="themes/bo/css/custom-theme/jquery.ui.all.css">
<link rel="stylesheet"  href="themes/bo/css/treeview/jquery.treeview.css" />
<link rel="stylesheet"  href="css/icheckbox_style.css" />

<link rel="stylesheet" type="text/css" media="screen"  href="themes/bo/css/pagination.css" />
<link rel="stylesheet" type="text/css" media="screen"  href="themes/bo/css/colorbox.css" />
<link type="text/css" href="js/jquery.datepick/redmond.datepick.css" rel="stylesheet" />
<link type="text/css" href="css/tip-twitter.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="themes/bo/js/SWFSupport.js"></script>
<script type="text/javascript" src="themes/bo/js/vtip.js"></script>
<script type="text/javascript" src="themes/bo/js/core.js"></script>
<script type="text/javascript" src="themes/bo/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="themes/bo/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="themes/bo/js/ui/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="js/jquery.ui.accordion.js"></script>

<script type="text/javascript" src="themes/bo/js/cufon/cufon-yui.js"></script>
<script type="text/javascript" src="themes/bo/js/cufon/supermarket_400.font.js"></script>
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick-th.js"></script>
<script type="text/javascript" src="themes/bo/js/treeview/jquery.treeview.js"></script>
<script type="text/javascript" src="themes/bo/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="themes/bo/js/NumberFormat154.js"></script>
<script type="text/javascript" src="themes/bo/js/jquery.rowcount-1.0.js"></script>
<script type="text/javascript" src="themes/bo/js/jquery.meio.mask.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.8.1/lib/jquery.metadata.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.8.1/jquery.validate.js"></script>
<script type="text/javascript" src="js/iphone-style-checkboxes.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js"></script>
<script type="text/javascript" src="js/jquery.poshytip.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			    			    
				$("td").filter(function() {
				    if($(this).attr("onclick")) {
				        return $(this).attr("onclick").indexOf("location") !== -1; 
				    }
				}).attr('style','cursor:pointer;cursor:hand;'); 
			    			    
			    			    
        		//$("td").attr("onClick").css('cursor','pointer'); 
			    
				$('.tip').poshytip({className:'tip-twitter',showTimeout:1,alignTo:'target',alignX:'center',offsetY:5,allowTipHover:false,fade:false,slide:false});              
			    $(".Number").bind('keypress', function(e) {									  
			    return ( e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
			    });
			     
			//Examples of how to assign the ColorBox event to elements
			$("a[rel='example1']").colorbox();
			$("a[rel='example2']").colorbox({transition:"fade"});
			$("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
			$("a[rel='example4']").colorbox({slideshow:true});
			$(".example5").colorbox();
			$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
			$(".example7").colorbox({width:"80%", height:"80%", iframe:true});
			$("a[href=#]").click(function(){return false});
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
			
			$("#tree").treeview({
				collapsed: false,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
			$( "#tabs" ).tabs();
			
			$('.datepicker').datepick({showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery.datepick/calendar.png'});
      		
		//----- Disabled Enter Key Submit -----
		   var textboxes = $("input:text");

		   if ($.browser.mozilla) {
		      $(textboxes).keypress(checkForEnter);
		   } else {
		      $(textboxes).keydown(checkForEnter);
		   }
		
		   function checkForEnter(event) {
		      if (event.keyCode == 13) {
		         currentTextboxNumber = textboxes.index(this);
		
		         if (textboxes[currentTextboxNumber + 1] != null) {
		           nextTextbox = textboxes[currentTextboxNumber + 1];
		           nextTextbox.select();
		      }
		
		         event.preventDefault();
		         return false;
		      }
		   }
		   
		});
	    
		Cufon.replace('h1, h3, h4, h5, ul#navmenu-h');
	</script>

<?php echo login_chk(); //--- ภ้าไม่ได้มาจากการล้อกอินให้ redirect กลับไปล้อกอินใหม่ ---?>
