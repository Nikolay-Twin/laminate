<div class="wrapper">        
        <div class="panel">
<?php if(empty($fatal)){ ?>
            <a  title="<?=$title['arguments']; ?>" href="#" 
            onclick="return visibleArg('<?=$uniq;?>')"><div class="button">➥<sup class="closed" id="closed_arg_<?=$uniq;?>">&nbsp;</sup></div></a>
            <a  title="<?=$title['stack']; ?>" href="#" 
            onclick="return visibleAllStacks()"><div class="button">☱<sup class="closed" id="closed_stack_<?=$uniq;?>">&nbsp;</sup></div></a>
<?php } ?>

<?php if($uniq == 'main'){ ?>
            <a  title="<?=$title['position']; ?>" href="#" 
            onclick="return toPosition()"><div class="button">↳</div></a>
            <a  title="<?=$title['dbg']; ?>" href="#" 
            onclick="return addDbg()"><div class="button">⇴</div></a>
    <?php if(empty($fatal)){ ?>
            <a  title="<?=$title['comment']; ?>" href="#" 
            onclick="return addComment()"><div class="button" style="font-size:14px;line-height:40px;">/**/</div></a>
            
    <?php } ?>
    <br />
            <a  title="<?=$title['fix']; ?>" href="#" 
            onclick="return fixCode('<?=$rawFile ?>')"><div class="button" style="color:#ff7575">⚒</div></a>
<?php } ?>
        </div>            

        <div class="editor"> 
            <div class="code_value" >
                <div style="display:none" id="arg_<?=$uniq;?>">
<?=$params; ?>
                </div>
                <div  class="listing" id="lst_<?=$uniq;?>">    
<?php if($uniq == 'main'){ ?>  
<script>
var tracer = false;
var position = <?=$position; ?>;
var active   = <?=$active; ?>;
</script>  
                    <div id="edit" style="display:none">        
                        <textarea id="code_<?=$uniq;?>" name="code_<?=$uniq;?>"><?=$fullScript;?></textarea>
                    </div> 
<?php } else {?>
                    <div class="num">
                        <code><?=$lines;?></code>
                    </div>
    
                    <div class="code">
                        <code><?=$total;?></code> 
                    </div>
                    <div class="clear"></div>  
<?php } ?>                             
                </div> 
            </div>    
        </div>
</div>
   