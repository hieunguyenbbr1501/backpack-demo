<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
			<small>Use the <span class="label label-default">details_row</span> functionality to show more information about the entry, when that information does not fit inside the table column.</small><br><br>
			<strong>Preview: </strong><a href="{{ url('/admin/post/'.$entry->slug) }}">{{ $entry->title }} <br></a>
			<strong>Content:</strong> {!! $entry->content !!} <br>
			<strong>Created by:</strong> {{ $entry->user_id }} at {{ $entry->created_at }} <br>
			<strong>Last Modified:</strong> {{ $entry->last_user_id }} at {{ $entry->updated_at }} <br>
			etc.
		</div>
	</div>
</div>
<div class="clearfix"></div>