@extends($page->getTemplate()->getView())

@section('layout')
    <div class="container-fluid bg-radial layout">
        <div class="row">
            @include('pixii::includes.navbar')
        </div>
        <div class="row content-row">
            <div class="col-2">
                @isset($sidebar)
                    @block($sidebar)
                @endisset
            </div>
            <div class="col-10">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-7">
                            <main>
                                <div class="container-fluid content-container">
                                    @include('pixii::includes.blocks')
                                </div>
                            </main>
                        </div>
                        <nav class="col-3 table-of-contents-container">
                            <div class="table-of-contents-sticky">
                                <div class="section-title">ON THIS PAGE</div>
                                <ul id="table-of-contents">
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
