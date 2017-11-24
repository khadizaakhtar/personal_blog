/*  JsVal - prototype field validation framework
 *   - Rodrigo Yañez
 *
 *  JsVal is freely distributable under the terms of an MIT-style license. (http://www.opensource.org/licenses/mit-license.php)
 *  For details, see the JsVal web site: http://code.google.com/p/jsval/
 *
 *  Created on December 2007.
 *--------------------------------------------------------------------------*/

var JsVal = Object.extend(Enumerable,
{
    validators: [],
    pageIsValid: true,
    
    alertError: null,
    joinMessages: true,
    onValidatorActivated: function(validator){/*this.alertError(validator.message);*/},        
    onValidatorDeactivated: function(validator){},
        
    _each: function(iterator)
    {
        this.validators._each(iterator);
    },

    register: function(validator)
    {
        this.validators[this.validators.length] = validator;
    },
    
    validate: function(group)
    {
        var activated = this.select(function(validator)
        {
            return this.groupMatch(group, validator) && !validator.validate(false);
        }.bind(this));

        if(activated.length > 0)
        {
             (this.alertError || alert)(this.joinMessages ? activated.pluck("message").join("\n") : activated);
        }
     
        return activated.length == 0;
    },
    
    reset: function(group)
    {
        this.validators.each(function(validator)
        {
            if (group == null || this.groupMatch(group, validator))
            {
                validator.reset();
            }
        }.bind(this));
    },
    
    groupMatch: function(group, validator)
    {
        return group == validator.group;
    }
});

JsVal.BaseValidator = Class.create(
{
    setup: function(options)
    {
        Object.extend(this, Object.extend(
        {
            errorSpan: null,
            //messageSpan: null,
            message: "",
            input: null,
            regex: null,
            onvalidate: null,
            isvalid: true,
            cssInvalid: null,
            group: null,
            tooltip: null,
            registerSVal: true,
            registerInputEvents: true
        }, options || {}));
        
        if (this.registerSVal) JsVal.register(this);
        
        if(this.registerInputEvents && this.input)
        {
            Event.observe($(this.input), "blur", this.validate.bindAsEventListener(this, true));
            Event.observe($(this.input), "focus", this.help.bind(this));
        }
    },

    validate: function(e, raiseError)
    {
        var wasValid = this.isvalid;
        
        if(!(this.isvalid = this.test(e)))
        {
            if($(this.errorSpan)) $(this.errorSpan).show();
            if(this.cssInvalid) $(this.input).addClassName(this.cssInvalid);
            if(wasValid && raiseError && this.message) JsVal.onValidatorActivated(this);
        }
        else if(!wasValid)
        {
            if(this.cssInvalid) $(this.input).removeClassName(this.cssInvalid);
            if($(this.errorSpan)) $(this.errorSpan).hide();
            if(raiseError && this.message) JsVal.onValidatorDeactivated(this);
        }

        if(this.tooltip && JsVal.Tooltip) JsVal.Tooltip.hide(this);
        
        return this.isvalid;
    },

    test: function(e)
    {
        throw("Bad Validator implementation, must override 'test' method.");
    },
    
    reset: function()
    {
        this.isvalid = true;
        if (this.errorSpan) $(this.errorSpan).hide();
        if(this.cssInvalid) $(this.input).removeClassName(this.cssInvalid);
    },
    
    help: function()
    {
        if(!this.tooltip) return;
        JsVal.Tooltip.show(this);
    }
});

JsVal.Utils =
{
    trim: function(str)
    {
        return str.replace(/^\s+|\s+$/g,'');
    },
    
    rightTrim: function(str)
    {
        return str.replace(/\s+$/g,'');
    },
    
    leftTrim: function(str)
    {
        return str.replace(/^\s+/g,'');
    }
};

JsVal.TooltipMessage = Class.create(JsVal.BaseValidator,
{
    initialize: function(options)
    {
        options = Object.extend(
        {
            registerInputEvents: true,
            registerSVal: false
        }, options || {});
        
        this.setup(options);
    },
    
    test: function(e)
    {
        return true;
    }
});

JsVal.Custom = Class.create(JsVal.BaseValidator,
{
    initialize: function(options)
    {
        if  (!options || !Object.isFunction(options.test)) throw ("The test function is required for Custom Validator.");
        this.setup(options);
    }
});

JsVal.RegExp = Class.create(JsVal.BaseValidator,
{  
    initialize: function(options)
    {
        Object.extend(
        {
            regExp : JsVal.RegExp.NotEmpty,
            allowEmpty : false
        }, options || {});
        
        this.setup(options);
    },
    
    test: function(e)
    {
        var val = $F(this.input);
        if (this.allowEmpty && JsVal.Utils.trim(val).length == 0) return true;

        return this.input && $(this.input) && this.regExp.test(val);
    }    
});


//Float numbers negative and positive
JsVal.RegExp.Numeric = /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
JsVal.RegExp.Integer = /((^-?\d)|(\d*))$/;
JsVal.RegExp.Unsigned = /^\d*$/;
JsVal.RegExp.EMail = /(^[a-z]([a-z_\.\d]*)@([a-z_\.]*)([.][a-z]{3})$)|(^[a-z]([a-z_\.]*)@([a-z_\.]*)(\.[a-z]{3})(\.[a-z]{2})*$)/i;
JsVal.RegExp.USPhone = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;
JsVal.RegExp.USZip = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
JsVal.RegExp.Date = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/;
JsVal.RegExp.NotEmpty =
{
    test: function(str)
    {
       str = JsVal.Utils.trim(str);
       return str.length > 0;
    }
};
/************************************************
Borrowed from: Karen Gayda
DESCRIPTION: Validates that a string contains only
    valid dates with 2 digit month, 2 digit day,
    4 digit year. Date separator can be ., -, or /.
    Uses combination of regular expressions and
    string parsing to validate date.
    Ex. mm/dd/yyyy or mm-dd-yyyy or mm.dd.yyyy

PARAMETERS:
   str - String to be tested for validity

RETURNS:
   True if valid, otherwise false.

REMARKS:
   Avoids some of the limitations of the Date.parse()
   method such as the date separator character.
*************************************************/
JsVal.RegExp.USDate =
{
    test: function(str)
    {
      var objRegExp = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/

      //check to see if in correct format
      if(!objRegExp.test(str))
        return false; //doesn't match pattern, bad date
      else
      {
        var strSeparator = str.substring(2,3) 
        var arrayDate = str.split(strSeparator); 
        //create a lookup for months not equal to Feb.
        var arrayLookup = { '01' : 31,'03' : 31, 
                            '04' : 30,'05' : 31,
                            '06' : 30,'07' : 31,
                            '08' : 31,'09' : 30,
                            '10' : 31,'11' : 30,'12' : 31}
        var intDay = parseInt(arrayDate[1],10); 

        //check if month value and day value agree
        if(arrayLookup[arrayDate[0]] != null) {
          if(intDay <= arrayLookup[arrayDate[0]] && intDay != 0)
            return true; //found in lookup table, good date
        }

        //check for February (bugfix 20050322)
        //bugfix  for parseInt kevin
        //bugfix  biss year  O.Jp Voutat
        var intMonth = parseInt(arrayDate[0],10);
        if (intMonth == 2) { 
           var intYear = parseInt(arrayDate[2]);
           if (intDay > 0 && intDay < 29) {
               return true;
           }
           else if (intDay == 29) {
             if ((intYear % 4 == 0) && (intYear % 100 != 0) || 
                 (intYear % 400 == 0)) {
                  // year div by 4 and ((not div by 100) or div by 400) ->ok
                 return true;
             }   
           }
        }
      }  
      return false; //any other values, bad date
    }
};

JsVal.Empty = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend( { regExp: JsVal.RegExp.NotEmpty }, options || {});
        this.setup(options);
    }
});

JsVal.Numeric = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend({ regExp: JsVal.RegExp.Numeric }, options || {});
        this.setup(options);
    }
});

JsVal.Unsigned = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend({ regExp: JsVal.RegExp.Unsigned }, options || {});        
        this.setup(options);
    }
});

JsVal.EMail = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend({ regExp: JsVal.RegExp.EMail }, options || {});
        this.setup(options);
    }
});

JsVal.Date = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend({ regExp: JsVal.RegExp.Date }, options || {});
        this.setup(options);
    }
});

JsVal.USDate = Class.create(JsVal.RegExp,
{
    initialize: function(options)
    {
        options = Object.extend({ regExp: JsVal.RegExp.USDate }, options || {});
        this.setup(options);
    }
});

JsVal.Comparator = Class.create(JsVal.BaseValidator,
{
    initialize: function(options)
    {
        options = Object.extend(
        {
            vsInput: null,
            condition: "==", /* expexted: ==, !=, <, >, <=, >= */
            converter: JsVal.Comparator.floatConverter,
            ignoreEmpty: true
        }, options || {});
        this.setup(options);

        if (!$(this.vsInput)) throw("The vsInput is a required field.");
    },

    test: function(e)
    {   
        var val1 = $F(this.input);
        var val2 = $F(this.vsInput);
        
        if (this.ignoreEmpty && (JsVal.Utils.trim(val1).length == 0 || JsVal.Utils.trim(val1).length == 0)) return true;

        var val1 = this.converter(val1);
        var val2 = this.converter(val2);

        switch(this.condition)
        {
            case "==": return val1 == val2;
            case "!=": return val1 != val2;
            case "<" : return val2 <  val2;
            case ">" : return val1 >  val2;
            case "<=": return val1 <= val2;
            case ">=": return val1 >= val2;
        }
        return false;
    }
});

JsVal.Comparator.floatConverter = function(value)
{
    var tmp = parseFloat(value);
    return isNaN(tmp) ? value : tmp;
};

JsVal.Comparator.dateConverter = function(value)
{
    var tmp = new Date(value);
    return isNaN(tmp) ? value : tmp;
};

JsVal.Form = Class.create(JsVal.BaseValidator,
{
    initialize: function(options, validators)
    {
        options = Object.extend(
        {
            form: "",
            HtmlInjection: true,
            registerInputEvents: false,
            registerSVal: true,
            regexp: /<\w/
        }, options || {});
                
        this.setup(options);
        this.form = $(this.form);
        
        if(!this.form) throw ("You must provide a valid form.");
        Event.observe(this.form, "submit", this.onFormSubmit.bindAsEventListener(this));
    },

    onFormSubmit: function(e)
    {
        this.validate(e, true);
    },
    
    test: function(e)
    {
        var inputs = Form.getElements(this.form);

        for(var i = 0, length = inputs.length; i < length; i++)
        {
            var input = inputs[i];
            if (input.type != 'text' && input.type != 'textarea') continue;
            var value = input.value;
            
            if ( this.regexp.test(value) )
            {
                return false;
            }
        }
        
        return true;
    }
});

JsVal.Multiple = Class.create(JsVal.BaseValidator,
{
    initialize: function(options, validators)
    {
        options = options || {};
        
        this.setup(options);
        
        var innerOptions =
        {
            registerSVal: false,
            registerInputEvents: false,
            input: options.input
        };
        
        this.validators = validators.collect(function(pair)
        {
            var opts = Object.extend(innerOptions, pair.options || {});
            opts.message = pair.message;
            return new pair.validator(opts);
        });
    },
    
    test: function(e)
    {
        var jsval = this.validators.find(function(validator){ return !validator.test(e); });
        if(jsval)
        {
            this.message = jsval.message;//overriding the error message because validate() method will raise it to the user
            return false;
        }
        return true;
    }
});

JsVal.AppearEffect = Class.create(
{
    initialize: function(element)
    {
        Element.show(element);
    },

    cancel: function()
    {
    }
});

JsVal.HideEffect = Class.create(
{
    initialize: function(element)
    {
        Element.show(element);
    },

    cancel: function()
    {
    }
});

JsVal.Tooltip = 
{
    divHelp: null,
    divHelpClass: "divHelpClass",
    
    divMessage: null,
    divMessageClass: "divMessageClass",
    
    verticalAlign: 'center', /*top|center|bottom*/
    horizontalAlign: 'right', /*left|center|right*/
    marginX: 5,
    marginY: 3,
    
    showEffect: typeof Effect == "object" ? Effect.Appear : JsVal.AppearEffect,
    showOptions: {"duration": 1.0},
    hideEffect: typeof Effect == "object" ? Effect.Fade : JsVal.HideEffect,
    hideOptions: {"duration": 1.0},
    currentEffect : null,
            
    doEffect: function(effect, options)
    {
        if (this.currentEffect)
        {
            this.currentEffect.cancel();
        }
        
        this.currentEffect = new effect(this.divHelp, Object.extend({afterFinish: function(){ this.currentEffect = null; }.bind(this)}, options || {}));
    },
    
    clear: function()
    {
        while(this.divMessage && this.divMessage.firstChild)
        {
            this.divMessage.removeChild(this.divMessage.firstChild);
        }
    },
    
    hide: function()
    {
        if(this.divHelp)
        {
            if(this.hideEffect)
            {   
                this.doEffect(this.hideEffect, this.hideOptions);
            }
            else
            {
                $(this.divHelp).hide();
            }            
        }
    },
    
    show: function(validator)
    {
        if (!validator.tooltip) return;
        this.prepareMessage(validator);
        var position = this.computePosition(validator);
        $(this.divHelp).setStyle({"left": position[0], "top": position[1]});
        
        if(this.showEffect)
        {   
            this.doEffect(this.showEffect, this.showOptions);
        }
        else
        {
            $(this.divHelp).show();
        }            
    },
    
    prepareMessage: function(validator)
    {
        if (!this.divHelp || !this.divMessage)
        {
            this.build();
        }

        this.clear();
        if (typeof validator.tooltip == "string")
        {
            $(this.divMessage).update(validator.tooltip);
        }
        else
        {
            if (validator.tooltip.each)
            {
                validator.tooltip.each(function(element)
                {
                    this.divMessage.appendChild(element);
                }.bind(this));
            }
            else
            {
                this.divMessage.appendChild(validator.tooltip);
            }
        }
    },
    
    computePosition: function(validator)
    {
        Position.prepare();
        var inputPosition = Position.cumulativeOffset($(validator.input));
        var inputSize = $(validator.input).getDimensions();
        var helpSize = $(this.divHelp).getDimensions();
        
        var left, top;

        switch(this.verticalAlign)
        {
            case 'top':
                top = inputPosition[1] - helpSize.height - this.marginY;
                break;
            
            case 'center':
                top = inputPosition[1] + Math.round((inputSize.height - helpSize.height)/2);
                break;

            default: /*bottom*/
                top = inputPosition[1] + inputSize.height + this.marginY;
            
        }
        
        switch(this.horizontalAlign)
        {
            case 'left':
                left = inputPosition[0] -helpSize.width - this.marginX;
                break;
                
            case 'center':
                left = inputPosition[0] + Math.round((inputSize.width - helpSize.width)/2);
                break;
                
            default: /*right*/
                left = inputPosition[0] + inputSize.width + this.marginX;
        }
        
        return [left + "px", top + "px"];
    },
    
    build: function()
    {
        this.divMessage = Builder.node("div");
        this.divHelp = Builder.node("div", [this.divMessage]);
        this.divHelp.style.position = "absolute";
        
        if(this.divMessageClass) $(this.divMessage).addClassName(this.divMessageClass);
        if(this.divHelpClass) $(this.divHelp).addClassName(this.divHelpClass);
        $(this.divHelp).hide();
        
        window.document.body.appendChild(this.divHelp);
    }
}

JsVal.Messages =
{
    currentEffect : null,
    pe: null,
            
    setup:function(options)
    {
        Object.extend(this, Object.extend(
        {
            container: null,
            list: null,
            title: null,
            errorClassName: "",
            infoClassName: "",
            infoTitle: "Information",
            errorTitle: "Error Message",
            showOptions: {duration: 1.0},
            hideOptions: {duration: 1.0, afterFinish: function(){ this.clear(); }.bind(this)},
            autoHideTimeout: 10.0,
            showEffect: Effect.BlindDown,
            hideEffect: Effect.BlindUp
        }, options || {}));
        
        JsVal.joinMessages = false;
        JsVal.alertError = this.showErrorMessage.bind(this);
    },
    
    showMessage: function(message)
    {
        if(message.each)
        {
            message.each(function(msg)
            {
                this.addMessage(msg);
            }.bind(this));
        }
        else
        {
            this.addMessage(message);
        }
        this.show();
    },

    showErrorMessage: function(message)
    {
        var title = $(this.title);
        if(title) title.update(this.errorTitle);
        $(this.container).removeClassName(this.infoClassName).addClassName(this.errorClassName);
        this.showMessage(message);
    },

    showInfoMessage: function(message)
    {
        var title = $(this.title);
        if(title) title.update(this.infoTitle);
        $(this.container).addClassName(this.infoClassName).removeClassName(this.errorClassName);
        this.showMessage(message);
    },
    
    addMessage: function(message)
    {
        var node = (typeof message == "string" || typeof message == "number") ? Builder.node("span", message) : message.message ? this.buildValidatorMessage(message) : message;
        $(this.list).appendChild(Builder.node("li", [node]));
    },
    
    buildValidatorMessage: function(validator)
    {
        return (typeof validator.message == "string" || typeof validator.message == "number") ? Builder.node("span", validator.message) : validator.message;
    },
    
    onValidatorActivated: function(validator)
    {
    },
    
    onValidatorDeactivated: function(validator)
    {
    },
    
    doEffect: function(effect, options)
    {
        if (this.currentEffect)
        {
            this.currentEffect.cancel();
        }
        
        this.currentEffect = new effect(this.container, Object.extend({afterFinish: function(){ this.currentEffect = null; }.bind(this)}, options || {}));
    },

    show: function()
    {
        if(!this.container) return;
        if(!$(this.container).visible())
        {
            if(this.showEffect)
            {   
                this.doEffect(this.showEffect, this.showOptions);
            }
            else
            {
                $(this.container).show();
            }
        }

        if(this.autoHideTimeout)
        {
            if (this.pe) this.pe.stop();
            this.pe = new PeriodicalExecuter(function(p)
            {
                p.stop();
                this.pe = null;
                this.hide(0);
            }.bind(this), this.autoHideTimeout); 
        }
    },
    
    hide: function(delay)
    {
        if(!this.container || !$(this.container).visible()) return;
        if(this.hideEffect)
        {   
            this.hideOptions.delay = delay || 0;
            this.doEffect(this.hideEffect, this.hideOptions);
        }
        else
        {
            $(this.container).hide();
        }          
    },
    
    clear: function()
    {
        var list = $(this.list);
        while(list && list.firstChild)
        {
            list.removeChild(list.firstChild);
        }
    },
    
    close: function()
    {
        $(this.container).hide();
        this.clear();

        if (this.currentEffect)
        {
            this.currentEffect.cancel();
        }
    }
};

var EnterCancelHitManager = 
{
    register: function(elements, accept, cancel)
    {
        elements = elements || [];  
        [elements].flatten().each(function(element)
        {
            var input = $(element);
            if (!input)
                throw("Can't found the element: " + element);

            input.acceptButton = (typeof accept == "function") ? accept : $(accept);
            input.cancelButton = $(cancel);
        });
    },

    keypress: function(e)
    {
        var element = Event.element(e);
        if ( e.keyCode == Event.KEY_RETURN && element.acceptButton)
        {
            if (typeof element.acceptButton == "function")
            {
                element.acceptButton();
            }
            else
            {
                $(element.acceptButton).click();
            }
        }
        else if ( e.keyCode == Event.KEY_ESC && element.cancelButton )
        {
            $(element.cancelButton).click();
        }            
        else return;

        Event.stop(e);
    }
};

Event.observe(window, "load", function()
{
    Event.observe(document.body, "keypress", EnterCancelHitManager.keypress.bindAsEventListener(EnterCancelHitManager));

})
