@extends($page->getTemplate()->getView())

@section('layout')
    @include('pixii::includes.navbar')
    <main>
        @include('pixii::includes.blocks')
    </main>
@endsection
