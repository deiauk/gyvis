$(document).ready(function() {
    var tableRowId = -1;
   $('.clickable-row').click(function (e) {
       var selectedClass = $('.selected-table-row');
       tableRowId = this.id;
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

   function resetBtnStates() {
       tableRowId = -1;
       $('#delete').addClass('disabled');
       $('#edit').addClass('disabled');
       $('#cure').addClass('disabled');
   }

   // $('#delete').click(function () {
   //    if(tableRowId !== -1) {
   //
   //        tableRowId = -1;
   //    }
   // });

    $('#delete').click(function () {
        if(tableRowId !== -1) {
            $('#confirm-delete').modal('show');
            //tableRowId = -1;
        }
    });

    $('#edit').click(function () {
        if(tableRowId !== -1) {
            $('#edit-animal').modal('show');
        }
    });

    $('#edit-animal').on('show.bs.modal', function (e) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
            url: 'gyvunasAxax/' + tableRowId,
            method: 'GET', // Type of response and matches what we said in the route
            success: function(response) { // What to do if we succeed
                $(".nr-val").val(response.number);
                $(".description-val").val(response.name);
                $(".live-being").val(response.liveBeing);
                $(".breed-being").val(response.breedName);
                console.log(response.number);
                if(response.sex === 1) {
                    $(".male").attr("checked", true);
                    $(".female").attr("checked", false);
                } else if (response.sex === 0) {
                    $(".male").attr("checked", false);
                    $(".female").attr("checked", true);
                }
                $(".color").val(response.color);
                $(".mother").val(response.mother);
                $(".father").val(response.father);
                $(".description-user").val(response.comment);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
            }
        });
    });

    $('#add-animal').on('show.bs.modal', function (e) {
        $(".nr-val").val('');
        $(".description-val").val('');
        $(".live-being").val('');
        $(".breed-being").val('');
        $(".male").attr("checked", false);
        $(".female").attr("checked", false);
        $(".color").val('');
        $(".mother").val('');
        $(".father").val('');
        $(".description-user").val('');
    });

   $('#confirm-delete-btn').click(function () {
       if(tableRowId !== -1) {
           var obj = {
               id: tableRowId
           };
           $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')},
               url: 'trinti',
               method: 'POST', // Type of response and matches what we said in the route
               data: obj,
               success: function(response) { // What to do if we succeed
                   location.reload();
               },
               error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                   console.log(JSON.stringify(jqXHR));
                   console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
               }
           });
           tableRowId = -1;
       }
   });
});