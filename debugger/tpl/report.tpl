<div class="dedugger" id="dedug">
    <div class="level" >
        <?=$level;?>
    </div>
    <div class="mess">
        <?=$message;?>
<?php if ($adds) { ?>
        <br />
        <span class="location">in:</span> <?=$file;?>
        <span class="location">on line:</span> <?=$line;?>
<?php } ?>
    </div> 
        <?=$listing;?> 
<?php if (empty($stack)) { ?>
    <div class="callstack">
    </div>
<?php } else { ?>
        <?=$stack;?> 
<?php } ?>        
</div> 

