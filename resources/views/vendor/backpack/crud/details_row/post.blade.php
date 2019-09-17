<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
			<small>Use the <span class="label label-default">details_row</span> functionality to show more information about the entry, when that information does not fit inside the table column.</small><br><br>
			<strong>Title:</strong><a href="{{ url('/post/'.$entry->slug) }}" {{ $entry->title }} <br>
			<strong>Textarea:</strong> {{ $entry->title }} <br>
			<strong>Email:</strong> {{ $entry->title }} <br>
			<strong>Number:</strong> {{ $entry->title }} <br>
			<strong>Float:</strong> {{ $entry->title }} <br>
			<strong>Week:</strong> {{ $entry->title }} <br>
			<strong>Month:</strong> {{ $entry->title }} <br>
			etc.
		</div>
	</div>
</div>
<div class="clearfix"></div>