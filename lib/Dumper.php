<?php
/**
 * TVarDumper class file
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.pradosoft.com/
 * @copyright Copyright &copy; 2005-2008 PradoSoft
 * @license http://www.pradosoft.com/license/
 * @version $Id$
 * @package System.Util
 */

/**
 * TVarDumper class.
 *
 * TVarDumper is intended to replace the buggy PHP function var_dump and print_r.
 * It can correctly identify the recursively referenced objects in a complex
 * object structure. It also has a recursive depth control to avoid indefinite
 * recursive display of some peculiar variables.
 *
 * TVarDumper can be used as follows,
 * <code>
 *   echo TVarDumper::dump($var);
 * </code>
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package System.Util
 * @since 3.0
 */
class Dumper
{
    private static $_objects;
    private static $_output;
    private static $_depth;
    public  static $_auto = <<<DUMP
<script type="text/javascript">
var jq_inj = document.createElement('script');
jq_inj.onload = function () {
jQuery.noConflict();
(function ($) {
jQuery("#dumper_dump").appendTo("body").css({
'position':'fixed',
'top':'0px',
'left':'0px',
'width':'100%',
'height':'100%',
'white-space':'pre',
'z-index':'99999999',
'margin':'0 auto',
'padding':'10px 0px',
'background':'#FFF',
'overflow':'auto'
}).wrapInner(
jQuery('<pre id="dumper_dump_inner"/>').css({
'width':'50%',
'margin':'20px 35%'
})
);
jQuery('<div id="dumper_dump_close"/>').on('click',function(e) {
jQuery("body").css("overflow","auto");
jQuery("#dumper_dump_reopen").fadeIn("fast");
jQuery("#dumper_dump").slideUp("fast");
}).css({
'position':'fixed',
'top':'10px',
'right':'30px',
'width':'23px',
'height':'23px',
'background-color':'rgb(0, 0, 0)',
'color':'rgb(255, 255, 255)',
'font-style':'normal',
'font-variant':'normal',
'font-weight':'normal',
'font-size':'20px',
'line-height':'20px',
'font-family':'Verdana',
'vertical-align':'middle',
'text-align':'center',
'font-weight':'bold',
'border-radius':'100%',
'cursor':'pointer'
}).html('&#215;').appendTo("#dumper_dump");

jQuery('<div id="dumper_dump_reopen"/>').on('click',function(e) {
jQuery("body").css("overflow","hidden");
jQuery("#dumper_dump_reopen").fadeOut("fast");
jQuery("#dumper_dump").slideDown("fast");
}).css({
'position':'fixed',
'top':'10px',
'right':'30px',
'width':'23px',
'height':'23px',
'background-color':'rgb(0, 0, 0)',
'color':'rgb(255, 255, 255)',
'font-style':'normal',
'font-variant':'normal',
'font-weight':'normal',
'font-size':'20px',
'line-height':'20px',
'font-family':'Verdana',
'vertical-align':'middle',
'text-align':'center',
'font-weight':'bold',
'border-radius':'100%',
'cursor':'pointer'
}).html('&#x25BC;').appendTo("body");

jQuery("body").css("overflow","hidden");
jQuery("#dumper_dump_reopen").fadeOut("fast");
jQuery("#dumper_dump").slideDown("fast");
})(jQuery);
};
if (typeof(jQuery) === typeof(undefined_var)) {
jq_inj.setAttribute("src", "http://code.jquery.com/jquery-2.1.0.min.js");
var jq_body = document.getElementsByTagName("body")[0];
jq_body.appendChild(jq_inj);
} else {
jQuery(jq_inj).trigger("load");
}
</script>
DUMP;

    /**
     * Converts a variable into a string representation.
     * This method achieves the similar functionality as var_dump and print_r
     * but is more robust when handling complex objects such as PRADO controls.
     * @param mixed variable to be dumped
     * @param integer maximum depth that the dumper should go into the variable. Defaults to 10.
     * @return string the string representation of the variable
     */
    public static function dump($var,$depth=10,$highlight=false)
    {
        self::$_output='';
        self::$_objects=array();
        self::$_depth=$depth;
        self::dumpInternal($var,0);
        if($highlight)
        {
            $result=highlight_string("<?php\n".self::$_output,true);
            return preg_replace('/&lt;\\?php<br \\/>/','',$result,1);
        }
        else
            return self::$_output;
    }

    public static function auto($var) {
        $args = func_get_args();
        $retval = '<div id="dumper_dump">';
        if(func_num_args()==1) {
            $retval.= self::dump($var);
        } else {
            foreach($args as $arg) {
                $retval.=self::dump($arg).PHP_EOL.PHP_EOL;
            }
        }
        $retval.= '</div>' . self::$_auto;
        return $retval;
    }

    private static function dumpInternal($var,$level)
    {
        switch(gettype($var))
        {
            case 'boolean':
                self::$_output.=$var?'true':'false';
                break;
            case 'integer':
                self::$_output.="$var";
                break;
            case 'double':
                self::$_output.="$var";
                break;
            case 'string':
                self::$_output.="'$var'";
                break;
            case 'resource':
                self::$_output.='{resource}';
                break;
            case 'NULL':
                self::$_output.="null";
                break;
            case 'unknown type':
                self::$_output.='{unknown}';
                break;
            case 'array':
                if(self::$_depth<=$level)
                    self::$_output.='array(...)';
                else if(empty($var))
                    self::$_output.='array()';
                else
                {
                    $keys=array_keys($var);
                    $spaces=str_repeat(' ',$level*4);
                    self::$_output.="array\n".$spaces.'(';
                    foreach($keys as $key)
                    {
                        self::$_output.="\n".$spaces."    [$key] => ";
                        self::$_output.=self::dumpInternal($var[$key],$level+1);
                    }
                    self::$_output.="\n".$spaces.')';
                }
                break;
            case 'object':
                if(($id=array_search($var,self::$_objects,true))!==false)
                    self::$_output.=get_class($var).'#'.($id+1).'(...)';
                else if(self::$_depth<=$level)
                    self::$_output.=get_class($var).'(...)';
                else
                {
                    $id=array_push(self::$_objects,$var);
                    $className=get_class($var);
                    $members=(array)$var;
                    $keys=array_keys($members);
                    $spaces=str_repeat(' ',$level*4);
                    self::$_output.="$className#$id\n".$spaces.'(';
                    foreach($keys as $key)
                    {
                        $keyDisplay=strtr(trim($key),array("\0"=>':'));
                        self::$_output.="\n".$spaces."    [$keyDisplay] => ";
                        self::$_output.=self::dumpInternal($members[$key],$level+1);
                    }
                    self::$_output.="\n".$spaces.')';
                }
                break;
        }
    }
}
