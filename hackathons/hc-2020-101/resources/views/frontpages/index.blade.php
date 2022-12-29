@extends('layouts.home')
@section('title', 'Hack Cambridge 101 — The Official University of Cambridge Hackathon')

@section('header-content')
    <div id="intro-container">
        <img id="top-logo" src="{{ asset('images/101-white.png') }}" />
        <p id="top-tagline" style="">Hack Cambridge is going back to basics with 101.</p>

        <div id="intro-description">
            <p>18<span class="superscript">th</span>-19<span class="superscript">th</span> January, 2020</p>
            <p>Cambridge Corn Exchange, Cambridge CB2 3QB</p>
            <a href="https://blackrock.com", target="_blank">
                <img id="cohost-logo" src="{{ asset('images/101-cohost.png') }}" />
            </a>
        </div>
    </div>
    <div id="header-bottom-card">
        <div id="header-bottom-card-content">
            <img style="padding: 0.1rem 0 0.3rem;" src="{{ asset('images/official-hackathon.png') }}" />
            <img src="{{ asset('images/cambridge.png') }}" />
        </div>
    </div>
@endsection

@section('content')
    <section id="" class="section-diagonal static-section section-paper">
        <div class="container grid-lg large-description" style="padding: 3rem 30px 0.25rem;">
            <p>Hack Cambridge is back for its fifth year! In January 2020, the University of Cambridge’s annual hackathon will yet again bring together 300 outstanding hackers, programmers, designers and more from universities all over the world. For 24 hours, they will build, break and innovate to produce genuinely remarkable projects that push the boundaries of technology.</p>
            <button onclick="window.location.href = '{{ route('apply') }}';" class="apply-button">Apply for 101 →</button>
        </div>
    </section>


    <section id="" class="section-diagonal static-section section-closeup">
        <div class="container grid-lg" style="height: 400px;">
        </div>
    </section>

    <section id="" class="section-diagonal static-section section-floral">
        <div class="container grid-lg large-description" style="padding: 0.1rem 30px 0.5rem;">
            <h5 class="intro-subtitle">That sounds awesome, but isn't it expensive?</h5>
            <p>Nope! That's the best part! Hack Cambridge is totally <strong>FREE!</strong> Even more, you'll get unlimited free food and drinks. With 4 free meals and a constant supply of snacks, we'll make sure you're never hungry, and you don't even have to pay a penny. You'll have access to free hardware and, some of the top tech companies will be sending their engineers to help you realise your vision.</p>

            <h5 class="intro-subtitle">Ok, what's the catch? Surely I have to be a programming genius?</h5>
            <p>Nope! We're looking for enthusiastic people with a desire to make something cool. Hackathon projects take more than just software development, teams with hardware engineers, designers and project managers all help make a hack great! No software development experience is necessary (some people even learn to code during the event itself).</p>

            <h5 class="intro-subtitle">How do I sign up?</h5>
            <button onclick="window.location.href = '{{ route('apply') }}';" class="apply-button" style="margin:25px 0 15px;">Apply for 101 →</button>
        </div>
    </section>

    <section id="" class="section-diagonal static-section section-cam-bg">
        <div class="container grid-lg" style="height: 400px;">
        </div>
    </section>

    <section id="" class="section-diagonal static-section section-peach">
        <div class="container grid-lg" style="padding:2rem 30px 1rem">
            <h1 class="section-header">Frequenly Asked Questions</h1>
            <div class="accordion">
                <!-- Question 1 -->
                <input type="checkbox" id="accordion-1" name="accordion-checkbox-1" hidden>
                <label class="accordion-header" for="accordion-1">
                    <i class="icon icon-arrow-right mr-1"></i> What is a hackathon?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">A hackathon is an invention marathon. Thoughts become things. Attendees work in teams of up to five people to hack together a prototype to solve a problem; this could be a web app, hardware-hack, or something completely different.</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 2 -->
                <input type="checkbox" id="accordion-2" name="accordion-checkbox-2" hidden>
                <label class="accordion-header" for="accordion-2">
                    <i class="icon icon-arrow-right mr-1"></i> Do I need a team?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Nope! You are of course welcome to apply in a pre-formed team but some of our hackers will meet their team when they arrive on the first day. </div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 9 -->
                <input type="checkbox" id="accordion-9" name="accordion-checkbox-2" hidden>
                <label class="accordion-header" for="accordion-9">
                    <i class="icon icon-arrow-right mr-1"></i> How large are the teams?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner"> No more than 4 people can be in a team; otherwise, it would be unfair. </div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 3 -->
                <input type="checkbox" id="accordion-3" name="accordion-checkbox-3" hidden>
                <label class="accordion-header" for="accordion-3">
                    <i class="icon icon-arrow-right mr-1"></i> What am I allowed to build?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Web, mobile, hardware, anything! Projects will be judged based on creativity, technical difficulty, polish and usefulness by a panel of industry judges. The IP of your projects will remain with you.</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 4 -->
                <input type="checkbox" id="accordion-4" name="accordion-checkbox-4" hidden>
                <label class="accordion-header" for="accordion-4">
                    <i class="icon icon-arrow-right mr-1"></i> Am I allowed to attend?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Anyone who is currently a registered student or has graduated after 18th January 2019 is eligible to attend. Sadly we can't accommodate anyone under the age of 18 this year.</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 5 -->
                <input type="checkbox" id="accordion-5" name="accordion-checkbox-5" hidden>
                <label class="accordion-header" for="accordion-5">
                    <i class="icon icon-arrow-right mr-1"></i> Is Hack Cambridge free to attend?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Absolutely! The weekend is free for all accepted hackers. We provide WiFi, meals, swag, and the workspace.</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 6 -->
                <input type="checkbox" id="accordion-6" name="accordion-checkbox-6" hidden>
                <label class="accordion-header" for="accordion-6">
                    <i class="icon icon-arrow-right mr-1"></i> Do you have a code of conduct?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner"><a href="{{ route('conduct') }}">Yes</a>. TL;DR be pleasant and respectful to everyone at the event.</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 7 -->
                <input type="checkbox" id="accordion-7" name="accordion-checkbox-7" hidden>
                <label class="accordion-header" for="accordion-7">
                    <i class="icon icon-arrow-right mr-1"></i> Do you guys offer travel reimbursements?
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Yes. If you're travelling from outside of Cambridge, you can apply for an amount of money back. This will be considered on a case by case basis. (Only travel costs will be considered and applying does not guarantee reimbursement)</div>
                </div>
            </div>
            <div class="accordion">
                <!-- Question 8 -->
                <input type="checkbox" id="accordion-8" name="accordion-checkbox-8" hidden>
                <label class="accordion-header" for="accordion-8">
                    <i class="icon icon-arrow-right mr-1"></i> I have other questions / am a member of the press!
                </label>
                <div class="accordion-body faq-body">
                    <div class="inner">Send us an email at <a href="mailto:team@hackcambridge.com">team@hackcambridge.com</a>. We'd love to chat!</div>
                </div>
            </div>

        </div>
    </section>

    <section id="" class="section-diagonal static-section section-speaker">
        <div class="container grid-lg" style="height: 400px;">
        </div>
    </section>

    <section id="" class="section-diagonal static-section section-ocean">
        <div class="container grid-lg" style="padding:1rem 30px 1.5rem">
            <h1 class="section-header">Sponsors</h1>

            <!-- Temporary placeholder -->
            <!-- <h4 style="font-family: var(--title-font);text-align: center;">— We will announce all our sponsors for 101 very soon! —</h4> -->
            
            <h6 class="sponsor-tier-title">— Cohost —</h6>
            <div id="sponsors-cohost" class="sponsors-container">
                <div class="item">
                    <a href="https://www.blackrock.com" target="_blank">
                        <img src="{{ asset('images/sponsors/blackrock.png') }}" />
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>

            <h6 class="sponsor-tier-title">— Tera —</h6>
            <div id="sponsors-tera" class="sponsors-container">
                <div class="item">
                    <a href="https://www.avast.com" target="_blank">
                        <img src="{{ asset('images/sponsors/avast.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.microsoft.com" target="_blank">
                        <img src="{{ asset('images/sponsors/microsoft.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.reply.com" target="_blank">
                        <img src="{{ asset('images/sponsors/reply.png') }}" />
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>

            <h6 class="sponsor-tier-title">— Giga —</h6>
            <div id="sponsors-giga" class="sponsors-container">
                <div class="item">
                    <a href="https://www.amazon.com" target="_blank">
                        <img src="{{ asset('images/sponsors/amazon.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.huawei.com" target="_blank">
                        <img src="{{ asset('images/sponsors/huawei.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.mathworks.com" target="_blank">
                        <img src="{{ asset('images/sponsors/mathworks.png') }}" />
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>

            <h6 class="sponsor-tier-title">— Mega —</h6>
            <div id="sponsors-mega" class="sponsors-container">
                <div class="item">
                    <a href="https://www.arm.com" target="_blank">
                        <img src="{{ asset('images/sponsors/arm.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.featurespace.com" target="_blank">
                        <img src="{{ asset('images/sponsors/featurespace.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.gresearch.co.uk" target="_blank">
                        <img src="{{ asset('images/sponsors/gresearch.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://improbable.io/" target="_blank">
                        <img src="{{ asset('images/sponsors/improbable.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.janestreet.com" target="_blank">
                        <img src="{{ asset('images/sponsors/janestreet.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.man.com" target="_blank">
                        <img src="{{ asset('images/sponsors/man.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.netcraft.com" target="_blank">
                        <img src="{{ asset('images/sponsors/netcraft.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.thoughtmachine.net" target="_blank">
                        <img src="{{ asset('images/sponsors/thoughtmachine.png') }}" />
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>

            <h6 class="sponsor-tier-title">— Kilo —</h6>
            <div id="sponsors-kilo" class="sponsors-container">
                <div class="item">
                    <a href="https://datascope.co.uk" target="_blank">
                        <img src="{{ asset('images/sponsors/datascope.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="http://hackp.ac/mlh-stickermule-hackathons" target="_blank">
                        <img src="{{ asset('images/sponsors/stickermule.png') }}" >
                    </a>
                </div>
                <div class="item">
                    <a href="https://stripe.com/gb" target="_blank">
                        <img src="{{ asset('images/sponsors/stripe.png') }}" >
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.twilio.com/" target="_blank">
                        <img src="{{ asset('images/sponsors/twilio.png') }}" >
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.wolfram.com" target="_blank">
                        <img src="{{ asset('images/sponsors/wolfram.png') }}" />
                    </a>
                </div>
                <div class="item">
                    <a href="https://www.yoyogames.com" target="_blank">
                        <img src="{{ asset('images/sponsors/yoyogames.png') }}" />
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>


        </div>
    </section>
@endsection
