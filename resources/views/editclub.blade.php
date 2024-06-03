@extends('layouts.app')

@section('content')

    <div class="container"> 

        <div class="columns is-marginless is-centered">
            <div class="column is-8">
                <nav class="card">
                    <header class="card-header ">
                        <p class="card-header-title">
                            Player 
                        </p> 
                    </header>
                    
                    <div class="card-content ">  
                    <a href="/home" class="button is-warning">Home  <i class="fas fa-home"></i></a>

                    <form method="post" enctype="multipart/form-data" action="{{ route('clubcrud.update', $club->id) }}">
                        @method('PATCH')
                        @csrf
                          <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Name:</label> 
                            <div class="field">
                            <div class="control">
                                <textarea required name="name" class="input is-primary "> {{ $club->name }}  </textarea>
                            </div>

                            <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Logo :</label> 
                            <br> <br>
                          @if( $club->photo  != null)
                            <div ><img src="{{url($club->photo)}}" height=80 width=80/></div> 
                            <br>
                            <div class="file is-info ">
                                <label class="file-label">
                                
                                  <input class="file-input" type="file" name="filenames">
                                  <span class="file-cta">

                                    <span class="file-icon">
                                      <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                  
                                    <span class="file-label">
                                        Update Image
                                    </span>
                                  </span>
                                   
                                </label>    
                              </div>
                          @else 
                            <div class="file is-info ">
                                <label class="file-label">
                                
                                  <input class="file-input" type="file" name="filenames">
                                  <span class="file-cta">

                                    <span class="file-icon">
                                      <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                  
                                    <span class="file-label">
                                        Upload Image
                                    </span>
                                  </span>
                                   
                                </label>    
                              </div>
                        @endif 

 
                           
                    <br>
                        <button type="submit" class="button is-success">Update</button> 
                        <a href="{{route('club') }}" class="button is-danger">Cancel</a>
                    </form>


                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
 