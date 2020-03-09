<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" href="./css/join_css.css">
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
  </head>
  <body>
    <header>
      <?php include "./header.php";?>
    </header>
    <section>
      <div id="main_content">
        <div id="inner_main" style="margin: -74px 0 0 -400px">
          <form id="join_form" action="./member_insert.php"  name="joinPlease" method="post">
          <h4 id="main_title">회 원 가 입</h4>
            <div class="title-table">사이트 이용정보 입력</div>
            <table>
              <tr>
                <td class="col-key">아이디</td>
                <td>영문자, 숫자, _만 입력 가능. 최소 3자 이상 입력하세요.<br>
                  <input id="input-id" type="text" name="id" value="" required><span></span>
                  <!-- <input type="button" value="중복확인" onclick="check_id();"> -->
                  </td>
              </tr>
              <tr>
                <td class="col-key">비밀번호</td>
                <td><input id="input-pw1" name="pw1" type="password" title="비밀번호는 영문자와 숫자 6~10자리입니다" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">비밀번호 확인</td>
                <td><input id="input-pw2" type="password" name="pw2" value="" required><span></span></td>
              </tr>
            </table>

            <div class="title-table">개인정보 입력</div>
            <table>
              <tr>
                <td class="col-key">이름</td>
                <td><input id="input-name" type="text" name="name" value="" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">닉네임</td>
                <td>공백없이 한글,영문,숫자만 입력 가능(4글자 이상)<br>닉네임을 바꾸시면 앞으로 1일 이내에는 변경 할 수 없습니다.<br>
                  <input id="input-nickname" type="text" name="nickname" value="" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">E-mail</td>
                <td><input id="input-email" type="email" name="email" value="" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">가입경로</td>
                <td>
                  <input type="radio" name="joinRoute" value="인터넷검색">인터넷검색
                  <input type="radio" name="joinRoute" value="배너광고">배너광고
                  <input type="radio" name="joinRoute" value="관련기사를 보고">관련기사를 보고
                  <input type="radio" name="joinRoute" value="미라지 홈페이지 보고">미라지 홈페이지 보고
                  <input type="radio" name="joinRoute" value="주변사람 소개">주변사람 소개
                  <input type="radio" name="joinRoute" value="기타" checked>기타
                </td>
              </tr>
              <tr>
                <td class="col-key">전화번호</td>
                <td><input id="input-tel" type="tel" name="tel" value="" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">휴대폰번호</td>
                <td><input id="input-mobile" type="tel" name="mobile" value="" required><span></span></td>
              </tr>
              <tr>
                <td class="col-key">생년월일</td>
                <td><input type="date" name="date" value=""></td>
              </tr>
              <tr>
                <td class="col-key">주소</td>
                <td id="input-address">
                  <input type="address" id="zipcode" name="zipcode" value="" size="4px" required >
                  <input id="btn-searchAddr" type="button" value="주소 검색" onclick="execPostcode();"><br>
                  <input type="address" id="addr1" value="" name="addr1" size="35px" required readonly="readonly"> 기본주소<br>
                  <input type="address" id="addr2" value="" name="addr2" size="35px"> 상세주소<br>
                  <input type="address" name="addr3" value="" size="35px"> 참고항목
                </td>
              </tr>
            </table>

            <div class="title-table">기타 개인설정</div>
            <table>
              <tr>
                <td class="col-key">카카오톡 메세지</td>
                <td style="font-weight:bold"><input type="checkbox" name="checkInfo[]" value="카카오톡 메세지" checked>카카오톡 메세지를 받겠습니다.<span style="color:tomato"> >수신체크를 하시면 세일 소식을 가장 먼저 받아보실 수 있습니다.</span></td>
              </tr>
              <tr>
                <td class="col-key">메일링서비스</td>
                <td><input type="checkbox" name="checkInfo[]" value="정보 메일" checked>정보 메일을 받겠습니다.</td>
              </tr>
              <tr>
                <td class="col-key">SMS 수신여부</td>
                <td><input type="checkbox" name="checkInfo[]" value="SMS 메세지" checked>휴대폰 문자메세지를 받겠습니다.</td>
              </tr>
              <tr>
                <td class="col-key">정보공개</td>
                <td>정보공개를 바꾸시면 앞으로 0일 이내에는 변경이 안됩니다.<br><input type="checkbox" name="checkInfo[]" value="정보 공개 YES" checked>다른 분들이 나의 정보를 볼 수 있도록 합니다.</td>
              </tr>
              <tr>
                <td class="col-key">자동등록방지</td>
                <td>
                  <div style="width:300px; height:40px;">
                  <img src="./image/prevent_auto.jpg" width="120px" height="50px" style="float:left;">
                  <input id="auto-check" style="width:90px; height:48px; float:left;" type="text" name="" value="" required><span></span><br>
                  </div><br>
                  자동등록방지 숫자를 순서대로 입력하세요.
                </td>
              </tr>
            </table>
            <div id="btns-submit">
              <!-- <button type="submit" id="btn-join" onclick="joinMember();">회원가입</button> -->
              <button type="submit" id="btn-join" name="button" onclick="document.getElementById('join_form').submit();">회원가입</button>
              <input id="btn-cancel" type="reset" name="" value="취소" onclick="reset();">
            </div>
        </form>
       </div>
      </div>
    </section>
    <footer>
      <?php include "./footer.php";?>
    </footer>
  <script src="./login_join.js"></script>
  </body>
</html>
