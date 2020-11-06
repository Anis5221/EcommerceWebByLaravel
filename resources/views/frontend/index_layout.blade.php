@extends('welcome')
@section('category_slider_brand')
<?php 
$all_active_slider = App\Models\Slider::where('publication_status', 1)->get();
?>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($all_active_slider as $key=>$item)

                        <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="active"></li>
                        @endforeach
                    </ol>
                    
                    <div class="carousel-inner">
                        @foreach ($all_active_slider as $item)
                            
                        @if ($loop->first)
                        <div class="item active">
                        @else
                        <div class="item">
                        @endif
                        
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{URL::to($item->slider_image)}}" class="girl img-responsive" alt="" />
                                <img src="{{URL::to("frontend/images/home/pricing.png")}}"  class="pricing" alt="" />
                            </div>
                        </div>
                        @endforeach

                        
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section><!--/slider-->

            <?php
                  $all_active_category = App\Models\Categorie::where('publication_status', 1)->get();
            ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach ($all_active_category as $category)
                            
                        
                        <div class="panel panel-default">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{("/product_by_category/".$category->categorie_id)}}">{{ $category->categorie_name }}</a></h4>
                                </div>
                            </div>
                            
                        </div>
                        @endforeach
                    </div><!--/category-products-->
                <?php 
                    $all_active_brand = App\Models\Manufecture::all();
                ?>
                    <div class="brands_products"><!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach ($all_active_brand as $item)
                                    
                                <li><a href="{{("/product_by_manufecture/".$item->manufecture_id)}}"> <span class="pull-right">(50)</span>{{ $item->manufecture_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!--/brands_products-->
                    
                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->
                    
                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{URL::to("frontend/images/home/shipping.jpg")}}" alt="" />
                    </div><!--/shipping-->
                
                </div>
            </div>
            
            <div class="col-sm-9 padding-right">
                <!--features_items-->
                    @yield('container')
                
                    
                <!--/recommended_items-->
                
            </div>
        </div>
    </div>
</section>

@endsection
