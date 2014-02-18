<?php

if(!function_exists('set_notify'))
{
	function set_notify($type,$msg)
	{
		$config = array(
			'notify' => TRUE,
			'type' => $type,
			'msg' => $msg
		);
		$CI =& get_instance();
		$CI->session->set_flashdata($config);
	}
}

if(!function_exists('get_one'))
{
	function get_one($field,$table,$id='id',$value)
	{
		$CI =& get_instance();
		$result = $CI->db->getone('select '.$field.' from '.$table.' where '.$id.' = ?',$value);
		dbConvert($result);
		return $result;
	}
}

if(!function_exists('notify'))
{
	function js_notify()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('notify'))
		{
			$js = '<link rel="stylesheet" href="js/jquery.notifyBar.css" type="text/css" media="screen" />';
		    $js .= '<script type="text/javascript" src="js/jquery.notifyBar.js"></script>';
		    $js .= '<script type="text/javascript">
		    				$(function () {
						  		$.notifyBar({
						  			cls:"'.$CI->session->flashdata('type').'",
						    		html: "'.$CI->session->flashdata('msg').'",
						    		delay: 2000,
						    		animationSpeed: "normal"
						  		});
							});
						</script>';
			return $js;
		}
	}
}
//$type -> attention information success error
if(!function_exists('set_caution'))
{
	function set_caution($type,$msg,$selector=".block_content",$position="prepend")
	{
		$config = array(
			'caution' => TRUE,
			'type' => $type,
			'msg' => $msg,
			'position' => $position,
			'selector' => $selector
		);
		$CI =& get_instance();
		$CI->session->set_flashdata($config);
	}
}

if(!function_exists('caution'))
{
	function caution()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('caution'))
		{
		    $js = '<div class="notification '.$CI->session->flashdata('type').' png_bg"><div>'.$CI->session->flashdata('msg').'</div></div>';
			return $js;
		}
	}
}

if(!function_exists('js_caution'))
{
	function js_caution()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('caution'))
		{
		    $html = "<div class='notification ".$CI->session->flashdata('type')." png_bg'><div>".$CI->session->flashdata('msg')."</div></div>";
			$js = '<script type="text/javascript">
		    				$(function () {
						  		$("'.$CI->session->flashdata('selector').'").'.$CI->session->flashdata('position').'("'.$html.'")
							});
						</script>';
			return $js;
		}
	}
}

if(!function_exists('menu_active'))
{
	function menu_active($module,$controller = FALSE,$class='active')
	{
		$CI =& get_instance();
		if($controller)
		{
			return ($CI->router->fetch_module() == $module && $CI->router->fetch_class() == $controller) ? 'class='.$class : '';
		}
		else
		{
			return ($CI->router->fetch_module() == $module) ? 'class='.$class : '';
		}
	}
}

function cycle($key,$odd = 'odd',$even = '')
{
	return ($key&1) ? 'class="'.$even.'"' : 'class="'.$odd.'"';
}

function get_option($value,$text,$table,$where = FALSE,$order=FALSE)
{
	$CI =& get_instance();
	$order = ($order) ? ' order by '.$order : '';
	$where = ($where) ? ' where '.$where : '';
	$result = $CI->db->GetAssoc('select '.$value.','.$text.' from '.$table.' '.$where.$order);
	array_walk($result,'dbConvert');
	return $result;
}
function get_option1($value,$text,$table,$where = FALSE,$order=FALSE)
{
	$CI =& get_instance();
	$order = ($order) ? ' order by '.$order : '';
	$where = ($where) ? ' where '.$where : '';
	$result = $CI->db->GetAssoc('select '.$value.','.$text.' from '.$table.' '.$where.$order);
	array_walk($result,'dbConvert1');
	return $result;
}
function get_option_same($value, $table, $where = FALSE)
{
	$CI =& get_instance();
	$where = ($where) ? 'where '.$where : '';
	$result = $CI->db->GetArray('select '.$value.' from '.$table.' '.$where);
	array_walk($result,'dbConvert');
	$data = array();
	foreach($result as $item) $data[$item[$value]] = $item[$value];
	return $data;
}

function pagebreak($content){
	$break = '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
	return substr("$content",0,strpos($content,$break)+strlen($break));
	//return    strstr($content, '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>',TRUE); // for PHP 5.3.0
}

function getIP(){
    $ip = (getenv(HTTP_X_FORWARDED_FOR))
    ?  getenv(HTTP_X_FORWARDED_FOR)
    :  getenv(REMOTE_ADDR);
    return $ip;
}

function currency_rate($price)
{
	$CI =& get_instance();
	$CI->load->model('currency/currency_model');
	$currency = $CI->currency_model->get_active_rate($CI->session->userdata('currency'));
	return number_format(($price * $currency['rate']),2).' '.$currency['currency'];
}

// js syntaghighlight
function js_syntax()
{
	return '<script type="text/javascript" src="js/sysntaxhighilight/scripts/shCore.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushBash.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCpp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCSharp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCss.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushDelphi.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushDiff.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushGroovy.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushJava.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushJScript.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPhp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPlain.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPython.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushRuby.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushScala.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushSql.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushVb.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushXml.js"></script>
			<link type="text/css" rel="stylesheet" href="js/sysntaxhighilight/styles/shCore.css"/>
			<link type="text/css" rel="stylesheet" href="js/sysntaxhighilight/styles/shThemeDefault.css"/>
			<script type="text/javascript">
				SyntaxHighlighter.config.clipboardSwf = "js/sysntaxhighilight/scripts/clipboard.swf";
				SyntaxHighlighter.all();
			</script>';
}

function js_validate()
{
	return '<script type="text/javascript" src="js/jquery.validate.min.js"></script>';
}

function js_ckeditor()
{
	return '<script type="text/javascript" src="ckeditor/ckeditor.js"></script>';
}

function js_checkbox()
{
	$CI =& get_instance();
	return '<link rel="stylesheet" href="js/checkbox/jquery.checkbox.css" />
		<script type="text/javascript" src="js/checkbox/jquery.checkbox.min.js"></script>
		<script>
			$(function(){
				$("input:checkbox").checkbox({empty:"js/checkbox/empty.png"});
				$("input:checkbox").click(function(){
					var value = this.checked ? 0 : 1;
					$.post("'.$CI->router->fetch_module().'/admin/'.$CI->router->fetch_module().'/save",{id:this.value ,active:value});
				});
			});
		</script>';
}


if (!function_exists('json_encode'))
{
 function json_encode($a=false)
 {
 if (is_null($a)) return 'null';
 if ($a === false) return 'false';
 if ($a === true) return 'true';
 if (is_scalar($a))
 {
 if (is_float($a))
 {
 // Always use "." for floats.
 return floatval(str_replace(",", ".", strval($a)));
 }

 if (is_string($a))
 {
 static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
 return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
 }
 else
 return '"'.$a.'"';
 }
 $isList = true;
 for ($i = 0, reset($a); $i < count($a); $i++, next($a))
 {
 if (key($a) !== $i)
 {
 $isList = false;
 break;
 }
 }
 $result = array();
 if ($isList)
 {
 foreach ($a as $v) $result[] = json_encode($v);
 return '[' . join(',', $result) . ']';
 }
 else
 {
 foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
 return '{' . join(',', $result) . '}';
 }
 }
}

function dbConvert1(&$value,$key = null,$output='UTF-8')
{
	$encode = array('UTF-8'=>'TIS-620','TIS-620'=>'UTF-8');
	if(is_array($value))
	{
		$value = array_change_key_case($value);
		array_walk($value,'dbConvert1',$output);
	}
	else
	{
		$value = ThaiToUtf8($value);
	}
}
function dbConvert(&$value,$key = null,$output='UTF-8')
{
	$encode = array('UTF-8'=>'TIS-620','TIS-620'=>'UTF-8');
	if(is_array($value))
	{
		$value = array_change_key_case($value);
		array_walk($value,'dbConvert',$output);
	}
	else
	{
		@$value = iconv($encode[$output],$output,$value);
	}
}
function fix_file(&$files)
{
    $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

    foreach ($files as $key => $part) {
        // only deal with valid keys and multiple files
        $key = (string) $key;
        if (isset($names[$key]) && is_array($part)) {
            foreach ($part as $position => $value) {
                $files[$position][$key] = $value;
            }
            // remove old key reference
            unset($files[$key]);
        }
    }
}
function tis620_to_utf8($in) {
   $out = "";
   for ($i = 0; $i < strlen($in); $i++)
   {
     if (ord($in[$i]))
       $out .= $in[$i];
     else
       $out .= "&#" . (ord($in[$i]) - 161 + 3585) . ";";
   }
   return $out;
}

function ThaiToUtf8($string)
{
    if(false == preg_match('#[\241-\377]#i', $string))
    {
        return $string;
    }
    return strtr($string, array("\xa1" => "\xe0\xb8\x81",
                                "\xa2" => "\xe0\xb8\x82",
                                "\xa3" => "\xe0\xb8\x83",
                                "\xa4" => "\xe0\xb8\x84",
                                "\xa5" => "\xe0\xb8\x85",
                                "\xa6" => "\xe0\xb8\x86",
                                "\xa7" => "\xe0\xb8\x87",
                                "\xa8" => "\xe0\xb8\x88",
                                "\xa9" => "\xe0\xb8\x89",
                                "\xaa" => "\xe0\xb8\x8a",
                                "\xab" => "\xe0\xb8\x8b",
                                "\xac" => "\xe0\xb8\x8c",
                                "\xad" => "\xe0\xb8\x8d",
                                "\xae" => "\xe0\xb8\x8e",
                                "\xaf" => "\xe0\xb8\x8f",
                                "\xb0" => "\xe0\xb8\x90",
                                "\xb1" => "\xe0\xb8\x91",
                                "\xb2" => "\xe0\xb8\x92",
                                "\xb3" => "\xe0\xb8\x93",
                                "\xb4" => "\xe0\xb8\x94",
                                "\xb5" => "\xe0\xb8\x95",
                                "\xb6" => "\xe0\xb8\x96",
                                "\xb7" => "\xe0\xb8\x97",
                                "\xb8" => "\xe0\xb8\x98",
                                "\xb9" => "\xe0\xb8\x99",
                                "\xba" => "\xe0\xb8\x9a",
                                "\xbb" => "\xe0\xb8\x9b",
                                "\xbc" => "\xe0\xb8\x9c",
                                "\xbd" => "\xe0\xb8\x9d",
                                "\xbe" => "\xe0\xb8\x9e",
                                "\xbf" => "\xe0\xb8\x9f",
                                "\xc0" => "\xe0\xb8\xa0",
                                "\xc1" => "\xe0\xb8\xa1",
                                "\xc2" => "\xe0\xb8\xa2",
                                "\xc3" => "\xe0\xb8\xa3",
                                "\xc4" => "\xe0\xb8\xa4",
                                "\xc5" => "\xe0\xb8\xa5",
                                "\xc6" => "\xe0\xb8\xa6",
                                "\xc7" => "\xe0\xb8\xa7",
                                "\xc8" => "\xe0\xb8\xa8",
                                "\xc9" => "\xe0\xb8\xa9",
                                "\xca" => "\xe0\xb8\xaa",
                                "\xcb" => "\xe0\xb8\xab",
                                "\xcc" => "\xe0\xb8\xac",
                                "\xcd" => "\xe0\xb8\xad",
                                "\xce" => "\xe0\xb8\xae",
                                "\xcf" => "\xe0\xb8\xaf",
                                "\xd0" => "\xe0\xb8\xb0",
                                "\xd1" => "\xe0\xb8\xb1",
                                "\xd2" => "\xe0\xb8\xb2",
                                "\xd3" => "\xe0\xb8\xb3",
                                "\xd4" => "\xe0\xb8\xb4",
                                "\xd5" => "\xe0\xb8\xb5",
                                "\xd6" => "\xe0\xb8\xb6",
                                "\xd7" => "\xe0\xb8\xb7",
                                "\xd8" => "\xe0\xb8\xb8",
                                "\xd9" => "\xe0\xb8\xb9",
                                "\xda" => "\xe0\xb8\xba",
                                "\xdf" => "\xe0\xb8\xbf",
                                "\xe0" => "\xe0\xb9\x80",
                                "\xe1" => "\xe0\xb9\x81",
                                "\xe2" => "\xe0\xb9\x82",
                                "\xe3" => "\xe0\xb9\x83",
                                "\xe4" => "\xe0\xb9\x84",
                                "\xe5" => "\xe0\xb9\x85",
                                "\xe6" => "\xe0\xb9\x86",
                                "\xe7" => "\xe0\xb9\x87",
                                "\xe8" => "\xe0\xb9\x88",
                                "\xe9" => "\xe0\xb9\x89",
                                "\xea" => "\xe0\xb9\x8a",
                                "\xeb" => "\xe0\xb9\x8b",
                                "\xec" => "\xe0\xb9\x8c",
                                "\xed" => "\xe0\xb9\x8d",
                                "\xee" => "\xe0\xb9\x8e",
                                "\xef" => "\xe0\xb9\x8f",
                                "\xf0" => "\xe0\xb9\x90",
                                "\xf1" => "\xe0\xb9\x91",
                                "\xf2" => "\xe0\xb9\x92",
                                "\xf3" => "\xe0\xb9\x93",
                                "\xf4" => "\xe0\xb9\x94",
                                "\xf5" => "\xe0\xb9\x95",
                                "\xf6" => "\xe0\xb9\x96",
                                "\xf7" => "\xe0\xb9\x97",
                                "\xf8" => "\xe0\xb9\x98",
                                "\xf9" => "\xe0\xb9\x99",
                                "\xfa" => "\xe0\xb9\x9a",
                                "\xfb" => "\xe0\xb9\x9b"));
}

?>