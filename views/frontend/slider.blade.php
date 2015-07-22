<div class="slider" ng-controller="sliderCtrl" spinner-on-load>

    <ul ng-repeat="(i, slide) in slides">
            <li ng-show="i === currentIndex" class="slide" style="background-image:url(' %% slide.large_thumb %% ')"><div class="back_slide"></div></li>
            <div ng-show="i === currentIndex" class="container">
                <div class="col-xs-8 col-sm-8 col-md-12 content_slide" ng-bind-html="slide.description_<?php echo App::getLocale(); ?>">

                </div>
            </div>
    </ul>




    <a class="arrow_left" href="" ng-click="prev()">
        <i class="fa fa-angle-left fa-inverse fa-5x"></i>
    </a>

    <a class="arrow_right" href="" ng-click="next()"><i class="fa fa-angle-right fa-inverse fa-5x"></i></a>

    <div class="navigator">
        <nav class="nav">
            <div class="">
                <ul class="dots ">
                    <li ng-repeat="(i,slide) in slides">
                        <a class="dot" href="" ng-class="{'active':isCurrentSlideIndex($index)}"
                           ng-click="setCurrentSlideIndex($index);"></a></li>
                </ul>
            </div>
        </nav>
    </div>


</div>

<div class="navigator-bar" ng-controller="sliderCtrl">
    <progressbar value="interval"></progressbar>
</div>





