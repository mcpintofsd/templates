function registerTemplate(){
    let inData = new FormData();
    inData.append ("id", $('#idTemplate').val());
    inData.append ("name", $('#nameTemplate').val());
    inData.append ("address", $('#addressTemplate').val());
    inData.append ("phone", $('#phoneTemplate').val());
    inData.append ("email", $('#emailTemplate').val());
    inData.append ("type", $('#typeTemplate').val());
    inData.append ("img", $('#imgTemplate').prop('files')[0]);
    inData.append ('op', 1);

    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        getTemplateTable();
        getTemplateSelect();
        getMaxTemplateId();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getTemplateTable(){
    let inData = new FormData();
    inData.append ('op', 2);

    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#templateTableContainer').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getTemplateSelect(){
    let inData = new FormData();
    inData.append ('op', 3);

    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#templateSelect').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getTemplateDetails(id){
    let inData = new FormData();
    inData.append ('op', 4);
    inData.append ('id', id);

    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#idTemplateEdit').val(obj.id);
        $('#nameTemplateEdit').val(obj.nome);
        $('#editTemplateBtn').attr('onclick', 'editTemplate(' + obj.id + ')');
        $('#templateDetailsModal').modal('show');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function editTemplate(id){
    let inData = new FormData();
    inData.append ('op', 5);
    inData.append ("id", id);
    inData.append ("newId", $('#idTemplatedit').val());
    inData.append ("name", $('#nameTemplateEdit').val());

    $.ajax({
    url: "assets/controller/controllerClient.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        getTemplateTable();
        getTemplateSelect();
        getMaxTemplateId();
        $('#templateDetailsModal').modal('hide');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removeTemplate(id){
    let inData = new FormData();
    inData.append ('op', 6);
    inData.append ("id", id);

    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        getTemplateTable();
        getTemplateSelect();
        getMaxTemplateId();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

//Register checkbox table items
let maxId;

function getMaxTemplateId(){
    let inData = new FormData();
    inData.append ('op', 7);
   
    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        maxId = msg;
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function registerArrayTemplate(){
    let tempArr = [];

    for(let i = 0; i <= maxId; i++){
        if($('#checkTemplate' + i).is(':checked')){
            tempArr.push([
                $('#quantTemplate' + i).val(),
                $('#checkTemplate' + i).val()
            ]);
        }
    }

    let enTempArr = JSON.stringify(tempArr);

    let inData = new FormData();
    inData.append ('op', 3);
    inData.append ('id', id);
    inData.append ('template', enTempArr);
   
    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

//Display input for item registration based on onchange select
function checkTemplateSelect(optionSelected){
    let txt = "";

    if(optionSelected == -2){
        txt = "<div class='col-md-6'><label for='addYearInput' class='form-label'>Ano a Registar</label>";
        txt += "<input type='number' class='form-control form-control-sm' id='addYearInput' required></input></div>";

        $('#yearInputPlacement').html(txt);
    }
}

//Conditional registration
let inData = new FormData();
    inData.append ('op', 1);
    if($('#templateSelect').val() != -2){
        inData.append ("template", $('#templateSelect').val());
    }else{
        inData.append ("template", $('#templateInput').val());
    }
    
    $.ajax({
    url: "assets/controller/controllerTemplate.php",
    method: "POST",
    data: inData,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

$(function() {
    getTemplateTable();
    getTemplateSelect();
    getMaxTemplateId();
});