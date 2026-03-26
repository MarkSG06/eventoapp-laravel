@php
    $faqs = \App\Models\MongoDB\Faq::all();
@endphp
<x-faqs :faqs="$faqs"/>
<footer>
	<span><b>ReadTickets</b> © 2026 - All rights reserved</span>
</footer>