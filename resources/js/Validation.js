class Validation {
    constructor() {
        this.validationData = [];
        this.validationRules = [];
        this.buttons = [];

        this.addValidationRule("text", "required",function(text,req){
            let result = false;
            let failReason = "";
            let successReason = "";
            if(text.length > 0){
                result = true;
            } else {
                failReason = "You can't leave this field blank.";
            }
            return [result,failReason,successReason];
        });

        this.addValidationRule("text", "email",function(text,req){
            let result = false;
            let failReason = "";
            let successReason = "";
            if(RegExp("(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\\])").test(text)){
                result = true;
            } else {
                result = false;
                failReason = "Invalid Email format.";
            }
            return [result,failReason,successReason];
        });

        this.addValidationRule("text", "steamid",function(text,req){
            let result = false;
            let failReason = "";
            let successReason = "";
            if(RegExp("^STEAM_[0-5]:[01]:\\d+$").test(text)){
                result = true;
            } else {
                result = false;
                failReason = "Invalid SteamID format.";
            }
            return [result,failReason,successReason];
        });

        this.addValidationRule("text", "steamid64",function(text,req){
            let result = false;
            let failReason = "";
            let successReason = "";
            if(RegExp("\\b\\d{17}\\b").test(text)){
                result = true;
            } else {
                result = false;
                failReason = "Invalid SteamID64 format.";
            }
            return [result,failReason,successReason];
        });
    }

    addValidationRule(type,cmd,func){
        let data = [];
        if(this.validationRules[type] === undefined){
            this.validationRules[type] = [];
        }
        data["cmd"] = cmd;
        data["func"] = func;

        this.validationRules[type].push(data);
    };

    startValidating(){
        let inputs = $("*[data-validation]");

        for(elem of inputs){
            let id = elem.id
            let elem = $("#"+id)
            this.validationData[id] = []
            let data = this.validationData[id];
            data.shouldFocus = false;
            data.requirementsMet = false;
            data.requirements = this.getRequirements(id);
            data.helper = elem.next();
            data.target = elem.attr("data-valtarget");

            if(typeof this.buttons[data.target] != 'undefined'){
                this.buttons[data.target].push(id);
            } else {
                this.buttons[data.target] = [];
                this.buttons[data.target].push(id);
            }

            let checkRequirements = this.checkRequirements;
            let validatedData = this.getValidationData();
            let buttons = this.buttons
            let prevent = this.allRequirementsMet;
            let validatedField = this.validatedField;
            let validationRules = this.getValidationRules();

            elem.keyup(function() {
                checkRequirements(id,validatedData,validatedField,validationRules);
                $("#"+data.target).attr('disabled',!prevent(data.target,buttons,validatedData))
            });

            elem.focusin(function() {
                if(!data.shouldFocus){
                    data.shouldFocus = true;
                }
            });

            elem.focusout(function() {
                if (data.shouldFocus){
                    checkRequirements(id,validatedData,validatedField,validationRules);
                    $("#"+data.target).attr('disabled',!prevent(data.target,buttons,validatedData))
                }
            });
        }

        this.preventButtons();
    }

    validatedField(id,valid,data,failReason,successReason){
        let field = $("#"+id);
        if(valid){
            field.removeClass('invalid');
            field.addClass('valid');
            if(successReason.length > 0){
                data.helper.attr("data-success", successReason);
            }
        } else {
            field.removeClass('valid');
            field.addClass('invalid');
            data.helper.attr("data-error", failReason);
        }
    }

    checkRequirements(id,validatedData,validatedField,validationRules){
        let text = $("#"+id).val().trim();
        let requirements = validatedData[id].requirements;
        let data = [];
        let failReason = "";
        let successReason = "";

        for(type of Object.keys(validationRules)){
            let rule = validationRules[type];
            for(val of rule){
                if (type === "text"){
                    if(requirements.includes(val.cmd)){
                        let results = val.func(text,requirements)
                        if (typeof(results) == "boolean"){
                            data.push(results);
                        } else {
                            data.push(results[0]);
                            if (typeof(results[1]) == "string" && results[1].length > 0){
                                failReason = results[1];
                            }
                            if (typeof(results[2]) == "string" && results[2].length > 0){
                                successReason = results[2];
                            }
                        }
                    }
                }
            }
        }

        if(Number.isInteger(requirements["min"])){
            if(text.length > requirements["min"] - 1){
                data.push(true);
            } else {
                data.push(false);
                failReason = "Min characters allowed is "+requirements["min"]+". You have "+text.length+".";
            }
        }

        if(Number.isInteger(requirements["max"])){
            if(text.length <= requirements["max"]){
                data.push(true);
            } else {
                data.push(false);
                failReason = "Max characters allowed is "+requirements["max"]+". You have "+text.length+".";
            }
        }
        validatedData[id].requirementsMet = data.every(Boolean);
        validatedField(id,data.every(Boolean),validatedData[id],failReason,successReason)
    }

    preventButtons(){
        let buttons = this.buttons
        let prevent = this.allRequirementsMet;
        let data = this.getValidationData();
        for(id of Object.keys(buttons)){
            $("#"+id).click(function(event) {
                if(!prevent(id,buttons,data)){
                    event.preventDefault();
                }
            });
        }
    }
    getValidationRules(){
        return this.validationRules;
    }

    getValidationData(){
        return this.validationData;
    }

    allRequirementsMet(id,buttons,validationData){
        let met = false;
        let validated = [];

        for(button of buttons[id]){
            validated.push(validationData[button].requirementsMet);
        }

        met = validated.every(Boolean);

        return met;
    }

    getRequirements(id) {
        let elem = $("#"+id);
        let data = [];

        for(val of elem.attr("data-validation").split(" ")){
            if(val.includes("=")){
                let newVal = val.split("=");
                data[newVal[0]] = parseInt(newVal[1]);
            } else {
                data.push(val);
            }
        }

        return data;
    }
}
