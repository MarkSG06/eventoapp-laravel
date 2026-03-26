@props([
	'faqs'
])
<div class="faqs">
    <div class="faqs-container">
				<h2>{{ __('front/faq.title') }}</h2>
				@foreach($faqs as $faq)
					<div class="faqs-item">
						<div class="faqs-item-header">
							<div class="faqs-item-question">
								{{ $faq->question }}
							</div>
							<div class="faqs-item-icon">
								+
							</div>
						</div>
						<div class="faqs-item-answer hide ">
								{{ $faq->answer }}
						</div>
					</div>
				@endforeach
		</div>
</div>