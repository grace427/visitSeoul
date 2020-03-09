// 모든 문서가 로딩이 되면 자동으로 실행해주는 함수
$(function () {
  // slideshow 하나만 $로 찾은 다음에 그걸로 다른 것을 찾기 때문에 속도 개선하는 좋은 방법이다.
  var slideshow = $('.slideshow'),
      slideshow_slides = slideshow.find('.slideshow_slides'),
      slides = slideshow_slides.find('a'),  //각 <a> 들이 배열로 들어있다
      slidesCount = slides.length,
      nav = slideshow.find('.slideshow_nav'),
      prev = nav.find('.prev'),
      next = nav.find('.next'),
      currentIndex = 0, // 현재 슬라이드를 첫번째 화면으로 셋팅하기 위한 변수
      indicator = slideshow.find('.indicator'),
      interval = 2000, // 자동슬라이드 변환시간
      timer = null, // setInterval객체를 받을 변수
      incrementValue = 1;
  // 이벤트 처리 : 슬라이드 가로로 배치
  // 슬0 0%, 슬1 100%, 슬2 200%, 슬3 300% 왼쪽으로
  slides.each(function(i){
    var newLeft = i*100+'%';
    $(this).css({left : newLeft});
  });

  // 이벤트 처리 : 네비게이션
  prev.click(function(e){
    console.log('새로 만든 로그');
  });



  // 슬라이드 화면이동하는 함수
  function gotoSlide(index){
    slideshow_slides.animate({left: -100*index+'%'}, 1000, 'easeInOutExpo');
    currentIndex = index;
    if(currentIndex === 0){

      prev.addClass('disabled');
    }else{
      prev.removeClass('disabled');
    }

    if(currentIndex === slidesCount-1){
      next.addClass('disabled');
    }else{
      next.removeClass('disabled');
    }

    indicator.find('a').removeClass('active');
    indicator.find('a').eq(currentIndex).addClass('active');
  }


  // prev.click(function(event){
  //   console.log('이전값을 클릭');
    // event.preventDefault(); // <a> 태그가 가지고 있는 기본 기능 막기(마우스 올리면 손바닥 나오는거)
    // if(currentIndex !== 0){
    //   currentIndex -= 1;
    // }
    // gotoSlide(currentIndex);
  // });

  next.click(function(event){
    event.preventDefault(); // <a> 태그가 가지고 있는 기본 기능 막기(마우스 올리면 손바닥 나오는거)
    if(currentIndex == slidesCount-1){
      currentIndex += 1;
    }
    gotoSlide(currentIndex);
  });

  // 인디케이터로 움직이기
  indicator.find('a').click(function(event){
    event.preventDefault();
    var point = $(this).index();
    gotoSlide(point);
  });

  // 자동 슬라이드
  function autoDisplayStart(){
    timer = setInterval(function(){
      if(currentIndex === 3) incrementValue = -1;
      if(currentIndex === 0) incrementValue = 1;
      var nextIndex = (currentIndex + incrementValue) % slidesCount;
      gotoSlide(nextIndex);
    }, interval);
  }
  function autoDisplayStop(){
    clearInterval(timer);
  }
  slideshow.mouseenter(function(event){
    autoDisplayStop();
  });
  slideshow.mouseleave(function(event){
    autoDisplayStart();
  });
  autoDisplayStart(); // 제일 처음에 화면 시작하면 나오는 0번째 그림에 prev 안보이게 하기
});
