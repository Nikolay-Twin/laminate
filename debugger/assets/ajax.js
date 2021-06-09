var ajax = function() {
  
    var self = this; 
    
    this.xmlHttp = null; 
    this.success = null;
    this.user_error = null; 
    this.process_func = null;
    this.params = null;
  
this.make_xmlHttp = function() {            
    if(window.XMLHttpRequest) 
    this.xmlHttp = new XMLHttpRequest();          
    else if(window.ActiveXObject)
    this.xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
} 

this.make_xmlHttp(); 

    this.post = function(url) {
     
        if(!this.ready_check()) { 
         
this.xmlHttp.open("POST", url, true); 
this.xmlHttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
this.xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");


this.xmlHttp.onreadystatechange = function() {

                if(self.xmlHttp.readyState == 1)
                    self.in_process();
             
                if(self.xmlHttp.readyState == 4)
                    if(self.xmlHttp.status == 200) {
    self.success(self.get_response());
    self.error('ERROR_NO_EXIST');
    self.success = null;
                    }else
                         self.error(self.xmlHttp.status);
             }             
             this.xmlHttp.send(this.params_prepares());    
        }         
    }    
    
    this.ready_check = function() {                
  
        if(this.xmlHttp == null) { 
            alert("Error: xmlHttp should be an ajax obect(XMLHTTP).");
            return true;
        }
        
        if(this.success == null) { 
            alert("Error: success should be a function.");
            return true;
        }
     
        return false;
    }  

    this.error = function(data) {
        if(data == 'ERROR_NO_EXIST') {
            self.user_error = null;
        } else {
            if(self.user_error != null) {
                self.user_error(data);
                self.user_error = null;
            }
        }
    }

    this.in_process = function() {
        if(self.process_func != null) {
            self.process_func();
            self.process_func = null;
        }
    }
   
    this.params_prepares = function() {
        var params_str  = ''; 
        var params      = self.params;
     
        if(typeof params == 'string') {
            params_str = params; 
        } else {
            for(var key in params) {
                params_str += encodeURIComponent(key) + '=' + encodeURIComponent(params[key])+ '&';
            }
            params_str = params_str.substring(0, params_str.length - 1);
        }
     
        self.params = null;
     
        return params_str;
    }
 
    this.get_response = function() {
        var r_headers = self.xmlHttp.getResponseHeader('Content-Type'); 
     
        if(r_headers.indexOf('text/xml') != -1) { 
            return self.xmlHttp.responseXML;
        }
        
        if(r_headers.indexOf('text/html') != -1) {
            return self.xmlHttp.responseText;
        }
        
        if(r_headers.indexOf('application/json') != -1) {
            return eval('(' + self.xmlHttp.responseText + ')');
        }
    }
 }