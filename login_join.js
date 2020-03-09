  // 회원가입

  $(document).ready(function(){
    let id = document.getElementById("input-id");
    let pw1 = document.getElementById("input-pw1");
    let pw2 = document.getElementById("input-pw2");
    let name = document.getElementById("input-name");
    let nickname = document.getElementById("input-nickname");
    let email = document.getElementById("input-email");
    let tel = document.getElementById("input-tel");
    let mobile = document.getElementById("input-mobile");
    let auto_check = document.getElementById("auto-check");

    let id_pattern = /^[\w]{3,}$/;
    let pw_pattern = /^[\w]{6,10}$/;
    let name_pattern = /^[가-힣]{2,4}|[a-zA-Z]{1}[a-zA-Z\x20]{1,9}$/;
    let nickname_pattern = /^[\w가-힣]{4,}$/;
    let email_pattern = /^[a-z0-9_+.-]+@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/;
    let tel_pattern = /^\d{2,3}-\d{3,4}-\d{4}$/;
    let mobile_pattern = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;

    validate(id, id_pattern, " 아이디는 영문자, 숫자, _만 입력 가능. 최소 3자 이상 입력하세요.");
    validate(pw1, pw_pattern, " 비밀번호는 영문자와 숫자 6~10자리입니다");
    check_pw(pw2, pw1, " 비밀번호가 일치하지 않습니다");
    validate(name, name_pattern, " 이름은 영문자(2~10), 한글(2~4)으로 입력해주세요");
    validate(nickname, nickname_pattern, " 닉네임은 공백없이 한글,영문,숫자만 4자 이상으로 입력해주세요");
    validate(email, email_pattern, " 양식에 맞게 이메일을 작성해주세요");
    validate(tel, tel_pattern, " -를 포함하여 전화번호 형식을 맞춰주세요");
    validate(mobile, tel_pattern, " -를 포함하여 휴대폰번호 형식을 맞춰주세요");
    check_pw(auto_check, '378291', "자동등록방지 문자를 다시 입력해주세요");
  });


const validate = (userinput, pattern, message) => {
  userinput.nextSibling.style.color = "tomato";
  $(userinput).blur(function(){
    let userinputVal = userinput.value;
    let key = userinput.parentElement.parentElement.childNodes[1].textContent;
    // 아무것도 입력하지 않았을 경우
    if(userinputVal === ""){
      userinput.nextSibling.innerHTML = key + "를 입력해주세요.";
    // 패턴과 매치되지 않을 경우
    }else if(!userinputVal.match(pattern)){
      userinput.nextSibling.innerHTML = message;
      // console.log("전",userinputVal);
      // userinputVal="";
      // console.log("후",userinputVal);
      userinput.focus();
    // 패턴과 매치될 경우
    }else{
      if(userinput !== document.getElementById("input-id")){
        userinput.nextSibling.innerHTML = "";
      }else{
        $.ajax({
          url: "member_check_id.php?id="+userinputVal,
          type: "get",
          success: function(data){
            if(data == '1'){
              userinput.nextSibling.innerHTML = "이미 사용중인 아이디입니다.";
            }else{
              userinput.nextSibling.innerHTML = "사용 가능한 아이디입니다.";
            }
          },
          error: function(){
            console.log("ajax 실패");
          }
        });
      }
    }
  });
}
const check_pw = (pw2, pw1, message) =>{
  pw2.nextSibling.style.color = "tomato";
  $(pw2).blur(function(){
    let userinputVal = pw2.value;
    let key = pw2.parentElement.parentElement.childNodes[1].textContent;
    // 아무것도 입력하지 않았을 경우
    if(userinputVal === ""){
      pw2.nextSibling.innerHTML = " 입력이 되지 않았습니다.";
    // 비밀번호와 비밀번호 확인이 같지 않을 경우
    }else if (userinputVal !== pw1.value) {
      pw2.nextSibling.innerHTML = message;
      // userinput= "";
      pw2.focus();
    // 비밀번호를 동일하게 잘 입력했을 경우
    }else {
      pw2.nextSibling.innerHTML = "";
    }
  });
}


execPostcode = () => {
  new daum.Postcode({
    oncomplete: function(data) {
      // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드
      document.getElementById("zipcode").value = data.zonecode;
      document.getElementById("addr1").value = data.roadAddress;
    }
  }).open();
}
