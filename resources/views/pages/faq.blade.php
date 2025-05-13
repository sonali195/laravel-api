@extends('layouts.app')

@section('title') FAQs @endsection

@section('content')
<section class="mb-2" id="">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 text-center mx-auto">
                <h2 class="mt-3">
                    FAQs
                </h2>
                <p class="">
                    Have questions about {{env('APP_NAME')}}? Explore our FAQs for prompt and informative responses to common queries.
                </p>
            </div>

            <div class="col-lg-10 mx-auto mt-9 mt-md-11">

                <form class="search-form w-100 mb-5">
                    <div class="input-group">
                        <input type="search" name="search" value="{{ $search ?? "" }}" placeholder="Search for FAQ’s" class="form-control border">
                        <div class="input-group-append ms-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                @if(isset($faqs) && !empty($faqs) && $faqs->count())
                    <div class="accordion custom-accordionwitharrow" id="accordionExample">
                        @foreach ($faqs as $faq)
                            <div class="card mb-1 shadow-none border">

                                <a href="javascript:;" class="text-dark collapsed" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" aria-expanded="false" aria-controls="collapse-{{$faq->id}}">
                                    <div class="card-header" id="heading-{{$faq->id}}">
                                        <h5 class="m-0 font-size-16">
                                            {{$faq->question}} <i class="uil uil-angle-down float-right accordion-arrow"></i>
                                        </h5>
                                    </div>
                                </a>

                                <div id="collapse-{{$faq->id}}" class="collapse" aria-labelledby="heading-{{$faq->id}}" data-parent="#accordionExample">
                                    <div class="card-body text-muted">
                                        {!! Helper::convertInHtml($faq->answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $faqs->onEachSide(1)->appends(['search' => $search ?? ""])->links() }}
                    </div>
                @else
                    <div class="no-items text-center">{{__('app.FAQ_is_not_found')}}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
