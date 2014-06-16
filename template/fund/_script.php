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

<script>
	$(function() {
		$( "#tabs, #tabs1, #tabs2, #tabs3, #tabs4, #tabs5, #tabs6, #tabs7" ).tabs();
	});
</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- DIV Option show/hide -->
<script>
$(document).ready(function(){
        $("select").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="1"){
					$(".type1").show();
                    $(".type2").hide();
					$(".type3").hide();
                }
                if($(this).attr("value")=="2"){
                	$(".type1").hide();
                    $(".type2").show();
					$(".type3").hide();
                }
                if($(this).attr("value")=="3"){
                 	$(".type1").hide();
                    $(".type2").hide();
					$(".type3").show();
				}
				
				<!--ผลการพิจารณาของคณะอนุกรรมการ get_support_personal/form.php-->
				if($(this).attr("value")=="nocommand"){
                 	$(".boxAttachfile").hide();
				}
				if($(this).attr("value")=="command"){
					$(".boxAttachfile").show();
				}
				
				<!--รายละเอียดการจ่ายเงิน  get_support_personal/form_pay.php (Lightbox)-->
				if($(this).attr("value")=="paid"){
                 	$(".boxPaid").show();
					$(".boxStop").hide();
				}
				if($(this).attr("value")=="stop"){
					$(".boxPaid").hide();
					$(".boxStop").show();
				}
            });
        }).change();
    });
</script>

<!-- Tab -->
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>


<!-- Radio show/hide -->
<script type="text/javascript">
    $(document).ready(function(){   
		$(".dvCen").hide();
        $(".dvArea").hide();	
		$(".dvApprove").hide();
        $(".dvReject").hide();
		
		
        $('input[type="radio"]').click(function(){
												
			// get_support_project.php								
            if($(this).attr("value")=="cen"){
                $(".dvCen").show();
                $(".dvArea").hide();
            }
            if($(this).attr("value")=="area"){
                $(".dvCen").hide();
                $(".dvArea").show();
            }
			
			// get_support_personal.php
			if($(this).attr("value")=="approve"){
                $(".dvApprove").show();
                $(".dvReject").hide();
            }
			if($(this).attr("value")=="reject"){
                $(".dvApprove").hide();
                $(".dvReject").show();
            }
        });
		
    });
</script> 

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
			
			$(".example8").colorbox({width:"80%", inline:true, href:"#inline_example1"});
			$(".example82").colorbox({width:"80%", inline:true, href:"#inline_example82"});
			$(".example83").colorbox({width:"80%", inline:true, href:"#inline_example83"});
			$(".example84").colorbox({width:"80%", inline:true, href:"#inline_example84"});
			$(".example85").colorbox({width:"80%", inline:true, href:"#inline_example85"});
			
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
