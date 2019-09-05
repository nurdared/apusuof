@extends('layouts/app')
@section('welcome')
<div class="jumbotron jumbotron-fluid text-center" style="background-image: url('/storage/images/bg-home.jpg');
                                          background-size: cover;
                                          padding-top: 100px;
                                          padding-bottom: 150px;
                                          ">
    <img src="/storage/images/logo.png" style="width: 10em" class="img img-fluid" alt="">
    <h1 class="text-light">Welcome To APU | SUOF!</h1>
    <p class="text-light h5">This is the Student Union Online forum for the APU student</p>
    <p>
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
    </p>
    <div class="container">
        <h4 class="text-justify text-white">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form
            of a document without relying on meaningful content (also called greeking). Replacing the actual content with
            placeholder text allows designers to design the form of the content before the content itself has been produced.
    
            The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin
            text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.
    
            A variation of the ordinary lorem ipsum text has been used in typesetting since the 1960s or earlier, when it
            was popularized by advertisements for Letraset transfer sheets. It was introduced to the information age in the
            mid-1980s by Aldus Corporation, which employed it in graphics and word-processing templates for its desktop
            publishing program PageMaker. Many popular word processors use this format as a placeholder. Some examples </h4>
    </div>
</div>
@endsection