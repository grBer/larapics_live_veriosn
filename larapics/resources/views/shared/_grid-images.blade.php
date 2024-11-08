<div class="row" ><!--within this div with class 'row', was a " data-masonry='{"percentPosition": false }' " which i removed due to css problems on loading images, you can add it if want-->
    @foreach ($images as $image)
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <a href="{{$image->permalink()}}">
                    <img src="{{$image->fileUrl()}}" alt="{{$image->title}}" class="card-img-top">
                </a>                                             
            </div>
        </div>
    @endforeach
</div>
{{$images->links()}}