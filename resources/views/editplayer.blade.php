@extends('layouts.app')

@section('content')

<script type="text/javascript">

$(document).ready(function(){    
  var postURL = "<?php echo url('addmore'); ?>";
  var i=1;  

  $('#add').click(function(){  
       i++;  
     //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select id="p" name="clubs[]" >@php ($data = [])@foreach($allclub as $allclubs)<option value="{{ $allclubs->name }}">{{ $allclubs->name }} </option>@php ($data[] = $allclubs->name)@endforeach<input required name="duration[]" class="input is-primary " type="text"  placeholder="Enter Duration"></select> <td><button type="button" name="remove" id="'+i+'" class="button is-danger btn_remove">X</button></td></tr>');   
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
            @if(session()->get('del'))
            <div class="notification is-danger">
                <button class="delete"></button>
                {{ session()->get('del') }}  
            </div> 
            @endif

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

                    <form method="post" enctype="multipart/form-data" action="{{ route('crud.update', $player->id) }}">
                        @method('PATCH')
                        @csrf
                          <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">Name:</label> </b>
                            <div class="field">
                            <div class="control">
                                <textarea required name="name" class="input is-primary"  >  {{ $player->name }} </textarea>
                            </div>
                            <br>
                            <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">National Team:</label> </b>
                            <div class="field">
                            <div class="control">
                                <textarea required name="national_team" class="input is-primary " >{{ $player->national_team }}</textarea> 
                            </div>
                            <br>
                            <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">Position:</label> </b>
                            <div class="field">
                            <div class="control">
                                <input required name="position" class="input is-primary " type="text" value={{ $player->position }}>  
                            </div>
                            <br>
 
                            <div class="form-group">
                          <b><label for="recipient-name" class="col-form-label">Hint:</label> </b>
                            <div class="field">
                            <div class="control">
                                <textarea name="hint" class="textarea is-primary " type="text" >{{ $player->hint }}</textarea>  
                            </div>
                            <br>

                            <b><label for="recipient-name" class="col-form-label">Answer:</label></b>
                            <select  class="form-control" name="answer"  >
                                <option value="{{ $player->answer }} "selected  > {{ $player->answer }}</option>
                                <option value="True"> True</option>
                                <option value="False">False</option>
                            </select>
                            <br><br>
                            
                            <b><label for="recipient-name" class="col-form-label">Difficulty Level:</label></b> 

                            <select id="p" name="difficulty" > 
                                <option value="{{ $player->difficulty }}" selected  > {{ $player->difficulty }} </option>
                                <option value="Easy"> Easy</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard" >Hard</option>
                            </select>
                            <br><br>

                            <b><label for="recipient-name" class="col-form-label">Clubs:</label></b> 

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
                            <table class="table  is-bordered"> 
                                <!-- @foreach ($club as $logo)<td>  
                                    @if($logo->player_id == $player->id ) 
                                            <img src="{{url($logo->Club[0]->photo)}}" height=80 width=80/>   
                                                <br><b>Club : <i>{{ $logo->Club[0]->name }} </i>
                                                <br>Duration :<i> {{ $logo->duration }} </i>  </b>  
                                                <a href="{{ route('playerclub.edit',$logo->id)}}" class="button is-info">Edit</a>
                                                <a href="{{ route('playerclub.show',$logo->id)}}" class="button is-danger">Delete</a> 
                                            </td>
                                    @endif
                                <br>
                                @endforeach --> 
                                    
                                <tr>   
                                        @foreach ($club as $key => $logo)
                                        @if($key%7 == 0)   <tr>   </tr> @endif 
                                            @if($logo->player_id == $player->id )
                                                <td style="height:100px;overflow:auto;">
                                                    <img src="{{url($logo->Club[0]->photo)}}" height=60 width=60/>
                                                    <br>
                                                    <b> Club : </b> {{ $logo->Club[0]->name }} 
                                                    <b> Duration : </b>{{ $logo->duration }} 
                                                     <!-- <a href="{{ route('playerclub.edit',$logo->id)}}" class="button is-info">Edit</a> -->
                                                    <a href="{{ route('playerclub.show',$logo->id)}}" class="button is-danger">Delete</a> 
                                                </td>  
                                            @endif 
                                        @endforeach 
                                </tr>  

                            </table> 
                        <br>
                        <button type="submit" class="button is-success">Update</button> 
                        <a href="{{route('player') }}" class="button is-danger">Cancel</a>
                    </form>
  
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
 