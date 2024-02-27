$(document).ready(function(e){

    $('.records_table').DataTable();
    //$('.datepicker').datepicker({maxDate: '0'});
    $(document).on('click', '.datepicker', function(){
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: '0'
         }).focus();
    });
    $('.timepicker').timepicker({});
    //$('.timepicker').timepicker('setTime', new Date());
    $('#timepicker_now').on('click', function (){
        $('.timepicker').timepicker('setTime', new Date());
    });

   $("body").on("submit", "#createNewForm", function(e){
        
        e.preventDefault();
        
        $.ajax({
            url: $("#base_url").val() + "dbcontroller/createNewForm",
            type: "POST",
            data: $(this).serialize(),
            success: function(result){
                
                if(result == "ok"){
                    window.location.href = $("#base_url").val() + "forms";
                }else{
                    alert(result);
                }
            }
        })
    
   });
   
   $("body").on("change keyup", "#value_type", function(e){
        
        var val = $(this).val();
        
        $(".max_size_viewer").hide();
        $("#max_size").val("");
        $("#value_option option[value='S']").prop("disabled", false);
        
        $(".selection_viewer").hide();
        $(".selection_value").val("").prop("disabled", true);
        $("#value_option").val("M");
        
        if(val == "VARCHAR"){
            $(".max_size_viewer").show();
        }
        
        $(".selection_value").val("");
        if(val == "TEXT" || val == "VARCHAR"){
            $(".selection_value").prop({type: "text"});
        }else if(val == "TIME" || val == "DATE"){
            $("#value_option option[value='S']").prop("disabled", true);
        }else{
            $(".selection_value").prop({type: "number"});
        }
    
   });
   
   $("body").on("change keyup", "#value_option", function(e){
        
        var val = $(this).val();
        var type = $("#value_type").val();
        
        $(".selection_viewer").hide();
        $(".selection_value").val("").prop("disabled", true);
        
        var c = $("tbody.add_remove_rows tr").length;
        
        for(i = 1; i < c; i++){
            
            if (c > 1) var b = $("tbody.add_remove_rows > tr:last-child").remove();
        }
        
        if(type == "TEXT" || type == "VARCHAR"){
        
            $(".selection_value").prop({type: "text"});
        }else{
            $(".selection_value").prop({type: "number"});
        }
        
        if(val == "S"){
            $(".selection_value").val("").prop("disabled", false);
            $(".selection_viewer").show();
            
        }
         
   });
   
   
   $("body").on("click", ".add_line", function(a){
            
        a.preventDefault();
            
        var c = $("tbody.add_rows tr").length;
        var b = $("tbody.add_rows > tr:first").html().replace(/0/g,c);
        var d = b.replace('<td><span class="numbering" id="1">1</span></td>','<td class="numbering" id="'+(c+1)+'">'+(c+1)+'</td>');
                
        $("tbody.add_rows").append("<tr id='"+c+"'>"+d+"</tr>");
        $(".selection_value#sv"+c).val("");
            
    });
    
    $("body").on("click", ".remove_line", function(a){
        a.preventDefault();
        var c = $("tbody.add_rows tr").length;
         
        if (c > 1) var b = $("tbody.add_rows > tr:last-child").remove();
        
    });
    
    $("body").on("click", ".form_settings", function(e){
        
        $("#primary_key").val($(this).attr("PK_id"));
        $(".modal-title").text($(this).attr("Form_name") + " Settings");
        $(".selection_viewer").hide();
        $(".max_size_viewer").hide();
        $(".selection_value").val("");
        $("#field_name").val("");
        $("#value_type").val("TEXT");
        $("#value_option").val("M");
        $("#max_size").val("");
        $(".btn_settings").text("Save Setting");
        $("#pk_structure_id").val("");
        
        $.ajax({
           url: $("#base_url").val() + "dbcontroller/showColumns",
           type: "POST",
           data: {"primary_key": $(this).attr("PK_id")},
           success: function(result){
                //$(".column_names").html(result);
                $(".column_list").html(result);
           }
            
        });
        
    });
    
    $("body").on("submit", "#createSetting", function(e){
        
        e.preventDefault();
        
        if($("#value_option").val() != "S"){
            $(".selection_value").prop("disabled", true);
        }
        
        $.ajax({
            url: $("#base_url").val() + "dbcontroller/createNewSetting",
            type: "POST",
            dataType: "json",
            data: $(this).serialize(),
            success: function(result){
                if(result.message == "ok"){
                    $(".column_list").html(result.columns);
                    $(".selection_viewer").hide();
                    $(".max_size_viewer").hide();
                    $(".selection_value").val("");
                    $("#field_name").val("");
                    $("#value_type").val("TEXT");
                    $("#value_option").val("M");
                    $("#max_size").val("");
                    $(".btn_settings").text("Save Setting");
                    $("#pk_structure_id").val("");
                    //window.location.href = $("#base_url").val() + "forms";
                }else{
                    alert(result.message);
                }
                
                
            }
        })
    
   });
   
   $("body").on("click", ".form_entry", function(e){
    
        var PK_id = $(this).attr("PK_id");
        
        $.ajax({
            url: $("#base_url").val() + "dbcontroller/getFormFields",
            type: "POST",
            dataType: "json",
            data: {"PK_id": PK_id},
            success: function(result){
                $(".form_entry_container").html(result.fields);
                $(".modal-title").text(result.title);
                //window.location.href = $("#base_url").val() + "forms";
                
            }
        });
   });
   
   $("body").on("submit", "#saveRecord", function(e){
        
        e.preventDefault();
        
        $.ajax({
            url: $("#base_url").val() + "dbcontroller/saveNewRecord",
            type: "POST",
            data: $(this).serialize(),
            success: function(result){
                if(result == "ok"){
                    window.location.href = $("#base_url").val() + "forms";
                }else{
                    alert(result);
                }
                
                
            }
        })
    
   });
   
   $("body").on("click", ".records_viewer", function(e){
        
        var PK_id = $(this).attr("PK_id");
        $(".modal-title").text($(this).attr("Form_name") + " Records");
        
        $.ajax({
           url: $("#base_url").val() + "dbcontroller/getRecords",
           type: "POST",
           data: {"PK_id": PK_id},
           success: function(result){
                $(".table_container").html(result);
                
           }
            
        });
        
    });
    
    $("body").on("click", ".form_update", function(e){
       
        var PK_id = $(this).attr("PK_id");
       
        $(".modal-title").text($(this).attr("Form_name"));
        $("#update_form_title").val($(this).attr("Form_name"));
        $("#update_department").val($(this).attr("Form_department"));
        $("#update_form_description").val($(this).attr("Form_description"));
        $("#update_primary_key").val(PK_id);
       
    });
    
    $("body").on("submit", "#updateForm", function(e){
       
        e.preventDefault();
        
        $.ajax({
           url: $("#base_url").val() + "dbcontroller/updateTable",
           type: "POST",
           data: $(this).serialize(),
           success: function(result){
                window.location.href = $("#base_url").val() + "forms";
                
           }
            
        });
         
    });
    
    $("body").on("click", ".form_delete", function(e){
        
        var PK_id = $(this).attr("PK_id");
        var option = $(this).attr("Option")
        
        $("#delete_primary_key").val(PK_id);
        $("#delete_option").val(option);
        
        $(".modal-title#deleteModal").text("Would you like to delete '" + $(this).attr("Form_name") + "' ?");
       
        if(option == "table"){
            $(".delete_notes").html("Once confirmed, all of the records under this Form will be <span style='color: red;'>PERMANENTLY</span> deleted from the Database");
        }else{
            $(".delete_notes").html("Once confirmed, all of the records under this field of this form  will be <span style='color: red;'>PERMANENTLY</span> deleted from the Database");
        }
        
        
    });
    
    $("body").on("click", ".edit_field_structure", function(e){
        
        var PK_structure_id = $(this).attr("PK_structure_id");
        
        $("#pk_structure_id").val(PK_structure_id);
        $(".btn_settings").text("Update Setting");
        $(".selection_viewer").hide();
        
        $.ajax({
           url: $("#base_url").val() + "dbcontroller/getStructureDetails",
           type: "POST",
           dataType: "json",
           data: {"pk_structure_id": PK_structure_id},
           success: function(result){
            
                $("#field_name").val(result.field_name);
                $("#value_type").val(result.value_type);
                $("#value_option").val(result.value_option);
                $("#max_size").val(result.size);
                
                if(result.value_option == "S"){
                    
                    $(".selection_viewer").show();
                    $(".add_rows").html(result.option_values);
                }
           }
            
        });
       
        
    });
    
    $("body").on("submit", "#deleteForm", function(e){
        
        e.preventDefault();
        $("#deleteCloseBtn").trigger("click");
        var option = $("#delete_option").val();
        
        $.ajax({
           url: $("#base_url").val() + "dbcontroller/deleteTableColumn",
           type: "POST",
           data: $(this).serialize(),
           success: function(result){
                
                if(option == "table"){
                    window.location.href = $("#base_url").val() + "forms";
                }else{
                    $(".column_list").html(result);
                }
                
                
                
                
           }
            
        });
        
    });
    
    $("body").on("click", ".update_records_viewer", function(e){
    
        $.ajax({
           
           url: $("#base_url").val() + "dbcontroller/viewRecordsDetail",
           type: "POST",
           dataType: "json",
           data: {"PK_id": $(this).attr("PK_id"), "Form_id": $(this).attr("Form_id")},
           success: function(result){
                $("#updateRecordModal").text("");
                $(".modal-body#updateRecordBody").html(result.page);
           }
            
        });
        
    });
    
    $("body").on("submit", "#updateRecordForm", function(e){
       
        e.preventDefault();
        $("#updateRecordCloseBtn").trigger("click");
        
        $.ajax({
           
           url: $("#base_url").val() + "dbcontroller/updateRecordsDetail",
           type: "POST",
           dataType: "json",
           data: $(this).serialize(),
           success: function(result){
                $(".table-container").html(result.page);
           }
            
        });
    });
    
    $("body").on("click", ".remove_record", function(e){
    
        var table = $(this).attr('table_name');
        var PK_id = $(this).attr('PK_id');
        var PK_column = $(this).attr('PK_column');
        var Form_id = $(this).attr('Form_id');
        
        
        if(confirm("Do you wish to PERMANENTLY delete this Record?")){
            $.ajax({
               url: $("#base_url").val() + "dbcontroller/deleteRecord",
               type: "POST",
               data: {"table_name": table, "PK_id": PK_id, "PK_column": PK_column},
               success: function(result){
                    $.ajax({
                       url: $("#base_url").val() + "dbcontroller/getRecords",
                       type: "POST",
                       data: {"PK_id": Form_id},
                       success: function(result){
                            $(".table_container").html(result);
                            
                       }
                        
                    });
               }
            })
       }
    });

    $(".add-row").click(function() {
        var markup = $('table.main').find('tr:eq(3)').clone();
        $("table tbody").append(markup);
        populateTableNum();
    });
    
    // Find and remove selected table rows
    $(".delete-row").click(function(){
        var tr_length = $('table.main tbody tr.form-inputs').length;
        var checked_length = $('input[name="record"]:checked').length;
        
        if (checked_length < tr_length) {
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
            populateTableNum();
        } 
    });

    function populateTableNum() {
        $.each($('.num'), function(index, element){
     
            $(this).text(index + 1);
        });
    }
   
});