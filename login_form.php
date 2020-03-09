<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" href="./css/join_css.css">
  </head>
  <body>
    <header>
      	<?php include "./header.php";?>
    </header>
    <section>
      <div id="main_content">
        <div id="inner_main" style="margin: -74px 0 0 -150px">
          <h4 id="main_title">로그인</h4>
          <form name="login_form" action="./login.php" method="post">
            <input type="radio" name="member" value="" checked>회원
            <input type="radio" name="member" value="">비회원(주문조회)<br>
            <div class="div-float">
              <input id="userId" name="userId" placeholder="visitSeoul 아이디" size="30px" type="text" style="margin:3px"><br>
              <input id="userPw" type="password" name="userPw" size="30px" value="" style="margin:3px"><br>
              <input type="checkbox" name="" value="" style="margin-top:7px; margin-bottom:12px;">아이디저장
            </div>
            <div class="div-float">
              <input id="big-login" type="button" name="" value="로그인" onclick="check_input();"><br>
              <div id="otp-login">
                <a href="#"> OTP 로그인 <img src=./image/question.png width="13px" height="13px"></img></a>
              </div>
            </div>
          </form>
          <div id="btns-bottom">
            <button type="button" name="button"><a href="./join_form.php">회원가입</a></button>
            <button type="button" name="button"><a href="#">아이디 찾기</a></button>
            <button type="button" name="button"><a href="#">비밀번호 찾기</a></button>
          </div>
        </div>
      </div>
    </section>
    <footer>
     	<?php include "./footer.php";?>
    </footer>
    <script>
    function check_input()
    {
        if (!document.getElementById("userId").value)
        {
            alert("아이디를 입력하세요");
            document.getElementById("userId").focus();
            return;
        }

        if (!document.getElementById("userPw").value)
        {
            alert("비밀번호를 입력하세요");
            document.getElementById("userPw").focus();
            return;
        }
        document.login_form.submit();
    }
    </script>
  </body>
</html>
