<div class="footer hidden-print">
    <div class="footer-inner">
        <div class="footer-content">
            <span class="bigger-120">
                @if(isset($generalSetting->copyright))
                    @if(isset($generalSetting->institute))
                        <span class="blue bolder"><a href="{{isset($generalSetting->website)?$generalSetting->website:'#'}}">{{$generalSetting->institute}}</a></span>
                    @endif
                    &copy;
                    {!! $generalSetting->copyright !!}
                @else
                    <span class="blue bolder"><a href="https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988">Unlimited Edu Firm</a></span>
                    &copy;
                    <a href="http://businesswithtechnology.com" target="_blank">Business With Technology Pvt. Ltd.</a>
                @endif
            </span>
        </div>
    </div>
</div>

