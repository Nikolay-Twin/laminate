

        <tr class="trace">
            <td rowspan="2" class="num_stack">
                <?=$num;?>
            </td>
            <td style="border-right:none;width:23px"> 
<a name="sc_<?=$uniq;?>"></a>    
                <a href="#" onclick="return visibleBlock('<?=$uniq;?>')"><div class="button_steck"><div class="icon_steck">☈<sup class="closed" id="closed_total_<?=$uniq;?>">&nbsp;</sup></div></div></a>
            </td>
            <td style="border-left:none">  
                 <?=$action;?>()
            </td>
            <td>
                <?=$file;?> : 
                <?=$line;?> 
            </td>
        </tr>
        <tr id="called_<?=$uniq;?>" >
            <td colspan="6" class="called">
            <?=$called; ?>
            </td>
        </tr>  
        <tr style="display:none" id="total_<?=$uniq;?>">
            <td colspan="5" class="excerpt">
                <?=$total;?>
            </td>
        </tr>  
