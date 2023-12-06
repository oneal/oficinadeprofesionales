// Register Form validation starts
$(document).ready(function () {
    $("#register_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            first_name: {required: true},
            user_type: {required: true},
            email_id: {required: true,email: true},
            mobile_number: {matches:"[0-9]+", minlength:9, maxlength:9},
            password: {required: true, minlength: 6, maxlength: 10},
            politica_privacidad: {required: true},
        },
        messages: {

            first_name: {required: "Nombre es obligatorio"},
            user_type: {required: "Se requiere el tipo de usuario"},
            email_id: {required: "Email es obligatorio"},
            mobile_number: {required: "El número de telefóno no es válido debe tener 9 dígitos"},
            password: {required: "Password es obligatorio"},
            politica_privacidad: {required: "La política de privacidad es obligatoria"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Register Form validation ends

// Login Form validation starts

$(document).ready(function () {
    $("#login_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            email_id: {required: true},
            password: {required: true}
        },
        messages: {
            email_id: {required: "Email es obligatorio"},
            password: {required: "Password es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Login Form validation ends

// Forget Password Form validation starts

$(document).ready(function () {
    $("#forget_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            email_id: {required: true}
        },
        messages: {
            email_id: {required: "Email es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Forget Password Form validation ends

// Listing Form -1 validation starts
$(document).ready(function () {
    $("#listing_form_1").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            listing_name: {required: true},
            listing_address: {required: true},
            // listing_lat: {required: true},
            // listing_lng: {required: true},
            event_image: {required: true},
            event_address: {required: true},
            event_start_date: {required: true},
            event_time: {required: true},
            event_description: {required: true},
            event_email: {required: true,email: true},
            event_mobile: {required: true}
        },
        messages: {

            listing_name: {required: "El nombre de la ficha es obligatorio"},
            event_contact_name: {required: "La persona de contacto es obligatorio"},
            event_image: {required: "La imagen del evento es obligatoria"},
            listing_address: {required: "La dirección de la ficha es obligatoria"},
            // listing_lat: {required: "Listing Latitude is Required"},
            // listing_lng: {required: "Listing Longitude is Required"},
            event_start_date: {required: "La fecha del evento es obligatoria"},
            event_time: {required: "La hora del evento es obligatoria"},
            event_description: {required: "La descripción del evento es obligatoria"},
            event_email: {required: "El email del evento es obligatorio"},
            event_mobile: {required: "El numero de telefono es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Listing Form -1 validation ends

// Event Form validation starts
$(document).ready(function () {
    $("#event_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            event_name: {required: true},
            event_contact_name: {required: true},
            event_image: {required: true},
            event_address: {required: true},
            event_start_date: {required: true},
            event_time: {required: true},
            event_description: {required: true},
            event_email: {required: true,email: true},
            event_mobile: {required: true}
        },
        messages: {

            event_name: {required: "El nombre del evento es obligatorio"},
            event_contact_name: {required: "La persona de contacto es obligatorio"},
            event_image: {required: "La imagen del evento es obligatoria"},
            event_address: {required: "La dirección del evento es obligatorio"},
            event_start_date: {required: "La fecha del evento es obligatoria"},
            event_time: {required: "La hora del evento es obligatoria"},
            event_description: {required: "La descripción del evento es obligatoria"},
            event_email: {required: "El email del evento es obligatorio"},
            event_mobile: {required: "El numero de telefono es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Event Form validation ends

// Event Edit Form validation starts
$(document).ready(function () {
    $("#event_edit_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            event_name: {required: true},
            event_contact_name: {required: true},
            event_address: {required: true},
            event_start_date: {required: true},
            event_time: {required: true},
            event_description: {required: true},
            event_email: {required: true,email: true},
            event_mobile: {required: true}
        },
        messages: {

            event_name: {required: "El nombre del evento es obligatorio"},
            event_contact_name: {required: "La persona de contacto es obligatorio"},
            event_address: {required: "La dirección del evento es obligatorio"},
            event_start_date: {required: "La fecha del evento es obligatoria"},
            event_time: {required: "La hora del evento es obligatoria"},
            event_description: {required: "La descripción del evento es obligatoria"},
            event_email: {required: "El email del evento es obligatorio"},
            event_mobile: {required: "El numero de telefono es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Event Edit Form validation ends

// Blog Form validation starts
$(document).ready(function () {
    $("#blog_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            blog_name: {required: true},
            blog_image: {required: true},
            blog_description: {required: true}
        },
        messages: {

            blog_name: {required: "El nombre obligatorio"},
            blog_image: {required: "La imagen es obligatorio"},
            blog_description: {required: "La descripción es obligatoria"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Blog Form validation ends

// Blog Edit Form validation starts
$(document).ready(function () {
    $("#blog_edit_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            blog_name: {required: true},
            blog_description: {required: true}
        },
        messages: {

            blog_name: {required: "El nombre obligatorio"},
            blog_description: {required: "La descripción es obligatoria"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Blog Edit Form validation ends


// User Ad Request Form validation starts
$(document).ready(function () {
    $("#create_ads_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            all_ads_price_id: {required: true},
            ad_start_date: {required: true},
            ad_end_date: {required: true},
            ad_enquiry_photo: {required: true},
            ad_link: {required: true}
        },
        messages: {

            all_ads_price_id: {required: "La posición del anuncio es obligatoria"},
            ad_start_date: {required: "Se requiere la fecha de inicio"},
            ad_end_date: {required: "Se requiere la fecha de finalización"},
            ad_enquiry_photo: {required: "El anuncio es obligatorio"},
            ad_link: {required: "El enlace del anuncio es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// User Ad Request Form validation ends


//Home page slide Enquiry Form Ajax Call And Validation starts-->

$("#home_slide_enquiry_submit").click(function() {

    $("#home_slide_enquiry_form").validate({
        rules: {
            enquiry_name: {required: true},
            enquiry_email: {required: true, email: true},
            enquiry_mobile: {required: true},
            enquiry_message: {required: true},
            politica_privacidad: {required: true},
            theme: {required: true}

        },
        messages: {
            enquiry_name: {required: "El nombre es obligatorio"},
            enquiry_email: {required: "El email es obligatorio"},
            enquiry_mobile: {required: "El número de teléfono es obligatorio"},
            enquiry_message: {required: "El mensaje es obligatorio"},
            politica_privacidad: {required: "La política de privacidad es obligatoria"},
            theme: {required: "El asunto es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            //form.submit();
            $.ajax({
                type: "POST",
                data: $("#home_slide_enquiry_form").serialize(),
                url: "contact_submit.php",
                cache: true,
                success: function (html) {
                    // alert(html);
                    if (html == 1) {
                        $("#home_slide_enq_success").show();
                        $("#home_slide_enquiry_form")[0].reset();
                    } else {
                        if (html == 3) {
                            $("#home_slide_enq_same").show();
                            $("#home_slide_enquiry_form")[0].reset();
                        }else {
                            if (html == -4) {
                                $("#home_slide_enq_name").show();
                                $("#home_slide_enquiry_form")[0].reset();
                            }else{
                                if (html == -5) {
                                    $("#home_slide_enq_email").show();
                                    $("#home_slide_enquiry_form")[0].reset();
                                }else{
                                    if (html == -6) {
                                        $("#home_slide_enq_phone").show();
                                        $("#home_slide_enquiry_form")[0].reset();
                                    }else{
                                        if (html == -7) {
                                            $("#home_slide_enq_message").show();
                                            $("#home_slide_enquiry_form")[0].reset();
                                        }else{
                                            if (html == -8) {
                                                $("#home_slide_enq_theme").show();
                                                $("#home_slide_enquiry_form")[0].reset();
                                            }else{
                                                $("#home_slide_enq_fail").show();
                                                $("#home_slide_enquiry_form")[0].reset();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            })
        }
    });
});
//Home page slide Enquiry Form Ajax Call And Validation ends-->


//Home page Enquiry Form Ajax Call And Validation starts-->

$("#home_contact_submit").click(function() {

    $("#home_contact_form").validate({
        rules: {
            enquiry_name: {required: true},
            enquiry_email: {required: true, email: true},
            enquiry_mobile: {required: true},
            politica_privacidad: {required: true},
            theme: {required: true},
            enquiry_message: {required: true}

        },
        messages: {

            enquiry_name: {required: "El nombre es obligatorio"},
            enquiry_email: {required: "El email es obligatorio"},
            enquiry_mobile: {required: "El número de teléfono es obligatorio"},
            politica_privacidad: {required: "La política de privacidad es obligatoria"},
            theme: {required: "El asunto es obligatorio"},
            enquiry_message: {required: "El mensaje es obligatorio"}
        },

        submitHandler: function (form) { // for demo
            //form.submit();
            $.ajax({
                type: "POST",
                data: $("#home_contact_form").serialize(),
                url: "contact_submit.php",
                cache: true,
                success: function (html) {
                    // alert(html);
                    if (html == 1) {
                        $("#home_enq_success").show();
                        $("#home_contact_form")[0].reset();
                    } else {
                        if (html == 3) {
                            $("#home_enq_same").show();
                            $("#home_contact_form")[0].reset();
                        }else {
                            if (html == -4) {
                                $("#home_enq_name").show();
                                $("#home_contact_form")[0].reset();
                            }else{
                                if (html == -5) {
                                    $("#home_enq_email").show();
                                    $("#home_contact_form")[0].reset();
                                }else{
                                    if (html == -6) {
                                        $("#home_enq_phone").show();
                                        $("#home_contact_form")[0].reset();
                                    }else{
                                        if (html == -7) {
                                            $("#home_enq_message").show();
                                            $("#home_contact_form")[0].reset();
                                        }else{
                                            if (html == -8) {
                                                $("#home_enq_theme").show();
                                                $("#home_contact_form")[0].reset();
                                            }else{
                                                $("#home_enq_fail").show();
                                                $("#home_contact_form")[0].reset();
                                            }                                         
                                        }
                                    }
                                }
                            }
                        }
                    }

                }

            })
        }
    });
});

//$("#home_enquiry_submit").click(function() {
//
//    $("#home_enquiry_form").validate({
//        rules: {
//            enquiry_name: {required: true},
//            enquiry_email: {required: true, email: true},
//            enquiry_mobile: {required: true},
//            politica_privacidad: {required: true}
//
//        },
//        messages: {
//
//            enquiry_name: {required: "El nombre es obligatorio"},
//            enquiry_email: {required: "El email es obligatorio"},
//            enquiry_mobile: {required: "El número de teléfono es obligatorio"},
//            politica_privacidad: {required: "La política de privacidad es obligatoria"}
//        },
//
//        submitHandler: function (form) { // for demo
//            //form.submit();
//            $.ajax({
//                type: "POST",
//                data: $("#home_enquiry_form").serialize(),
//                url: "enquiry_submit.php",
//                cache: true,
//                success: function (html) {
//                    // alert(html);
//                    if (html == 1) {
//                        $("#home_slide_enq_success").show();
//                        $("#home_slide_enquiry_form")[0].reset();
//                    } else {
//                        if (html == 3) {
//                            $("#home_slide_enq_same").show();
//                            $("#home_slide_enquiry_form")[0].reset();
//                        }else {
//                            if (html == -4) {
//                                $("#home_slide_name").show();
//                                $("#home_slide_enquiry_form")[0].reset();
//                            }else{
//                                if (html == -5) {
//                                    $("#home_slide_email").show();
//                                    $("#home_slide_enquiry_form")[0].reset();
//                                }else{
//                                    if (html == -6) {
//                                        $("#home_slide_phone").show();
//                                        $("#home_slide_enquiry_form")[0].reset();
//                                    }else{
//                                        if (html == -7) {
//                                            $("#home_slide_message").show();
//                                            $("#home_slide_enquiry_form")[0].reset();
//                                        }else{
//                                            $("#home_slide_enq_fail").show();
//                                            $("#home_slide_enquiry_form")[0].reset();
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                    }
//
//                }
//
//            })
//        }
//    });
//});
//Home page Enquiry Form Ajax Call And Validation ends-->


// product Form validation starts
$(document).ready(function () {
    $("#product_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            product_name: {required: true},
            product_price: {required: true},
            gallery_image: {required: true},
            product_description: {required: true},
            category_id: {required: true}
        },
        messages: {

            product_name: {required: "El nombre del producto es obligatorio"},
            product_price: {required: "El precio del producto es obligatorio"},
            gallery_image: {required: "La imagen del producto es obligatoria"},
            product_description: {required: "Se requiere una descripción del producto"},
            category_id: {required: "La categoría de producto es obligatoria"}
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// product Form validation ends

// Feedback Form validation starts
$(document).ready(function () {
    $("#feedback_form").validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            feedback_name: {required: true},
            feedback_email: {required: true,email: true},
            feedback_mobile: {required: true},
            feedback_message: {required: true},
            politica_privacidad: {required: true}
        },
        messages: {

            feedback_name: {required: "El nombre es obligatorio"},
            feedback_email: {required: "El email es obligatorio"},
            feedback_mobile: {required: "El número de teléfono es obligatorio"},
            feedback_message: {required: "Se requieren comentarios"},
            politica_privacidad: {required: "La política de privacidad es obligatoria"},
        },

        submitHandler: function (form) { // for demo
            form.submit();
        }
    });
});

// Feedback Form validation ends
