@if(!Auth::user() && !Auth::guard('company')->user())
<div class="emploginbox">
	<div class="container">		
		<div class="titleTop">
			<div class="subtitle">{{__('Are You Looking For Candidates!')}}</div>
           <h3>{{__('Post a Job Today')}}  </h3>
			<h4>{{__('and Hire the Right Candidates')}}</h4>
        </div>
		<p></p>
		<div class="viewallbtn"><a href="{{route('register')}}">{{__('Post a Job')}}</a></div>
	</div>
</div>
@endif