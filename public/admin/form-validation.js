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
        },
        messages: {
            name: {
                required: "Please enter name",
            },
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
            if(element.attr("name") == 'name') {
                error.insertAfter('.projectName');
            }else if(element.attr("name") == 'project_type_id') {
                error.insertAfter('.projectTypeId');
            } else {
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
                required: true
            },
            user_type_id: {
                required: true
            },
            designation_id: {
                required: true
            },
            'project_id[]':{
                required: true
            },
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
            'project_id[]': {
                required: "Please select project type",
            },
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
            }else if(element.attr("name") == 'project_id[]') {
                error.insertAfter('.userProjectType');
            }else if(element.attr("name") == 'designation_id') {
                error.insertAfter('.designationId');
            }else if(element.attr("name") == 'user_type_id') {
                error.insertAfter('.userTypeId');
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
            specialty: {
                required: true
            },
            skills: {
                required: true
            },
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
            specialty: {
                required: "Please enter specialty",
            },
            skills: {
                required: "Please enter skills",
            },
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
            }else if(element.attr("name") == 'specialty') {
                error.insertAfter('.userSpeciality');
            }else if(element.attr("name") == 'skills') {
                error.insertAfter('.userSkill');
            }else if(element.attr("name") == 'birth_date') {
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
});