@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session()->get('fail'))
            <div class="notification is-danger">
                <button class="delete"></button>
                {{ session()->get('fail') }}  
            </div> 
        @endif

        @if(session()->get('edit'))
            <div class="notification is-info">
                <button class="delete"></button>
                {{ session()->get('edit') }} 
            </div> 
         @endif
        
        <div class="columns is-marginless is-centered">
            <div class="column is-5">
                <nav class="card">
                    <header class="card-header ">
                        <p class="card-header-title">
                            Club
                        </p> 
                    </header>
                    
                    <div class="card-content"> 
                    <a href="home" class="button is-warning">Home <i class="fas fa-home"></i> </a>
                    <a href="addclub" class="button is-success">Add Club <i class="fas fa-gamepad"></i></a>
                        <table class="table">
                          <thead>
                            <tr> 
                              <th> No</th>
                              <th> Name</th>
                              <th> Logo </th> 
                              <th> Edit  </th> 
                              <th> Delete </th> 
                            </tr>
                          </thead> 
                          <tbody>
                            @foreach ($club as $clubs)
                                <tr> 
                                    <td>{{ $clubs->id }}</td> 
                                    <td>{{ $clubs->name }}</td>
                                    <td> 
                                    
                                    @if($clubs->photo!=null)
                                            <div><img src="{{url($clubs->photo)}}" height=80 width=80/></div> 
                                    @else
                                            Upload Logo
                                    @endif

                                    </td>    
                                    <td>  <a href="{{ route('clubcrud.edit',$clubs->id)}}" class="button is-info">Edit</a>    </td>     
                                    <td>
                                     <form action="{{ route('clubcrud.destroy', $clubs->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button is-danger" type="submit">Delete</button>
                                    </form> 
                                    </td> 
                                </tr> 
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
