$("#account").change(function() {
    if ($(this).val() === "registrar") {
        $('#inst').show();
        $('#instlogo').show();
        $('#comp').hide();
        $('#student_no').hide();
        $('#selinst').hide();
    }else if ($(this).val() === "student") {
        $('#selinst').show();
        $('#instlogo').hide();
        $('#student_no').show();
        $('#inst').hide();
        $('#comp').hide();
    }else if ($(this).val() === "graduate") {
        $('#selinst').show();
        $('#instlogo').hide();
        $('#student_no').show();
        $('#inst').hide();
        $('#comp').hide();
    }else if ($(this).val() === "employer") {
        $('#comp').show();
        $('#instlogo').show();
        $('#student_no').hide();
        $('#inst').hide();
        $('#selint').hide();
    }else {
        $('#inst').hide();
        $('#instlogo').hide();
        $('#student_no').hide();
        $('#comp').hide();
        $('#selinst').hide();
    }
});
$("#account").trigger("change");
