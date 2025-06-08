<div>
@if (session('info'))

        <div id="contactmessage" class="alert alert-success">

            {{ session('info') }}
        </div>
@endif
</div>
