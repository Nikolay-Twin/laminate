<script>
var tracer = true;
var position = <?=$position; ?>;
var active   = <?=$active; ?>;
</script> 
<div class="wrapper">        
    <div class="panel">        
        <a  title="<?=$title['stack']; ?>" href="#" 
        onclick="return visibleAllStacks()"><div class="button">☱<sup class="closed" id="closed_stack_<?=$uniq;?>">&nbsp;</sup></div></a>
        <a  title="<?=$title['editor']; ?>" href="#" 
        onclick="return swithEditor()"><div class="button">✎<sup class="closed" id="closed_edit_main">&nbsp;</sup></div></a>
        <div id="dbg" style="visibility:hidden">
            <a  title="<?=$title['position']; ?>" href="#" 
            onclick="return toPosition()"><div class="button">↳</div></a>
            <a  title="<?=$title['dbg']; ?>" href="#" 
            onclick="return addDbg()"><div class="button">⇴</div></a>
            <a  title="<?=$title['comment']; ?>" href="#" 
            onclick="return addComment()"><div class="button" style="font-size:14px;line-height:40px;">/**/</div></a>
            <br />
            <a  title="<?=$title['fix']; ?>" href="#" 
            onclick="return fixCode('<?=$rawFile ?>')"><div class="button" style="color:#ff7575">⚒</div></a>        
        </div>
    </div>   
    <div class="editor">  
        <div class="listing">
            <div id="total">
            <?=$params; ?>
            </div>

    <div id="edit" style="display:none">        
        <textarea id="code_main" name="code_main"><?=$fullScript;?></textarea>
    </div> 
        
        </div>               
    </div> 
</div>