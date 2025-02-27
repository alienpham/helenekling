/**
* @package      jelix
* @subpackage   forms
* @author       Laurent Jouanneau
* @contributor  Julien Issler, Dominique Papin
* @copyright    2007-2008 Laurent Jouanneau
* @copyright    2008 Julien Issler, 2008 Dominique Papin
* @link         http://www.jelix.org
* @licence      GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/*
usage :

jForms.tForm = new jFormsForm('name');                         // create a form descriptor
jForms.tForm.setErrorDecorator(new jFormsErrorDecoratorAlert());    // declare an error handler

// declare a form control
var c = new jFormsControl('name', 'a label', 'datatype');
c.required = true;
c.errInvalid='';
c.errRequired='';
jForms.tForm.addControl(c);
...

// declare the form now. A 'submit" event handler will be attached to the corresponding form element
jForms.declareForm(jForms.tForm);

*/

/**
 * form manager
 */
var jForms = {
    _forms: {},

    tForm: null,
    frmElt: null,

    declareForm : function(aForm){
        this._forms[aForm.name]=aForm;
        if(window.jQuery)
            jQuery('#'+aForm.name).bind('submit',function (ev) { jQuery(ev.target).trigger('jFormsUpdateFields'); return jForms.verifyForm(ev.target); });
        else{
            var elem = document.getElementById(aForm.name);
            if (elem.addEventListener) {
                elem.addEventListener("submit", function (ev) { if(!jForms.verifyForm(elem)) {ev.preventDefault(); ev.stopPropagation(); return false;} return true; }, false);
            } else if (elem.attachEvent) {
                elem.attachEvent("onsubmit", function (ev) { if(!jForms.verifyForm(elem)) { window.event.cancelBubble = true ; window.event.returnValue = false; return false;} return true;});
            }
        }
    },

    getForm : function (name) {
        return this._forms[name];
    },

    verifyForm : function(frmElt){
        this.tForm = this._forms[frmElt.attributes.getNamedItem("id").value]; // we cannot use getAttribute for id because a bug with IE
        this.frmElt = frmElt;
        var msg = '';
        var valid = true;
        this.tForm.errorDecorator.start();
        for(var i =0; i < this.tForm.controls.length; i++){
            var c = this.tForm.controls[i];
            if(typeof c.getValue == 'function')
                var val = c.getValue();
            else{
                var elt = frmElt.elements[c.name];
                if (!elt) continue; // sometimes, all controls are not generated...
                var val = this.getValue(elt);
            }
            if(val === null || val === false){ 
                if(c.required){
                    this.tForm.errorDecorator.addError(c, 1);
                    valid = false;
                }
            }else{
                if(!c.check(val, this)){
                    this.tForm.errorDecorator.addError(c, 2);
                    valid = false;
                }
            }
        }
        if(!valid)
            this.tForm.errorDecorator.end();
        return valid;
    },

    trim : function (str) {
        if(str.replace)
            return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
        else return str;
    },

    getValue : function (elt){
        if(elt.nodeType) { // this is a node
            switch (elt.nodeName.toLowerCase()) {
                case "input":
                    if(elt.getAttribute('type') == 'checkbox')
                        return elt.checked;
                case "textarea":
                    var val = this.trim(elt.value);
                    return val!==''?val:null; 
                case "select":
                    if (!elt.multiple)
                        return (elt.value!==''?elt.value:null);
                    var values = [];
                    for (var i = 0; i < elt.options.length; i++) {
                        if (elt.options[i].selected)
                            values.push(elt.options[i].value);
                    }
                    if(values.length) 
                        return values; 
                    return null;
            }
        } else if(elt.item){
            // this is a NodeList of radio buttons or multiple checkboxes
            var values = [];
            for (var i = 0; i < elt.length; i++) {
                var item = elt.item(i);
                if (item.checked)
                    values.push(item.value);
            }
            if(values.length) {
                if (elt.item(0).getAttribute('type') == 'radio')
                    return values[0];
                return values; 
            }
        }
        return null;
    },

    showHelp : function(aFormName, aControlName){
        var frm = this._forms[aFormName];
        var ctrls = frm.controls;
        var ctrl = null;
        for(var i=0; i < ctrls.length; i++){
            if (ctrls[i].name == aControlName) {
                ctrl = ctrls[i];
                break;
            }
            if (ctrls[i].confirmField &&  ctrls[i].confirmField.name == aControlName) {
                ctrl = ctrls[i].confirmField;
                break;
            }
        }
        if (ctrl) {
            frm.helpDecorator.show(ctrl.help);
        }
    },

    hasClass: function (elt,clss) {
        return elt.className.match(new RegExp('(\\s|^)'+clss+'(\\s|$)'));
    },
    addClass: function (elt,clss) {
        if (this.isCollection(elt)) {
            for(var j=0; j<elt.length;j++) {
                if (!this.hasClass(elt[j],clss)) {
                    elt[j].className += " "+clss;
                }
            }
        } else {
            if (!this.hasClass(elt,clss)) {
                elt.className += " "+clss;
            }
        }
    },
    removeClass: function (elt,clss) {
        if (this.isCollection(elt)) {
            for(var j=0; j<elt.length;j++) {
                if (this.hasClass(elt[j],clss)) {
                    elt[j].className = elt[j].className.replace(new RegExp('(\\s|^)'+clss+'(\\s|$)'),' ');
                }
            }
        } else {
            if (this.hasClass(elt,clss)) {
                elt.className = elt.className.replace(new RegExp('(\\s|^)'+clss+'(\\s|$)'),' ');
            }
        }
    },
    setAttribute: function(elt, name, value){
        if (this.isCollection(elt)) {
            for(var j=0; j<elt.length;j++) {
                elt[j].setAttribute(name, value);
            }
        } else {
            elt.setAttribute(name, value);
        }
    },
    removeAttribute: function(elt, name){
        if (this.isCollection(elt)) {
            for(var j=0; j<elt.length;j++) {
                elt[j].removeAttribute(name);
            }
        } else {
            elt.removeAttribute(name);
        }
    },
    isCollection: function(elt) {
        if (elt instanceof NodeList || elt instanceof HTMLCollection || elt instanceof Array)
            return true;
        if (elt.length != undefined && !(elt.localName != undefined && (elt.localName != 'SELECT' || elt.localName != 'select')))
            return true;
        return false;
    }
};

/**
 * represents a form
 */
function jFormsForm(name){
    this.name = name;
    this.controls = [];
    this.errorDecorator =  new jFormsErrorDecoratorAlert();
    this.helpDecorator =  new jFormsHelpDecoratorAlert();
};

jFormsForm.prototype={
    addControl : function(ctrl){
        this.controls.push(ctrl);
        ctrl.formName = this.name;
    },

    setErrorDecorator : function (decorator){
        this.errorDecorator = decorator;
    },

    setHelpDecorator : function (decorator){
        this.helpDecorator = decorator;
    },
    getControl : function(aControlName) {
        var ctrls = this.controls;
        for(var i=0; i < ctrls.length; i++){
            if (ctrls[i].name == aControlName) {
                return ctrls[i];
            }
        }
        return null;
    }
};


/**
 * control with string
 */
function jFormsControlString(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.minLength = -1;
    this.maxLength = -1;
};
jFormsControlString.prototype.check = function (val, jfrm) {
    if(this.minLength != -1 && val.length < this.minLength)
        return false;
    if(this.maxLength != -1 && val.length > this.maxLength)
        return false;
    return true;
};

/**
 * control for secret input
 */
function jFormsControlSecret(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.minLength = -1;
    this.maxLength = -1;
};
jFormsControlSecret.prototype.check = function (val, jfrm) {
    if(this.minLength != -1 && val.length < this.minLength)
        return false;
    if(this.maxLength != -1 && val.length > this.maxLength)
        return false;
    return true;
};

/**
 * confirm control
 */
function jFormsControlConfirm(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this._masterControl = name.replace(/_confirm$/,'');
};
jFormsControlConfirm.prototype.check = function(val, jfrm) {
    if(jfrm.getValue(jfrm.frmElt.elements[this._masterControl]) !== val)
        return false;
    return true;
};

/**
 * control with boolean
 */
function jFormsControlBoolean(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlBoolean.prototype.check = function (val, jfrm) {
    return (val == true || val == false);
};

/**
 * control with Decimal
 */
function jFormsControlDecimal(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlDecimal.prototype.check = function (val, jfrm) {
    return ( -1 != val.search(/^\s*[\+\-]?\d+(\.\d+)?\s*$/));
};

/**
 * control with Integer
 */
function jFormsControlInteger(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlInteger.prototype.check = function (val, jfrm) {
    return ( -1 != val.search(/^\s*[\+\-]?\d+\s*$/));
};

/**
 * control with Hexadecimal
 */
function jFormsControlHexadecimal(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlHexadecimal.prototype.check = function (val, jfrm) {
  return (val.search(/^0x[a-f0-9A-F]+$/) != -1);
};

/**
 * control with Datetime
 */
function jFormsControlDatetime(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.minDate = null;
    this.maxDate = null;
    this.multiFields = false;
};
jFormsControlDatetime.prototype.check = function (val, jfrm) {
    var t = val.match(/^(\d{4})\-(\d{2})\-(\d{2}) (\d{2}):(\d{2})(:(\d{2}))?$/);
    if(t == null) return false;
    var yy = parseInt(t[1],10);
    var mm = parseInt(t[2],10) -1;
    var dd = parseInt(t[3],10);
    var th = parseInt(t[4],10);
    var tm = parseInt(t[5],10);
    var ts = 0;
    if(t[7] != null)
        ts = parseInt(t[7],10);
    var dt = new Date(yy,mm,dd,th,tm,ts);
    if(yy != dt.getFullYear() || mm != dt.getMonth() || dd != dt.getDate() || th != dt.getHours() || tm != dt.getMinutes() || ts != dt.getSeconds())
        return false;
    else if((this.minDate !== null && val < this.minDate) || (this.maxDate !== null && val > this.maxDate))
        return false;
    return true;
};
jFormsControlDatetime.prototype.getValue = function(){
    if(!this.multiFields){ 
	var val = document.getElementById(this.formName+'_'+this.name).value.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
	return val!==''?val:null; 
    } 
    var controlId = this.formName+'_'+this.name;
    var v = document.getElementById(controlId+'_year').value + '-'
        + document.getElementById(controlId+'_month').value + '-'
        + document.getElementById(controlId+'_day').value + ' '
        + document.getElementById(controlId+'_hour').value + ':'
        + document.getElementById(controlId+'_minutes').value;

    var secondsControl = document.getElementById(this.formName+'_'+this.name+'_seconds');
    if(secondsControl.getAttribute('type') !== 'hidden'){
        v += ':'+secondsControl.value;
        if(v == '-- ::')
            return null;
    }
    else if(v == '-- :')
        return null;
    return v;
};

/**
 * control with Date
 */
function jFormsControlDate(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.multiFields = false;
    this.minDate = null;
    this.maxDate = null;
};
jFormsControlDate.prototype.check = function (val, jfrm) {
    var t = val.match(/^(\d{4})\-(\d{2})\-(\d{2})$/);
    if(t == null) return false;
    var yy = parseInt(t[1],10);
    var mm = parseInt(t[2],10) -1;
    var dd = parseInt(t[3],10);
    var dt = new Date(yy,mm,dd,0,0,0);
    if(yy != dt.getFullYear() || mm != dt.getMonth() || dd != dt.getDate())
        return false;
    else if((this.minDate !== null && val < this.minDate) || (this.maxDate !== null && val > this.maxDate))
        return false;
    return true;
};
jFormsControlDate.prototype.getValue = function(){
    if(!this.multiFields){ 
	var val = document.getElementById(this.formName+'_'+this.name).value.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
	return val!==''?val:null; 
    } 

    var controlId = this.formName+'_'+this.name;
    var v = document.getElementById(controlId+'_year').value + '-'
        + document.getElementById(controlId+'_month').value + '-'
        + document.getElementById(controlId+'_day').value;
    if(v == '--')
        return null;
    return v;
};

/**
 * control with time
 */
function jFormsControlTime(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlTime.prototype.check = function (val, jfrm) {
    var t = val.match(/^(\d{2}):(\d{2})(:(\d{2}))?$/);
    if(t == null) return false;
    var th = parseInt(t[1],10);
    var tm = parseInt(t[2],10);
    var ts = 0;
    if(t[4] != null)
        ts = parseInt(t[4],10);
    var dt = new Date(2007,05,02,th,tm,ts);
    if(th != dt.getHours() || tm != dt.getMinutes() || ts != dt.getSeconds())
        return false;
    else
        return true;
};

/**
 * control with LocaleDateTime
 */
function jFormsControlLocaleDatetime(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.lang='';
};
jFormsControlLocaleDatetime.prototype.check = function (val, jfrm) {
    var yy, mm, dd, th, tm, ts;
    if(this.lang.indexOf('fr_') == 0) {
        var t = val.match(/^(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})(:(\d{2}))?$/);
        if(t == null) return false;
        yy = parseInt(t[3],10);
        mm = parseInt(t[2],10) -1;
        dd = parseInt(t[1],10);
        th = parseInt(t[4],10);
        tm = parseInt(t[5],10);
        ts = 0;
        if(t[7] != null)
            ts = parseInt(t[7],10);
    }else{
        //default is en_* format
        var t = val.match(/^(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})(:(\d{2}))?$/);
        if(t == null) return false;
        yy = parseInt(t[3],10);
        mm = parseInt(t[1],10) -1;
        dd = parseInt(t[2],10);
        th = parseInt(t[4],10);
        tm = parseInt(t[5],10);
        ts = 0;
        if(t[7] != null)
            ts = parseInt(t[7],10);
    }
    var dt = new Date(yy,mm,dd,th,tm,ts);
    if(yy != dt.getFullYear() || mm != dt.getMonth() || dd != dt.getDate() || th != dt.getHours() || tm != dt.getMinutes() || ts != dt.getSeconds())
        return false;
    else
        return true;
};

/**
 * control with localedate
 */
function jFormsControlLocaleDate(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.lang='';
};
jFormsControlLocaleDate.prototype.check = function (val, jfrm) {
    var yy, mm, dd;
    if(this.lang.indexOf('fr_') == 0) {
        var t = val.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if(t == null) return false;
        yy = parseInt(t[3],10);
        mm = parseInt(t[2],10) -1;
        dd = parseInt(t[1],10);
    }else{
        //default is en_* format
        var t = val.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if(t == null) return false;
        yy = parseInt(t[3],10);
        mm = parseInt(t[1],10) -1;
        dd = parseInt(t[2],10);
    }
    var dt = new Date(yy,mm,dd,0,0,0);
    if(yy != dt.getFullYear() || mm != dt.getMonth() || dd != dt.getDate())
        return false;
    else
        return true;
};

/**
 * control with Url
 */
function jFormsControlUrl(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlUrl.prototype.check = function (val, jfrm) {
    return (val.search(/^[a-z]+:\/\/((((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))((\/)|$)/) != -1);
};

/**
 * control with email
 */
function jFormsControlEmail(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlEmail.prototype.check = function (val, jfrm) {
    return (val.search(/^((\"[^\"f\n\r\t\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/) != -1);
};


/**
 * control with ipv4
 */
function jFormsControlIpv4(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlIpv4.prototype.check = function (val, jfrm) {
    var t = val.match(/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/);
    if(t)
        return (t[1] > 255 || t[2] > 255 || t[3] > 255 || t[4] > 255);
    return false;
};

/**
 * control with ipv6
 */
function jFormsControlIpv6(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
};
jFormsControlIpv6.prototype.check = function (val, jfrm) {
    return (val.search(/^([a-f0-9]{1,4})(:([a-f0-9]{1,4})){7}$/i) != -1);
};

/**
 * choice control
 */
function jFormsControlChoice(name, label) {
    this.name = name;
    this.label = label;
    this.required = false;
    this.errInvalid = '';
    this.errRequired = '';
    this.help='';
    this.items = {};
};
jFormsControlChoice.prototype = {
    addControl : function (ctrl, itemValue) {
        if(this.items[itemValue] == undefined)
            this.items[itemValue] = [];
        this.items[itemValue].push(ctrl);
    },
    check : function (val, jfrm) {
        if(this.items[val] == undefined)
            return false;

        var list = this.items[val];
        var valid = true;
        for(var i=0; i < list.length; i++) {
            var val2 = jfrm.getValue(jfrm.frmElt.elements[list[i].name]);

            if (val2 == '') {
                if (list[i].required) {
                    jfrm.tForm.errorDecorator.addError(list[i], 1);
                    valid = false;
                }
            } else if (!list[i].check(val2, jfrm)) {
                jfrm.tForm.errorDecorator.addError(list[i], 2);
                valid = false;
            }
        }
        return valid;
    },
    activate : function (val) {
        var frmElt = document.getElementById(this.formName);
        for(var j in this.items) {
            var list = this.items[j];
            for(var i=0; i < list.length; i++) {
                var elt = frmElt.elements[list[i].name];
                if (val == j) {
                    jForms.removeAttribute(elt, "readonly");
                    jForms.removeClass(elt, "jforms-readonly");
                } else {
                    jForms.setAttribute(elt, "readonly", "readonly");
                    jForms.addClass(elt, "jforms-readonly");
                }
            }
        }
    }
};

/**
 * Decorator to display errors in an alert dialog box
 */
function jFormsErrorDecoratorAlert(){
    this.message = '';
};

jFormsErrorDecoratorAlert.prototype = {
    start : function(){
        this.message = '';
    },
    addError : function(control, messageType){
        if(messageType == 1){
            this.message  +="* "+control.errRequired + "\n";
        }else if(messageType == 2){
            this.message  +="* "+control.errInvalid + "\n";
        }else{
            this.message  += "* Error on '"+control.label+"' field\n";
        }
    },
    end : function(){
        if(this.message != ''){
            alert(this.message);
        }
    }
};


/**
 * Decorator to display help messages in an alert dialog box
 */
function jFormsHelpDecoratorAlert() {

};
jFormsHelpDecoratorAlert.prototype = {
    show : function( message){
        alert(message);
    }
};
