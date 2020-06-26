@extends('layouts.web.common')

@section('content')
<div class="blank"></div>
<article>
  <div class="leftbox">
    <div class="infos">
      <div class="newsview">
        <h2 class="intitle">您现在的位置是：<a href="/">网站首页</a>&nbsp;&gt;&nbsp;<a href="/">学无止境</a></h2>
        <h3 class="news_title">作为一个设计师,如果遭到质疑你是否能恪守自己的原则?</h3>
        <div class="news_author"><span class="au01">杨青</span><span class="au02">2018-03-18</span><span class="au03">共<b>309</b>人围观</span></div>
        <div class="tags"><a href="/">中兴</a> <a href="/" target="_blank">咔咔</a> <a href="/" target="_blank">MWC</a> <a href="/" target="_blank">小蚁</a> <a href="/" target="_blank">运动相机</a></div>
        <div class="news_about"><strong>简介</strong>description</div>
        <div class="news_infos">
          content
        </div>


        <div class="nextinfo">
          <p>上一篇：<a href="/" >传微软将把入门级Surface平板价格下调150美元</a></p>
          <p>下一篇：<a href="/">云南之行――大理洱海一日游</a></p>
        </div>
    {{--<div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        <li><a href="/" title="云南之行――丽江古镇玉龙雪山">云南之行――丽江古镇玉龙雪山</a></li>
        <li><a href="/" title="云南之行――大理洱海一日游">云南之行――大理洱海一日游</a></li>
        <li><a href="/" target="_blank">住在手机里的朋友</a></li>
        <li><a href="/" target="_blank">豪雅手机正式发布! 在法国全手工打造的奢侈品</a></li>
        <li><a href="/" target="_blank">教你怎样用欠费手机拨打电话</a></li>
        <li><a href="/" target="_blank">原来以为，一个人的勇敢是，删掉他的手机号码...</a></li>
      </ul>
    </div>
    <div class="news_pl">
      <h2>文章评论</h2>
      <ul>
      </ul>
    </div>--}}
  </div>
  </div>
  </div>

  <div class="rightbox">
    @component('components.search')
    @endcomponent

    @component('components.list', ['list' => $recommend_list, 'title' => '置顶推荐'])
    @endcomponent

    @component('components.list', ['list' => $click_list, 'title' => '置顶推荐'])
    @endcomponent

    @component('components.link')
    @endcomponent
    {{--<div class="weixin">
      <h2 class="ab_title">微信关注</h2>
      <ul>
        <img src="images/wx.jpg">
      </ul>
    </div>--}}
  </div>
  <div class="blank"></div>
</article>
@endsection
