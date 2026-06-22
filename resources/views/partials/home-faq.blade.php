@if($faqSection && $faqSection->items->isNotEmpty())
<section class="reveal faq-section" id="faq">
    <div class="container container-two">
        <!-- FAQ Header -->
        <div class="reveal faq-header text-center">
            <span class="faq-label">FAQ</span>
            <h2 class="faq-title">{{ $faqSection->title }}</h2>
            @if($faqSection->subtitle)
                <p class="faq-subtitle">{{ $faqSection->subtitle }}</p>
            @endif
        </div>

        <!-- FAQ Accordion Container -->
        <div class="faq-accordion-container">
            @foreach($faqSection->items as $index => $item)
                <div class="faq-item @if($index === 0) active @endif" id="faq-item-{{ $item->id }}">
                    <!-- FAQ Question (Toggle) -->
                    <button class="faq-question-btn" type="button" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="faq-answer-{{ $item->id }}">
                        <div class="question-content">
                            <span class="question-icon">?</span>
                            <span class="question-text">{{ $item->question }}</span>
                        </div>
                        <div class="toggle-icon">
                            <span class="icon-line horizontal"></span>
                            <span class="icon-line vertical"></span>
                        </div>
                    </button>

                    <!-- FAQ Answer (Content) -->
                    <div class="faq-answer-wrapper" id="faq-answer-{{ $item->id }}" style="{{ $index === 0 ? 'max-height: 1000px;' : 'max-height: 0;' }}">
                        <div class="faq-answer-content">
                            <div class="answer-text">
                                <p>{{ $item->answer }}</p>
                            </div>
                            @if($item->image)
                                <div class="answer-image">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->question }}" loading="lazy">
                                    <div class="image-overlay"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
/* --- FAQ Section Styles --- */
.faq-section {
    padding: 100px 0;
    background: #fff;
    overflow: hidden;
}

.faq-header {
    margin-bottom: 60px;
}

.faq-label {
    display: block;
    color: #d19e66;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    margin-bottom: 12px;
}

.faq-title {
    font-family: var(--font-serif, "Cormorant Garamond", serif); /* Matches Softyskin style */
    font-size: 42px;
    font-weight: 700;
    color: #1b1b18;
    margin-bottom: 20px;
    line-height: 1.2;
}

.faq-subtitle {
    font-size: 16px;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Accordion */
.faq-accordion-container {
    max-width: 1000px;
    margin: 0 auto;
    border-top: 1px solid #f0f0f0;
}

.faq-item {
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.faq-item.active {
    background: #fff;
}

.faq-question-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 28px 24px;
    background: none;
    border: none;
    cursor: pointer;
    text-align: left;
    outline: none;
}

.question-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.question-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #d19e66;
    font-weight: 700;
    background: #fff;
}

.question-text {
    font-size: 18px;
    font-weight: 700;
    color: #1b1b18;
    transition: color 0.3s ease;
}

/* Toggle Icon (+/-) */
.toggle-icon {
    position: relative;
    width: 14px;
    height: 14px;
    flex-shrink: 0;
}

.icon-line {
    position: absolute;
    background: #1b1b18;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.icon-line.horizontal {
    width: 100%;
    height: 2px;
    top: 6px;
    left: 0;
}

.icon-line.vertical {
    width: 2px;
    height: 100%;
    top: 0;
    left: 6px;
}

.faq-item.active .icon-line.vertical {
    transform: rotate(90deg);
    opacity: 0;
}

/* Answer Wrapper */
.faq-answer-wrapper {
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
}

.faq-item.active .faq-answer-wrapper {
    height: auto;
    transition: max-height 0.5s cubic-bezier(1, 0, 1, 0);
}

.faq-answer-content {
    padding: 0 24px 35px 76px; /* Align with text */
    display: flex;
    gap: 40px;
    align-items: flex-start;
}

.answer-text {
    flex: 1;
}

.answer-text p {
    font-size: 16px;
    line-height: 1.8;
    color: #666;
    margin: 0;
}

.answer-image {
    width: 280px;
    flex-shrink: 0;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.answer-image img {
    width: 100%;
    height: auto;
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.1), transparent);
}

/* Responsive FAQ */
@media (max-width: 991px) {
    .faq-section { padding: 70px 0; }
    .faq-title { font-size: 34px; }
    .faq-answer-content {
        flex-direction: column;
        padding-left: 24px;
        padding-right: 24px;
    }
    .answer-image {
        width: 100%;
        max-width: 400px;
        margin-top: 20px;
    }
    .question-text { font-size: 16px; }
}

@media (max-width: 575px) {
    .faq-question-btn { padding: 20px 15px; }
    .question-content { gap: 12px; }
    .question-icon { width: 28px; height: 28px; }
    .faq-answer-content { padding-left: 15px; padding-right: 15px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const btn = item.querySelector('.faq-question-btn');
        const wrapper = item.querySelector('.faq-answer-wrapper');

        btn.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer-wrapper').style.maxHeight = '0';
                    otherItem.querySelector('.faq-question-btn').setAttribute('aria-expanded', 'false');
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                wrapper.style.maxHeight = '0';
                btn.setAttribute('aria-expanded', 'false');
            } else {
                item.classList.add('active');
                wrapper.style.maxHeight = '1000px'; // Arbitrary large value
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
});
</script>
