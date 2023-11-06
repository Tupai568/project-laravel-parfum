@if (session()->has('error'))
<div class="container-flash">
    <span class="error">{{ session("error") }}</span>
</div>
@endif @if (session()->has('success'))
<div class="container-flash">
    <span class="success">{{ session("success") }}</span>
</div>
@endif
