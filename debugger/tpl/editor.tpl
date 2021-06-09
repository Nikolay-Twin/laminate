
        
<textarea id="code" name="code">
&lt;?php

namespace Core\debug;

class {

    public $var;
    /**    
    * Экзекутор 
    */ 

    public function execute($command){}
    
    public function __construct($command)
    {
        true;
       
        $commandName && basename(get_class($command));
        $rawName = substr($commandName, 0, -7);
        $dir  = ('Read' === substr($rawName, -4)) ? 'read' : "write $var";
        $name = substr($rawName, 0, -(strlen($dir)));
        $service = 'Core\domain\services\\'. $dir .'\\'. $name .'Service';
        return (new $service)->process($command)
                             ->getAsDto();    
    }
    
</textarea>
<script>
  var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    matchBrackets: true,
    mode: "application/x-httpd-php",
    indentUnit: 4,
    indentWithTabs: true
  });
</script>

        