<link rel="stylesheet" href="css/index.css">
<link rel="icon" href="img/web_icon.jpg">

<body style="margin:0px;">
  <!-- calling the header file -->
  <?php
  require 'header.php';
  ?>

  <inside >

  <div class="info" >
    <span>
    <strong>  مساعد الطالب </strong>
    </br>
موقع  مختص لمساعدة طلاب الجامعات خلال حياتهم الجامعية من خلال توفير مصادر دراسية جيدة وتقديم المساعدة في بناء الجدول الفصلي
    </span>
  </div>

  <div class="calculate">
    <img src="img/calculate.jpg" alt="" class="sideimg">
    <div id="firefly" class="text">
      <span>
        <strong>احسب </strong>
      </br>
        اعرف اهم المواد التي يجب عليك اختيارها لهذا الفصل باستخدام الية حساب متقدمة تعمل على ترديب المواد حسب اهميتها
        وضرورة اجتيازها خلال هذا الفصل
        </br>
        <a class="btn" href="calc.php" style="color:white;cursor:pointer">
          ...المزيد
        </a>
      </span>
    </div>
  </div>

  <div class="coursetrack">
    <div id="firefly" class="text">
      <span>
        <strong>تابع</strong>
      </br>
        تستطيع متابعة المواد التي قمت باجتيازها ومعرفة المواد المتاحة لك بسهولة ما عليك سوا التسجيل في الوقع ثم اختيار جميع المواد
        التي قمت باجتيازها
      </br>
      <a class="btn2" href="profile.php?user=<?php echo $user_name ?>" style="color:white;cursor:pointer">
        ...المزيد
      </a>
      </span>
    </div>
    <img src="img/coursestrack.jpg" alt="" class="sideimg">
  </div>
  <!-- This state panel will be improved to be auto updated -->
  <div class="stats">
    <div class="course-stat">
      <br><br><br><br>
      <span>94</span>
      <span>Courses</span>
    </div>

    <div class="major-stat">
      <br><br><br><br>
      <span>1</span>
      <span>Majors</span>
    </div>

    <div class="uni-stat">
      <br><br><br><br>
      <span>1</span>
      <span>Universities</span>
    </div>

    <div class="user-stat">
      <br><br><br><br>
      <span>4</span>
      <span>Students</span>
    </div>
  </div>

  <div class="discuss">
    <img src="img/discuss.jpg" alt="" class="sideimg">
    <div id="firefly" class="text">
      <span>
        <strong>ناقش </strong>
      </br>
        تواصل مع طلاب اخرين من نفس جامعتك لمعرفة المزيد عن المواد واستفد من خبرات طلاب السنوات السابقة لمعرفة المواد التي تناسبك
      </br>
      <a class="btn3" href="commentMainPage.php" style="color:white;cursor:pointer">
        ...المزيد
      </a>
      </span>
    </div>
  </div>


  <br><br><br>
</inside>

  <!-- calling the footer -->
  <?php
  require 'footer.html';
  ?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="text/javascript" src="helper/jquery.firefly-0.7.js"></script>

</body>
