    var editor;    
    var ajax = new ajax();
    var t;

    function ge(id) {return window.document.getElementById(id);}
    function gec(className) {return window.document.getElementsByClassName(className);}
    function dpn(id) {return ge(id).style.display == 'none';}
    function change(id, style) {ge(id).style.display = style;}
    function closed(id, opn) {ge('closed_' + id).innerHTML = (opn) ? '&nbsp;' : '✘';}

    function fixCode(file) {
        
        ajax.params = {
            'filea1b01e734b': file,
            'codea1b01e734b': editor.getValue(),
            'debuga1b01e734b' : true
        }
     
        ajax.success = function(data) {
            if (data == 'oka1b01e734b') {
                location.href = uri;
            } else if(data == 'dataa1b01e734b') {
                alert('There was a problem with data transfer.');
            } else if(data == 'filea1b01e734b') {
                alert('There was a problem rewriting the file.');
            } 
        }
     
        ajax.user_error = function(data) {
            alert("Problem! \n\n" + data);
        }
     
        ajax.post(uri);
        return false;
    }
    
    function scrollToBottom() 
    {
        if((window.innerHeight + window.pageYOffset) < document.documentElement.scrollHeight) 
        { 
            window.scrollBy(0, 20); 
            t = setTimeout('scrollToBottom()', 10);
        } else {
            clearTimeout(t);
        }    
        return false;
    }
    
    function scrollToTop() {
        var top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        if(top > 0) {
            window.scrollBy(0,-20);
            t = setTimeout('scrollToTop()', 20);
        } else {
            clearTimeout(t);
        }
        return false;
    } 
   
    window.onload = function(){editor()}
    
    var edt = true;
    function swithEditor()
    {
        if (dpn('edit')) {
            change('edit', 'block');
            change('total', 'none') ;        
            ge('dbg').style.visibility = 'visible';
            tracer = false;
            if (edt) {
                editor();
                edt = false;
            }
        } else {
            change('edit', 'none');
            change('total', 'block') ;
            ge('dbg').style.visibility = 'hidden';
        }
        closed('edit_main', dpn('edit'));
        
        return false;
    }
   
    function addDbg()
    {
        var text = editor.getSelection();
        var semicolon = (text == '') ? ';' : '';
        text = 'dbg(' + text + ')' + semicolon;
        editor.replaceSelection(text);
        return false;
    }    
 
    function addComment()
    {
        var text = editor.getSelection();
        text = '/* ' + text + ' */';
        editor.replaceSelection(text);
        return false;
    }  
    
    function editor()
    {
        if (tracer) {
            return false;
        }
        
        ge('edit').style.display = 'block';

        editor = CodeMirror.fromTextArea(ge("code_main"), {
                    lineNumbers: true,
                    matchBrackets: true,
                    mode: "application/x-httpd-php",
                    indentUnit: 4,
                    indentWithTabs: true
                });
     
        return toPosition();
    }

    function toPosition()
    {
        var Y = position * 18;
        gec("CodeMirror-scroll")[0].scrollTo(0, 0);
        gec("CodeMirror-scroll")[0].scrollBy(0, Y);
        var tm = setInterval(function(){
                ge('eltid_' + active).parentNode.parentNode.style.background = '#423f1d';
                ge('eltid_' + active).style.color = '#ffff00';
                ge('eltid_' + active).style.background = '#ff0000';
                clearInterval(tm);
        }, 200);
       
        return false;
    }    
    
    
    var opend = true;
    function visibleAllStacks()
    {   
        var blocks = JSON.parse(uniqs); 
        blocks.forEach(function(item, i, arr){
         
            if (item != 'main') {
                if (opend) {
                    change('total_'  + item, 'table-row');
                    change('called_' + item, 'none') ;
                    closed('total_'  + item, false);
                    closed('stack_'  + item, false);
                    scrollToBottom();
                } else {
                    scrollToTop();
                    change('total_'  + item, 'none');
                    change('called_' + item, 'table-row') ;
                    closed('total_'  + item, true);
                    closed('stack_'  + item, true);
                }
            }
        });
        
        opend = (opend == false);
        closed('stack_main', opend);
        return false;
    }
    
    function visibleBlock(id)
    {
        var block = 'total_'  + id,
            call  = 'called_' + id;
     
        if (dpn(block)) {
            change(block, 'table-row');
            change(call, 'none') ;
        } else {
            change(block, 'none');
            change(call, 'table-row') ;
        }
        location.href = '#sc_' + id;
        closed(block, dpn(block));
        
        return false;
    }
    
    function visibleArg(id)
    {
        var arg = 'arg_' + id,
            lst = 'lst_' + id;
            
        if (dpn(arg)) {
            change(arg, 'block');
            change(lst, 'none') ;
        } else {
            change(arg, 'none');
            change(lst, 'block') ;
        }
        
        closed(arg, dpn(arg));
        
        return false;
    }
    
