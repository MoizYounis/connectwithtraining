@extends('front.layouts.master')
@section('title')User Dashboard | {{$gs->title}} @endsection
@section('content')
        
    <div class="container" style="font-size:large;">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
	
    	<a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        <a href="{{url('user/profile')}}"> User Profile</a>
    </div>
    <br><br><br><br>
    
    
@endsection
@section('script')
<script>
$(document).ready(function(){
	
});
</script>
@endsection