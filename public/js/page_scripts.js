$(document).ready(function() {
    var animalTableRowId = -1;
    var medicineTableRowId = -1;
    var treatmentTableRowId = -1;
    
   $('.clickable-row').click(function () {
       var selectedClass = $('.selected-table-row');
       animalTableRowId = this.id;
       if($(this).hasClass('selected-table-row')) {
           $(this).removeClass('selected-table-row');
           resetBtnStates();
       } else {
           selectedClass.removeClass('selected-table-row');
           $(this).toggleClass("selected-table-row");
           if($('.selected-table-row').length === 0) {
               resetBtnStates();
           } else {
               $('#delete').removeClass('disabled');
               $('#edit').removeClass('disabled');
               $('#cure').removeClass('disabled');
           }
       }
   });

    $('.clickable-med-row').click(function () {
        var selectedClass = $('.selected-table-row');
        medicineTableRowId = this.id;
        $('tr').removeClass('selected-table-row-danger');
        if($(this).hasClass('selected-table-row')) {
            $(this).removeClass('selected-table-row');

            resetMedBtnStates();
        } else {
            selectedClass.removeClass('selected-table-row');
            if($(this).hasClass('no-med')) {
                $(this).toggleClass("selected-table-row-danger");
                $(this).toggleClass("selected-table-row");
            } else {
                $(this).toggleClass("selected-table-row");
            }
            if($('.selected-table-row').length === 0) {
                resetMedBtnStates();
            } else {
                $('#delete-medicine').removeClass('disabled');
                $('#edit-medicine').removeClass('disabled');
            }
        }
    });

    $('.clickable-treat-row').click(function () {
        var selectedClass = $('.selected-table-row');
        treatmentTableRowId = this.id;

        if($(this).hasClass('selected-table-row')) {
            $(this).removeClass('selected-table-row');
            resetTreatmentStates();
        } else {
            selectedClass.removeClass('selected-table-row');
            if($(this).hasClass('no-med')) {
                $(this).toggleClass("selected-table-row-danger");
                $(this).toggleClass("selected-table-row");
            } else {
                $(this).toggleClass("selected-table-row");
            }
            if($('.selected-table-row').length === 0) {
                resetTreatmentStates();
            } else {
                $('#delete-treatment').removeClass('disabled');
                $('#edit-treatment').removeClass('disabled');
            }
        }
    });

    $('#cure').click(function () {
        if (animalTableRowId !== -1) {
            var date = getCurrentDate();
            $('#add-treatment').modal('show');
            $(".sickdate").datepicker().datepicker("setDate", new Date());
            $(".date").datepicker().datepicker("setDate", new Date());


            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'vaistai/' + animalTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    console.log(response);
                    $(".animalNumber").val(response.number);
                    $(".breed").val(response.name);
                    var birthday = new Date(response.birthday).getTime();
                    var age = getAge(birthday);
                    $(".animalAge").val(age);
                    // $(".nr-val").val(response.number);
                    // $(".description-val").val(response.name);
                    // $(".live-being").val(response.liveBeing);
                    // $(".breed-being").val(response.breedName);
                    // $(".birthday").val(response.birthday);
                    // console.log(response);
                    // $(".color").val(response.color);
                    // $(".mother").val(response.mother);
                    // $(".father").val(response.father);
                    // $(".description-user").val(response.comment);
                    //
                    // if (response.sex === 1) {
                    //     $(".male").attr("checked", true);
                    //     $(".female").attr("checked", false);
                    //     console.log("A");
                    // } else if (response.sex === 2) {
                    //     $(".male").attr("checked", false);
                    //     $(".female").attr("checked", true);
                    //     console.log("B");
                    // }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $('#medicine').change(function () {
        if(this.value !== -1) {
            console.log("vaistas: " + this.value);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'vaistai/' + this.value,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    // console.log(response);
                    // $(".animalNumber").val(response.number);
                    // $(".breed").val(response.name);
                    // var birthday = new Date(response.birthday).getTime();
                    // var age = getAge(birthday);
                    // $(".animalAge").val(age);
                    console.log(response);
                    $('#quantity').attr({
                        "max" : response.balance
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $('.js-add-new-treatment').click(function () {
        clearErrors('#add-treatment')
        var newTreatment = {
            date : $('#date').val(),
            number : $('.animalNumber').val(),
            breed : $('#breed').val(),
            age : $('#age').val(),
            color : $('.animalColor').val(),
            sickdate : $('#sickdate').val(),
            temperature : $('#temperature').val(),
            pulse : $('#pulse').val(),
            diagnosis : $('#diagnosis').val(),
            treatment : $('#treatment').val(),
            medicine : $('#medicine').val(),
            quantity : $('#quantity').val(),
            end : $('#end').val(),
            info : $('#info').val()
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'gydymai',
            method: 'POST', // Type of response and matches what we said in the route
            data: newTreatment,
            success: function(response, textStatus, xhr) { // What to do if we succeed
                //location.reload();
                //console.log(response);
                if(xhr.status === 201) {
                    $('#add-treatment').modal('toggle');
                    location.reload();
                } else if(xhr.status === 200) {
                    setErrors(response);
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    });

    $('#add-treatment').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal' && animalTableRowId != -1) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'gyvunas/' + animalTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    $(".animalNumber").val(response.number);
                    $(".breed").val(response.breedName);
                    $(".animalAge").val(_calculateAge(response.birthday));
                    $(".animalColor").val(response.color);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    function _calculateAge(birthday) { // birthday is a date
        var firstDate = new Date(Date.now());
        var secondDate = new Date(birthday);

        return diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(24*60*60*1000)));
    }

    $('#edit-treatment-modal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'gydymas/' + treatmentTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed

                    $('.edit-treatment-date').val(response.date);
                    $('.edit-treatment-animalNumber').val(response.animalNumber);
                    $('.edit-treatment-breed').val(response.animalType);
                    $('.edit-treatment-animalAge').val(response.age);
                    $('.edit-treatment-animalColor').val(response.color);
                    $('.edit-treatment-sickdate').val(response.sickDate);
                    //'animalResearchData' : '';
                    $('.edit-treatment-animalPulse').val(response.pulse);
                    //'breath' : '';
                    $('.edit-treatment-diagnosis').val(response.diagnosis);
                    $('.edit-treatment-treatment').val(response.treatmentAndDirections);
                    $('.edit-treatment-end').val(response.result);
                    $('.edit-treatment-otherInfo').val(response.notes);
                    $('.edit-treatment-medicine').val(response.medicine);
                    $('.edit-treatment-quantity').val(response.medicineQuantity);

                    if(response.medicine <= 0) {
                        $('.edit-treatment-medicine').val(-1);
                    } else {
                        $('.edit-treatment-medicine').val(response.medicine);
                    }

                    $('.edit-treatment-quantity').val(response.quantity);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $('.js-edit-treatment').click(function () {
        clearErrors('#edit-treatment-modal');
        var editedTreatment = {
            'rowId': treatmentTableRowId,
            'date' : $('.edit-treatment-date').val(),
            'number' : $('.edit-treatment-animalNumber').val(),
            'breed' : $('.edit-treatment-breed').val(),
            'age' : $('.edit-treatment-animalAge').val(),
            'color' : $('.edit-treatment-animalColor').val(),
            'sickdate' : $('.edit-treatment-sickdate').val(),
            'animalResearchData' : '',
            'pulse' : $('.edit-treatment-animalPulse').val(),
            'breath' : '',
            'temperature' : $('.edit-treatment-animalTemperature').val(),
            'diagnosis' : $('.edit-treatment-diagnosis').val(),
            'treatment' : $('.edit-treatment-treatment').val(),
            'end' : $('.edit-treatment-end').val(),
            'notes' : $('.edit-treatment-otherInfo').val(),
            'medicine' : $('.edit-treatment-medicine').val(),
            'quantity' : $('.edit-treatment-quantity').val()
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'gydymai/' + treatmentTableRowId,
            method: 'PUT', // Type of response and matches what we said in the route
            data: editedTreatment,
            success: function(response, textStatus, xhr) { // What to do if we succeed
                if(xhr.status === 201) {
                    $('#edit-treatment-modal').modal('toggle');
                    location.reload();
                } else if(xhr.status === 200) {
                    setErrors(response);
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    });

    function getAge(birtdayMillis) {
        var current = new Date(getCurrentDate()).getTime();
        console.log("sdfdsffdsf " + current + " " + birtdayMillis + " ");
        var date = new Date((current - birthday));
        var str = date.getUTCDate() - 1;
        var stra = date.getUTCMonth() - 1;
        var straa = date.getUTCDate() - 1;
        console.log(str  + " " + stra + " " + straa);
    }

    function getCurrentDate() {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        return d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
    }

   function resetBtnStates() {
       animalTableRowId = -1;
       $('#delete').addClass('disabled');
       $('#edit').addClass('disabled');
       $('#cure').addClass('disabled');
   }

    function resetMedBtnStates() {
        medicineTableRowId = -1;
        $('#delete-medicine').addClass('disabled');
        $('#edit-medicine').addClass('disabled');
    }

    function resetTreatmentStates() {
        treatmentTableRowId = -1;
        $('#delete-treatment').addClass('disabled');
        $('#edit-treatment').addClass('disabled');
    }

   // $('#delete').click(function () {
   //    if(animalTableRowId !== -1) {
   //
   //        animalTableRowId = -1;
   //    }
   // });

    $('#delete').click(function () {
        if(animalTableRowId !== -1) {
            $('#confirm-delete').modal('show');
            //animalTableRowId = -1;
        }
    });

    $('#edit').click(function () {
        if(animalTableRowId !== -1) {
            $('#edit-animal').modal('show');
        }
    });

    $('#edit-medicine').click(function () {
        if(medicineTableRowId !== -1) {
            $('#edit-medicine-modal').modal('show');
        }
    });

    $('#delete-medicine').click(function () {
        if(medicineTableRowId !== -1) {
            $('#confirm-delete').modal('show');
        }
    });

    $('#edit-treatment').click(function () {
        if(treatmentTableRowId !== -1) {
            $('#edit-treatment-modal').modal('show');
        }
        else {
            return false;
        }
    });

    $('#delete-treatment').click(function () {
        if(treatmentTableRowId !== -1) {
            $('#confirm-delete').modal('show');
        }
        else {
            return false;
        }
    });



    $('#edit-animal').on('show.bs.modal', function (e) {
        var modal = $('#edit-animal');
        if (e.namespace === 'bs.modal') {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'gyvunas/' + animalTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    $(".nr-val").val(response.number);
                    $(".description-val").val(response.name);
                    $(".live-being").val(response.liveBeing);
                    $(".breed-being").val(response.breedName);
                    $(".birthday").val(response.birthday);
                    $(".color").val(response.color);
                    $(".mother").val(response.mother);
                    $(".father").val(response.father);
                    $(".description-user").val(response.comment);

                    if (response.sex === 1) {
                        $(".male").prop("checked", true);
                        $(".female").prop("checked", false);
                    } else if (response.sex === 2) {
                        $(".male").prop("checked", false);
                        $(".female").prop("checked", true);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $('.js-save-edited-animal').click(function () {
        clearErrors('#edit-animal');

        var editedAnimal = {
            'rowId': animalTableRowId,
            'number' : $("#nr-edit-val").val(),
            'name' : $("#description-edit-val").val(),
            'livebeing' : $("#live-being-edit-val").val(),
            'breed' : $("#breed-being-edit-val").val(),
            'gender' : $('input[name=gender]:checked', '#edit-animal').val(),
            'color' : $("#color-edit-val").val(),
            'mother' : $("#mother-edit-val").val(),
            'father' : $("#father-edit-val").val(),
            'desc' : $("#edited-description").val(),
            'birthday': $("#birthday").val()
        };
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'sarasas/' + animalTableRowId,
            method: 'PUT', // Type of response and matches what we said in the route
            data: editedAnimal,
            success: function(response, textStatus, xhr) { // What to do if we succeed
                if(xhr.status === 201) {
                    $('#edit-animal').modal('toggle');
                    location.reload();
                } else if(xhr.status === 200) {
                    setErrors(response);
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR);
            }
        });
    });

    $('#add-animal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            $(".nr-val").val('');
            $(".description-val").val('');
            $(".live-being").val('');
            $(".breed-being").val('');
            $(".male").prop("checked", false);
            $(".female").prop("checked", false);
            $(".color").val('');
            $(".birthday").val('');
            $(".mother").val('');
            $(".father").val('');
            $(".description-user").val('');
        }
    });

    $('#add-medicine').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            $(".filldate").val('');
            $(".medicname").val('');
            $(".productiondate").val('');
            $(".expirydate").val('');
            $(".series").val('');
            $(".patientregistrationnr").val('');
            $(".quantity").val('');
            $(".consumed").val(0);
        }
    });

   $('#confirm-delete-btn').click(function () {
       if(animalTableRowId !== -1) {
           var obj = {
               id: animalTableRowId
           };
           $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
               url: 'gyvunas/trinti/' + animalTableRowId,
               method: 'POST', // Type of response and matches what we said in the route
               data: obj,
               success: function(response) { // What to do if we succeed
                   animalTableRowId = -1;
                   location.reload();
               },
               error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                   console.log(JSON.stringify(jqXHR));
                   console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
               }
           });
       } else if (medicineTableRowId !== -1) {
           var obj = {
               id: medicineTableRowId
           };
           $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
               url: 'vaistai/trinti/' + medicineTableRowId,
               method: 'POST', // Type of response and matches what we said in the route
               data: obj,
               success: function(response) { // What to do if we succeed
                   medicineTableRowId = -1;
                   location.reload();
               },
               error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                   console.log(JSON.stringify(jqXHR));
                   console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
               }
           });
       } else if(treatmentTableRowId !== -1) {
           var obj = {
               id: treatmentTableRowId
           };
           console.log("id = " +treatmentTableRowId);
           $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
               url: 'gydymai/' + medicineTableRowId,
               method: 'DELETE', // Type of response and matches what we said in the route
               data: obj,
               success: function(response) { // What to do if we succeed
                   treatmentTableRowId = -1;
                   location.reload();
               },
               error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                   console.log(JSON.stringify(jqXHR));
                   console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
               }
           });
       }
   });

   $('.js-save-new-animal').click(function () {
       clearErrors('#add-animal');

       var newAnimal = {
           'number' : $(".nr-val").val(),
           'name' : $(".description-val").val(),
           'livebeing' : $(".live-being").val(),
           'breed' : $(".breed-being").val(),
           'gender' : $('input[name=gender]:checked', '#add-animal').val(),
           'color' : $(".color").val(),
           'mother' : $(".mother").val(),
           'father' : $(".father").val(),
           'desc' : $(".description-user").val(),
           'birthday': $(".birthday").val()
       };

       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
           url: 'sarasas',
           method: 'POST', // Type of response and matches what we said in the route
           data: newAnimal,
           success: function(response, textStatus, xhr) { // What to do if we succeed
               if(xhr.status === 201) {
                   $('#add-animal').modal('toggle');
                   location.reload();
               } else if(xhr.status === 200) {
                   setErrors(response);
                   return false;
               }
           },
           error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail

           }
       });
   });


   //MEDICAMENTS

    $('.js-add-new-medicament').click(function () {
        clearErrors('#add-medicine');

        var newMedicament = {
            'filldate' : $('.filldate').val(),
            'medicname' : $('.medicname').val(),
            'productiondate' : $('.productiondate').val(),
            'expirydate' : $('.expirydate').val(),
            'series' : $('.series').val(),
            'patientregistrationnr' : $('.patientregistrationnr').val(),
            'quantity' : $('.quantity').val(),
            'consumed' : $('.consumed').val()
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'medikamentai',
            method: 'POST', // Type of response and matches what we said in the route
            data: newMedicament,
            success: function(response, textStatus, xhr) { // What to do if we succeed
                if(xhr.status === 201) {
                    $('#add-medicine').modal('toggle');
                    location.reload();
                } else if(xhr.status === 200) {
                    setErrors(response);
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    });

    $('#edit-medicine-modal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'vaistai/' + medicineTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    $(".filldate").val(response.filldate);
                    $(".medicname").val(response.from);
                    $(".productiondate").val(response.productiondate);
                    $(".expirydate").val(response.expirydate);
                    $(".series").val(response.series);
                    $(".patientregistrationnr").val(response.patientregistrationnr);
                    $(".quantity").val(response.quantity);
                    $(".consumed").val(response.consumed);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });


    $('.js-edit-medicament').click(function () {
        clearErrors('#edit-medicine-modal');
        var editedMedicament = {
            'rowId': medicineTableRowId,
            'filldate' : $('#edit-med-date').val(),
            'medicname' : $('#edit-med-medicname').val(),
            'productiondate' : $('#edit-med-productiondate').val(),
            'expirydate' : $('#edit-med-expirydate').val(),
            'series' : $('#edit-med-series').val(),
            'patientregistrationnr' : $('#edit-med-patientregistrationnr').val(),
            'quantity' : $('#edit-med-quantity').val(),
            'consumed' : $('#edit-med-consumed').val()
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'medikamentai/' + medicineTableRowId,
            method: 'PUT', // Type of response and matches what we said in the route
            data: editedMedicament,
            success: function(response, textStatus, xhr) { // What to do if we succeed
                if(xhr.status === 201) {
                    $('#edit-medicine-modal').modal('toggle');
                    location.reload();
                } else if(xhr.status === 200) {
                    setErrors(response);
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    });

    $('.fullinfo').click(function () {
        $('#full-info').modal('show');
        var fullComment = $(this).attr('data-comment');
        $('#full-info-p').text(fullComment);
    });

    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
});

function setErrors(errors) {
    $.each(errors, function (name, value) {
        $('span.err-' + name).children('strong').text(value[0]);
    });
}
function clearErrors(modalId) {
    $(modalId).find('span.help-block').each(function () {
        $(this).children('strong').text('');
    });
}