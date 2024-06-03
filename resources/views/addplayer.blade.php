@extends('layouts.app')

@section('content')

<script type="text/javascript">

$(document).ready(function(){    
  var postURL = "<?php echo url('addmore'); ?>";
  var i=1;  

  $('#add').click(function(){  
       i++;  
     //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select id="p" name="clubs[]" >@php ($data = [])@foreach($club as $clubs)<option value="{{ $clubs->name }}">{{ $clubs->name }} </option>@php ($data[] = $clubs->name)@endforeach<input required name="duration[]" class="input is-primary " type="text"  placeholder="Enter Duration"></select> <td><button type="button" name="remove" id="'+i+'" class="button is-danger btn_remove">X</button></td></tr>');   
  });  

  $(document).on('click', '.btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#row'+button_id+'').remove();  
  });  

  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#submit').click(function(){            
       $.ajax({  
            url:postURL,  
            method:"POST",  
            data:$('#add_name').serialize(),
            type:'json',
            success:function(data)  
            {
                if(data.error){
                    printErrorMsg(data.error);
                }else{
                    i=1;
                    $('.dynamic-added').remove();
                    $('#add_name')[0].reset();
                    $(".print-success-msg").find("ul").html('');
                    $(".print-success-msg").css('display','block');
                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                }
            }  
       });  
    });  

  function printErrorMsg (msg) {
     $(".print-error-msg").find("ul").html('');
     $(".print-error-msg").css('display','block');
     $(".print-success-msg").css('display','none');
     $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
     });
  }
});  

</script>

    <div class="container"> 
        <div class="columns is-marginless is-centered">
            <div class="column is-8">
                <nav class="card">
                    <header class="card-header ">
                        <p class="card-header-title">
                            Player 
                        </p> 
                    </header> 
                   
                    <div class="card-content">  
                    <a href="/home" class="button is-warning">Home  <i class="fas fa-home"></i></a>
                    <br><br>
                    <form method="post" enctype="multipart/form-data" action="{{ route('crud.store') }}">
                        @method('POST')
                        @csrf
                          <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">Player Name:</label> </b>
                            <div class="field">
                            <div class="control">
                                <input required name="name" class="input is-primary " type="text"  >  
                            </div>
                            <br>
                            <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">National Team:</label> </b>
                            <div class="field">
                            <div class="control">
                                <input required name="national_team" class="input is-primary " type="text"  >  
                            </div>
                            <br>
                            <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">Position:</label> </b>
                            <div class="field">
                            <div class="control">
                                <input required name="position" class="input is-primary " type="text"  >  
                            </div>

                            <br>
                            <div class="form-group">
                            <b><label for="recipient-name" class="col-form-label">Hint's:</label> </b> 
                            <div class="field">
                            <div class="control"> 
                                <textarea name="hint" class="textarea is-primary" >  </textarea>
                            </div>
                            </div></div>
                            <br>
 
                            <b><label for="recipient-name" class="col-form-label">Answer :</label></b>
                            <br>  
                            
                            <select id="p" name="answer"  > 
                                <option value="True">True</option> 
                                <option value="False">False</option>  
                            </select>
                            
                            <br>
                            <b><label for="recipient-name" class="col-form-label">Difficulty Level:</label></b>
                            <br>  
                            
                            <select id="p" name="difficulty" > 
                                <option value="Easy">Easy</option> 
                                <option value="Medium">Medium</option> 
                                <option value="Hard">Hard</option>  
                            </select>
                            
                            <br>
                            <b><label for="recipient-name" class="col-form-label">Clubs:</label></b>
                            <br>  
                              
                    <div class="form-group">
                        <form name="add_name" id="add_name">  
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                             <div class="alert alert-success print-success-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="table-responsive">  
                                <table class="table table-bordered" id="dynamic_field">  
                                    <tr>   
                                        <td>
                                        <button type="button" name="add" id="add" class="button is-info">Add Clubs</button></td>  
                                    </tr>  
                                </table>
                            </div>
                        </form>  
                    </div> 
                    
 
                        <br><br>
                        <button type="submit" class="button is-success">Add</button> 
                        <a href="{{route('player') }}" class="button is-danger">Cancel</a>
                    </form>
  
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
  
