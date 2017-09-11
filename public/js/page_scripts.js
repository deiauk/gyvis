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
                url: 'gyvunasAxax/' + animalTableRowId,
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

    $('#edit-animal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
                url: 'gyvunasAxax/' + animalTableRowId,
                method: 'GET', // Type of response and matches what we said in the route
                success: function (response) { // What to do if we succeed
                    $(".nr-val").val(response.number);
                    $(".description-val").val(response.name);
                    $(".live-being").val(response.liveBeing);
                    $(".breed-being").val(response.breedName);
                    $(".birthday").val(response.birthday);
                    console.log(response);
                    $(".color").val(response.color);
                    $(".mother").val(response.mother);
                    $(".father").val(response.father);
                    $(".description-user").val(response.comment);

                    if (response.sex === 1) {
                        $(".male").attr("checked", true);
                        $(".female").attr("checked", false);
                        console.log("A");
                    } else if (response.sex === 2) {
                        $(".male").attr("checked", false);
                        $(".female").attr("checked", true);
                        console.log("B");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $('.js-save-edited-animal').click(function () {
        var number = $("#nr-edit-val").val();
        var name = $("#description-edit-val").val();
        var livebeing =  $("#live-being-edit-val").val();
        var breed =  $("#breed-being-edit-val").val();
        var gender = $('input[name=gender]:checked', '#edit-animal').val();
        var color = $("#color-edit-val").val();
        var mother = $("#mother-edit-val").val();
        var father = $("#father-edit-val").val();
        var desc = $("#edited-description").val();
        var birthday =  $("#birthday").val();

        console.log(birthday + " " + gender);

        var editedAnimal = {
            'rowId': animalTableRowId,
            'number' : number,
            'name' : name,
            'livebeing' : livebeing,
            'breed' : breed,
            'gender' : gender,
            'color' : color,
            'mother' : mother,
            'father' : father,
            'desc' : desc,
            'birthday': birthday
        };
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'sarasas/' + animalTableRowId,
            method: 'PUT', // Type of response and matches what we said in the route
            data: editedAnimal,
            success: function(response) { // What to do if we succeed
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
            }
        });
    });

    $('#add-animal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            console.log("clear");
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
               url: 'trinti',
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
               url: 'trintiVaista',
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

       }
   });

   $('.js-save-new-animal').click(function () {
       var number = $(".nr-val").val();
       var name = $(".description-val").val();
       var livebeing =  $(".live-being").val();
       var breed =  $(".breed-being").val();
       var gender = $('input[name=gender]:checked', '#add-animal').val();
       var color = $(".color").val();
       var mother = $(".mother").val();
       var father = $(".father").val();
       var desc = $(".description-user").val();
       var birthday =  $(".birthday").val();

       console.log(gender + " asdsdsadsdasdasd");

       var newAnimal = {
           'number' : number,
           'name' : name,
           'livebeing' : livebeing,
           'breed' : breed,
           'gender' : gender,
           'color' : color,
           'mother' : mother,
           'father' : father,
           'desc' : desc,
           'birthday': birthday
       };

       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
           url: 'sarasas',
           method: 'POST', // Type of response and matches what we said in the route
           data: newAnimal,
           success: function(response) { // What to do if we succeed
               location.reload();
           },
           error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
               console.log(JSON.stringify(jqXHR));
               console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
           }
       });

       $('#add-animal').modal('toggle');
   });


   //MEDICAMENTS

    $('.js-add-new-medicament').click(function () {
        var filldate = $('.filldate').val();
        var medicname = $('.medicname').val();
        var productiondate = $('.productiondate').val();
        var expirydate = $('.expirydate').val();
        var series = $('.series').val();
        var patientregistrationnr = $('.patientregistrationnr').val();
        var quantity = $('.quantity').val();
        var consumed = $('.consumed').val();

        var newMedicament = {
            'filldate' : filldate,
            'medicname' : medicname,
            'productiondate' : productiondate,
            'expirydate' : expirydate,
            'series' : series,
            'patientregistrationnr' : patientregistrationnr,
            'quantity' : quantity,
            'consumed' : consumed
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'medikamentai',
            method: 'POST', // Type of response and matches what we said in the route
            data: newMedicament,
            success: function(response) { // What to do if we succeed
                location.reload();
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
                url: 'medicalAjax/' + medicineTableRowId,
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
        var filldate = $('#edit-med-date').val();
        var medicname = $('#edit-med-medicname').val();
        var productiondate = $('#edit-med-productiondate').val();
        var expirydate = $('#edit-med-expirydate').val();
        var series = $('#edit-med-series').val();
        var patientregistrationnr = $('#edit-med-patientregistrationnr').val();
        var quantity = $('#edit-med-quantity').val();
        var consumed = $('#edit-med-consumed').val();

        var editedMedicament = {
            'rowId': medicineTableRowId,
            'filldate' : filldate,
            'medicname' : medicname,
            'productiondate' : productiondate,
            'expirydate' : expirydate,
            'series' : series,
            'patientregistrationnr' : patientregistrationnr,
            'quantity' : quantity,
            'consumed' : consumed
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'medikamentai/' + medicineTableRowId,
            method: 'PUT', // Type of response and matches what we said in the route
            data: editedMedicament,
            success: function(response) { // What to do if we succeed
                location.reload();
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