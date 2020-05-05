// This is to ensure that on edit page  the new position/education fields added references the existing field numbers
$(document).ready(function(){
    var posFields = $('#position_fields').find('div');
    countPos = posFields.length;

    var eduFields = $('#education_fields').find('div');
     countEdu = eduFields.length;
})
 
// A button with an ID of removeEdu, removes the closest div element up the tree; from its position
$(document).on("click", ".removeEdu",function (e){
    e.preventDefault();
     var edu = $(this).closest('div');
     edu.remove();
     console.log('removing  ' + edu.attr('id'));

     // reset the edu count;
     var eduFields = $('#education_fields').find('div');
     countEdu = eduFields.length;
     console.log('you can now add  ' + (9 - eduFields.length) + '  more fields');

});

// A button with an ID of removeEdu, removes the closest div element up the tree; from its position
$(document).on("click", ".removePos", function(e){
    e.preventDefault();
    var pos = $(this).closest('div')
    pos.remove();
     console.log('removing  ' + pos.attr('id'));


     // reset the edu count;
     var posFields = $('#position_fields').find('div');
     countPos = posFields.length;
     console.log('you can now add  ' + (9 - posFields.length )+ ' more fields');

});


// Dynamically creates postion fields
$(document).ready(function(){
    $('#addPos').click(function(e){
        e.preventDefault();
        if(countPos >= 9){
            alert('Maximum of nine postion entries exceeded');
            return;
        }
        countPos++;
        console.log('Adding Position' +countPos);
        var position_fields = '<div id="position' +countPos+'" class="mb-2">\
                            <input type="text" name="year' +countPos+'" value="" class="form-control col-sm-11 float-left" placeholder="Year">\
                            <button id="" class="removePos" onclick="return false" class="form-control col-sm-1 float-right"><i class="fa fa-times-circle"></i></button>\
                            <textarea name="desc' +countPos+'" cols="80" rows="2" class="form-control" placeholder="Description"></textarea>\
                        </div>';
        $('#position_fields').append(position_fields);
    });

});

// Dynamically creates education fields
$(document).ready(function(){
    $('#addEdu').click(function(e){
        e.preventDefault();
        if(countEdu >= 9){
            alert('Maximum of nine education records exceeded');
            return;
        }
        countEdu++;
        console.log('Adding Education' +countEdu);
        var education_fields = '<div id="education' +countEdu+'" class="mb-2">\
                            <input type="text" name="edu_year' +countEdu+'" value="" class="form-control col-sm-11 float-left" placeholder="Year">\
                            <button id="" class="removeEdu" onclick="return false" class="form-control col-sm-1 float-right"><i class="fa fa-times-circle"></i></button>\
                            <textarea id="school" name="edu_school' +countEdu+'" cols="80" rows="2" class="form-control"  value="" placeholder="School"></textarea\
                        </div>';
        $('#education_fields').append(education_fields);
    }); 

});


$(document).ready(function(){
    var data = ["University of Cambridge","University of Michigan", "University of Oxford","University of Virginia"];
     $('#fname').autocomplete({
        source: data
    });
})

$(document).on("focus", "#education_fields", function(){
    var data = 'test.php';
     $('#school').autocomplete({
        source: data
    });
     console.dir('hello from education_fields');
})

