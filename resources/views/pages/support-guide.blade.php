@extends("layout")
@section("content")
    <section class="padding-top-30 padding-bottom-40 beige-background">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center fs-45 lato-bold">Support Guide</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-bottom-50 beige-background slider-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <div class="support-guide-slider second-type-arrows">
                        @foreach($posts as $post)
                            <div class="single-slide">
                                @if(!empty($post->media))
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                        <img alt="{{$post->media->alt}}" itemprop="contentUrl" src="/assets/uploads/{{$post->media->name}}"/>
                                    </figure>
                                @endif
                                <div class="number">
                                    @php($num = $post->order_id + 1)
                                    @if($num < 10)
                                        0{{$num}}
                                    @else
                                        {{$num}}
                                    @endif
                                </div>
                                <div class="description">
                                    <div class="custom-triangle"></div>
                                    <div class="custom-circle"></div>
                                    <div class="wrapper">{!! $post->text !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-50 padding-bottom-50 list">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center fs-45 lato-bold">Frequently Asked Questions</h2>
                    <section class="section-row">
                        <div class="fs-30 section-title padding-top-30 padding-bottom-20 lato-bold">General</div>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">01</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">02</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">03</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                        </ul>
                    </section>
                    <section class="section-row">
                        <div class="fs-30 section-title padding-top-30 padding-bottom-20 lato-bold">Wallet & Rewards</div>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">01</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">02</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">03</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                        </ul>
                    </section>
                    <section class="section-row">
                        <div class="fs-30 section-title padding-top-30 padding-bottom-20 lato-bold">Technical Questions</div>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">01</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">02</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="fs-20 question"><span class="lato-black fs-20">03</span>What can Dentacoin Wallet do?</a>
                                <div class="fs-18 fs-xs-16 calibri-light padding-bottom-30 padding-top-10 padding-left-20 padding-right-20 question-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section class="blue-green-color-background padding-top-15 padding-bottom-20">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center white-color fs-45 lato-bold">WIN - WIN</div>
            </div>
        </div>
    </section>
    <section class="padding-top-50 padding-bottom-50">
        <div class="container">
            <div class="row">
                <figure itemscope="" itemtype="http://schema.org/ImageObject" class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <img alt="Faq bottom image" itemprop="contentUrl" src="/assets/uploads/faq-bottom-img.svg"/>
                </figure>
            </div>
        </div>
    </section>
@endsection