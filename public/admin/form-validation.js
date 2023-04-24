$(document).ready(function(){
    var pathArray = window.location.pathname.split( '/' );
    var urlSegment = pathArray[pathArray.length-1];

    jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");

    jQuery.validator.addMethod("cke_required", function (value, element) {
        var idname = $(element).attr('id');
        var editor = CKEDITOR.instances[idname];
        $(element).val(editor.getData());
        return $(element).val().length > 0;
    }, "This field is required");

    $('#adminForm').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: {
                    depends: function (element) {
                        if(urlSegment === "create") { return true }
                    },
                }
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            email: {
                required: "Please enter email",
            },
            password: {
                required: "Please enter password",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });

	$('#userType').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
        	if(element.attr("name") == 'name') {
            	error.insertAfter('.userTypeName');
        	} else {
            	error.insertAfter(element);
        	}
        },
    });

    $('#rateCard').validate({
        ignore: [],
        rules: {
            project_type_id: {
                required: true
            },
        },
        messages: {
            project_type_id: {
                required: "Please select project type",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'project_type_id') {
                error.insertAfter('.projectType');
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('#projectType').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'name') {
                error.insertAfter('.projectTypeName');
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('#designation').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'name') {
                error.insertAfter('.designationName');
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('#project').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            project_type_id: {
                required: true
            },
            client_id: {
                required: true
            },
            'user_id[]': {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            project_type_id: {
                required: "Please select project type",
            },
            client_id: {
                required: "Please select client",
            },
            'user_id[]': {
                required: "Please select user",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'name') {
                error.insertAfter('.projectName');
            }else if(element.attr("name") == 'project_type_id') {
                error.insertAfter('.projectTypeId');
            }else if(element.attr("name") == 'client_id') {
                error.insertAfter('.clientId');
            }else if(element.attr("name") == 'user_id[]') {
                error.insertAfter('.userId');
            }else{
                error.insertAfter(element);
            }
        },
    });

    $('#userForm').validate({
        ignore: [],
        rules: {
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: {
                    depends: function (element) {
                        if(urlSegment === "create") { return true }
                    },
                }  
            },
            user_type_id: {
                required: true
            },
            designation_id: {
                required: true
            },
            employee_code: {
                required: true
            },
            /*'project_id[]':{
                required: true
            },*/
            joining_date: {
                required: true
            },
        },
        messages: {
            username: {
                required: "Please enter username",
            },
            email: {
                required: "Please enter email",
            },
            password: {
                required: "Please enter password",
            },
            user_type_id: {
                required: "Please select experience level",
            },
            designation_id: {
                required: "Please select designation",
            },
            employee_code: {
                required: "Please enter employee code",
            },
            /*'project_id[]': {
                required: "Please select project type",
            },*/
            joining_date: {
                required: "Please select date"
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'username') {
                error.insertAfter('.userName');
            }else if(element.attr("name") == 'email') {
                error.insertAfter('.userEmail');
            }else if(element.attr("name") == 'password') {
                error.insertAfter('.userPassword');
            }/*else if(element.attr("name") == 'project_id[]') {
                error.insertAfter('.userProjectType');
            }*/else if(element.attr("name") == 'designation_id') {
                error.insertAfter('.designationId');
            }else if(element.attr("name") == 'user_type_id') {
                error.insertAfter('.userTypeId');
            }else if(element.attr("name") == 'employee_code') {
                error.insertAfter('.empCode');
            }else if(element.attr("name") == 'joining_date') {
                error.insertAfter('.joiningDate');
            }else{
                error.insertAfter(element);
            }
        },
    });

    $('#userProfile').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            surname: {
                required: true
            },
            phone: {
                required: true
            },
            gender: {
                required: true
            },
            /*specialty: {
                required: true
            },
            skills: {
                required: true
            },*/
            birth_date: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
        },
        messages: {
            name: {
                required: "Please enter firstname",
            },
            surname: {
                required: "Please enter lastname",
            },
            phone: {
                required: "Please enter phone number",
            },
            gender: {
                required: "Please select gender",
            },
            /*specialty: {
                required: "Please enter specialty",
            },
            skills: {
                required: "Please enter skills",
            },*/
            birth_date: {
                required: "Please select your birth date",
            },
            email: {
                required: "Please enter email",
            }   

        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'name') {
                error.insertAfter('.firstName');
            }else if(element.attr("name") == 'lastname') {
                error.insertAfter('.lastName');
            }else if(element.attr("name") == 'phone') {
                error.insertAfter('.phone');
            }else if(element.attr("name") == 'gender') {
                error.insertAfter('.genderId');
            }/*else if(element.attr("name") == 'specialty') {
                error.insertAfter('.userSpeciality');
            }else if(element.attr("name") == 'skills') {
                error.insertAfter('.userSkill');
            }*/else if(element.attr("name") == 'birth_date') {
                error.insertAfter('.birthDate');
            }else if(element.attr("name") == 'email') {
                error.insertAfter('.Email');
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('#timesheet').validate({
        ignore: [],
        rules: {
            hours: {
                required: true
            },
            submitted_date: {
                required: true
            },
        },
        messages: {
            hours: {
                required: "Please enter hours",
            },
            submitted_date: {
                required: "Please select date",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            if(element.attr("name") == 'hours') {
                error.insertAfter('.clockpicker');
            }else if(element.attr("name") == 'submitted_date') {
                error.insertAfter('.submittedDate');
            } else {
                error.insertAfter(element);
            }
        },
    });

    $('#client').validate({
        ignore: [],
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
            },
            email: {
                required: "Please enter email",
            },
        },
        onfocusout: function (element) {
            jQuery(element).valid()
        },
        errorElement: "div",
        errorClass: "validateError",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
});